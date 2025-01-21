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

			'city_name' => $pagetitleEntered, 
			'city_state' => $pagedescEntered, 
			'city_status' => 1,
			'city_page_desc' => $pagemetadescription, 
			'city_seo_title' => $pagePublishedEntered, //Random thing to insert
			'city_seo_keywords' => $pagePublishedEntered, //Random thing to insert
			'city_seo_description' => $category_name,
			'city_popular' => $blog_add_date

		);

		
		$add_query = $database->insert( 'tbl_blogs', $names );
	
		$lastInsertedId=$database->lastid();

		if($_POST['images4ex'][0] != "")
		{			
		$imageName = $_POST['images4ex'][0];

		$updateimage = array(
				'blog_image' => $imageName 
				
			);

		$where_clause = array(
			'id' => $lastInsertedId
		);
	
		$database->update( 'tbl_blogs', $updateimage, $where_clause, 1 );
	
		}

		

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=10'</script>";

		}

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

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

			

				$pagetitleEntered = $_POST['blog_title'];

				$pagedescEntered = $_POST['blog_description'];

				$pagemetatitle = $_POST['blog_meta_title'];

				$pagemetakeywords = $_POST['blog_meta_keywords'];

				$pagemetadescription= $_POST['blog_meta_description'];

				$pagePublishedEntered = $_POST['rdoPublished'];	

				$id=$_POST['blogId'];

				$short_description = $_POST['short_description'];

				$category_name = $_POST['txtCategories'];

				$blog_add_date = date('Y-m-d H:i:s');
			

			$update = array(

				'blog_title' => $pagetitleEntered, 

				'blog_description' => $pagedescEntered,

				'blog_seo_title' => $pagemetatitle, 

				'blog_seo_keywords' => $pagemetakeywords, 

				'blog_seo_description' => $pagemetadescription, 		

				'blog_status' => $pagePublishedEntered,

				'short_description' => $short_description,

				'blog_categories' => $category_name, 

				'blog_add_date' => $blog_add_date

				
			);

//Add the WHERE clauses

		$where_clause = array(

			'id' => $id

		);
		

		 $updated = $database->update( 'tbl_blogs', $update, $where_clause, 1 ); 
		 $lastInsertedId=$database->lastid();

		 if($_POST['images4ex'][0] != "")
		 {			
		 $imageName = $_POST['images4ex'][0];
		 
		 
		 
		 $updateimage = array(
				 'blog_image' => $imageName 
				 
			 );
		 
 
		 $where_clause = array(
			 'id' => $id
		 );
			$database->update( 'tbl_blogs', $updateimage, $where_clause, 1 );
		 }
 

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=10'</script>";

		}

			 

	}

	

	function publishSelectedItems()

	{

		global $database,$component;	

		

		for($i = 0; $i < count($_GET['deletes']); $i++)

		{

			 $provinceIdToPublish = $_GET['deletes'][$i];

			

			 

			$update = array(

				'blog_status' => 1

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_blogs', $update, $where_clause, 1 );

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

				'blog_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_blogs', $update, $where_clause, 1 );

		}

		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=10'</script>";

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

				'id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_blogs', $where_clause, 1 );

		}

		

		if( $delete )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=10'</script>";

		}

	}
	
?>