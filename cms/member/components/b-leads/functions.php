<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";


	 $sql = "SELECT * FROM tbl_inquiry,tbl_business where inquiry_listing_id=business_id and business_owner_id='".$database->filter($_SESSION['sess_member_id'])."' ";
	 
	 
	 if($_GET['txtSearchByTitle'] != "")

		{

			$sql .= " and (inquiry_id like '%".$database->filter(str_replace("PH-","",$_GET['txtSearchByTitle']))."%' || inquiry_message like '%".$database->filter($_GET['txtSearchByTitle'])."%' || inquiry_phone like '%".$database->filter($_GET['txtSearchByTitle'])."%')";

		}
		
		if($_GET['cmbCategory'] != "")
		{

			$sql .= " and business_category='".$database->filter($_GET['cmbCategory'])."'";

		}
		
		/*if($_GET['txtSearchByTitle'] != "")
		{
			$sql .= " and (patient_first_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_middle_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_last_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_id like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_phone like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_email like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_phone like '%".$database->filter($_GET['txtSearchByTitle'])."%') ";

		}		
		*/
		$sql .= " order by inquiry_id desc";
		
		//print_r($sql);
		
		
		

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		

			

		showRecordsListing( $results );

		

	}

	

	

function removeSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			$provinceIdToPublish = $_GET['deletes'][$i];

			

			

			//Add the WHERE clauses

			$where_clause = array(

				'message_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_messages', $where_clause, 1 );

		}


		

		if( $delete )

		{

			print "<script>window.location='index.php?c=".$component."'</script>";

		}

	}


	





?>