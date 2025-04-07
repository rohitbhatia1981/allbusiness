<?php include "../private/settings.php";

function getStateId($name)
{
	global $database;
	
	$sqlCategory="select * from tbl_states where state_name='".$database->filter($name)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	return $rowCategory['state_id'];
}


// Specify the path to your CSV file
$csvFile = 'file/locations.csv';

// Open the CSV file for reading
$file = fopen($csvFile, 'r');

// Initialize an empty array to store the CSV data
$data = array();

$lineNumber = 0;

// Read each line of the CSV file until the end of the file is reached
while (($line = fgetcsv($file)) !== false) {
    // Add the line as an array to the $data array
	
	 $lineNumber++;
    
		// Skip the first line
		if ($lineNumber == 1) {
			continue;
		}
		


$stateId = getStateId(rtrim(trim($line[2])));
$postcode=$line[0];
$locality=$line[1];
$long=$line[3];
$lat=$line[4];
$region=$line[5];


$sqlCheck="select * from tbl_regions where region_name='".$region."'";
$resCheck=$database->get_results($sqlCheck);
$regionCount=count($resCheck);

if ($regionCount==0)
	{
		
		
		$names = array(
		'region_name' => $region,
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
	
	
$sqlCheck="select * from tbl_locations where location_locality='".$locality."'";
$resCheck=$database->get_results($sqlCheck);
$locationCount=count($resCheck);


	if ($locationCount==0)
	{
		
		$names = array(
		'location_postcode' => $postcode,
		'location_locality' => $locality,
		'location_state_id' => $stateId,
		'location_region' => $regionId,
		'location_long' => $long,
		'location_lat' => $lat,
		'location_status' => 1
		
		
		);
		
		$database->insert( 'tbl_locations', $names );
	}
	
}




fclose($file);









?>