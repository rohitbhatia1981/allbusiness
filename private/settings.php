<?php session_start();
/*ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);*/

date_default_timezone_set('Australia/Melbourne');

//if (preg_match('/localhost/', $_SERVER['HTTP_HOST'])) {
define("URL","http://{$_SERVER['SERVER_NAME']}/allbusiness/");
define("PATH","{$_SERVER['DOCUMENT_ROOT']}/allbusiness/");
/*}
else
{
define("URL","https://{$_SERVER['SERVER_NAME']}/projects/allbusiness/");
define("PATH","{$_SERVER['DOCUMENT_ROOT']}/projects/allbusiness/");
}*/

include_once(PATH."private/filenames.php");
include_once(PATH."private/configuration.php");

require_once( PATH.'classes/class.db.php' );
$database = new DB();

require_once( PATH.'classes/class_thumbnails.php' );
$image = new Thumbnail();

require_once(PATH."classes/pagination.php");
$pagingObject = new pagingRecords();

include_once(PATH."includes/front-common-functions.php");

//$loadSettingsData=$database->get_results("select * from tbl_settings");
//$resultSettingsData = $loadSettingsData[0];




//$loadSettingsData=$database->get_results("select * from tbl_settings");

//$resultSettingsData = $loadSettingsData[0];

define ("CURRENCY","$");
define ("TITLE","All Business");
define("ADMIN_EMAIL","rohitbhatia1@gmail.com");


define("ADMIN_FORM_EMAIL","info@hidemos.com");

define("ADMIN_GENERAL_EMAIL","rohitbhatia1@gmail.com");

define("FROM_NAME","All Business");

define ("JOB_ID","LBJ-");

define ("SITE_PHONE","XXX-XXX-XXX3");


define ("ENCRYPTION_KEY","9q7B3RVQ670ntKl");



?>