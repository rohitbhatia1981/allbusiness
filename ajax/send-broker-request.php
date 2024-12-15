<?php include "../private/settings.php";

if ($_POST['txtFirstName']!="" && $_POST['txtEmail']!=""  && $_POST['txtPhone']!="")
{
	
		
	
	$curDate = date("Y-m-d H:i:s");
	
	$names = array(

			'br_first_name' => $_POST['txtFirstName'], 
			'br_last_name' => $_POST['txtLastName'],
			'br_email' => md5($_POST['txtEmail']), 
			'br_phone' => $_POST['txtPhone'],	
			'br_company' => $_POST['txtCompanyName'],	
			'br_website' => $_POST['txtWebsite'],	
			'br_trading_name' => $_POST['txtBusinessTradingName'],		
			'br_address' => $_POST['txtAddress'],							
			'br_date' => $curDate
			
		);
		
		

		$add_query = $database->insert( 'tbl_broker_request', $names );
		
		
		//---------send  email------
		
		
					include PATH."include/email-templates/email-template.php";
					include PATH."mail/sendmail.php";
		
				
					$emailContent="Dear Admin, <br><br>
					Received new request from broker, please login in admin to review it.
					";
					$headingContent=$emailContent;
					$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
				

				$ToEmail=ADMIN_EMAIL;
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend="New Broker Request";
				$BodySend=$mailBody;
				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
		
		
		
		//---------end sending verification code in email---
		
		echo "1";
		
		
	}
	else echo "2";

 ?>
 