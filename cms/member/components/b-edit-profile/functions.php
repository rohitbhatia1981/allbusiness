<?php
	function showList()
	{

	global $database, $page, $pagingObject;
	
	$sql="select * from tbl_members where member_id='".$_SESSION['sess_member_id']."'";
	$results = $database->get_results( $sql );
	showRecordsListing( $results );
	}

	

	

	function saveFormValues()

	{

	global $database, $component;

	
		

		$curDate=date("Y-m-d");

		$names = array(

			'patient_title' => $_POST['txtTitle'], 
			'patient_first_name' => $_POST['txtFirstName'],
			'patient_middle_name' => $_POST['txtMiddleName'], 
			'patient_last_name' => $_POST['txtLastName'],
			'patient_email' => $_POST['txtEmail'],
			'patient_password' => $_POST['txtPassword'],
			'patient_phone' => $_POST['txtPhone'],
			'patient_gender' => $_POST['cmbGender'],
			'patient_dob' => $_POST[''],
			'patient_city' => $_POST['txtCity'],
			'patient_address1' => $_POST['txtAddress1'],
			'patient_address2' => $_POST['txtAddress2'],
			'patient_pharmacy' => $_POST[''],
			'patient_marketing_emails' => $_POST[''],
			'patient_registered_date' => $curDate,
			'patient_ip' => $_SERVER['REMOTE_ADDR'],
			'patient_kyc' => $_POST['rdoKYC'],
			'patient_status' => $_POST['rdoPublished']


		);

		$add_query = $database->insert( 'tbl_pages', $names );

		

		if( $add_query )

		{

			print "<script>window.location='index.php?c=".$component."&Cid=6'</script>";

		}

		



		

		

		//$resultInsertGroup = $db->query($sqlInsertGroup);

		

		

		

	}

	

	function createFormForPages($id)

			{

				global $database;

				

				$sql = "SELECT * FROM tbl_pages where page_id='".$database->filter($id)."'";

				$results = $database->get_results( $sql );

			

				createFormForPagesHtml($results);

			}
	
	
	function createFormForPages_detail($id)
			{
				global $database;
				$sql = "SELECT * FROM tbl_patients where patient_id='".$database->filter($id)."'";
				$results = $database->get_results( $sql );
				createFormForPagesHtml_details($results);

			}

	

	

	function saveModificationsOperation()

	{

		

			global $database,$component;	

			
			
							

			$update = array(
			'member_firstname' => $_POST['txtFirstName'],
			'member_lastname' => $_POST['txtLastName'],
			'member_email' => $_POST['txtEmail'],
			'member_phone' => $_POST['txtPhone'],			
			'member_company' => $_POST['txtCompany'],
			'member_tradingname' => $_POST['txtAgency'],
			'member_website' => $_POST['txtWebsite'],
			'member_address' => $_POST['txtAddress'],
			'member_aboutus' => $_POST['txtAbout'],
			'member_speciality' => $_POST['txtSpeciality'],
			'member_locations' => $_POST['txtLocations'],		

			);
			
			

//Add the WHERE clauses

		$where_clause = array(

			'member_id' => $_SESSION['sess_member_id']

		);
		$updated = $database->update( 'tbl_members', $update, $where_clause, 1 );
		
		
		
		if (!empty($_POST['images4ex'])) {			
		
				$imageName=$_POST['images4ex'][0];
				
				$update = array(
				'member_agency_logo' => $imageName			
				);
				
				$where_clause = array(
				'member_id' => $_SESSION['sess_member_id']
				);
				
				$updated = $database->update( 'tbl_members', $update, $where_clause, 1 );
				
				
			
		
		}
		

		if( $updated )

		{

			print "<script>window.location='index.php?c=".$component."&done=1'</script>";

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

				'page_id' => $provinceIdToPublish

			);

			$delete = $database->delete( 'tbl_pages', $where_clause, 1 );

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