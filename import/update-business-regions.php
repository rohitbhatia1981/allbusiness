<?php include "../private/settings.php";

function getStateId($id)
{
	global $database;
	$sql="select * from tbl_states where state_name='".$database->filter($id)."'";
	$res=$database->get_results($sql);
	$row=$res[0];
	$stateId=$row['state_id'];
	return $stateId;
	
}

$sqlBusiness="SELECT * FROM tbl_business where business_region=0 and business_greater_region=0";
$resBusiness=$database->get_results($sqlBusiness);


for ($biz=0;$biz<count($resBusiness);$biz++)
{
	$rowBusiness=$resBusiness[$biz];
	
	$suburb=$rowBusiness['business_suburb'];	
	$state=getStateId($rowBusiness['business_state']);
	$postcode=$rowBusiness['business_postcode'];
	
	$sqlLocation="select * from tbl_locations where location_postcode='".$postcode."' and location_locality='".$suburb."' and location_state_id='".$state."'";	
	$resLocation=$database->get_results($sqlLocation);
	$rowLocation=$resLocation[0];
	$regionId=$rowLocation['location_region'];
	$greaterRegionId=$rowLocation['location_greater_region'];
	
	
		$update = array(
			'business_greater_region' => $greaterRegionId,
			'business_region' => $regionId
		);
		$where_clause = array(
		'business_id' => $rowBusiness['business_id']
		);
		$database->update( 'tbl_business', $update, $where_clause, 1 );
		
}
		







?>