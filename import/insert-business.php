<?php include "../private/settings.php";


function getStateId($id)
{
	global $database;
	$sql="select * from tbl_states where state_name='".$database->filter($id)."'";
	$res=$database->get_results($sql);
	$row=$res[0];
	$stateId=$row['state_id'];
	return $stateId;
	
}

function getParentCatId($subcats)
{
	global $database;
	 $sql="select * from tbl_business_category where bc_id in (".$subcats.")";
	$res=$database->get_results($sql);
	for ($k=0;$k<count($res);$k++)
	{
		$row=$res[$k];
		$sqlParent="select * from tbl_business_category where bc_id='".$row['bc_id']."'";
		$resParent=$database->get_results($sqlParent);
		if (count($resParent)>0)
		{
			$rowParent=$resParent[0];
			if ($rowParent['bc_parent_id']==0)
			{
				$parentId=$rowParent['bc_id'];
				return $parentId;
				
			}
		}
		
		
	}
	if ($parentId=="")
	{
		$row=$res[0];
		$sqlParent="select bc_parent_id from tbl_business_category where bc_id='".$row['bc_id']."'";
		$resParent=$database->get_results($sqlParent);
		$rowParent=$resParent[0];
		$parentId=$rowParent['bc_parent_id'];
		return $parentId;
	}
}

function getAgentId($phone)
{
	global $database;
	 $sql="select * from tbl_member_agents where agent_mobile='".$database->filter($phone)."'";
	$res=$database->get_results($sql);
	$row=$res[0];
	$agentId=$row['agent_id'];
	return $agentId;
	
}

function getCategoryId($categoryName)
{
    global $database;

    // Define an array of category replacements
    $categoryReplacements = array(
        'Cleaning Services' => 'Cleaning',
        'Beverage & Hospitality' => 'Food/Beverage',
        'Professional Services' => 'Professional',
        'Food' => 'Food/Beverage',
        'Entertainment & Technology' => 'Entertainment/Tech',
        'Beauty' => 'Beauty Products',
        'Health & Fitness' => 'Health/Beauty',
		'Shop & Retail' => 'Retail',
		'Distribution & Storage' => 'Transport/Distribution',
		'Hairdresser' => 'Hair',
		'Export & Wholesale' => 'Export',
		'Franchise Resale' => 'Franchise',
		'Grocery & Alcohol' => 'Alcohol/Liquor',
		'Automotive & Marine' => 'Automotive',
		'Aquatic / Marine / Marina Berth' => 'Aquatic/Marine',
		'Advertising / Marketing' => 'Advertising/Mkting',
		'Veg & Fresh Produce' => 'Fruit/Veg',
		'Music Related' => 'Music Video',
		'Photo Printing' => 'Print/Photo',
		'Rural & Farming' => 'Farming',
		'Paper / Printing' => 'Print/Photo',
		
	
		
		
        // Add more replacements as needed
        // 'Original Name' => 'Replacement Name',
    );

    // Trim and normalize the input category name
    $categoryName = trim($categoryName);

    // Check if the category name exists in the replacements array (case-insensitive)
    foreach ($categoryReplacements as $original => $replacement) {
        if (strcasecmp($categoryName, $original) === 0) {
            $categoryName = $replacement;
            break; // Stop after the first match
        }
    }

    // Normalize the category name for the SQL query
    $normalized = str_replace(['&', '/'], ['%', '%'], $categoryName); // Replace '&' and '/' with '%'
    $normalized = preg_replace('/\s+/', '%', $normalized); // Replace multiple spaces with '%'
    $normalized = '%' . $normalized . '%'; // Add wildcards to the beginning and end

    // Build and execute the SQL query
    $sqlCategory = "SELECT * FROM tbl_business_category WHERE bc_name LIKE '" . $database->filter($normalized) . "'";
    $loadCategory = $database->get_results($sqlCategory);

    // Check if any results were returned
    if (!empty($loadCategory)) {
        $rowCategory = $loadCategory[0];
        $bcId = $rowCategory['bc_id'];
        return $bcId; // Return the category ID if found
    } else {
        return $categoryName; // Return the original category name if not found
		
    }
}

$sqlBusiness="SELECT * FROM `business_db`,tbl_members where agency_phone=member_phone and agency_phone<>'' limit 9000,1000";
$resBusiness=$database->get_results($sqlBusiness);

for ($biz=0;$biz<count($resBusiness);$biz++)
{
	$rowBusiness=$resBusiness[$biz];
	
	echo "<br><br>";
	$catStr=$rowBusiness['category2'];
	$arrCat=explode(",",$catStr);
	
	$arrCatCont=array();
	
	for ($i=0;$i<count($arrCat);$i++)
	{
		array_push($arrCatCont,getCategoryId($arrCat[$i]));
		
	}
	$arrCatCont=array_unique($arrCatCont);
	
	echo "<strong>Import Id</strong>: ".$importId=$rowBusiness['id'];
	echo "<br>";
	echo "<strong>Subcategory</strong>: ".$subcategory=implode(",",$arrCatCont);
	echo "<br>";
	echo "<strong>Category</strong>: ".$category=getParentCatId($subcategory);;
	echo "<br>";
	echo "<strong>Owner Id</strong>: ".$ownerId=$rowBusiness['member_id'];
	echo "<br>";
	echo "<strong>Suburb</strong>: ".$suburb=$rowBusiness['suburb'];
	echo "<br>";
	echo "<strong>State</strong>: ".$state=$rowBusiness['state'];
	echo "<br>";
	echo "<strong>Postcode</strong>: ".$postcode=$rowBusiness['postcode'];
	echo "<br>";
	echo "<strong>Price</strong>: ".$askingprice=$rowBusiness['price'];
	echo "<br>";
	echo "<strong>Title</strong>: ".$title=$rowBusiness['title'];
	echo "<br>";
	echo "<strong>Description</strong>: ".$description=$rowBusiness['description'];
	echo "<br>";
	echo "<strong>Agent Ids</strong>: ".$agentId=getAgentId($rowBusiness['agent_mobile']);
	
	echo "<br><br>";
	echo "__________________________________";
	
	$stateId=getStateId($state);
	
	$sqlLocation="select * from tbl_locations where location_postcode='".$postcode."' and location_locality='".$suburb."' and location_state_id='".$stateId."'";	
	$resLocation=$database->get_results($sqlLocation);
	$rowLocation=$resLocation[0];
	$regionId=$rowLocation['location_region'];
	$greaterRegionId=$rowLocation['location_greater_region'];
	
	
	$currentDate = date('Y-m-d');
	$price = preg_replace('/\D/', '', $askingprice);

			$sqlB="select * from tbl_business where business_imported=1 and business_import_id='".$importId."'";
			$resB=$database->get_results($sqlB);
			
			if (count($resB)==0)
			{
			
				$names = array(
				
				'business_owner_id' => $ownerId,
				'business_suburb' => $suburb,
				'business_state' => $state,
				'business_postcode' => $postcode,				
				'business_greater_region' => $greaterRegionId,
				'business_region' => $regionId,				
				'business_address_display' => 2,
				'business_category' => $category,
				'business_subcat' => $subcategory,	
				'business_asking_price' => $askingprice,	
				'business_price' => $price,	
				'business_heading' => $title,
				'business_description' => $description,	
				'business_added_date' => $currentDate,				
				'business_plan_id' => 1,
				'business_status' => 'current',	
				'business_imported' => 1,	
				'business_import_id' => $importId
				);
				
				
							
				
				$database->insert( 'tbl_business', $names );
				$businessId=$database->lastid();
			
			
			// URL of the logo
					
	//---------image upload 1-------
	if ($rowBusiness['property_image1'] != "") {
    $image1 = $rowBusiness['property_image1'];
    $saveDirectory = "../images/business/i/";
    
    // Get the original file name without query strings
    $originalFileName = basename(parse_url($image1, PHP_URL_PATH));
    $originalFileName = strtok($originalFileName, '?');

    // Initialize cURL to fetch the image data
    $ch = curl_init($image1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects
    $data = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200 && $data !== false) {
        // Determine the image MIME type
        $imageInfo = getimagesizefromstring($data);
        if ($imageInfo !== false) {
            $mime = $imageInfo['mime'];
            $extension = "";
            // Map MIME type to file extension
            switch ($mime) {
                case 'image/jpeg':
                    $extension = '.jpg';
                    break;
                case 'image/png':
                    $extension = '.png';
                    break;
                case 'image/gif':
                    $extension = '.gif';
                    break;
                default:
                    // If MIME type is not one of the above, default to .jpg
                    $extension = '.jpg';
            }
            
            // Remove any existing extension from the original file name
            $baseName = pathinfo($originalFileName, PATHINFO_FILENAME);
            // Append a unique ID to ensure the file name is unique
            $uniqueId = uniqid();
            $fileName = $baseName . '_' . $uniqueId . $extension;
            $savePath = $saveDirectory . $fileName;

            // Save the image data to the file
            if (file_put_contents($savePath, $data)) {
                $names = array(
                    'image_business_id' => $businessId,
                    'image_local'       => $fileName,
                    'image_mod_date'    => $currentDate
                );
                $database->insert('tbl_business_images', $names);
            }
        }
    }
}


					
					//--------end image upload 1--------
					
		
		//---------image upload 2-------
	if ($rowBusiness['property_image2'] != "") {
    $image1 = $rowBusiness['property_image2'];
    $saveDirectory = "../images/business/i/";
    
    // Get the original file name without query strings
    $originalFileName = basename(parse_url($image1, PHP_URL_PATH));
    $originalFileName = strtok($originalFileName, '?');

    // Initialize cURL to fetch the image data
    $ch = curl_init($image1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects
    $data = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200 && $data !== false) {
        // Determine the image MIME type
        $imageInfo = getimagesizefromstring($data);
        if ($imageInfo !== false) {
            $mime = $imageInfo['mime'];
            $extension = "";
            // Map MIME type to file extension
            switch ($mime) {
                case 'image/jpeg':
                    $extension = '.jpg';
                    break;
                case 'image/png':
                    $extension = '.png';
                    break;
                case 'image/gif':
                    $extension = '.gif';
                    break;
                default:
                    // If MIME type is not one of the above, default to .jpg
                    $extension = '.jpg';
            }
            
            // Remove any existing extension from the original file name
            $baseName = pathinfo($originalFileName, PATHINFO_FILENAME);
            // Append a unique ID to ensure the file name is unique
            $uniqueId = uniqid();
            $fileName = $baseName . '_' . $uniqueId . $extension;
            $savePath = $saveDirectory . $fileName;

            // Save the image data to the file
            if (file_put_contents($savePath, $data)) {
                $names = array(
                    'image_business_id' => $businessId,
                    'image_local'       => $fileName,
                    'image_mod_date'    => $currentDate
                );
                $database->insert('tbl_business_images', $names);
            }
        }
    }
}


					
					//--------end image upload 2--------
					
					
	
		//---------image upload 3-------
	if ($rowBusiness['property_image3'] != "") {
    $image1 = $rowBusiness['property_image3'];
    $saveDirectory = "../images/business/i/";
    
    // Get the original file name without query strings
    $originalFileName = basename(parse_url($image1, PHP_URL_PATH));
    $originalFileName = strtok($originalFileName, '?');

    // Initialize cURL to fetch the image data
    $ch = curl_init($image1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects
    $data = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200 && $data !== false) {
        // Determine the image MIME type
        $imageInfo = getimagesizefromstring($data);
        if ($imageInfo !== false) {
            $mime = $imageInfo['mime'];
            $extension = "";
            // Map MIME type to file extension
            switch ($mime) {
                case 'image/jpeg':
                    $extension = '.jpg';
                    break;
                case 'image/png':
                    $extension = '.png';
                    break;
                case 'image/gif':
                    $extension = '.gif';
                    break;
                default:
                    // If MIME type is not one of the above, default to .jpg
                    $extension = '.jpg';
            }
            
            // Remove any existing extension from the original file name
            $baseName = pathinfo($originalFileName, PATHINFO_FILENAME);
            // Append a unique ID to ensure the file name is unique
            $uniqueId = uniqid();
            $fileName = $baseName . '_' . $uniqueId . $extension;
            $savePath = $saveDirectory . $fileName;

            // Save the image data to the file
            if (file_put_contents($savePath, $data)) {
                $names = array(
                    'image_business_id' => $businessId,
                    'image_local'       => $fileName,
                    'image_mod_date'    => $currentDate
                );
                $database->insert('tbl_business_images', $names);
            }
        }
    }
}


					
					//--------end image upload 3--------
					
					
		//---------image upload 4-------
	if ($rowBusiness['property_image4'] != "") {
    $image1 = $rowBusiness['property_image4'];
    $saveDirectory = "../images/business/i/";
    
    // Get the original file name without query strings
    $originalFileName = basename(parse_url($image1, PHP_URL_PATH));
    $originalFileName = strtok($originalFileName, '?');

    // Initialize cURL to fetch the image data
    $ch = curl_init($image1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects
    $data = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200 && $data !== false) {
        // Determine the image MIME type
        $imageInfo = getimagesizefromstring($data);
        if ($imageInfo !== false) {
            $mime = $imageInfo['mime'];
            $extension = "";
            // Map MIME type to file extension
            switch ($mime) {
                case 'image/jpeg':
                    $extension = '.jpg';
                    break;
                case 'image/png':
                    $extension = '.png';
                    break;
                case 'image/gif':
                    $extension = '.gif';
                    break;
                default:
                    // If MIME type is not one of the above, default to .jpg
                    $extension = '.jpg';
            }
            
            // Remove any existing extension from the original file name
            $baseName = pathinfo($originalFileName, PATHINFO_FILENAME);
            // Append a unique ID to ensure the file name is unique
            $uniqueId = uniqid();
            $fileName = $baseName . '_' . $uniqueId . $extension;
            $savePath = $saveDirectory . $fileName;

            // Save the image data to the file
            if (file_put_contents($savePath, $data)) {
                $names = array(
                    'image_business_id' => $businessId,
                    'image_local'       => $fileName,
                    'image_mod_date'    => $currentDate
                );
                $database->insert('tbl_business_images', $names);
            }
        }
    }
}


					
					//--------end image upload 4--------
		
							
		//---------image upload 5-------
	if ($rowBusiness['property_image5'] != "") {
    $image1 = $rowBusiness['property_image5'];
    $saveDirectory = "../images/business/i/";
    
    // Get the original file name without query strings
    $originalFileName = basename(parse_url($image1, PHP_URL_PATH));
    $originalFileName = strtok($originalFileName, '?');

    // Initialize cURL to fetch the image data
    $ch = curl_init($image1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects
    $data = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200 && $data !== false) {
        // Determine the image MIME type
        $imageInfo = getimagesizefromstring($data);
        if ($imageInfo !== false) {
            $mime = $imageInfo['mime'];
            $extension = "";
            // Map MIME type to file extension
            switch ($mime) {
                case 'image/jpeg':
                    $extension = '.jpg';
                    break;
                case 'image/png':
                    $extension = '.png';
                    break;
                case 'image/gif':
                    $extension = '.gif';
                    break;
                default:
                    // If MIME type is not one of the above, default to .jpg
                    $extension = '.jpg';
            }
            
            // Remove any existing extension from the original file name
            $baseName = pathinfo($originalFileName, PATHINFO_FILENAME);
            // Append a unique ID to ensure the file name is unique
            $uniqueId = uniqid();
            $fileName = $baseName . '_' . $uniqueId . $extension;
            $savePath = $saveDirectory . $fileName;

            // Save the image data to the file
            if (file_put_contents($savePath, $data)) {
                $names = array(
                    'image_business_id' => $businessId,
                    'image_local'       => $fileName,
                    'image_mod_date'    => $currentDate
                );
                $database->insert('tbl_business_images', $names);
            }
        }
    }
}


					
					//--------end image upload 5--------

					
					
					
					
					
		}
		

	}





?>