<?php include "../private/settings.php"; ?>
<ul id="country-list">
<!--<li onClick="selectCountry('<?php echo $country["country_name"]; ?>');"><?php echo $country["country_name"]; ?></li>-->

<?php
$loadLocation=$database->get_results("select * from tbl_locations,tbl_states where state_id=location_state_id and (location_locality like '".$database->filter($_POST["keyword"])."%' || location_postcode like '".$database->filter($_POST["keyword"])."%') order by location_locality limit 0,8");
$totalLocation = count($loadLocation);

$strLocation="";

if ($totalLocation>0)
	{
		for ($i = 0; $i < $totalLocation; $i++) 
			{
			$resultLocation = $loadLocation[$i];
			$locationName=ucfirst(strtolower($resultLocation['location_locality']));
			$locationName.=", ".$resultLocation['state_name'];
			$locationName.=", ".$resultLocation['location_postcode'];
			
?>


		<li onClick="selectLocation('<?php echo $locationName; ?>','<?php echo $resultLocation['location_locality'] ?>');"><?php echo $locationName; ?></li>

<?php       }

    }
?>

</ul>
