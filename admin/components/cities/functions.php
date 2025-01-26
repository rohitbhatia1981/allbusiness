<?php

	function showList()

	{

	

	global $database, $page, $pagingObject;


		$sql = "SELECT * FROM tbl_cities where 1";

		if($_GET['txtSearchByTitle'] != "")

		{

			$sql .= " and city_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' ";

		}

		$sql .= " order by city_name asc";

		//print_r($sql);

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		

			

		showRecordsListing( $results );

		

	}

	

	

	function saveFormValues()

	{

	global $database, $component;

		$names = array(

			'city_name' => $_POST['txtName'], 
			'city_state' => $_POST['cmbState'], 
			'city_postcode' => $_POST['txtPostcode'], 
			'city_status' => 1,
			'city_page_desc' => $_POST['txtDescription'], 
			'city_seo_title' => $_POST['txtSEOTitle'], //Random thing to insert
			'city_seo_keywords' => $_POST['txtSEOKeywords'], //Random thing to insert
			'city_seo_description' => $_POST['txtSEODesc'],
			'city_popular' => $_POST['rdoPopular']

		);

		
		$add_query = $database->insert( 'tbl_cities', $names );
	
		$lastInsertedId=$database->lastid();

		if($_POST['images4ex'][0] != "")
		{			
		$imageName = $_POST['images4ex'][0];

		$updateimage = array(
				'city_image' => $imageName 
				
			);

		$where_clause = array(
			'city_id' => $lastInsertedId
		);
	
		$database->update( 'tbl_cities', $updateimage, $where_clause, 1 );
	
		}

		include PATH."update_htacess.php";

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."'</script>";

		}

	

	}

	

	function createFormForPages($id)

			{

				global $database;
				

				$sql = "SELECT * FROM tbl_cities where city_id='".$database->filter($id)."'";

				$results = $database->get_results( $sql );

				createFormForPagesHtml($results);

			}

	

	

	function saveModificationsOperation()
	{

		global $database,$component;	
	
			
		$update = array(

			'city_name' => $_POST['txtName'], 
			'city_state' => $_POST['cmbState'], 
			'city_postcode' => $_POST['txtPostcode'], 
			'city_status' => 1,
			'city_page_desc' => $_POST['txtDescription'], 
			'city_seo_title' => $_POST['txtSEOTitle'], //Random thing to insert
			'city_seo_keywords' => $_POST['txtSEOKeywords'], //Random thing to insert
			'city_seo_description' => $_POST['txtSEODesc'],
			'city_popular' => $_POST['rdoPopular']

		);

		$lastInsertedId=$_POST['id'];
		
			$where_clause = array(
				'city_id' => $lastInsertedId
			);

			$updated = $database->update( 'tbl_cities', $update, $where_clause, 1 );

		if($_POST['images4ex'][0] != "")
		{			
		$imageName = $_POST['images4ex'][0];

		$updateimage = array(
				'city_image' => $imageName 
				
			);

		$where_clause = array(
			'city_id' => $lastInsertedId
		);
	
		$database->update( 'tbl_cities', $updateimage, $where_clause, 1 );
	
		}	
			
		include PATH."update_htacess.php";
		

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

				'city_status' => 1

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'city_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_cities', $update, $where_clause, 1 );

		}

		include PATH."update_htacess.php";

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

				'city_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'city_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_cities', $update, $where_clause, 1 );

		}

		include PATH."update_htacess.php";

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

				'city_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_cities', $where_clause, 1 );

		}

		include PATH."update_htacess.php";

		if( $delete )

		{

			print "<script>window.location='index.php?c=".$component."'</script>";

		}

	}
	
?>