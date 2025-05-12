<?php include "../../../private/settings.php";
if ($_POST['type']!="" && $_POST['val']!="" && $_POST['adId']!="" && $_SESSION['sess_member_id']!="")
{

$adId=base64_decode($_POST['adId']);
	
	
	
		 $getCredits="select * from tbl_agency_ads_inventory where inventory_agency_id='".$_SESSION['sess_member_id']."'";
		$resCredits=$database->get_results($getCredits);
		if (count($resCredits)>0)
		{
			
			$rowCredits=$resCredits[0];	
			
			$valDays=$_POST['val'];
			
			if ($_POST['type']=="p")
			{			
			$fieldName="inventory_premium_".$valDays;			
			$creditCheck=$rowCredits[$fieldName];
			$planId=3;
			
			if ($valDays==90)
			{
			$bumpTotal=2;
			$adTypeUsage="Premium 90 Days";
			}
			else
			{
			$bumpTotal=4;
			$adTypeUsage="Premium 180 Days";
			}
			
			} else if ($_POST['type']=="a")
			{			
			$fieldName="inventory_advanced_".$valDays;			
			$creditCheck=$rowCredits[$fieldName];
			$planId=2;
			
				if ($valDays==90)
				{
				$bumpTotal=1;
				$adTypeUsage="Advanced 90 Days";
				}
				else
				{
				$bumpTotal=2;
				$adTypeUsage="Advanced 180 Days";
				}
			}
			
			$planExpiry = date('Y-m-d', strtotime("+$valDays days"));
			
			if ($creditCheck>0)
			{
				
				
				//------update ad type
				
				$update = array(
				'business_plan_id' => $planId, //$_SESSION['sess_member_id'],	
				'business_plan_expiry_date' => $planExpiry,
				'business_plan_bumpup_total' => $bumpTotal
				

				);
				
				$where_clause = array(
					'business_id' => $adId,
					'business_owner_id' => $_SESSION['sess_member_id']
					
				);
				
				
				
				
				$updated = $database->update( 'tbl_business', $update, $where_clause, 1 );
			
			
				//--------deduct inventory---
			
				$sqlCredits = "UPDATE tbl_agency_ads_inventory
               SET $fieldName = $fieldName - 1
               WHERE inventory_agency_id = '" . $_SESSION['sess_member_id'] . "'";
			
			   $database->query($sqlCredits);
				
			
				//-----------Ad redemption of Ads log
				
				$curDateTime = date('Y-m-d H:i:s');
				
				
				$names = array(		
				'usage_agency_id' => $_SESSION['sess_member_id'],	
				'usage_ad_id' => $adId,
				'usage_description' => $adTypeUsage,			
				'usage_date' => $curDateTime
				);	
	
				$add_query = $database->insert( 'tbl_ad_usage', $names );
				
				
				
				include PATH."include/email-templates/email-template.php";
				include_once PATH."mail/sendmail.php";
				
				
				
				//--------Fetch ad Title---
				
				$sqlBusiness="select business_heading from tbl_business where business_id='".$database->filter($adId)."'";
			    $resBusiness=$database->get_results($sqlBusiness);
				$rowBusiness=$resBusiness[0];
				
				$adTitle=str_replace("amp;","",$rowBusiness['business_heading']);
				
				//--------end fetch ad title
				
				//-------Fetch user information-----
				
				$sqlMember="select * from tbl_members where member_id='".$_SESSION['sess_member_id']."'";
			    $resMember=$database->get_results($sqlMember);
				$rowMember=$resMember[0];
				
				$membername=$rowMember['member_firstname']." ".$rowMember['member_lastname'];
				$memberemail=$rowMember['member_email'];			
				
				
				//-------end fetch user information---
				
				$sqlEmail="select * from tbl_emails where email_id=56 and email_status=1";
			    $resEmail=$database->get_results($sqlEmail);			
			
				if (count($resEmail)>0)
				{
									
					$rowEmail=$resEmail[0];
					$emailContent=fnUpdateHTML($rowEmail['email_description']);					
					$emailContent=str_replace("<ad_title>","<strong>".$adTitle."</strong>",$emailContent);
					$emailContent=str_replace("<ad_id>","<strong>".$adId."</strong>",$emailContent);
					$emailContent=str_replace("<name>",$membername,$emailContent);														
					$emailContent=str_replace("\n","<br>",$emailContent);
					
					
					$headingContent=$emailContent;

					$mailBody=generateEmailBody($headingTemplate,$headingContent,$buttonTitle,$buttonLink,$bottomHeading,$bottomText);				
					
					
				
				


				$ToEmail=$memberemail;
				$FromEmail=ADMIN_FORM_EMAIL;
				$FromName=FROM_NAME;
				
				$SubjectSend=$rowEmail['email_heading'];
				$BodySend=$mailBody;	
				
				

				SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend);
				}
				
				
				//-----------end Ad redemption of ads log
			
			
		
				echo "1";
				
				//------end update ad type--
				
				
				
				
			}
			
			}
		
		
		
	
	
}
?>