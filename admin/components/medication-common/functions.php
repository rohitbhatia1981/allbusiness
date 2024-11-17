<?php



	function showList()
	{	

	global $database, $page, $pagingObject;				

		//$sql = "SELECT * FROM tbl_pages where 1 order by page_title asc";


		$sql = "SELECT * FROM tbl_medication_common where 1";

		if($_GET['txtSearchByTitle'] != "")
		{
			$sql .= " and med_c_title like '%".$database->filter($_GET['txtSearchByTitle'])."%' ";

		}

		$sql .= " order by med_c_title asc";


		//print_r($sql);

		$pagingObject->setMaxRecords(PAGELIMIT); 

		$sql = $pagingObject->setQuery($sql);

		$results = $database->get_results( $sql );

		

			

		showRecordsListing( $results );

		

	}

	

	

	function saveFormValues()

	{

	global $database, $component;

		$strConditions="";
		
		if (count($_POST['ckMedicine'])>0)			
		$strMed=implode(",",$_POST['ckMedicine']);
				

		$names = array(

			'med_c_title' => $_POST['txtTitle'],
			'med_c_medicines' => $strMed, 
			'med_c_image' => $_POST['images4ex'][0],							  
			'med_c_status' => $_POST['rdoPublished'] //Random thing to insert

		);

		$add_query = $database->insert( 'tbl_medication_common', $names );

		

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}

	

	function createFormForPages($id)

			{

				global $database;				

				$sql = "SELECT * FROM tbl_medication_common where med_c_id='".$database->filter($id)."'";

				$results = $database->get_results( $sql );		

				createFormForPagesHtml($results);

			}

	

	

	function saveModificationsOperation()

	{

		

			global $database,$component;	

			

			
			
			$strConditions="";
		
			if (count($_POST['ckMedicine'])>0)			
		$strMed=implode(",",$_POST['ckMedicine']);
			

			
			
			

			$update = array(

			'med_c_title' => $_POST['txtTitle'],
			'med_c_medicines' => $strMed, 
			'med_c_image' => $_POST['images4ex'][0],							  
			'med_c_status' => $_POST['rdoPublished'] //Random thing to insert

			);

//Add the WHERE clauses

		$where_clause = array(

			'med_c_id' => $_POST['pageId']

		);
		$updated = $database->update( 'tbl_medication_common', $update, $where_clause, 1 );

		

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

				'med_c_status' => 1

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'med_c_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_medication_common', $update, $where_clause, 1 );

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

				'med_c_status' => 0

			);

			

			//Add the WHERE clauses

			$where_clause = array(

				'med_c_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_medication_common', $update, $where_clause, 1 );

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

				'med_c_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_medication_common', $where_clause, 1 );

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