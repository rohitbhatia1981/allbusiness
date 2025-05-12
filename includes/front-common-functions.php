<?php
function getProductPrice($menuId)
	{
		global $database;
		$menuPrice=$database->get_row("select * from tbl_prices where price_product_id='".$database->filter($menuId)."' order by price_value asc limit 0,1");
		return $menuPrice[3];
	}

function fn_GiveMeDateInDisplayFormat($datetoupdate)
	{
		if($datetoupdate!='' && $datetoupdate!='0000-00-00')
		{
			 $rdate = explode("-",$datetoupdate);
			 $y = $rdate[0];
			 $m = $rdate[1];
			 $d = $rdate[2];
			 return $newDate=$d."/".$m."/".$y;
		}
		else
		{
			return "";
		}
	}

function fn_GiveMeDateTimeInDisplayFormat($dateTimeToUpdate) {
    if ($dateTimeToUpdate != '' && $dateTimeToUpdate != '0000-00-00 00:00:00') {
        $dateTime = new DateTime($dateTimeToUpdate);
        return $dateTime->format('d/m/Y H:i:s');
    } else {
        return "";
    }
}



function fn_TrueDateFormat($datetoupdate)

	{

	 $rdate = explode("/",$datetoupdate);

	 $d = $rdate[0];

	 $m = $rdate[1];

	 $y = $rdate[2];

	 if($datetoupdate!="") 

	 return $newDate=$y."-".$m."-".$d;

	 else

	 return "";

	}

function fnUpdateHTML($text)
{
	$description=str_replace("&lt;","<",$text);
	$description=str_replace("&gt;",">",$description);
	$description=str_replace("&quot;",'"',$description);
	$description=str_replace("&amp;rsquo;","'",$description);
	$description=str_replace("&amp;nbsp;"," ",$description);
	$description=str_replace("&amp;","&",$description);
	 
	
	return $description;
}


function getParentCategory($id)
{
	global $database;
	$sqlCategory="select * from tbl_categories where category_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['category_name']!="")
	echo $rowCategory['category_name'];
	else
	echo "-";
	
	
}




function getRegionId($regionName)
{
	global $database;

	$sql = "SELECT * FROM tbl_regions WHERE region_name = '".$database->filter($regionName)."' AND region_status = 1";
	$result = $database->get_results($sql);

	if (!empty($result)) {
		$row = $result[0];
		return array(
			'region_id' => $row['region_id'],
			'region_greater_region' => $row['region_greater_region']
		);
	} else {
		return array(
			'region_id' => null,
			'region_greater_region' => null
		);
	}
}


function getLeadsCount($id)
{
	global $database;
	if ($id==0)
	$sqlLeads="select * from tbl_assign_aleads,tbl_leads_appraisal where alead_id=assign_alead_id and assign_agent_id='".$database->filter($_SESSION['uid'])."' and assign_alead_sold=0";
	else
	$sqlLeads="select * from tbl_assign_aleads,tbl_leads_appraisal where alead_id=assign_alead_id and assign_agent_id='".$database->filter($_SESSION['uid'])."' and assign_alead_sold=0 and alead_user_category='".$database->filter($id)."'";
	
	$resLeads=$database->get_results($sqlLeads);
	$totalLeads=count($resLeads);
	
	if ($totalLeads>0)
	return " ".$totalLeads."";
	
	
	
}




function htCategoryName_link($catName)
	{
			$categoryName=str_replace(" ","-",$catName);
			 $categoryName=str_replace("/","-",$categoryName);
			 $categoryName=str_replace(",","",$categoryName);
			 $categoryName=str_replace("ä","a",$categoryName);
			 $categoryName=str_replace(".com","",$categoryName);
			  $categoryName=str_replace("|","",$categoryName);
			 
			
			 $categoryName=str_replace("&amp;","",$categoryName);
			 $categoryName=str_replace("&","",$categoryName);
			 
			 $categoryName=str_replace("---","-",$categoryName);
			 $categoryName=str_replace("--","-",$categoryName);
			 $categoryName=str_replace("'","",$categoryName);
			  $categoryName=str_replace('"',"",$categoryName);
			 $categoryName=str_replace("?","",$categoryName);
			 $categoryName=str_replace("#","",$categoryName);
			 $categoryName=str_replace("!","",$categoryName);
			 $categoryName=str_replace(":","",$categoryName);
			 $categoryName=str_replace("(","",$categoryName);
			 $categoryName=str_replace(")","",$categoryName);
			 
			return urlencode(strtolower($categoryName));
	}

function shippingFree($totalAmount)
{
	if ($_SESSION['sesRegion']==9)
	{
		//if ($totalAmount<50)
		$awayPrice=round(50-$totalAmount,2);
		//else
		//$awayPrice=0;
	}
	else
	{
		//if ($totalAmount<99)
		$awayPrice=round(99-$totalAmount,2);
		//else
		//$awayPrice=0;
	}
	return $awayPrice;
}

function formatPhoneNumber($phoneNumber) {
	
	$phoneNumber=str_replace(" ","",$phoneNumber);	
    $phoneNumber = preg_replace('/[^0-9]/','',$phoneNumber);

    if(strlen($phoneNumber) > 10) {
        $countryCode = substr($phoneNumber, 0, strlen($phoneNumber)-10);
        $areaCode = substr($phoneNumber, -10, 4);
        //$nextThree = substr($phoneNumber, -6, 3);
        //$lastFour = substr($phoneNumber, -4, 4);
		
		$nextThree = "***";	
		$lastFour="***";

        $phoneNumber = '+'.$countryCode.' '.$areaCode.' '.$nextThree.' '.$lastFour;
    }
    else if(strlen($phoneNumber) == 10) {
        $areaCode = substr($phoneNumber, 0, 4);
        //$nextThree = substr($phoneNumber, 4, 3);
		$nextThree = "***";	
        //$lastFour = substr($phoneNumber, 6, 4);
		$lastFour="***";

        $phoneNumber = $areaCode.' '.$nextThree.' '.$lastFour;
    }
    else if(strlen($phoneNumber) == 9) {
		$phoneNumber="0".$phoneNumber;
        $areaCode = substr($phoneNumber, 0, 4);
        $nextThree = substr($phoneNumber, 4, 3);
		//$lastFour = substr($phoneNumber, 6, 4);
		$lastFour="***";

        $phoneNumber = $areaCode.' '.$nextThree.' '.$lastFour;
    }

    return $phoneNumber;
}


function formatEmail($email) {
	
	

    $emailArr=explode("@",$email);
	$part1=$emailArr[0];
	$part2=$emailArr[1];
	
	$pCount1=strlen($part1);
	$part1=str_pad("",$pCount1,"*");
	
	$finalEmail=$part1."@".$part2;

   

    return $finalEmail;
}





function updateStats($action,$pid,$agentId)
	{
		global $database;
		
		$fieldAction="stats_".$action;
		
		
		
		$sql = "SELECT * FROM tbl_stats where stats_property_id='".$database->filter($pid)."'";
		$results = $database->get_results( $sql );
		$Total = count($results);

		if($Total > 0) 
		{
			$rowStats=$results[0];			
			$fieldAction="stats_".$action;
			$valueField=$rowStats[$fieldAction]+1;
		
		
			$update = array(
			
			$fieldAction => $valueField
			);

			$where_clause = array(
			'stats_property_id' => $pid
			);
			
			$updated = $database->update( 'tbl_stats', $update, $where_clause );
		}
		else
		{
				
			$values = array(

			'stats_property_id' => $pid,
			'stats_agent_id' => $agentId,
			$fieldAction => 1250

			);			

			$add_query = $database->insert( 'tbl_stats', $values );
				
		}
		
	}

function getCleanforURL($text)
	{
		
			$prodName=$text;			
			$prodName=str_replace(" ","-",$prodName);
			$prodName=str_replace("/","-",$prodName);			 
			$prodName=str_replace(",","",$prodName);
			$prodName=str_replace("'","",$prodName);
			$prodName=str_replace("ä","a",$prodName);
			$prodName=str_replace("&","and",$prodName);
			
			return urlencode(strtolower($prodName));
		
	}

function getStateName($id)
{
	global $database;
	$sqlCategory="select * from tbl_states where state_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['state_name']!="")
	return $rowCategory['state_name'];
	else
	echo "-";
	
	
}

function getCrmProvider($id)
{
	global $database;
	$sqlCategory="select * from tbl_crm_providers where crm_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['crm_name']!="")
	return $rowCategory['crm_name'];
	else
	echo "-";
	
	
}

function getAgentCtr($id)
{
	global $database;
	 $sqlCategory="select count(agent_id) as ctr from tbl_agents where agent_office_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	return $rowCategory['ctr'];
	
	
}

function getPropertyCtr($id,$status)
{
	global $database;
	$sqlCategory="select count(property_id) as ctr from tbl_properties left join tbl_agents on property_agent_id=agent_id where property_status='".$database->filter($status)."' and (property_type='residential' || property_type='land') and agent_office_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	return $rowCategory['ctr'];
	
	
	
}

function getOfferCtr($id)
{
	global $database;
	$sqlCategory="select count(offer_id) as ctr from tbl_offers where offer_property_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	return $rowCategory['ctr'];
	
	
	
}

function getAgencyLogo($id)
{
	
	
	global $database;
	$sqlCategory="select * from tbl_agencies where agency_office_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	return $rowCategory['agency_logo'];
	
}



function getAgencyLogo2($id)
{
	
	
	global $database;
	$sqlCategory="select * from tbl_agencies where agency_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	return $rowCategory['agency_logo'];
	
}

function getAgencyId($id)
{
	
	
	global $database;
	$sqlCategory="select * from tbl_agencies where agency_office_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	return $rowCategory['agency_id'];
	
}

function getPropTitle($id)
	{
		global $database;
		$sql = "select * from tbl_properties where property_id='".$database->filter($id)."'";
		$res = $database->get_results($sql);
		if(count($res)>0)
		{
			$row = $res[0];
			
			$address=explode(",",$row['property_address']);
			$prodName=$address[0]."-".$address[1]."-".$address[2]."-".$address[3]."-".$address[4];
			
			//$prodName=$row['property_category']."-".$row['property_state']."-".$row['property_suburb'];
			
			$prodName=str_replace(" ","",$prodName);
			$prodName=str_replace("/","",$prodName);
			 
			 $prodName=str_replace(",","",$prodName);
			  $prodName=str_replace("'","",$prodName);
			 $prodName=str_replace("ä","a",$prodName);
			 
			
			 $prodName=str_replace("&","and",$prodName);
			 
			 	 
			
			return urlencode(strtolower($prodName));
		}
	}
	

function getFormattedPhone($number)
{
	return preg_replace('~.*(\d{4})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{3}).*~', '$1 $2 $3', $number);
}

function showAddress($address)
{
		  //$address=explode(", ",$address);
		  
		  $location=str_replace(", Australia","",$address);
		  //$location=$address[0]." ".$address[1]." ".$address[2]." ".$address[3]." ".$address[4];
		  return $location;
}

function showAddress2($address)
{
		  $address=explode(", ",$address);
		  
		  //$location=str_replace(", Australia","",$address);
		  $location=$address[0]." ".$address[1];
		  return $location;
}


function getPropertyAddress($id)
	{
		global $database;
		$sql = "select * from tbl_properties where property_id='".$database->filter($id)."'";
		$res = $database->get_results($sql);
		if(count($res)>0)
		{
			$row = $res[0];
			
			$address=showAddress($row['property_address']);	 
			 	 
			
			return $address;
		}
	}

function getPropertyAddress2($id)
	{
		global $database;
		$sql = "select * from tbl_properties where property_id='".$database->filter($id)."'";
		$res = $database->get_results($sql);
		if(count($res)>0)
		{
			$row = $res[0];
			
			$address=showAddress2($row['property_address']);	 
			 	 
			
			return $address;
		}
	}

function dateDiff($date)
{
  $mydate= date("Y-m-d H:i:s");
  $theDiff="";
  //echo $mydate;//2014-06-06 21:35:55
  $datetime1 = date_create($date);
  $datetime2 = date_create($mydate);
  $interval = date_diff($datetime1, $datetime2);
  //echo $interval->format('%s Seconds %i Minutes %h Hours %d days %m Months %y Year    Ago')."<br>";
  $min=$interval->format('%i');
  $sec=$interval->format('%s');
  $hour=$interval->format('%h');
  $mon=$interval->format('%m');
  $day=$interval->format('%d');
  $year=$interval->format('%y');
  
  
    $formatDate="";
  
  
  if ($year>0)
  {
	if ($year>1)
 	 $formatDate.=$year." years ";
	 else
	 $formatDate.=$year." year ";
	 
  }
  
   if ($mon>0)
  {
	if ($mon>1)
 	 $formatDate.=$mon." months ";
	 else
	 $formatDate.=$mon." month ";
	 
  }
  
  
  if ($day>0)
  {
	if ($day>1)
 	 $formatDate.=$day." days ";
	 else
	 $formatDate.=$day." day ";
	 
  }
  
   if ($hour>0)
  {
	if ($hour>1)
 	 $formatDate.=$hour." hours ";
	 else
	$formatDate.=$hour." hour ";
	 
  }
  
   if ($min>0)
  {
	if ($sec>1)
 	 $formatDate.=$min." mins ";
	 else
	 $formatDate.=$sec." min ";
	 
  }
  
   if ($formatDate=="")
  {
	$formatDate="few seconds";
	 
  }
  
 
  
  /* if ($min>0)
  {
	if ($min>1)
 	 $formatDate.=$min." mins ";
	 else
	 $formatDate.=$min." min ";
	 
  }*/
  
  echo $formatDate;
  
  
 /* 
  if($interval->format('%i%h%d%m%y')=="00000")
  {
    //echo $interval->format('%i%h%d%m%y')."<br>";
    return $sec." Seconds";

  } 

else if($interval->format('%h%d%m%y')=="0000"){
   return $min." Minutes";
   }


else if($interval->format('%d%m%y')=="000"){
   return $hour." Hours";
   }


else if($interval->format('%m%y')=="00"){
	if ($day>1)
   return $day." days";
   else 
   return $day." day";
   
   }

else if($interval->format('%y')=="0"){
	if ($mon>1)
   return $mon." months";
   else
    return $mon." month";
   
   }

else{
	if ($year>1)
   return $year." years";
   else
    return $year." year";
   
   }
   */

}


function timeRemaining($startDate,$endDate)
{
 
  
  //echo $mydate;//2014-06-06 21:35:55
  $datetime1 = date_create($startDate);
  $datetime2 = date_create($endDate);
  $interval = date_diff($datetime1, $datetime2);
  $interval->format('%d days %h Hours %i Mins')."<br>";
  
  $min=$interval->format('%i');
  $sec=$interval->format('%s');
  $hour=$interval->format('%h');
  $mon=$interval->format('%m');
  $day=$interval->format('%d');
  $year=$interval->format('%y');
  
  $formatDate="";
  
  
  if ($year>0)
  {
	if ($year>1)
 	 $formatDate.=$year." years ";
	 else
	 $formatDate.=$year." year ";
	 
  }
  
   if ($mon>0)
  {
	if ($mon>1)
 	 $formatDate.=$mon." months ";
	 else
	 $formatDate.=$mon." month ";
	 
  }
  
  
  if ($day>0)
  {
	if ($day>1)
 	 $formatDate.=$day." days ";
	 else
	 $formatDate.=$day." day ";
	 
  }
  
   if ($hour>0)
  {
	if ($hour>1)
 	 $formatDate.=$hour." hours ";
	 else
	$formatDate.=$hour." hour ";
	 
  }
  
   if ($min>0)
  {
	if ($min>1)
 	 $formatDate.=$min." mins ";
	 else
	 $formatDate.=$min." min ";
	 
  }
  
  echo $formatDate;
  /*
  if($interval->format('%i%h%d%m%y')=="00000")
  {
    //echo $interval->format('%i%h%d%m%y')."<br>";
    return $sec." Seconds";

  } 

else if($interval->format('%h%d%m%y')=="0000"){
   return $min." Minutes";
   }


else if($interval->format('%d%m%y')=="000"){
   return $hour." Hours";
   }


else if($interval->format('%m%y')=="00"){
	if ($day>1)
   return $day." days";
   else 
   return $day." day";
   
   }

else if($interval->format('%y')=="0"){
	if ($mon>1)
   return $mon." months";
   else
    return $mon." month";
   
   }

else{
	if ($year>1)
   return $year." years";
   else
    return $year." year";
   
   }
   */

}


function memberDays($startDate,$endDate)
{
 
  
 	  $date1_ts = strtotime($startDate);
	  $date2_ts = strtotime($endDate);
	  $diff = $date2_ts - $date1_ts;
	  return round($diff / 86400)." days";
 
}



function getLeadCategory($id)
	{
		global $database;
	$sqlCategory="select * from tbl_lead_category where lcat_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	
	echo $rowCategory['lcat_name'];
	}

function fnLinkName($catName)
	{
			$categoryName=str_replace(" ","-",$catName);
			 $categoryName=str_replace("/","-",$categoryName);
			 $categoryName=str_replace(",","",$categoryName);
			 $categoryName=str_replace("ä","a",$categoryName);
			 $categoryName=str_replace(".com","",$categoryName);
			  $categoryName=str_replace("|","",$categoryName);
			 
			
			 $categoryName=str_replace("&amp;","",$categoryName);
			 $categoryName=str_replace("&","",$categoryName);
			 
			 $categoryName=str_replace("---","-",$categoryName);
			 $categoryName=str_replace("--","-",$categoryName);
			 $categoryName=str_replace("'","",$categoryName);
			 $categoryName=str_replace('"',"",$categoryName);
			 $categoryName=str_replace("?","",$categoryName);
			 $categoryName=str_replace("#","",$categoryName);
			 $categoryName=str_replace("!","",$categoryName);
			 $categoryName=str_replace(":","",$categoryName);
			 $categoryName=str_replace("(","-",$categoryName);
			 $categoryName=str_replace(")","-",$categoryName);
			 
			return urlencode(strtolower($categoryName));
	}


function getAgentLink($email)
	{
		global $database;
		$sql = "select lp_page_name from tbl_profile_pages where lp_email='".$database->filter($email)."'";
		$res = $database->get_results($sql);
		if(count($res)>0)
		{
			$row = $res[0];
			
			$pageName=showAddress2($row['lp_page_name']);	 
			 	 
			
			return $pageName;
		}
		else
		return "#";
	}

function getAgentImage($email)
	{
		global $database;
		$sql = "select lp_image from tbl_profile_pages where lp_email='".$database->filter($email)."'";
		$res = $database->get_results($sql);
		if(count($res)>0)
		{
			$row = $res[0];
			
			$agentImage=$row['lp_image'];	 
			 	 
			
			return $agentImage;
		}
		else
		return "#";
	}
	
	

function formatPhoneNumber_show($phoneNumber) {
    $phoneNumber = preg_replace('/[^0-9]/','',$phoneNumber);

    if(strlen($phoneNumber) > 10) {
        $countryCode = substr($phoneNumber, 0, strlen($phoneNumber)-10);
        $areaCode = substr($phoneNumber, -10, 3);
        $nextThree = substr($phoneNumber, -7, 3);
        $lastFour = substr($phoneNumber, -4, 4);
		
		

        $phoneNumber = '+'.$countryCode.' '.$areaCode.' '.$nextThree.' '.$lastFour;
    }
    else if(strlen($phoneNumber) == 10) {
        $areaCode = substr($phoneNumber, 0, 4);
        $nextThree = substr($phoneNumber, 4, 3);
        $lastFour = substr($phoneNumber, 7, 3);
		

        $phoneNumber = $areaCode.' '.$nextThree.' '.$lastFour;
    }
    else if(strlen($phoneNumber) == 9) {
		$phoneNumber="0".$phoneNumber;
        $areaCode = substr($phoneNumber, 0, 4);
        $nextThree = substr($phoneNumber, 4, 3);
		$lastFour = substr($phoneNumber, 6, 2);
		//$lastFour="***";

        $phoneNumber = $areaCode.' '.$nextThree.' '.$lastFour;
    }

    return $phoneNumber;
}
function getProfilePic($email)
{
	global $database;
	$sql="select * from tbl_profile_pages where lp_email='".$database->filter($email)."'";
	$res=$database->get_results($sql); 
	$row=$res[0];
	return $row['lp_image'];
}
function getProfileData($email)
{
	global $database;
	$sql="select * from tbl_profile_pages where lp_email='".$database->filter($email)."'";
	$res=$database->get_results($sql); 
	$row=$res[0];
	$arrPr[0]=$row['lp_image'];
	$arrPr[1]=$row['lp_page_name'];
	
	return $arrPr;
}



function displayTimeAgo($dbDate) {
    // Convert database date to timestamp
    $dbTimestamp = strtotime($dbDate);

    // Current timestamp
    $currentTimestamp = time();

    // Calculate difference in seconds
    $difference = $currentTimestamp - $dbTimestamp;

    // Calculate hours and days
    $hours = floor($difference / 3600);
    $days = floor($hours / 24);

   
        if ($days <= 7) {
            return "New";
        } 
}

function getBusinessCategoryName($id)
{
    global $database;
    $ids = explode(',', $id);
	 // Split comma-separated IDs into an array
    $categoryNames = array(); // Array to store category names
	

    foreach ($ids as $id) {
      $sqlCategory = "SELECT bc_name FROM tbl_business_category WHERE bc_id='" . $database->filter($id) . "'";
	
        $loadCategory = $database->get_results($sqlCategory);
        $rowCategory = $loadCategory[0];

		$categoryName = $rowCategory['bc_name'];
		
    
   		 // Check if the category name already exists in the array
   		 if (!in_array($categoryName, $categoryNames))
        	$categoryNames[] = $categoryName; // Store category name in the array
   		 }
		

   return $categoryString = implode(', ', $categoryNames); // Convert array to comma-separated string
    
}

function getFullUrl() {
    // Determine the protocol (http or https)
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

    // Get the server name
    $serverName = $_SERVER['SERVER_NAME'];

    // Get the port number if it's not the default port
    $port = $_SERVER['SERVER_PORT'];
    $port = ($port == '80' || $port == '443') ? '' : ":$port";

    // Get the request URI
    $requestUri = $_SERVER['REQUEST_URI'];

    // Construct the full URL
    $fullUrl = $protocol . $serverName . $port . $requestUri;

    return $fullUrl;
}

function removeSpecialCharacters($value) {
    // Define a regular expression pattern to match special characters
    $pattern = '/[^a-zA-Z0-9\s]/';
    
    // Replace special characters with an empty string
    $cleanedValue = preg_replace($pattern, '', $value);
    
    return $cleanedValue;
}

function getBusinessAddress($id)
{
	global $database;
	
	$sqlBusiness="select * from tbl_business where business_id='".$database->filter($id)."'";
	$resBusiness=$database->get_results($sqlBusiness);
	$rowBusiness=$resBusiness[0];
	
	//if ($rowBusiness['business_owner_id']>0)
	//{
	if ($rowBusiness['business_address_display']==1)
	{
		$address=$rowBusiness['business_address'];
		
	//$address=$rowBusiness['business_street'];
	//$address.=" ".$rowBusiness['business_suburb'].", ".$rowBusiness['business_state'].", ".$rowBusiness['business_postcode'];
	}
	else if ($rowBusiness['business_address_display']==2)
	$address=$rowBusiness['business_suburb'].", ".$rowBusiness['business_state'].", ".$rowBusiness['business_postcode'];
	
	else if ($rowBusiness['business_address_display']==3)
	$address=$rowBusiness['business_state'];
	//}
	//else
	//$address=$rowBusiness['business_address'];
	
	
	$address=str_replace(", AUS","",$address);
	
	return $address;
}

function getBusinessName($id)
{
	global $database;
	
	 $sqlBusiness="select business_heading from tbl_business where business_id='".$database->filter($id)."'";
	$resBusiness=$database->get_results($sqlBusiness);
	$rowBusiness=$resBusiness[0];
	$businessName=$rowBusiness['business_heading'];
	
	
	return $businessName;
}

function getAgencyName($id)
{
	global $database;
	
	$sql="select member_tradingname from tbl_members where member_id='".$database->filter($id)."'";
	$res=$database->get_results($sql);
	$row=$res[0];
	$agencyName=$row['member_tradingname'];
	return $agencyName;
}

function getRegionName($id)
{
	global $database;
	
	$sql="select region_name from tbl_regions where region_id='".$database->filter($id)."'";
	$res=$database->get_results($sql);
	$row=$res[0];
	$regionName=$row['region_name'];
	return $regionName;
}

function generateBusinessLink($id)
{
	global $database;
	
	$sqlBusiness = "SELECT * FROM tbl_business WHERE business_id='" . $database->filter($id) . "'";
	$resBusiness = $database->get_results($sqlBusiness);
	$rowProp = $resBusiness[0];
	
	$address = getBusinessAddress($rowProp['business_id']);

	// Decode HTML entities first
	$businessHeading = html_entity_decode($rowProp['business_heading'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
	$addressDecoded = html_entity_decode($address, ENT_QUOTES | ENT_HTML5, 'UTF-8');

	$detailLink = URL . "business-" . fnLinkName($businessHeading) . "-" . fnLinkName($addressDecoded) . "-" . $rowProp['business_id'];

	// Clean up any double dashes
	$detailLink = preg_replace('/-+/', '-', $detailLink);
	
	return $detailLink;
}




function encryptId($id) {
    $encryption_key = base64_decode(ENCRYPTION_KEY);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($id, 'aes-256-cbc', $encryption_key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
}

function decryptId($encryptedId) {
    $encryption_key = base64_decode(ENCRYPTION_KEY);
    list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($encryptedId), 2), 2, null);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}

function fn_formatDateTime($datetime) {
    $now = new DateTime();
    $inputDateTime = new DateTime($datetime);

    // Calculate the difference in hours and minutes
    $diff = $now->diff($inputDateTime);
    $hours = $diff->h + ($diff->days * 24);
    $minutes = $diff->i;

    if ($hours <= 24) {
        if ($hours < 1) {
            // Return time in minutes
            return $minutes . ' minutes ago';
        } else {
            // Return time in hours
            return $hours . ' hours ago';
        }
    } elseif ($hours <= 48) {
        // Return "Yesterday"
        return 'Yesterday';
    } else {
        // Return the date
        return $inputDateTime->format('d-m-Y');
    }
}

function pageheading(){
		
	global $database;

	if(isset($_GET['c']) && $_GET['c'] !='' )
	{
		
		$comp_name = $_GET['c'];
		$pages_query = "SELECT * FROM `tbl_components` WHERE `component_option` = '".$database->filter($comp_name)."'";
		$results = $database->get_results($pages_query); 
		 $DashboardTitle = $results[0]['component_text'];
		
	}else{
	
	$DashboardTitle = 'Dashboard';
	$ClassDashboard = 'active';
	
	}

return $DashboardTitle;
}
function displayDateTimeFormat($mysqlDateTime)
{
	$timestamp = strtotime($mysqlDateTime);

    // Format the timestamp as per your requirement
    $formattedDateTime = date('d/m/Y h:i a', $timestamp);

    return $formattedDateTime;
}
function displayDateFormat($mysqlDateTime)
{
	$timestamp = strtotime($mysqlDateTime);
	
	 $formattedDateTime = date('d/m/Y', $timestamp);

    return $formattedDateTime;
}


function htCategoryName($catName)
	{

			$categoryName=str_replace(" ","-",$catName);
			$categoryName=str_replace("/","-",$categoryName);
			$categoryName=str_replace(",","",$categoryName);
			$categoryName=str_replace("ä","a",$categoryName);
			$categoryName=str_replace(".com","",$categoryName);
			$categoryName=str_replace("|","",$categoryName);
			$categoryName=str_replace("&amp;","",$categoryName);
			$categoryName=str_replace("&","",$categoryName);
			$categoryName=str_replace("---","-",$categoryName);
			$categoryName=str_replace("--","-",$categoryName);
			$categoryName=str_replace("'","",$categoryName);
			$categoryName=str_replace('"',"",$categoryName);
			$categoryName=str_replace("?","",$categoryName);
			$categoryName=str_replace("#","",$categoryName);
			$categoryName=str_replace("!","",$categoryName);
			$categoryName=str_replace(":","",$categoryName);
			$categoryName=str_replace("(","-",$categoryName);
			$categoryName=str_replace(")","-",$categoryName);
			return urlencode(strtolower($categoryName));

	}

function formatDescriptionSmart($text, $wordsPerBlock = 50) {
    // If the text contains \n, assume manual formatting and just replace with <br><br>
    if (strpos($text, "\n") !== false) {
        $text = str_replace("\n", "<br><br>", $text);
        return preg_replace('/(<br>\s*){3,}/', '<br><br>', $text);
    }

    // Split into sentences
    $sentences = preg_split('/(?<=[.?!])\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);
    $formatted = '';
    $wordCount = 0;

    foreach ($sentences as $sentence) {
        $formatted .= $sentence . ' ';
        $wordCount += str_word_count($sentence);

        if ($wordCount >= $wordsPerBlock) {
            $formatted = rtrim($formatted) . '<br><br>';
            $wordCount = 0;
        }
    }

    // Clean up any extra spacing or extra breaks
    $formatted = preg_replace('/(<br>\s*){3,}/', '<br><br>', $formatted);

    return trim($formatted);
}



?>