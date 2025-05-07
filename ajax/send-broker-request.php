<?php include "../private/settings.php";

if ($_POST['txtFirstName']!="" && $_POST['txtEmail']!=""  && $_POST['txtPhone']!="")
{
	
		
	
	$curDate = date("Y-m-d H:i:s");
	
	$names = array(

			'br_first_name' => $_POST['txtFirstName'], 
			'br_last_name' => $_POST['txtLastName'],
			'br_email' => $_POST['txtEmail'], 
			'br_phone' => $_POST['txtPhone'],	
			'br_company' => $_POST['txtCompanyName'],
			'br_director_name' => $_POST['txtDirector'],	
			'br_website' => $_POST['txtWebsite'],	
			'br_trading_name' => $_POST['txtBusinessTradingName'],
			'br_crm' => $_POST['cmbCRM'],		
			'br_address' => $_POST['txtAddress'],							
			'br_date' => $curDate
			
		);
		
		

		$add_query = $database->insert( 'tbl_broker_request', $names );
		
		
		//---------send  email------
		
				include PATH."include/email-templates/email-template.php";
					include PATH."mail/sendmail.php";
				
				//$contactus='<a href="'.URL.'contact-us">contact us</a>';
				
				//end Settings all values

				$sqlEmail="select * from tbl_emails where email_id=53 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					/*$emailContent=str_replace("<name>",$receiverName,$emailContent);
					$emailContent=str_replace("<verification_link>",$veriLink,$emailContent);
					$emailContent=str_replace("<contact_us_link>",$contactus,$emailContent);*/
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					$headingContent=$emailContent;

				$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				


				$ToEmail=ADMIN_EMAIL;
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend=$rowEmail['email_heading'];
				$BodySend=$mailBody;	
				

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
				
				
				
				
		
		
		
		//---------end sending verification code in email---
		
		echo "1";
		
		
	}
	else echo "2";

 ?>
 