<?php session_start();
/*ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);*/

date_default_timezone_set('Australia/Melbourne');

define("URL","http://{$_SERVER['SERVER_NAME']}/allbusiness/");
define("PATH","{$_SERVER['DOCUMENT_ROOT']}/allbusiness/");


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
define ("TITLE","Demo CMS");
define("ADMIN_EMAIL1","info@2fabdesigns.net");
define("ADMIN_EMAIL2","info@2fabdesigns.net");

define("ADMIN_FORM_EMAIL","info@localbuilderfinder.com.au");

define("ADMIN_GENERAL_EMAIL","info@localbuilderfinder.com.au");

define("FROM_NAME","Local Builder Finder");

define ("JOB_ID","LBJ-");

define ("SITE_PHONE","XXX-XXX-XXXX");






?>