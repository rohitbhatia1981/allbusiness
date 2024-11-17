<?php
	function showList()
	{
	global $database, $page, $pagingObject;			
		$sql = "SELECT * FROM tbl_professionals where 1 ";
		if($_GET['txtSearchByTitle'] != "")
		{
			$sql .= " and (prof_name like '%".$database->filter($_GET['txtSearchByTitle'])."%'|| prof_id like '%".$database->filter($_GET['txtSearchByTitle'])."%' || prof_phone like '%".$database->filter($_GET['txtSearchByTitle'])."%' || prof_email like '%".$database->filter($_GET['txtSearchByTitle'])."%' ) ";
		}	
		
		if($_GET['cmbStatus'] != "")

		{

			$sql .= " and prof_status='".$database->filter($_GET['cmbStatus'])."'";

		}
	

		$sql .= " order by prof_id desc";
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

			'prof_name' => $_POST['txtName'], 
			'prof_email' => $_POST['txtEmail'],
			'prof_password' => md5($_POST['txtPassword']), 
			'prof_phone' => $_POST['txtPhone'],	
			'prof_city' => $_POST['txtCity'],
			'prof_address1' => $_POST['txtAddress1'],
			'prof_address2' => $_POST['txtAddress2'],	
			'prof_postcode' => $_POST['txtPostcode'],		
			'prof_registered_date' => $curDate,
			'prof_ip' => $_SERVER['REMOTE_ADDR'],
			'prof_phone_verify' => $_POST['rdoPhone'],
			'prof_email_verify' => $_POST['rdoEmail'],
			'prof_status' => $_POST['rdoPublished']


		);

		$add_query = $database->insert( 'tbl_professionals', $names );	
		if( $add_query )
		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}
		

	}

	

	function createFormForPages($id)

			{

				global $database;	
				$sql = "SELECT * FROM tbl_professionals where prof_id='".$database->filter($id)."'";
				$results = $database->get_results( $sql );	
				createFormForPagesHtml($results);

			}
	
	
	function createFormForPages_detail($id)
			{
				global $database;
				$sql = "SELECT * FROM tbl_professionals where prof_id='".$database->filter($id)."'";
				$results = $database->get_results( $sql );
				createFormForPagesHtml_details($results);

			}
	

	function saveModificationsOperation()
	{	

			global $database,$component;					
			$pageId=$_POST['pageId'];			

			$update = array(
			'prof_name' => $_POST['txtName'], 
			'prof_email' => $_POST['txtEmail'],			
			'prof_phone' => $_POST['txtPhone'],	
			'prof_city' => $_POST['txtCity'],
			'prof_address1' => $_POST['txtAddress1'],
			'prof_address2' => $_POST['txtAddress2'],	
			'prof_postcode' => $_POST['txtPostcode'],					
			'prof_phone_verify' => $_POST['rdoPhone'],
			'prof_email_verify' => $_POST['rdoEmail'],
			'prof_status' => $_POST['rdoPublished']

			);
			
			if ($_POST['txtPassword']!="")
			{
			$password=md5($_POST['txtPassword']);
			
				$update2 = array(
				'prof_password' => $password 
				);
				$update=array_merge($update,$update2);
			
			}
			
			

//Add the WHERE clauses

		$where_clause = array(

			'prof_id' => $pageId

		);
		$updated = $database->update( 'tbl_professionals', $update, $where_clause, 1 );

		

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

				'prof_status' => 1

			);
			$where_clause = array(
			'prof_id' => $provinceIdToPublish
			);
			$updated = $database->update( 'tbl_professionals', $update, $where_clause, 1 );
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
					'prof_status' => 0
				);		

			//Add the WHERE clauses
			$where_clause = array(
				'prof_id' => $provinceIdToPublish
			);
			$updated = $database->update( 'tbl_professionals', $update, $where_clause, 1 );

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

				'prof_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_professionals', $where_clause, 1 );
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
				'prof_id' => $provinceIdToPublish
			);

			$del = $database->delete( 'tbl_professionals', $where_clause, 1 );
			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

		



?>