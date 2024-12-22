<?php

//defined('_VALID_ACCESS') or die("Invalid Access");





$component="dashboard";

$task=$_GET['task'];



require_once(PATH.FOLDER_MEMBER."components/".$component."/functions.php");

require_once(PATH.FOLDER_MEMBER."components/".$component."/view.php");



switch($task)

	{

		

		case "add":

			createFormForPages(0);

			break;

		

		default:

			showList();

			break;

		

		

		

		

	}







?>

