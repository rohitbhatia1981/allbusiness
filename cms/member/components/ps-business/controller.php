<?php

//defined('_VALID_ACCESS') or die("Invalid Access");



$component=$_GET['c'];

$task=@$_GET['task'];

$id=@$_GET['id'];





require_once(PATH.FOLDER_MEMBER."components/".$component."/functions.php");

require_once(PATH.FOLDER_MEMBER."components/".$component."/view.php");



switch($task)

	{

		

		case "add":

			createFormForPages(0);

			break;

		

		case "edit":

			createFormForPages($id);

			break;
			
		
		case "detail":
		createFormForPages_detail($id);
		break;

		

		case "save":

			saveFormValues();

			break;

		

		case 'saveedit':



			saveModificationsOperation();



			break;

			

		case 'publishList':

			

			publishSelectedItems();



			break;

			

		case 'unpublishList':

			

			unpublishSelectedItems();



			break;

			

		case 'remove':

			

			removeSelectedItems();



			break;
			
		
		case 'subscribe':
		fnSubscribe();
		break;
		
		case 'paynow':
		fnPaynow();
		break;

		

		default:

			showList();

			break;

			
			
		case 'deleted':

			

			removeDeletedItems();
	
	
	
			break;	


		/*case "edit":

			createFormForPages($id);

			break;

		case "save":

			saveFormValues();

			break;*/

		

	}







?>

