<?php include "../private/settings.php"; 

if ($_POST['txtEmail']!="" && $_POST['txtPassword']!="")
{

//print "select * from tbl_agents where agent_email = '".$database->filter($_POST['txtLoginEmail'])."' and agent_password='".$database->filter(md5($_POST['txtLoginPassword']))."' and agent_status='1'";

 $sqlCheck = "select * from tbl_members where member_email = '".$database->filter($_POST['txtEmail'])."' and member_password='".$database->filter(md5($_POST['txtPassword']))."' and member_status='1'";
 $result = $database->get_results($sqlCheck);
 $totalMember = count($result);

				if($totalMember>0)
				{
					

					$rowMemberid = $result[0]; 
					
					if ($rowMemberid['member_type']==1)
					$groupId="5";
					else if ($rowMemberid['member_type']==2)
					$groupId="4";
					if ($rowMemberid['member_type']==3)
					$groupId="6";				
					
					
					$_SESSION['sess_member_id'] = $rowMemberid['member_id'];					
					$_SESSION['sess_member_groupid'] = $groupId;
					
					
					
					//
					
			        /*$_SESSION['sess_patient_username'] = $rowMemberid['patient_email'];
			        $_SESSION['sess_patient_name'] = $rowMemberid['patient_first_name']." ".$rowMemberid['patient_last_name'];
			        $_SESSION['sess_patient_email'] = $rowMemberid['patient_email'];	
					$_SESSION['sess_patient_pharmacy'] = $rowMemberid['patient_pharmacy'];			       
			        $_SESSION['sess_patient_groupid'] = 4;*/
					
					
					

		
					//----------Creating log--------
		
					/*$name=$_SESSION['name'];
					$uid=$_SESSION['sess_patient_id'];
					$utype="patient";
					$action=$name." has login to his account";
					
					createLogs($uid,$utype,$action);*/
		
				//----------end creating log
		
		
									
					
					/*  -- Record last login------
					$todaysDate=date("Y-m-d h:m:s");
					
					$sqlUpdate="update tbl_member set agent_last_logged='".$todaysDate."' where agent_id='".$database->filter($_SESSION['agentId'])."'";
					$database->query($sqlUpdate);
					
					*/
			
				//setcookie("cookie_memberId", $rowMember->member_id,0,"/");
				
					echo "1";	
		}

	
	else
	{
		echo "Invalid username or password. Please try again";
	}



}
else
echo "Something went wrong";





?>