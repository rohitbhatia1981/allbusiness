<?php 



include_once("../../private/settings.php");
unset ($_SESSION['sess_member_id']);
unset($_SESSION['sess_member_groupid']);
			
			



			//session_unset();

	

			header("location:".URL."cms/login");	  





?>