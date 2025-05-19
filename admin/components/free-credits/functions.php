<?php

	function showList()
	{

	global $database, $page, $pagingObject;

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";
		$sql = "SELECT * from tbl_ads_order where 1 ";
		
		if($_GET['cmbAgency'] != "")
		{
			$sql.=" and ad_agency_id='".$database->filter($_GET['cmbAgency'])."'";
		}
		
		if($_GET['txtSDate'] != "")
		{
			$sql.=" and ad_order_date >='".$_GET['txtSDate']."'";
		}
		
		if($_GET['txtEDate'] != "")
		{
			$sql.=" and ad_order_date <='".$_GET['txtEDate']."'";

		}		

		$sql .= " order by ad_order_id desc";

		

		$pagingObject->setMaxRecords(PAGELIMIT); 
		$sql = $pagingObject->setQuery($sql);
		$results = $database->get_results( $sql );	
		showRecordsListing( $results );
		

	}

	

	

function saveFormValues()

	{

	global $database, $component;


		
	
		if ($_POST['txtPrem90']=="")
		$number_of_premium_ad_90_days=0;
		else
		$number_of_premium_ad_90_days=$_POST['txtPrem90'];
		
		if ($_POST['txtPrem180']=="")
		$number_of_premium_ad_180_days=0;
		else
		$number_of_premium_ad_180_days=$_POST['txtPrem180'];
		
		if ($_POST['txtAdv90']=="")
		$number_of_advance_ad_90_days=0;
		else
		$number_of_advance_ad_90_days=$_POST['txtAdv90'];
		
		if ($_POST['txtAdv180']=="")
		$number_of_advance_ad_180_days=0;
		else
		$number_of_advance_ad_180_days=$_POST['txtAdv180'];


		//$curDate=date("Y-m-d");
		$curDateTime = date("Y-m-d H:i:s"); 

		$names = array(		
			'ad_agency_id' => $_POST['cmbBroker'],						
			'ad_premium_90_qty' => $number_of_premium_ad_90_days,						
			'ad_premium_180_qty' => $number_of_premium_ad_180_days,				
			'ad_advance_90_qty' => $number_of_advance_ad_90_days,			
			'ad_advance_180_qty' => $number_of_advance_ad_180_days,				
			'ad_order_date' => $curDateTime

		);	
		
		$add_query = $database->insert( 'tbl_ads_order', $names );		
		//$lastInsertedId=$database->lastid();
		
		
		
		$sqlCheck="select * from tbl_agency_ads_inventory where inventory_agency_id='".$database->filter($_POST['cmbBroker'])."'";
		$resCheck=$database->get_results($sqlCheck);
		if (count($resCheck)==0)
		{		
		$names = array(		
			'inventory_agency_id' => $_POST['cmbBroker'],	
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
			'inventory_agency_id' => $_POST['cmbBroker'],	
			'inventory_premium_90' => $UpdatedPremium90,			
			'inventory_premium_180' => $UpdatedPremium180,
			'inventory_advanced_90' => $UpdatedAdvance90,
			'inventory_advanced_180' => $UpdatedAdvance180

			);
					

		//Add the WHERE clauses

		$where_clause = array(
			'inventory_agency_id' => $_POST['cmbBroker'],
		);
		$updated = $database->update( 'tbl_agency_ads_inventory', $update, $where_clause, 1 );
			
		}

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		
			print "<script>window.location='index.php?c=".$component."'</script>";

		

		

	}

	

	function createFormForPages($id)

			{

				
				

				

				createFormForPagesHtml($results);

			}

	

	

	
?>