<?php include "../private/settings.php";

/*function getStateId($name)
{
	global $database;
	
	$sqlCategory="select * from tbl_states where state_name='".$database->filter($name)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	return $rowCategory['state_id'];
}*/


$sqlAgencyDb="select * from agency_db group by email";
$resAgencyDb=$database->get_results($sqlAgencyDb);


if (count($resAgencyDb)>0)
{		

	for ($k=0;$k<count($resAgencyDb);$k++)
	{
		$rowAgencyDb=$resAgencyDb[$k];
	
		
		$agencyName=rtrim(trim($rowAgencyDb['agency_name']));
		$agencylogo=rtrim(trim($rowAgencyDb['logo']));
		
		$suburb=rtrim(trim($rowAgencyDb['suburb']));		
		$state=rtrim(trim($rowAgencyDb['state']));
		$postcode=rtrim(trim($rowAgencyDb['postcode']));
		$phone=rtrim(trim($rowAgencyDb['phone']));
		$website=rtrim(trim($rowAgencyDb['website']));
		$email=rtrim(trim($rowAgencyDb['email']));
		$agent_name=rtrim(trim($rowAgencyDb['agent_name']));
		$agent_phone=rtrim(trim($rowAgencyDb['agent_phone']));
		$agent_mobile=rtrim(trim($rowAgencyDb['agent_mobile']));
		$agent_email=rtrim(trim($rowAgencyDb['agent_email']));
		$agent_picture=rtrim(trim($rowAgencyDb['agent_picture']));
		
		


		


		$sqlCheck="select * from tbl_members where member_email='".$email."'";
		$resCheck=$database->get_results($sqlCheck);
		$agencyCount=count($resCheck);
		
		
		
		if ($agencyCount==0)
			{
				
				$agentName=explode(" ",$agent_name);
				$password=md5(rand(10000,99999));
				$currentDate = date('Y-m-d');
								
				$names = array(
				'member_firstname' => $agentName[0],
				'member_lastname' => $agentName[1],					
				'member_email' => $email,	
				'member_password' => $password,	
				'member_phone' => $phone,	
				'member_company' => $agencyName,	
				'member_tradingname' => $agencyName,	
				'member_website' => $website,
				'member_address' => $suburb.", ".$postcode,
				'member_ip' => $_SERVER['REMOTE_ADDR'],
				'member_regdate' => $currentDate,
				'member_type' => 1,
				'member_imported' => 1
				
				);
				
				print_r ($names);
				
				$database->insert( 'tbl_members', $names );				
				$agencyId=$database->lastid();
			}
			else
			{
				$rowMember=$resCheck[0];
				$agencyId=$rowMember['member_id'];
			}
			
			
			
			// URL of the logo
			
			if ($agencylogo!="")
			{
				$logoUrl = $agencylogo;
				$saveDirectory = "../images/agencylogo/";
				$fileName = basename(parse_url($logoUrl, PHP_URL_PATH));
				$fileName = strtok($fileName, '?');
				
				$savePath = $saveDirectory . $fileName;
				
				if (file_put_contents($savePath, file_get_contents($logoUrl))) {
	   
					   $update = array(
						'member_agency_logo' => $fileName
						);
						
						$where_clause = array(
						'member_id' => $agencyId
						);
						$updated = $database->update( 'tbl_members', $update, $where_clause, 1 );
				}
			}
			
			
		
			
			
		
		

	}
}








?>