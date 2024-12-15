<?php include "../private/settings.php";

if ($_POST['txtFirstName']!="" && $_POST['txtEmail']!="" && $_POST['txtLastName']!="")
{

	
	$sqlCheck="select * from tbl_members where member_email='".$database->filter($_POST['txtEmail'])."'";
	$resCheck=$database->get_results($sqlCheck);
	if (count($resCheck)==0)
	{
				 
		 $curDate = date('Y-m-d H:i:s');		 
		 $values = array(		
			'member_firstname' => $_POST['txtFirstName'],			
			'member_lastname' => $_POST['txtLastName'],
			'member_email' => $_POST['txtEmail'],
			'member_password' => md5($_POST['txtPassword']),
			'member_phone' => $_POST['txtPhone'],
			'member_type' => 3,			
			'member_regdate' => $curDate,
			'member_ip' => $_SERVER['REMOTE_ADDR']
			);			

			$add_query = $database->insert( 'tbl_members', $values );
			$lastInsertedId=$database->lastid();			
			
			//$_SESSION['uid']=$lastInsertedId;			
			
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				//--------Settings all values--------
				
				$receiverName=$_POST['txtTitle']." ".$_POST['txtFirstName']." ".$_POST['txtMiddleName']." ".$_POST['txtLastName'];
				$veriLink='<a href="'.URL.'crm/activate?auth='.$verificationCode.'&e='.encryptId($lastInsertedId).'">Verify email address</a>';
				$contactus='<a href="'.URL.'contact-us">contact us</a>';
				
				//end Settings all values

				$sqlEmail="select * from tbl_emails where email_id=15 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					$emailContent=str_replace("<name>",$receiverName,$emailContent);
					$emailContent=str_replace("<verification_link>",$veriLink,$emailContent);
					$emailContent=str_replace("<contact_us_link>",$contactus,$emailContent);
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				


				$ToEmail=$_POST['txtEmail'];
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="Buyer Account Email Verification";
				$BodySend=$mailBody;	

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
	
		
	

		echo "1";
						
	}
	else
	{
		$rowCheck=$resCheck[0];
		if ($rowCheck['member_type']==1)
		echo "You are already registered as broker, please use another email";
		else if ($rowCheck['member_type']==2)
		echo "You are already registered as private seller, please us another email";
		else if ($rowCheck['member_type']==3)
		echo "You are already registered with us, please login to continue";
		else
		echo "Something went wrong";
		
	}



	}
else
echo "Something went wrong";





 ?>











      



    