<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";


		$sql = "select * from tbl_business,tbl_members where business_owner_id=member_id and business_owner_id='".$database->filter($_SESSION['sess_member_id'])."'";


		if ($_GET['status']==1)
		$sql.=" and business_status='current'";
		else if ($_GET['status']==2)
		$sql.=" and business_status='draft'";
		else if ($_GET['status']==3)
		$sql.=" and business_status='offmarket'";
		else if ($_GET['status']==4)
		$sql.=" and business_status='sold'";
		else if ($_GET['status']==5)
		$sql.=" and business_status='underoffer'";
		
		

		if ($_GET['txtSearchByTitle'] != "") {
    $searchTerms = explode(" ", $_GET['txtSearchByTitle']); // Break input into words
    $searchConditions = array();

    foreach ($searchTerms as $term) {
        $term = $database->filter($term); // Filter input for safety
        $searchConditions[] = "(business_id LIKE '%" . str_replace("AB-", "", $term) . "%' 
                                OR business_name LIKE '%$term%' 
                                OR member_firstname LIKE '%$term%' 
                                OR member_lastname LIKE '%$term%' 
                                OR member_phone LIKE '%$term%' 
                                OR member_email LIKE '%$term%')";
    }

    // Combine all conditions with AND
    $sql .= " AND (" . implode(" AND ", $searchConditions) . ")";
}

		
		if($_GET['cmbCategory'] != "")

		{

			$sql .= " and (business_category='".$database->filter($_GET['cmbCategory'])."' || FIND_IN_SET(".$database->filter($_GET['cmbCategory']).", business_subcat))";

		}
		

		$sql .= " order by business_id desc";


		//print_r($sql);
		
		
		

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		

			

		showRecordsListing( $results );

		

	}

	
	
	

	function saveFormValues()

	{

	global $database, $component;

	
		  if ($_POST['txtSuburb']!="")
		  {
			  $arrSub=explode(",",$_POST['txtSuburb']);
			  $suburb=$arrSub[0];
			  $state=$arrSub[1];
			  $postcode=$arrSub[2];
			  
		  }
  
   
    $category = '';
	if (!empty($_POST['cmbCategory'])) {
        $filteredCategories = array_filter($_POST['cmbCategory']);
    	$category = implode(",", $filteredCategories);
	}
	
	$subCat = '';
	if (!empty($_POST['cmbSubCategory'])) {
	
	$filteredSubCategories = array_filter($_POST['cmbSubCategory']);
    $subCat = @implode(",", $filteredSubCategories);
	}
	
	
	$curDate = date("Y-m-d H:i:s");	
	$street=$_POST['txtAddress'];
	$address=$_POST['txtAddress']." ".$suburb.", ".$state.", ".$postcode;		
	$addressDisplay=$_POST['rdAddressDisp'][0];		
	$regionArray=getRegionId($_POST['hdRegion']);		
	$regionId=$regionArray['region_id'];
	$greaterRegionId=$regionArray['region_greater_region'];	
	$selectedValues = isset($_POST['rdAdType']) ? $_POST['rdAdType'] : array();
	$adType = implode(',', $selectedValues); // This becomes "Independent Business,Franchise" etc.
	
	
	$selectedAgents = isset($_POST['rdAgent']) ? $_POST['rdAgent'] : array();
	$adAgents = implode(',', $selectedAgents);

	if ($_POST['cmbPriceDisplay']==3)
	$priceViewval=$_POST['txtPriceViewVal'];
	else
	$priceViewval="";
	
	if ($_POST['is_draft']==1)
	$status="draft";
	else
	$status="current";

		$curDate=date("Y-m-d");
		$names = array(
			'business_owner_id' => $_SESSION['sess_member_id'],
			'business_heading' => $_POST['txtHeading'],
			'business_description' => $_POST['txtDescription'],				
			'business_agent_id' => $adAgents,
			'business_ad_type' => $adType,		
			'business_street' => $street, 
			'business_address' => $address, 			
			'business_suburb' => $suburb,
			'business_state' => $state, 
			'business_postcode' => $postcode,
			'business_region' => $regionId,
			'business_greater_region' => $greaterRegionId,
			'business_address_display' => $addressDisplay,			
			'business_category' => $category,
			'business_subcat' => $subCat,
			'business_property_included' => $_POST['cmbPropertyWithBus'],	
			'business_asking_price' => $_POST['txtAskingPrice'],			
			'business_price' => $_POST['txtSearchPrice'],
			'business_price_display' => $_POST['cmbPriceDisplay'],	
			'business_price_value' => $priceViewval,
			
			'business_takings' => $_POST['cmbPeriodCount'],
			'business_takings_value' => $_POST['txtNetProfit'],
			'business_turnover' => $_POST['txtSalesRevenue'],
			'business_rent' => $_POST['txtRent'],
			'business_expenses' => $_POST['txtExpenses'],	
			
			'business_vendor_name' => $_POST['txtVendorName'],			
			'business_vendor_email' => $_POST['txtVendorEmail'],			
			'business_vendor_phone' => $_POST['txtVendorPhone'],
			
			'business_plus_stock' => $_POST['txtPlusStock'],			
			
						
			'business_added_date' => $curDate,
			'business_mod_date' => $curDate,
			'business_status' => $status,
			'business_plan_id' => 1,
			'business_active_status' => 1,
			'business_added_method_direct' => 1
		);
		
	
		$add_query = $database->insert( 'tbl_business', $names );
		$lastInsertedId=$database->lastid();
		
		
		
		
		if (!empty($_POST['images4ex'])) {			
		
			foreach ($_POST['images4ex'] as $imagesVal)
			{
				$names = array(
				'image_business_id' => $lastInsertedId, 
				'image_local' => $imagesVal,
				'image_mod_date' => $curDate,
				);
				$add_query = $database->insert( 'tbl_business_images', $names );
				
				
			}
		
		}

		$encryptOrderId=base64_encode($lastInsertedId);

	
			if ($status=="draft")
			print "<script>window.location='index.php?c=".$component."&status=2'</script>";
			else
			print "<script>window.location='index.php?c=".$component."&task=submitted&id=".$encryptOrderId."'</script>";

	

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}
	
	function fnSaveOrder()
	{
		global $database,$component;
		
		
		//echo "<br><br><br>";
		//print_r ($_POST);
		
$number_of_premium_ad_90_days = 0;
$number_of_premium_ad_180_days = 0;
$number_of_advance_ad_90_days = 0;
$number_of_advance_ad_180_days = 0;

$number_of_premium_ad_90_total_amount = 0;
$number_of_premium_ad_180_total_amount = 0;
$number_of_advance_ad_90_total_amount = 0;
$number_of_advance_ad_180_total_amount = 0;


// Loop through selected checkboxes
if (!empty($_POST['selected'])) {
    foreach ($_POST['selected'] as $selected) {
        list($key, $price) = explode('|', $selected);

        // Extract ad type, number of ads, and duration
        preg_match('/(premium|advance)_(\d+)_([0-9]+)/', $key, $matches);
        if (!$matches) continue;

        $type = $matches[1];     // 'premium' or 'advance'
        $count = (int)$matches[2]; // e.g., 5, 30
        $duration = (int)$matches[3]; // 90 or 180
        $price = (float)$price;

        // Add to corresponding counters and totals
        if ($type === 'premium' && $duration === 90) {
            $number_of_premium_ad_90_days += $count;
            $number_of_premium_ad_90_total_amount += $price;
        } elseif ($type === 'premium' && $duration === 180) {
            $number_of_premium_ad_180_days += $count;
            $number_of_premium_ad_180_total_amount += $price;
        } elseif ($type === 'advance' && $duration === 90) {
            $number_of_advance_ad_90_days += $count;
            $number_of_advance_ad_90_total_amount += $price;
        } elseif ($type === 'advance' && $duration === 180) {
            $number_of_advance_ad_180_days += $count;
            $number_of_advance_ad_180_total_amount += $price;
        }
    }
}


// Output or use your totals here


/*echo "<br><br>";

echo "Premium 90 Days: {$number_of_premium_ad_90_days} ads, Total \${$number_of_premium_ad_90_total_amount}<br>";
echo "Premium 180 Days: {$number_of_premium_ad_180_days} ads, Total \${$number_of_premium_ad_180_total_amount}<br>";
echo "Advance 90 Days: {$number_of_advance_ad_90_days} ads, Total \${$number_of_advance_ad_90_total_amount}<br>";
echo "Advance 180 Days: {$number_of_advance_ad_180_days} ads, Total \${$number_of_advance_ad_180_total_amount}<br>";

*/

$sumTotal=$number_of_premium_ad_90_total_amount+$number_of_premium_ad_180_total_amount+$number_of_advance_ad_90_total_amount+$number_of_advance_ad_180_total_amount;



		//-----Create Order-------
		
		$curDateTime = date("Y-m-d H:i:s"); 
		
		$gst=$sumTotal*10/100;
		$netTotal=$sumTotal+$gst;

		$names = array(		
			'ad_agency_id' => $_SESSION['sess_member_id'],	
			'ad_premium_90_amount' => $number_of_premium_ad_90_total_amount,			
			'ad_premium_90_qty' => $number_of_premium_ad_90_days,			
			'ad_premium_180_amount' => $number_of_premium_ad_180_total_amount,			
			'ad_premium_180_qty' => $number_of_premium_ad_180_days,			
			'ad_advance_90_amount' => $number_of_advance_ad_90_total_amount,
			'ad_advance_90_qty' => $number_of_advance_ad_90_days,			
			'ad_advance_180_amount' => $number_of_advance_ad_180_total_amount,
			'ad_advance_180_qty' => $number_of_advance_ad_180_days,
			'ad_total_amount' => $sumTotal,			
			'ad_total_gst' => $gst,
			'ad_net_total' => $netTotal,			
			'ad_order_date' => $curDateTime

		);	
		
	
		

		$add_query = $database->insert( 'tbl_ads_order', $names );		
		$lastInsertedId=$database->lastid();
		$encryptOrderId=base64_encode($lastInsertedId);
		
		$sqlCheck="select * from tbl_agency_ads_inventory where inventory_agency_id='".$database->filter($_SESSION['sess_member_id'])."'";
		$resCheck=$database->get_results($sqlCheck);
		if (count($resCheck)==0)
		{		
		$names = array(		
			'inventory_agency_id' => $_SESSION['sess_member_id'],	
			'inventory_premium_90' => $number_of_premium_ad_90_days,			
			'inventory_premium_180' => $number_of_premium_ad_180_days,
			'inventory_advanced_90' => $number_of_advance_ad_90_days,
			'inventory_advanced_180' => $number_of_advance_ad_180_days		);	

		$add_query = $database->insert( 'tbl_agency_ads_inventory', $names );
		
		
			
		}
		else
		{
			$rowCheck=$resCheck[0];
			$UpdatedPremium90=$number_of_premium_ad_90_days+$rowCheck['inventory_premium_90'];
			$UpdatedPremium180=$number_of_premium_ad_180_days+$rowCheck['inventory_premium_180'];
			$UpdatedAdvance90=$number_of_advance_ad_90_days+$rowCheck['inventory_advanced_90'];
			$UpdatedAdvance180=$number_of_advance_ad_180_days+$rowCheck['inventory_advanced_180'];
			
						
			$update = array(
			'inventory_agency_id' => $_SESSION['sess_member_id'],	
			'inventory_premium_90' => $UpdatedPremium90,			
			'inventory_premium_180' => $UpdatedPremium180,
			'inventory_advanced_90' => $UpdatedAdvance90,
			'inventory_advanced_180' => $UpdatedAdvance180

			);
					

//Add the WHERE clauses

		$where_clause = array(
			'inventory_agency_id' => $_SESSION['sess_member_id'],
		);
		$updated = $database->update( 'tbl_agency_ads_inventory', $update, $where_clause, 1 );
			
		}
		
		
 $orderSummary = '
<div style="font-family: Arial, sans-serif; color: #333333; max-width: 600px; margin: 10px auto;">
    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px;">
        
        
        <div style="margin-bottom: 15px;">';

// Premium Ad 90 days
if ($number_of_premium_ad_90_days > 0) {
    $orderSummary .= '
            <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #eeeeee;">
                <span style="color: #6a6a6a;">'.$number_of_premium_ad_90_days.' × Premium Ad (90 days)</span>
                <span style="font-weight: 500;">$'.($number_of_premium_ad_90_total_amount ?? '').'</span>
            </div>';
}

// Premium Ad 180 days
if ($number_of_premium_ad_180_days > 0) {
    $orderSummary .= '
            <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #eeeeee;">
                <span style="color: #6a6a6a;">'.$number_of_premium_ad_180_days.' × Premium Ad (180 days)</span>
                <span style="font-weight: 500;">$'.($number_of_premium_ad_180_total_amount ?? '').'</span>
            </div>';
}

// Advanced Ad 90 days
if ($number_of_advance_ad_90_days > 0) {
    $orderSummary .= '
            <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #eeeeee;">
                <span style="color: #6a6a6a;">'.$number_of_advance_ad_90_days.' × Advanced Ad (90 days)</span>
                <span style="font-weight: 500;">$'.($number_of_advance_ad_90_total_amount ?? '').'</span>
            </div>';
}

// Advanced Ad 180 days
if ($number_of_advance_ad_180_days > 0) {
    $orderSummary .= '
            <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #eeeeee;">
                <span style="color: #6a6a6a;">'.$number_of_advance_ad_180_days.' × Advanced Ad (180 days)</span>
                <span style="font-weight: 500;">$'.($number_of_advance_ad_180_total_amount ?? '').'</span>
            </div>';
}

// Summary totals
$orderSummary .= '
        </div>
        
        <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #eeeeee;">
            <span style="color: #6a6a6a;">Subtotal</span>
            <span style="font-weight: 500;">$'.$sumTotal.'</span>
        </div>
        <div style="display: flex; justify-content: space-between; padding: 8px 0; margin-bottom: 12px;">
            <span style="color: #6a6a6a;">GST</span>
            <span style="font-weight: 500;">$'.$gst.'</span>
        </div>
        
        <div style="display: flex; justify-content: space-between; background-color: #f1f8fe; padding: 12px; border-radius: 6px; margin-top: 10px;">
            <span style="font-weight: bold; color: #2c3e50;">Total to pay</span>
            <span style="font-weight: bold; font-size: 16px; color: #0066cc;">$'.$netTotal.'</span>
        </div>
    </div>
</div>';
		
		
		
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				
				//-------Fetch user information-----
				
				$sqlMember="select * from tbl_members where member_id='".$_SESSION['sess_member_id']."'";
			    $resMember=$database->get_results($sqlMember);
				$rowMember=$resMember[0];
				
				$membername=$rowMember['member_firstname']." ".$rowMember['member_lastname'];
				$memberemail=$rowMember['member_email'];
				
				
				
				//-------end fetch user information---
				
				$sqlEmail="select * from tbl_emails where email_id=55 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
				
			
				if (count($resEmail)>0)
				{
					
					
					
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);					
					$emailContent=str_replace("<name>",$membername,$emailContent);														
					$emailContent=str_replace("\n","<br>",$emailContent);
					$emailContent=str_replace("<summary_of_order>",$orderSummary,$emailContent);
					
					$headingContent=$emailContent;

					$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
					
					
				
				


				$ToEmail=$memberemail;
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend=$rowEmail['email_heading'];
				$BodySend=$mailBody;	
				
				

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
		
		
		
		
		//--------end creating ads-------
		
		print "<script>window.location='index.php?c=".$component."&cI=".$encryptOrderId."&task=upgrade&paid=1'</script>";
		




}


		function fnSubmitted($id)
			{

				global $database;
				 $sql = "SELECT * FROM tbl_business where business_id='".$database->filter(base64_decode($id))."'";
				$results = $database->get_results( $sql );
				
				createFormForPagesHtml_details($results);

			}
	

	function createFormForPages($id)
			{

				global $database;
				$sql = "SELECT * FROM tbl_business where business_id='".$database->filter($id)."'";
				$results = $database->get_results( $sql );
				
				createFormForPagesHtml($results);

			}
	
	function createUpgradePage($id)
	{
		global $database;
		$sql = "SELECT * FROM tbl_business where business_id='".$database->filter($id)."' and business_owner_id='".$database->filter($_SESSION['sess_member_id'])."'";
		$results = $database->get_results( $sql );
		
		createPageForSubscription($results);
	}
	
	function fnSubscribe()
	{
		global $database;
		$sql = "SELECT * FROM tbl_business where business_id='".$database->filter($id)."' and business_owner_id='".$database->filter($_SESSION['sess_member_id'])."'";
		$results = $database->get_results( $sql );
		createPageForPayment($results);
	}
	
	
	
	
	function createFormForPages_detail($id)
			{
				global $database;
				$sql = "select * from tbl_prescriptions,tbl_patients where pres_patient_id=patient_id and pres_id='".$database->filter($_GET['id'])."'  order by pres_id desc";
				$results = $database->get_results( $sql );
				createFormForPagesHtml_details($results);

			}

	

	

	function saveModificationsOperation()

	{

	global $database,$component;	

	 if ($_POST['txtSuburb']!="")
		  {
			  $arrSub=explode(",",$_POST['txtSuburb']);
			  $suburb=$arrSub[0];
			  $state=$arrSub[1];
			  $postcode=$arrSub[2];
			  
		  }
  
   
    $category = '';
	if (!empty($_POST['cmbCategory'])) {
        $filteredCategories = array_filter($_POST['cmbCategory']);
    	$category = implode(",", $filteredCategories);
	}
	
	$subCat = '';
	if (!empty($_POST['cmbSubCategory'])) {
	
	$filteredSubCategories = array_filter($_POST['cmbSubCategory']);
    $subCat = @implode(",", $filteredSubCategories);
	}	
	
	$curDate = date("Y-m-d H:i:s");	
	$street=$_POST['txtAddress'];
	$address=$_POST['txtAddress']." ".$suburb.", ".$state.", ".$postcode;		
	$addressDisplay=$_POST['rdAddressDisp'][0];		
	$regionArray=getRegionId($_POST['hdRegion']);		
	$regionId=$regionArray['region_id'];
	$greaterRegionId=$regionArray['region_greater_region'];	
	$selectedValues = isset($_POST['rdAdType']) ? $_POST['rdAdType'] : array();
	$adType = implode(',', $selectedValues); // This becomes "Independent Business,Franchise" etc.
	
	$selectedAgents = isset($_POST['rdAgent']) ? $_POST['rdAgent'] : array();
	$adAgents = implode(',', $selectedAgents);

	if ($_POST['cmbPriceDisplay']==3)
	$priceViewval=$_POST['txtPriceViewVal'];
	else
	$priceViewval="";			

			$update = array(			
			'business_heading' => $_POST['txtHeading'],
			'business_description' => $_POST['txtDescription'],	
			'business_agent_id' => $adAgents,
			'business_ad_type' => $adType,		
			'business_street' => $street, 
			'business_address' => $address, 			
			'business_suburb' => $suburb,
			'business_state' => $state, 
			'business_postcode' => $postcode,
			'business_region' => $regionId,
			'business_greater_region' => $greaterRegionId,
			'business_address_display' => $addressDisplay,			
			'business_category' => $category,
			'business_subcat' => $subCat,
			'business_property_included' => $_POST['cmbPropertyWithBus'],	
			'business_asking_price' => $_POST['txtAskingPrice'],			
			'business_price' => $_POST['txtSearchPrice'],
			'business_price_display' => $_POST['cmbPriceDisplay'],	
			'business_price_value' => $priceViewval,
			
			'business_takings' => $_POST['cmbPeriodCount'],
			'business_takings_value' => $_POST['txtNetProfit'],
			'business_turnover' => $_POST['txtSalesRevenue'],
			'business_rent' => $_POST['txtRent'],
			'business_expenses' => $_POST['txtExpenses'],	
			
			'business_vendor_name' => $_POST['txtVendorName'],			
			'business_vendor_email' => $_POST['txtVendorEmail'],			
			'business_vendor_phone' => $_POST['txtVendorPhone'],			
			'business_plus_stock' => $_POST['txtPlusStock'],			
			'business_mod_date' => $curDate,
			'business_status' => $_POST['cmbStatus'],
		);
			
		

//Add the WHERE clauses

		$where_clause = array(

			'business_id' => base64_decode($_POST['bid']),
			'business_owner_id' => $_SESSION['sess_member_id']

		);
		$updated = $database->update( 'tbl_business', $update, $where_clause, 1 );

			$imagesArr=array();
			$imagesArr=$_POST['images4ex'];
			
			
			
			
			//--------Checking first that is there image changes or not-------
			
		$diff1 = array_diff($_SESSION['sessImageArr'], $imagesArr);
		$diff2 = array_diff($imagesArr, $_SESSION['sessImageArr']);
			
			
			
			if (empty($diff1) && empty($diff2)) {
			
			} else {
			
			$deleteImg="delete from tbl_business_images where image_business_id='".$database->filter(base64_decode($_POST['bid']))."'";
			$database->query($deleteImg);
							
			
				
					for ($j=0;$j<count($imagesArr);$j++)
						{										
							$values2 = array(										   					     
							'image_business_id' => $database->filter(base64_decode($_POST['bid'])),
							'image_local' => $imagesArr[$j],
						);
							$database->insert( 'tbl_business_images', $values2 );
		
		
		
						}
			}

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&status=1'</script>";

		}

			 

	}

	

	function publishSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			

			 

			$update = array(

				'page_status' => 1

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'page_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_pages', $update, $where_clause, 1 );

		}

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

	}

	

	function unpublishSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			

			 

			$update = array(

				'page_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'page_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_pages', $update, $where_clause, 1 );

		}

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

	}

	

	

	function removeSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			

			

			//Add the WHERE clauses

			$where_clause = array(

				'business_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_business', $where_clause, 1 );

		}

		

		if( $delete )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

	}


	function removeDeletedItems()

	{

		global $database,$component;	

		

			 $provinceIdToPublish = $_GET['id'];

			

			//Add the WHERE clauses

			$where_clause = array(

				'page_id' => $provinceIdToPublish

			);

			$del = $database->delete( 'tbl_pages', $where_clause, 1 );
			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

		



?>