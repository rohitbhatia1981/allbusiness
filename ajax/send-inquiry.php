<?php include "../private/settings.php";

if ($_POST['txtName']!="" && $_POST['txtEmail']!="" && $_POST['txtPhone']!="")
{

	
	//$sqlCheck="select * from tbl_members where member_email='".$database->filter($_POST['txtEmail'])."'";
	//$resCheck=$database->get_results($sqlCheck);
	//if (count($resCheck)==0)
	//{
				 
		 $curDate = date('Y-m-d H:i:s');		 
		 $values = array(		
			'inquiry_name' => $_POST['txtName'],			
			'inquiry_email' => $_POST['txtEmail'],
			'inquiry_phone' => $_POST['txtPhone'],
			'inquiry_message' => $_POST['txtMessage'],
			'inquiry_listing_id' => $_POST['listingId'],			
			'inquiry_date' => $curDate
			
			);			

			$add_query = $database->insert( 'tbl_inquiry', $values );
			$lastInsertedId=$database->lastid();			
			
			//$_SESSION['uid']=$lastInsertedId;			
			
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				//--------Settings all values--------
				/*
				$receiverName=$_POST['txtTitle']." ".$_POST['txtFirstName']." ".$_POST['txtMiddleName']." ".$_POST['txtLastName'];
				$veriLink='<a href="'.URL.'crm/activate?auth='.$verificationCode.'&e='.encryptId($lastInsertedId).'">Verify email address</a>';
				$contactus='<a href="'.URL.'contact-us">contact us</a>';
				
				

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
	
		*/
	

		echo "1";
						
	}

else
echo "Something went wrong";





 ?>











      



    