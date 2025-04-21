<?php include "../../../private/settings.php";
if ($_POST['type']!="" && $_POST['val']!="" && $_POST['adId']!="" && $_SESSION['sess_member_id']!="")
{

$adId=decryptId($_POST['adId']);
	
	
	
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
					'business_id' => base64_decode($adId),
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
				
				//-----------end Ad redemption of ads log
			
			
		
				echo "1";
				
				//------end update ad type--
				
				
				
				
			}
			
			}
		
		
		
	
	
}
?>