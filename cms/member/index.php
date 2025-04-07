<?php 

	

	define('_VALID_ACCESS',1);

	include_once("../../private/settings.php");  //--Including settings 

	$currentTemplate = 'black';

	$error = '';

	if(isset($_SESSION['sess_member_id']) && ($_SESSION['sess_member_id']!="") && (isset($_SESSION['sess_member_id'])) )

	{

	

		 require_once(PATH.FOLDER_MEMBER."templates/black/index.php");	  

	}

	else 

	{	

	   if(isset($_POST['submit']))

       {

	        //$qry = "SELECT * FROM tbl_user WHERE username='".$_POST['username']."' and user_password='".md5($_POST['password'])."'";

		    $checklogin = $database->get_results("SELECT * FROM tbl_users WHERE username='".$database->filter($_POST['username'])."' and password='".$database->filter(md5($_POST['password']))."'");

			if(count($checklogin) == 1){

			$user = $checklogin[0];													   

				//print_r($user);
				
				//unset ($_SESSION['sess_prescriber_id']);
				//unset ($_SESSION['sess_patient_id']);
				//unset ($_SESSION['sess_pharmacy_id']);

		            $_SESSION['sess_member_id'] = $user['user_id'];

			        $_SESSION['username'] = $user['username'];

			        $_SESSION['name'] = $user['name'];

			        $_SESSION['email'] = $user['email'];

			        $_SESSION['alt_email'] = $user['alt_email'];

			        $_SESSION['sess_member_groupid'] = $user['groupid'];

			        $_SESSION['parentgroupid'] = $user['parentgroupid'];

			        $_SESSION['cityid'] = $user['cityid'];

					$_SESSION['user_status'] = $user['user_status'];

					$_SESSION['company'] = $user['company'];

					$_SESSION['parentuserid'] = $user['parentuserid'];

					

					if($user['user_status'] == 1)

			        {

				    //echo    header("location:".URL.FOLDER_MEMBER."index.php");
					  print "<script>window.location='".URL.FOLDER_MEMBER."index.php'</script>";
					  exit;

					    // require_once(PATH.FOLDER_MEMBER."templates/black/index.php");	  

					   

			        }

		            else

			        {

			            $error="<font color='red'>Your account has been blocked. Please contact administrator for details.</font>";

			        }

					

                   

			    

			}

			else

		    {

		        $error="<font color='red'>Invalid User Name Or Password</font>";

		    }

        }

		

		require_once(PATH.FOLDER_MEMBER."templates/".$currentTemplate."/login.php");	

    }

	 

		

?>

