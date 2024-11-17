<?php
function showList()
{
			global $database, $page, $pagingObject;
			$sql = "SELECT * FROM tbl_jobs,tbl_categories,tbl_homeowners where job_category=categories_id and job_posted_by=ho_id ";
				if($_GET['txtSearchByTitle'] != "")
					{
						$sql .= " and (job_description like '%".$database->filter($_GET['txtSearchByTitle'])."%' || pharmacy_address like '%".$database->filter($_GET['txtSearchByTitle'])."%' || pharmacy_o_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' || pharmacy_o_email like '%".$database->filter($_GET['txtSearchByTitle'])."%' || pharmacy_o_mobile like '%".$database->filter($_GET['txtSearchByTitle'])."%' || pharmacy_p_landline like '%".$database->filter($_GET['txtSearchByTitle'])."%' || pharmacy_city like '%".$database->filter($_GET['txtSearchByTitle'])."%') ";
					}	
					
					if($_GET['jobType'] != "")
					{
							$sql .= " and job_type='".$database->filter($_GET['jobType'])."'";
					}
						
					if($_GET['cmbStatus'] != "")
					{
							$sql .= " and job_status='".$database->filter($_GET['cmbStatus'])."'";
					}
			$sql .= " order by job_id  desc";
			$pagingObject->setMaxRecords(PAGELIMIT); 
			$sql = $pagingObject->setQuery($sql);
			$results = $database->get_results( $sql );		
			showRecordsListing( $results );
		}


	function saveFormValues()
	{
		global $database, $component;
		$dtToday=date('Y-m-d H:i:s');
		$categoryId=getCategoryId($_POST['txtCategory']);
	
		if ($_POST['cmbTimeUrgency']=="Specific Date")
		$spDt=$_POST['txtSpecDate'];
		else
		$spDt="";	

		$names = array(
			'job_type' => $_POST['cmbJobs'], 
			'job_category' => $categoryId,  
			'job_location' => $_POST['txtLocation'], 	
			'job_specific_date' => $spDt,		 
			'job_urgency' => $_POST['cmbTimeUrgency'], 
			'job_description' => $_POST['txtDescribe'], 
			'job_budget' => $_POST['txtBudget'],			
			'job_postdate' => $dtToday,				
			'job_posted_by' => $_POST['cmbHO'],				
			'job_status' => $_POST['rdoPublished']
		);
		
		
		$add_query = $database->insert( 'tbl_jobs', $names );		
		$lastInsertedId=$database->lastid();		
		
		if( $add_query )
		{
			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

	}

	

	function createFormForPages($id)
			{
				global $database;
				$sql = "SELECT * FROM tbl_jobs,tbl_categories where job_category=categories_id and job_id='".$database->filter($id)."'";
				$results = $database->get_results( $sql );
				createFormForPagesHtml($results);

			}
	
	
	function createFormForPages_detail($id)
			{
				global $database;
				$sql = "SELECT * FROM tbl_jobs,tbl_categories where job_category=categories_id and job_id='".$database->filter($id)."'";
				$results = $database->get_results( $sql );
				createFormForPagesHtml_details($results);

			}

		

	function saveModificationsOperation()
	{
		global $database,$component;
		$categoryId=getCategoryId($_POST['txtCategory']);
	
			if ($_POST['cmbTimeUrgency']=="Specific Date")
			$spDt=$_POST['txtSpecDate'];
			else
			$spDt="";			

			$update = array(
			'job_type' => $_POST['cmbJobs'], 
			'job_category' => $categoryId, 
			'job_posted_by' => $_POST['cmbHO'], 
			'job_location' => $_POST['txtLocation'], 	
			'job_specific_date' => $spDt,		 
			'job_urgency' => $_POST['cmbTimeUrgency'], 
			'job_description' => $_POST['txtDescribe'], 
			'job_budget' => $_POST['txtBudget'],							
			'job_posted_by' => $_POST['cmbHO'],				
			'job_status' => $_POST['rdoPublished'] 

			);

//Add the WHERE clauses
		$where_clause = array(
			'job_id' => $_POST['pId']
		);
		$updated = $database->update( 'tbl_jobs', $update, $where_clause, 1 );
		
	
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
				'job_status' => 1
			);
			//Add the WHERE clauses

			$where_clause = array(
				'job_id' => $provinceIdToPublish

			);
		$updated = $database->update( 'tbl_jobs', $update, $where_clause, 1 );

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
				'job_status' => 0
			);

				$where_clause = array(

				'job_id' => $provinceIdToPublish

			);

			$updated = $database->update( 'tbl_jobs', $update, $where_clause, 1 );

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
			 $where_clause = array(
				'job_id' => $provinceIdToPublish
			);
			$delete = $database->delete( 'tbl_jobs', $where_clause, 1 );
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
			  $where_clause = array(
			  'job_id' => $provinceIdToPublish

			);
			$del = $database->delete( 'tbl_jobs', $where_clause, 1 );
			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

		



?>