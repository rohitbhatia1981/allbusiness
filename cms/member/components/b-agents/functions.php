<?php
function showList() {
    global $database, $page, $pagingObject;
   $sql = "SELECT * FROM tbl_member_agents WHERE agent_agency_id='".$database->filter($_SESSION['sess_member_id'])."'";

    if ($_GET['txtSearchByTitle'] != "") {
        $sql .= " AND (agent_name LIKE '%" . $database->filter($_GET['txtSearchByTitle']) . "%' OR agent_email LIKE '%" . $database->filter($_GET['txtSearchByTitle']) . "%' OR agent_mobile LIKE '%" . $database->filter($_GET['txtSearchByTitle']) . "%' OR agent_phone LIKE '%" . $database->filter($_GET['txtSearchByTitle']) . "%')";
    }
	
	if ($_GET['cmbAgency'] != "") {
        $sql .= " AND agent_agency_id ='" . $database->filter($_GET['cmbAgency']) . "'";
    }
	
	

    $sql .= " ORDER BY agent_name asc";

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
        'agent_name' => $_POST['txtFirstName'],
        'agent_lastname' => $_POST['txtLastName'],
        'agent_email' => $_POST['txtEmail'],
        'agent_mobile' => $_POST['txtPhone'],
        'agent_agency_id' => $_SESSION['sess_member_id'],      
        'agent_status' => $_POST['rdoPublished']
    );

    $add_query = $database->insert('tbl_member_agents', $names);
	$lastInsertedId=$database->lastid();
	
	if (!empty($_POST['images4ex'])) {			
		
				$imageName=$_POST['images4ex'][0];
				
				$update = array(
				'agent_picture' => $imageName			
				);
				
				$where_clause = array(
				'agent_id' => $lastInsertedId
				);
				
				$updated = $database->update( 'tbl_member_agents', $update, $where_clause, 1 );
				
				
			
		
		}

    if ($add_query) {
        print "<script>window.location='index.php?c=" . $component . "'</script>";
    }
}

function createFormForPages($id) {
    global $database;
    $sql = "SELECT * FROM tbl_member_agents WHERE agent_id='" . $database->filter($id) . "'";
    $results = $database->get_results($sql);
    createFormForPagesHtml($results);
}

/*function createFormForPages_detail($id) {
    global $database;
    $sql = "SELECT * FROM tbl_member_agents WHERE agent_id='" . $database->filter($id) . "'";
    $results = $database->get_results($sql);
    createFormForPagesHtml_details($results);
}*/

function saveModificationsOperation() {
    global $database, $component;

    $update = array(
        'agent_name' => $_POST['txtFirstName'],
        'agent_lastname' => $_POST['txtLastName'],
        'agent_email' => $_POST['txtEmail'],
        'agent_mobile' => $_POST['txtPhone'],
		'agent_status' => $_POST['rdoPublished']
    );

    $where_clause = array(
        'agent_id' => $_POST['pid']
    );

    $updated = $database->update('tbl_member_agents', $update, $where_clause, 1);

    if ($updated) {
        print "<script>window.location='index.php?c=" . $component . "'</script>";
    }
}

function publishSelectedItems() {
    global $database, $component;

    foreach ($_GET['deletes'] as $provinceIdToPublish) {
        $update = array(
            'agent_status' => 1
        );

        $where_clause = array(
            'agent_id' => $provinceIdToPublish
        );

        $updated = $database->update('tbl_member_agents', $update, $where_clause, 1);
    }

    if ($updated) {
        print "<script>window.location='index.php?c=" . $component . "'</script>";
    }
}

function unpublishSelectedItems() {
    global $database, $component;

    foreach ($_GET['deletes'] as $provinceIdToPublish) {
        $update = array(
            'agent_status' => 0
        );

        $where_clause = array(
            'agent_id' => $provinceIdToPublish
        );

        $updated = $database->update('tbl_member_agents', $update, $where_clause, 1);
    }

    if ($updated) {
        print "<script>window.location='index.php?c=" . $component . "'</script>";
    }
}

function removeSelectedItems() {
    global $database, $component;

    foreach ($_GET['deletes'] as $provinceIdToPublish) {
        $where_clause = array(
            'agent_id' => $provinceIdToPublish
        );

        $delete = $database->delete('tbl_member_agents', $where_clause, 1);
    }

    if ($delete) {
        print "<script>window.location='index.php?c=" . $component . "'</script>";
    }
}

function removeDeletedItems() {
    global $database, $component;

    $where_clause = array(
        'agent_id' => $_GET['id']
    );

    $del = $database->delete('tbl_member_agents', $where_clause, 1);
    print "<script>window.location='index.php?c=" . $component . "'</script>";
}