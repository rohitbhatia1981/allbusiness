<?php



	function showList()

	{

	

	global $database, $page, $pagingObject;

		// $sql = "SELECT * FROM tbl_business_category where 1 order by bc_name asc";

			$sql = "SELECT * FROM tbl_business_category where 1";

			if($_GET['txtSearchByTitle'] != "")

			{

			$sql .= " and bc_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' ";

			}

			$sql .= " order by bc_parent_id asc, bc_name asc";	

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		showRecordsListing( $results );		

	}

	

	

	function saveFormValues()

	{

	global $database, $component;

		
		
		$bc_name = $_POST['txtTitle'];
		$bc_status = $_POST['rdoPublished'];

		

		$names = array(

				'bc_name' => $bc_name, 			
				'bc_page_description' => $_POST['txtDescription'], 
				'bc_seo_title' => $_POST['txtSEOTitle'], //Random thing to insert
				'bc_seo_keywords' => $_POST['txtSEOKeywords'], //Random thing to insert
				'bc_seo_description' => $_POST['txtSEODesc'],
				'bc_status' => $bc_status //Random thing to insert

		);

		$add_query = $database->insert( 'tbl_business_category', $names );
		

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."'</script>";

		}

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}

	

	function createFormForPages($id)

			{

				global $database;

				

				$sql = "SELECT * FROM tbl_business_category where bc_id ='".$database->filter($id)."'";

				$results = $database->get_results( $sql );

			

				createFormForPagesHtml($results);

			}

	

	

	function saveModificationsOperation()

	{
			global $database,$component;	
				$bc_name = $_POST['txtTitle'];
				$bc_status = $_POST['rdoPublished'];	
				$bc_id = $_POST['bc_id'];		

			$update = array(
				'bc_name' => $bc_name, 			
				'bc_page_description' => $_POST['txtDescription'], 
				'bc_seo_title' => $_POST['txtSEOTitle'], //Random thing to insert
				'bc_seo_keywords' => $_POST['txtSEOKeywords'], //Random thing to insert
				'bc_seo_description' => $_POST['txtSEODesc'],
				'bc_status' => $bc_status //Random thing to insert

			);
			

//Add the WHERE clauses

		$where_clause = array(

			'bc_id' => $bc_id

		);
	
		$updated = $database->update( 'tbl_business_category', $update, $where_clause, 1 );
		
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

				'bc_status' => 1

			);
			

			//Add the WHERE clauses

			$where_clause = array(

				'bc_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_business_category', $update, $where_clause, 1 );

		}

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=10'</script>";

		}

	}

	

	function unpublishSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			

			 

			$update = array(

				'bc_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'bc_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_business_category', $update, $where_clause, 1 );
			
		}

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."'</script>";

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

				'bc_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_business_category', $where_clause, 1 );

		}

		

		if( $delete )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=10'</script>";

		}

	}

	function removeDeletedItems()

	{

		global $database,$component;	

		

			 $provinceIdToPublish = $_GET['id'];

			

			//Add the WHERE clauses

			$where_clause = array(

				'bc_id' => $provinceIdToPublish

			);

			$del = $database->delete( 'tbl_business_category', $where_clause, 1 );
			print "<script>window.location='index.php?c=".$component."&Cid=10'</script>";

		}

?>	