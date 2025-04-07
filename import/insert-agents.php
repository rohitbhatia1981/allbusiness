<?php include "../private/settings.php";

/*function getStateId($name)
{
	global $database;
	
	$sqlCategory="select * from tbl_states where state_name='".$database->filter($name)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	return $rowCategory['state_id'];
}*/

$sqlAgency="select * from tbl_members where member_type=1 and member_imported=1";
$resAgency=$database->get_results($sqlAgency);

for ($k=0;$k<count($resAgency);$k++)
{
	$rowAgency=$resAgency[$k];

			$sqlAgent="select * from agency_db where email='".$rowAgency['member_email']."'";
			$resAgent=$database->get_results($sqlAgent);
			
			for ($r=0;$r<count($resAgent);$r++)
			{
				$rowAgent=$resAgent[$r];
				
				$names = array(
				'agent_name' => $rowAgent['agent_name'],
				'agent_agency_id' => $rowAgency['member_id'],
				'agent_email' => $rowAgent['agent_email'],
				'agent_mobile' => $rowAgent['agent_mobile'],
				'agent_phone' => $rowAgent['agent_phone']					
				);
				
				print_r ($names);
				
				$database->insert( 'tbl_member_agents', $names );
				$agentId=$database->lastid();
			
			
			// URL of the logo
			if ($rowAgent['agent_picture']!="")
			{
			$agentPic = $rowAgent['agent_picture'];
			$saveDirectory = "../images/agentpic/";
			$fileName = basename(parse_url($agentPic, PHP_URL_PATH));
			$fileName = strtok($fileName, '?');
		
			$savePath = $saveDirectory . $fileName;
			
			if (file_put_contents($savePath, file_get_contents($agentPic))) {
   
				   $update = array(
					'agent_picture' => $fileName
					);
					
					$where_clause = array(
					'agent_id' => $agentId
					);
					$updated = $database->update( 'tbl_member_agents', $update, $where_clause, 1 );
			}
			}
		}

	}





?>