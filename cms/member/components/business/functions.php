<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";


		$sql = "select * from tbl_business,tbl_members where business_owner_id=member_id and business_owner_id='".$database->filter($_SESSION['sess_member_id'])."'";

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
	$name=$_POST['txtBusinessName'];
	$abn=$_POST['txtABN'];	
	$propertyIncluded=$_POST['cmbPropertyWithBus'];
	$leaseAmount=$_POST['txtLeaseAmount'];
	$leaseAmountPeriod=$_POST['cmbLeaseAmountPeriod'];
	$leaseEnd=$_POST['txtLeaseEnd'];
	$furtherOption=$_POST['txtFurther'];
	$terms=$_POST['txtTerms'];
	$buildingArea=$_POST['txtBuilding'];
	$askingPrice=$_POST['txtAskingPrice'];	
	$price=removeSpecialCharacters($_POST['txtAskingPrice']);	
	$plusSav=$_POST['ckPlusSav'];
	$tax=$_POST['cmbTax'];
	$takings=$_POST['cmbTakings'];
	$takingsvalue=$_POST['txtTakingsValue'];
	$turnover=$_POST['cmbTurnover'];
	$netProfit=$_POST['txtNetProfit'];
	$heading=$_POST['txtHeading'];
	$description=$_POST['txtDescription'];
	$franchise=$_POST['cmbFranchisee'];
	$manageType=$_POST['cmbManageType'];
	
		

		$curDate=date("Y-m-d");

		$names = array(

			'business_street' => $street, 
			'business_address' => $address, 
			'business_owner_id' => $_SESSION['sess_member_id'],
			'business_suburb' => $suburb,
			'business_state' => $state, 
			'business_postcode' => $postcode,
			'business_address_display' => $addressDisplay,
			'business_name' => $name,
			'business_abn' => $abn,
			'business_category' => $category,
			'business_subcat' => $subCat,
			'business_property_included' => $propertyIncluded,
			'business_further_option' => $furtherOption,
			'business_lease_amount' => $leaseAmount,
			'business_lease_amount_period' => $leaseAmountPeriod,			
			'business_lease_end' => $leaseEnd,			
			'business_terms' => $terms,
			'business_building_area' => $buildingArea,
			'business_asking_price' => $askingPrice,
			'business_price' => $price,
			'business_plus_sav' => $plusSav,
			'business_tax' => $tax,
			'business_takings' => $takings,
			'business_takings_value' => $takingsvalue,
			'business_turnover' => $turnover,
			'business_net_profit' => $netProfit,
			'business_heading' => $heading,
			'business_status' => 'current',
			'business_description' => $description,
			'business_franchise' => $franchise,
			'business_manage_type' => $manageType,			
			'business_added_date' => $curDate,
			'business_mod_date' => $curDate,
			'business_active_status' => 0,
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

		

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}

	

	function createFormForPages($id)
			{

				global $database;
				$sql = "SELECT * FROM tbl_business where business_id='".$database->filter($id)."'";
				$results = $database->get_results( $sql );
				createFormForPagesHtml($results);

			}
	
	function fnSubscribe()
	{
		global $database;
		$sql = "SELECT * FROM tbl_business where business_id='".$database->filter($id)."' and business_owner_id='".$database->filter($_SESSION['sess_member_id'])."'";
		$results = $database->get_results( $sql );
		createPageForPayment($results);
	}
	
	function fnPaynow()
	{
		global $database;
		//$sql = "SELECT * FROM tbl_business where business_id='".$database->filter($id)."' and business_owner_id='".$database->filter($_SESSION['sess_member_id'])."'";
		//$results = $database->get_results( $sql );
		createPaynow($results);
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
	$name=$_POST['txtBusinessName'];
	$abn=$_POST['txtABN'];	
	$propertyIncluded=$_POST['cmbPropertyWithBus'];
	$leaseAmount=$_POST['txtLeaseAmount'];
	$leaseAmountPeriod=$_POST['cmbLeaseAmountPeriod'];
	$leaseEnd=$_POST['txtLeaseEnd'];
	$furtherOption=$_POST['txtFurther'];
	$terms=$_POST['txtTerms'];
	$buildingArea=$_POST['txtBuilding'];
	$askingPrice=$_POST['txtAskingPrice'];	
	$price=removeSpecialCharacters($_POST['txtAskingPrice']);	
	$plusSav=$_POST['ckPlusSav'];
	$tax=$_POST['cmbTax'];
	$takings=$_POST['cmbTakings'];
	$takingsvalue=$_POST['txtTakingsValue'];
	$turnover=$_POST['cmbTurnover'];
	$netProfit=$_POST['txtNetProfit'];
	$heading=$_POST['txtHeading'];
	$description=$_POST['txtDescription'];
	$franchise=$_POST['cmbFranchisee'];
	$manageType=$_POST['cmbManageType'];
			

			$update = array(

			'business_street' => $street, 
			'business_address' => $address, 			
			'business_suburb' => $suburb,
			'business_state' => $state, 
			'business_postcode' => $postcode,
			'business_address_display' => $addressDisplay,
			'business_name' => $name,
			'business_abn' => $abn,
			'business_category' => $category,
			'business_subcat' => $subCat,
			'business_property_included' => $propertyIncluded,
			'business_further_option' => $furtherOption,
			'business_lease_amount' => $leaseAmount,	
			'business_lease_amount_period' => $leaseAmountPeriod,			
			'business_lease_end' => $leaseEnd,			
			'business_terms' => $terms,
			'business_building_area' => $buildingArea,
			'business_asking_price' => $askingPrice,			
			'business_price' => $price,
			'business_plus_sav' => $plusSav,
			'business_tax' => $tax,
			'business_takings' => $takings,
			'business_takings_value' => $takingsvalue,
			'business_turnover' => $turnover,
			'business_net_profit' => $netProfit,
			'business_heading' => $heading,
			'business_status' => 'current',
			'business_description' => $description,
			'business_franchise' => $franchise,
			'business_manage_type' => $manageType,	
			'business_mod_date' => $curDate,
			'business_added_method_direct' => 1

			);
			
		

//Add the WHERE clauses

		$where_clause = array(

			'business_id' => base64_decode($_POST['bid']),

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

			print "<script>window.location='index.php?c=".$component."'</script>";

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