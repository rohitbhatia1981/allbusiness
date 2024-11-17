<?php
function showList() {
    global $database, $page, $pagingObject;
    $sql = "SELECT * FROM tbl_members WHERE 1";

    if ($_GET['txtSearchByTitle'] != "") {
        $sql .= " AND (member_firstname LIKE '%" . $database->filter($_GET['txtSearchByTitle']) . "%' OR member_lastname LIKE '%" . $database->filter($_GET['txtSearchByTitle']) . "%' OR member_email LIKE '%" . $database->filter($_GET['txtSearchByTitle']) . "%' OR member_phone LIKE '%" . $database->filter($_GET['txtSearchByTitle']) . "%')";
    }

    $sql .= " ORDER BY member_id DESC";

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

    if ($add_query) {
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