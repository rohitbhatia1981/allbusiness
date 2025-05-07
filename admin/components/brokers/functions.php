<?php
function showList() {
    global $database, $page, $pagingObject;
   
$sql = "SELECT * FROM tbl_members WHERE member_type = 1";

if (!empty($_GET['txtSearchByTitle'])) {
    $searchKeyword = $_GET['txtSearchByTitle'];
    $searchKeywords = explode(' ', trim($searchKeyword)); // Split by space

    if (!empty($searchKeywords)) {
        $sql .= " AND (";

        $conditions = array();
        foreach ($searchKeywords as $word) {
            $word = $database->filter($word); // Sanitize each word
            $conditions[] = "(member_firstname LIKE '%$word%' 
                             OR member_lastname LIKE '%$word%' 
                             OR member_email LIKE '%$word%' 
                             OR member_phone LIKE '%$word%'						 
                             OR member_company LIKE '%$word%'
                             OR member_tradingname LIKE '%$word%')";
        }

        // Combine all conditions with OR and append to SQL
        $sql .= implode(' OR ', $conditions);
        $sql .= ")";
    }
}



   /* if ($_GET['txtSearchByTitle'] != "") {
        $sql .= " AND (member_firstname LIKE '%" . $database->filter($_GET['txtSearchByTitle']) . "%' OR member_lastname LIKE '%" . $database->filter($_GET['txtSearchByTitle']) . "%' OR member_email LIKE '%" . $database->filter($_GET['txtSearchByTitle']) . "%' OR member_phone LIKE '%" . $database->filter($_GET['txtSearchByTitle']) . "%' OR member_company LIKE '%" . $database->filter($_GET['txtSearchByTitle']) . "%')";
    }*/

	if ($_GET['ty']=="")
    $sql .= " and member_imported=0 ORDER BY member_id DESC";
	else 
	$sql .= " and member_imported=1 ORDER BY member_firstname asc";

    $pagingObject->setMaxRecords(PAGELIMIT);
    $sql = $pagingObject->setQuery($sql);
    $results = $database->get_results($sql);

    showRecordsListing($results);
}

function saveFormValues() {
    global $database, $component;

    $curDateTime = date('Y-m-d H:i:s');
    $password = rand(10000, 99999);

    $names = array(
        'member_firstname' => $_POST['txtFirstName'],
        'member_lastname' => $_POST['txtLastName'],
        'member_email' => $_POST['txtEmail'],
        'member_password' => md5($password),
        'member_phone' => $_POST['txtPhone'],
        'member_company' => $_POST['txtCompany'],
        'member_tradingname' => $_POST['txtTradingName'],
		'member_crm' => $_POST['cmbCRM'],
        'member_website' => $_POST['txtWebsite'],
        'member_address' => $_POST['txtAddress'],
        'member_ip' => $_SERVER['REMOTE_ADDR'],
        'member_regdate' => $curDateTime,
        'member_type' => 1,
        'member_email_verify' => 1,
        'member_phone_verify' => 1,
        'member_status' => $_POST['rdoPublished']
    );

    $add_query = $database->insert('tbl_members', $names);
	
	//---------send  email------
		
		
		if ($_POST['ckEmail']==1)
		{
		
					include PATH."include/email-templates/email-template.php";
					include PATH."mail/sendmail.php";
					
					
					
				$sqlEmail="select * from tbl_emails where email_id=54 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					
					$loginLink='<a href="'.URL.'login">Login here</a>';
					
					$emailContent=str_replace("<name>",$_POST['txtTradingName'],$emailContent);
					$emailContent=str_replace("<name_of_crm>",$_POST['cmbCRM'],$emailContent);
					$emailContent=str_replace("<email>",$_POST['txtEmail'],$emailContent);
					$emailContent=str_replace("<password>",$password,$emailContent);
					$emailContent=str_replace("<login_link>",$loginLink,$emailContent);					
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				


				$ToEmail=$_POST['txtEmail'];
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend=$rowEmail['email_heading'];
				$BodySend=$mailBody;	
				
				
				

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
		
				
		
		}
		
		
		$update = array(
        'br_status' => 2
   		 );

		$where_clause = array(
			'br_id' => base64_decode($_POST['rid'])
		);
		
		$updated = $database->update('tbl_broker_request', $update, $where_clause, 1);


		
		
		//---------end sending verification code in email---

    if ($add_query) {
		if ($_POST['rid']!="")
		print "<script>window.location='index.php?c=agency-requests&ty=1'</script>";
		else
        print "<script>window.location='index.php?c=" . $component . "'</script>";
    }
}

function createFormForPages($id) {
    global $database;
    $sql = "SELECT * FROM tbl_members WHERE member_id='" . $database->filter($id) . "'";
    $results = $database->get_results($sql);
    createFormForPagesHtml($results);
}

function createFormForPages_detail($id) {
    global $database;
    $sql = "SELECT * FROM tbl_members WHERE member_id='" . $database->filter($id) . "'";
    $results = $database->get_results($sql);
    createFormForPagesHtml_details($results);
}

function saveModificationsOperation() {
    global $database, $component;

    $update = array(
        'member_firstname' => $_POST['txtFirstName'],
        'member_lastname' => $_POST['txtLastName'],
        'member_email' => $_POST['txtEmail'],
        'member_phone' => $_POST['txtPhone'],
        'member_company' => $_POST['txtCompany'],
        'member_tradingname' => $_POST['txtTradingName'],
        'member_website' => $_POST['txtWebsite'],
        'member_address' => $_POST['txtAddress'],
        'member_status' => $_POST['rdoPublished']
    );

    $where_clause = array(
        'member_id' => $_POST['pid']
    );

    $updated = $database->update('tbl_members', $update, $where_clause, 1);

    if ($updated) {
        print "<script>window.location='index.php?c=" . $component . "&Cid=6'</script>";
    }
}

function publishSelectedItems() {
    global $database, $component;

    foreach ($_GET['deletes'] as $provinceIdToPublish) {
        $update = array(
            'member_status' => 1
        );

        $where_clause = array(
            'member_id' => $provinceIdToPublish
        );

        $updated = $database->update('tbl_members', $update, $where_clause, 1);
    }

    if ($updated) {
        print "<script>window.location='index.php?c=" . $component . "'</script>";
    }
}

function unpublishSelectedItems() {
    global $database, $component;

    foreach ($_GET['deletes'] as $provinceIdToPublish) {
        $update = array(
            'member_status' => 0
        );

        $where_clause = array(
            'member_id' => $provinceIdToPublish
        );

        $updated = $database->update('tbl_members', $update, $where_clause, 1);
    }

    if ($updated) {
        print "<script>window.location='index.php?c=" . $component . "'</script>";
    }
}

function removeSelectedItems() {
    global $database, $component;

    foreach ($_GET['deletes'] as $provinceIdToPublish) {
        $where_clause = array(
            'member_id' => $provinceIdToPublish
        );

        $delete = $database->delete('tbl_members', $where_clause, 1);
    }

    if ($delete) {
        print "<script>window.location='index.php?c=" . $component . "'</script>";
    }
}

function removeDeletedItems() {
    global $database, $component;

    $where_clause = array(
        'member_id' => $_GET['id']
    );

    $del = $database->delete('tbl_members', $where_clause, 1);
    print "<script>window.location='index.php?c=" . $component . "'</script>";
}