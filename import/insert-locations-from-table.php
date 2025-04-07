<?php include "../private/settings.php";

function getStateId($name)
{
	global $database;
	
	$sqlCategory="select * from tbl_states where state_name='".$database->filter($name)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	return $rowCategory['state_id'];
}

function getGreaterRegionId($name)
{
	global $database;
	
	$sqlCategory="select * from tbl_greater_regions where g_region_name='".$database->filter($name)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	return $rowCategory['g_region_id'];
}


$sqlLocationDb="select * from location_db";
$resLocationDb=$database->get_results($sqlLocationDb);

if (count($resLocationDb)>0)
{		

	for ($k=0;$k<count($resLocationDb);$k++)
	{
		$rowLocationDb=$resLocationDb[$k];
	
		$stateId = getStateId(rtrim(trim($rowLocationDb['state'])));
		$postcode=rtrim(trim($rowLocationDb['postcode']));
		$locality=rtrim(trim($rowLocationDb['suburb']));
		$long=rtrim(trim($rowLocationDb['long']));
		$lat=rtrim(trim($rowLocationDb['lat']));
		$region=rtrim(trim($rowLocationDb['region']));
		
		if ($rowLocationDb['greater_region']!="")
		$greaterRegion=getGreaterRegionId(rtrim(trim($rowLocationDb['greater_region'])));
		else
		$greaterRegion="";
		


		 $sqlCheck="select * from tbl_regions where region_name='".$region."'";
		$resCheck=$database->get_results($sqlCheck);
		$regionCount=count($resCheck);
		
		if ($regionCount==0)
			{
								
				$names = array(
				'region_name' => $region,
				'region_greater_region' => $greaterRegion,
				'region_status' => 1	
				
				);
				
				$database->insert( 'tbl_regions', $names );
				
				$regionId=$database->lastid();
			}
			else
			{
				$rowRegion=$resCheck[0];
				$regionId=$rowRegion['region_id'];
			}
	
	
			 $sqlCheck="select * from tbl_locations where location_locality='".$locality."' and location_postcode='".$postcode."'";
			$resCheck=$database->get_results($sqlCheck);
			$locationCount=count($resCheck);


			if ($locationCount==0)
			{
				
				$names = array(
				'location_postcode' => $postcode,
				'location_locality' => $locality,
				'location_state_id' => $stateId,
				'location_region' => $regionId,
				'location_greater_region' => $greaterRegion,
				'location_long' => $long,
				'location_lat' => $lat,
				'location_status' => 1
				
				
				);
				
				//print_r ($names);
				
				$database->insert( 'tbl_locations', $names );
			}
		
		

	}
}








?>