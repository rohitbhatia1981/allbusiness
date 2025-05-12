<?php include "../private/settings.php";

if ($_POST['txtName']!="" && $_POST['txtEmail']!="" && $_POST['txtPhone']!="")
{

	$businessId=$_POST['listingId'];
	
	$sqlBusiness="select business_agent_id from tbl_business where business_id='".$database->filter($businessId)."'";
	$resBusiness=$database->get_results($sqlBusiness);
	$rowBusiness=$resBusiness[0];
	
	$agentIds=$rowBusiness['business_agent_id'];
	
	$arrAgentIds=explode(",",$agentIds);
	
	
	
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
			
			echo "1";			
			
			//$_SESSION['uid']=$lastInsertedId;			
			
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				
				//--------Fetch ad Title---
				
				$sqlBusiness="select business_id,business_heading,business_category from tbl_business where business_id='".$database->filter($_POST['listingId'])."'";
			    $resBusiness=$database->get_results($sqlBusiness);
				$rowBusiness=$resBusiness[0];
				
				$adTitle=str_replace("amp;","",$rowBusiness['business_heading']);
				$adId=$_POST['listingId'];
				$category=getBusinessCategoryName($rowBusiness['business_category']);
				$address = getBusinessAddress($rowBusiness['business_id']);
				
				//--------end fetch ad title
				
				//--------Settings all values--------
				
				
						
				

				$sqlEmail="select * from tbl_emails where email_id=57 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);
			
			
				if (count($resEmail)>0)
				{
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);
					
					
					if (count($arrAgentIds)>0)
					{
					
						for ($k=0;$k<count($arrAgentIds);$k++)
						{
							$sqlAgent="select * from tbl_member_agents where agent_id='".$database->filter($arrAgentIds[$k])."'";
							$resAgent=$database->get_results($sqlAgent);
							$rowAgent=$resAgent[0];
							$receiverName=$rowAgent['agent_name']." ".$rowAgent['agent_lastname'];
							$receiverEmail=$rowAgent['agent_email'];
							
							
							$emailContent=str_replace("<agent_name>",$receiverName,$emailContent);
							$emailContent=str_replace("<ad_title>","<strong>".$adTitle."</strong>",$emailContent);	
							$emailContent=str_replace("<ad_id>","<strong>".$adId."</strong>",$emailContent);
							$emailContent=str_replace("<category>","<strong>".$category."</strong>",$emailContent);
							$emailContent=str_replace("<location>","<strong>".$address."</strong>",$emailContent);
							$emailContent=str_replace("<broker_name>","<strong>".$receiverName."</strong>",$emailContent);
							
							$emailContent=str_replace("<contact_name>","<strong>".$_POST['txtName']."</strong>",$emailContent);
							$emailContent=str_replace("<contact_email>","<strong>".$_POST['txtEmail']."</strong>",$emailContent);
							$emailContent=str_replace("<contact_phone>","<strong>".$_POST['txtPhone']."</strong>",$emailContent);
							$emailContent=str_replace("<contact_message>","<strong>".$_POST['txtMessage']."</strong>",$emailContent);
												
							$emailContent=str_replace("\n","<br>",$emailContent);					
							$headingContent=$emailContent;
							$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
							
							$ToEmail=$receiverEmail;
							$FromEmail=ADMIN_FORM_EMAIL;
							$FromName=FROM_NAME;
						
							$SubjectSend=$rowEmail['email_heading'];
							$BodySend=$mailBody;	
							
		
							SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
							
						}
					
					}



					
				}
	
		
	

		
						
	}

else
echo "Something went wrong";





 ?>











      



    