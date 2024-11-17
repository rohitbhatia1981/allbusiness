<?php
	function showList()
	{
	global $database, $page, $pagingObject;			
		$sql = "SELECT * FROM tbl_homeowners where 1 ";
		if($_GET['txtSearchByTitle'] != "")
		{
			$sql .= " and (ho_name like '%".$database->filter($_GET['txtSearchByTitle'])."%'|| ho_id like '%".$database->filter($_GET['txtSearchByTitle'])."%' || ho_phone like '%".$database->filter($_GET['txtSearchByTitle'])."%' || ho_email like '%".$database->filter($_GET['txtSearchByTitle'])."%' ) ";
		}	
		
		if($_GET['cmbStatus'] != "")

		{

			$sql .= " and ho_status='".$database->filter($_GET['cmbStatus'])."'";

		}
	

		$sql .= " order by ho_id desc";
		$pagingObject->setMaxRecords(PAGELIMIT); 
		$sql = $pagingObject->setQuery($sql);
		$results = $database->get_results( $sql );	
		showRecordsListing( $results );		

	}



	

	function saveFormValues()
	{
	global $database, $component;	

		$curDate=date("Y-m-d");
		$names = array(

			'ho_name' => $_POST['txtName'], 
			'ho_email' => $_POST['txtEmail'],
			'ho_password' => md5($_POST['txtPassword']), 
			'ho_phone' => $_POST['txtPhone'],	
			'ho_city' => $_POST['txtCity'],
			'ho_address1' => $_POST['txtAddress1'],
			'ho_address2' => $_POST['txtAddress2'],	
			'ho_postcode' => $_POST['txtPostcode'],		
			'ho_registered_date' => $curDate,
			'ho_ip' => $_SERVER['REMOTE_ADDR'],
			'ho_phone_verify' => $_POST['rdoPhone'],
			'ho_email_verify' => $_POST['rdoEmail'],
			'ho_status' => $_POST['rdoPublished']


		);

		$add_query = $database->insert( 'tbl_homeowners', $names );	
		if( $add_query )
		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}
		

	}

	

	function createFormForPages($id)

			{

				global $database;	
				$sql = "SELECT * FROM tbl_homeowners where ho_id='".$database->filter($id)."'";
				$results = $database->get_results( $sql );	
				createFormForPagesHtml($results);

			}
	
	
	function createFormForPages_detail($id)
			{
				global $database;
				$sql = "SELECT * FROM tbl_homeowners where ho_id='".$database->filter($id)."'";
				$results = $database->get_results( $sql );
				createFormForPagesHtml_details($results);

			}
	

	function saveModificationsOperation()
	{	

			global $database,$component;					
			$pageId=$_POST['pageId'];			

			$update = array(
			'ho_name' => $_POST['txtName'], 
			'ho_email' => $_POST['txtEmail'],			
			'ho_phone' => $_POST['txtPhone'],	
			'ho_city' => $_POST['txtCity'],
			'ho_address1' => $_POST['txtAddress1'],
			'ho_address2' => $_POST['txtAddress2'],	
			'ho_postcode' => $_POST['txtPostcode'],					
			'ho_phone_verify' => $_POST['rdoPhone'],
			'ho_email_verify' => $_POST['rdoEmail'],
			'ho_status' => $_POST['rdoPublished']

			);
			
			if ($_POST['txtPassword']!="")
			{
			$password=md5($_POST['txtPassword']);
			
				$update2 = array(
				'ho_password' => $password 
				);
				$update=array_merge($update,$update2);
			
			}
			
			

//Add the WHERE clauses

		$where_clause = array(

			'ho_id' => $pageId

		);
		$updated = $database->update( 'tbl_homeowners', $update, $where_clause, 1 );

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

			 

	}

	

	function publishSelectedItems()
	{
		global $database,$component;
		for($i = 0; $i < count($_GET['deletes']); $i++)
		{
			 $provinceIdToPublish = $_GET['deletes'][$i];	 

			$update = array(

				'ho_status' => 1

			);
			$where_clause = array(
			'ho_id' => $provinceIdToPublish
			);
			$updated = $database->update( 'tbl_homeowners', $update, $where_clause, 1 );
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
					'ho_status' => 0
				);		

			//Add the WHERE clauses
			$where_clause = array(
				'ho_id' => $provinceIdToPublish
			);
			$updated = $database->update( 'tbl_homeowners', $update, $where_clause, 1 );

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

				'ho_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_homeowners', $where_clause, 1 );
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
				'ho_id' => $provinceIdToPublish
			);

			$del = $database->delete( 'tbl_homeowners', $where_clause, 1 );
			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

		



?>