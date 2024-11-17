<?php


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


function getCategoryId($name)
{
	global $database;
	$sqlCategory="select * from tbl_categories where categories_name='".$database->filter($name)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['categories_id']!="")
	return $rowCategory['categories_id'];
	else
	echo "-";
	
	
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

function getTranTruckNumber($id)
{
	global $database;
	$sqlCategory="select * from tbl_weighbridge_requests where wbr_transaction_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['wbr_truck_number']!="")
	echo $rowCategory['wbr_truck_number'];
	else
	echo "-";
	
	
}

function moneyFormat($amount) {
	
 list ($number, $decimal) = explode('.', sprintf('%.2f', floatval($amount)));

    $sign = $number < 0 ? '-' : '';

    $number = abs($number);

    for ($i = 3; $i < strlen($number); $i += 3)
    {
        $number = substr_replace($number, ',', -$i, 0);
    }

   
	if ($decimal>0)
	return $sign . $number . "." .$decimal;
	else
	return $sign . $number;
	
}

function getDriverName($phone)
{
	global $database;
	$sqlCategory="select * from tbl_drivers where driver_phone='".$database->filter($phone)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['driver_name']!="")
	echo $rowCategory['driver_name'];
	else
	echo "-";
	
	
}





function getSoldQtyMining($id,$dateFrom='',$dateTo='')
{
	global $database;
	
	$sqlContent="select sum(order_quantity) as totalQty from tbl_transactions,tbl_orders where transaction_id=order_transactionid  and transaction_mining='".$id."' and transaction_status='2'";
	
	if ($_GET['txtDateFrom']!="")
	{
	 $arrFrom=explode("/",$_GET['txtDateFrom']);
	 $dateFrom=$arrFrom[2]."-".$arrFrom[1]."-".$arrFrom[0];
	 
	$sqlContent.=" and transaction_date>='".$dateFrom."'"; 
	}
	
	if ($_GET['txtDateTo']!="")
	{
	 $arrTo=explode("/",$_GET['txtDateTo']);
	 $dateTo=$arrTo[2]."-".$arrTo[1]."-".$arrTo[0];
	 
	$sqlContent.=" and transaction_date<='".$dateTo."'"; 
	}
	
	$getContent=$database->get_results($sqlContent);
	$rowContent=$getContent[0];
	
	
	return fnCuToTon($rowContent['totalQty']);
	
	
	/*$sqlContent="select * from tbl_weighbridge_requests,tbl_transactions where wbr_transaction_id=transaction_id and wbr_status=2 and transaction_mining='".$database->filter($id)."' ";
	
	
	if ($_GET['txtDateFrom']!="")
	{
	 $arrFrom=explode("/",$_GET['txtDateFrom']);
	 $dateFrom=$arrFrom[2]."-".$arrFrom[1]."-".$arrFrom[0];
	 
	$sqlContent.=" and wbr_reviewed_datetime>='".$dateFrom." 00:00:00'"; 
	}
	
	if ($_GET['txtDateTo']!="")
	{
	 $arrTo=explode("/",$_GET['txtDateTo']);
	 $dateTo=$arrTo[2]."-".$arrTo[1]."-".$arrTo[0];
	 
	$sqlContent.=" and wbr_reviewed_datetime<='".$dateTo." 23:59:59' "; 
	}
	
	$getContent=$database->get_results($sqlContent);
	
	
	$totalQty=0;
	for ($i=0;$i<count($getContent);$i++)
			{
			$rowContent=$getContent[$i];
			//$sqlOrder="select sum(order_quantity) as totalQty from tbl_orders where order_transactionid='".$rowContent['transaction_id']."'";
			
						  if ($rowContent['wbr_loaded_truck_weight']>0)
							 {
							 $netWeight=$rowContent['wbr_loaded_truck_weight']-$rowContent['wbr_empty_truck_weight'];
							 
							 $totalQty=$totalQty+$netWeight;
							 
							// $netWeight=fnConKgToCu($netWeight);
							 //echo $netWeight;
							 
							 }
			
			
			
		}
		*/
		
		
}

function getContractorName($id)
{
	global $database;
	$sqlCategory="select * from tbl_contractors where contractor_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['contractor_name']!="")
	echo $rowCategory['contractor_name'];
	else
	echo "-";
	
	
}

function getInterestRate($aid)
{
	global $database;
	$sqlCategory="select * from emdmf_contractor where ec_id='".$database->filter($aid)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['ec_late_fees']!="")
	return $rowCategory['ec_late_fees'];
	else
	echo "0";
	
}

function getGraceDays($aid)
{
	global $database;
	$sqlCategory="select * from emdmf_contractor where ec_id='".$database->filter($aid)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['ec_grace_period']!="")
	return $rowCategory['ec_grace_period'];
	else
	echo "0";
	
}


function fnMiningOrders($id,$dateFrom='',$dateTo='')
{
	global $database;
	$sql = "SELECT count(transaction_id) as ctr FROM tbl_transactions where transaction_mining='".$database->filter($id)."' and transaction_status=2";
	
	if ($_GET['txtDateFrom']!="")
	{
	 $arrFrom=explode("/",$_GET['txtDateFrom']);
	 $dateFrom=$arrFrom[2]."-".$arrFrom[1]."-".$arrFrom[0];
	 
	$sql.=" and transaction_date>='".$dateFrom."'"; 
	}
	
	if ($_GET['txtDateTo']!="")
	{
	 $arrTo=explode("/",$_GET['txtDateTo']);
	 $dateTo=$arrTo[2]."-".$arrTo[1]."-".$arrTo[0];
	 
	$sql.=" and transaction_date<='".$dateTo."'"; 
	}
	
	
	$res = $database->get_results($sql);
	$row = $res[0];
	return $row['ctr'];
	
	
}

function fnGetMiningOfficer($id)
{
	global $database;
	$sql = "SELECT * FROM tbl_mining_officers where mo_id='".$database->filter($id)."'";
	$res = $database->get_results($sql);
	$row = $res[0];
	return $row['mo_name']." (".$row['mo_phone'].")";
}

function fnGetProductPrice($id,$pid)
{
	global $database;
	
	$sql = "SELECT * FROM tbl_custom_pricing where cp_mining_id='".$database->filter($id)."' and cp_product_id='".$database->filter($pid)."'";
	$res = $database->get_results($sql);
	if (count($res)>0)
	{
		$row = $res[0];
		$price=$row['cp_price'];
	}
	else
	{
		
		$sql = "SELECT * FROM tbl_products where product_id='".$database->filter($pid)."'";
		$res = $database->get_results($sql);
		if (count($res)>0)
		{
			$row = $res[0];
			$price=$row['product_price'];
		}
		
	}
	
	return $price;
	
}

/*
function fnMiningSales($id,$dateFrom='',$dateTo='')
{
	global $database;
	$sql = "SELECT sum(transaction_total_amount) as sumTotal FROM tbl_transactions where transaction_mining='".$database->filter($id)."' and transaction_status<>3";
	
	if ($_GET['txtDateFrom']!="")
	{
	 $arrFrom=explode("/",$_GET['txtDateFrom']);
	 $dateFrom=$arrFrom[2]."-".$arrFrom[1]."-".$arrFrom[0];
	 
	$sql.=" and transaction_date>='".$dateFrom."'"; 
	}
	
	if ($_GET['txtDateTo']!="")
	{
	 $arrTo=explode("/",$_GET['txtDateTo']);
	 $dateTo=$arrTo[2]."-".$arrTo[1]."-".$arrTo[0];
	 
	$sql.=" and transaction_date<='".$dateTo."'"; 
	}
	
	
	$res = $database->get_results($sql);
	$row = $res[0];
	return $row['sumTotal'];
}
*/

function fnMiningSales($id,$dateFrom='',$dateTo='')
{
	
	//----------Get total quantity approved by JE so far-----//
	
	global $database;
	
	
	
	$sql="select sum(transaction_total_amount) as totalSales from tbl_transactions where transaction_mining='".$database->filter($id)."' and transaction_status=2";
	
	if ($_GET['txtDateFrom']!="")
	{
	 $arrFrom=explode("/",$_GET['txtDateFrom']);
	 $dateFrom=$arrFrom[2]."-".$arrFrom[1]."-".$arrFrom[0];
	 
	$sql.=" and transaction_date>='".$dateFrom."'"; 
	}
	
	if ($_GET['txtDateTo']!="")
	{
	 $arrTo=explode("/",$_GET['txtDateTo']);
	 $dateTo=$arrTo[2]."-".$arrTo[1]."-".$arrTo[0];
	 
	$sql.=" and transaction_date<='".$dateTo."'"; 
	}
	
	
	$res = $database->get_results($sql);
	$row = $res[0];
	return number_format($row['totalSales']);
	
	
	
	
	
	
	/*$sqlContent="select * from tbl_weighbridge_requests where wbr_status=2 and wbr_mining_id='".$database->filter($id)."' ";
	
	
	if ($_GET['txtDateFrom']!="")
	{
	 $arrFrom=explode("/",$_GET['txtDateFrom']);
	 $dateFrom=$arrFrom[2]."-".$arrFrom[1]."-".$arrFrom[0];
	 
	$sqlContent.=" and wbr_reviewed_datetime>='".$dateFrom." 00:00:00'"; 
	}
	
	if ($_GET['txtDateTo']!="")
	{
	 $arrTo=explode("/",$_GET['txtDateTo']);
	 $dateTo=$arrTo[2]."-".$arrTo[1]."-".$arrTo[0];
	 
	$sqlContent.=" and wbr_reviewed_datetime<='".$dateTo." 23:59:59' "; 
	}
	
	$getContent=$database->get_results($sqlContent);
	
	
	$totalQty=0;
	$totalRevenue=0;
	for ($i=0;$i<count($getContent);$i++)
			{
			$rowContent=$getContent[$i];
			//$sqlOrder="select sum(order_quantity) as totalQty from tbl_orders where order_transactionid='".$rowContent['transaction_id']."'";
			
						  if ($rowContent['wbr_loaded_truck_weight']>0)
							 {
							 $netWeight=$rowContent['wbr_loaded_truck_weight']-$rowContent['wbr_empty_truck_weight'];
							 
							 //$totalQty=$totalQty+$netWeight;
							 $totalPerRev=fnConKgToCu_Val($netWeight)*$rowContent['wbr_product_price'];
							 $totalRevenue=$totalRevenue+$totalPerRev;
							// $netWeight=fnConKgToCu($netWeight);
							 //echo $netWeight;
							 
							 }
			
			
			
		}
		
		
		
		
		
		return $revenue=number_format($totalRevenue);
		
		*/
	
	//---------Get total quantity approved by je----------//
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



function getMining_multi($ids)

{
		global $database;	
		$arrayDcat=array();
		$arrayDcat_r=array();
		$arrayDcat=explode(",",$ids);		

		foreach ($arrayDcat as $val)

				{											

					$sql = "SELECT * FROM tbl_minings where mining_id='".$database->filter($val)."'";
					$dCategories = $database->get_results( $sql );
					$resultCategory = $dCategories[0];													

					array_push($arrayDcat_r,$resultCategory['mining_name']);

													//print $resultCategory['category_name'];

				}

			

			return $strDcat=implode(", ",$arrayDcat_r);

}

function getDistrictsFBlocks($id)

{
		global $database;	
		$arrayDcat_r=array();
		
												

		$sql = "SELECT * FROM tbl_districts where district_block_id='".$database->filter($id)."'";
		$dCategories = $database->get_results( $sql );
		if (count($dCategories)>0)
		{
				for ($j=0;$j<count($dCategories);$j++)
				{
					$resultCategory = $dCategories[$j];													
					array_push($arrayDcat_r,$resultCategory['district_name']);
				}
		}

													//print $resultCategory['category_name'];

			

			return $strDcat=implode(", ",$arrayDcat_r);

}




function getDistrict_multi($ids)

{
		global $database;	
		$arrayDcat=array();
		$arrayDcat_r=array();
		$arrayDcat=explode(",",$ids);		

		foreach ($arrayDcat as $val)

				{											

					$sql = "SELECT * FROM tbl_districts where district_id='".$database->filter($val)."'";
					$dCategories = $database->get_results( $sql );
					$resultCategory = $dCategories[0];													

					array_push($arrayDcat_r,$resultCategory['district_name']);

													//print $resultCategory['category_name'];

				}

			

			return $strDcat=implode(", ",$arrayDcat_r);

}

function getSubDistrict_multi($ids)

{
		global $database;	
		$arrayDcat=array();
		$arrayDcat_r=array();
		$arrayDcat=explode(",",$ids);		

		foreach ($arrayDcat as $val)

				{											

					$sql = "SELECT * FROM tbl_sub_districts where sd_id='".$database->filter($val)."'";
					$dCategories = $database->get_results( $sql );
					$resultCategory = $dCategories[0];													

					array_push($arrayDcat_r,$resultCategory['sd_name']);

													//print $resultCategory['category_name'];

				}

			

			return $strDcat=implode(", ",$arrayDcat_r);

}

function getProduct_multi($ids)

{
		global $database;	
		$arrayDcat=array();
		$arrayDcat_r=array();
		$arrayDcat=explode(",",$ids);		

		foreach ($arrayDcat as $val)

				{											

					$sql = "SELECT * FROM tbl_products where product_id='".$database->filter($val)."'";
					$dCategories = $database->get_results( $sql );
					$resultCategory = $dCategories[0];													

					array_push($arrayDcat_r,$resultCategory['product_title']);

													//print $resultCategory['category_name'];

				}

			

			return $strDcat=implode(", ",$arrayDcat_r);

}



function getMemberEmailId($id)
{
	
	global $database;
	$sql="select * from tbl_member where member_id='".$database->filter($id)."'";
	$load=$database->get_results($sql);
	$row=$load[0];
	
	if ($row['member_email']!="")
	echo $row['member_email'];
	else
	echo "-";
}



// Create a function for converting the amount in words








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


function getConditionName($id)
{
	global $database;
	$sqlCategory="select * from tbl_conditions where condition_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['condition_title']!="")
	echo $rowCategory['condition_title'];
	else
	echo "-";
	
	
}


function getCategoryName($id)
{
	global $database;
	$sqlCategory="select * from tbl_faq_categories where faq_categories_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['faq_categories_name']!="")
	echo $rowCategory['faq_categories_name'];
	else
	echo "-";
	
	
}

function getCategoryName_pharmacy($id)
{
	global $database;
	$sqlCategory="select * from tbl_faq_categories_pharmacy where faq_categories_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['faq_categories_name']!="")
	echo $rowCategory['faq_categories_name'];
	else
	echo "-";
	
	
}

function getPharmacyName($id)
{
	global $database;
	$sqlCategory="select * from tbl_pharmacies where pharmacy_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['pharmacy_name']!="")
	echo $rowCategory['pharmacy_name'];
	else
	echo "-";
	
	
}

function getGenderName($id)
{
	global $database;
	$sqlCategory="select * from tbl_gender where gender_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['gender_name']!="")
	echo $rowCategory['gender_name'];
	else
	echo "-";
	
	
}


function getMedicineName($id)
{
	global $database;
	$sqlCategory="select * from tbl_medication where med_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['med_title']!="")
	return $rowCategory['med_title'];
	else
	return "-";
	
	
}

function getMedicineId($name)
{
	global $database;
	$sqlCategory="select * from tbl_medication where med_title='".$database->filter($name)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['med_id']!="")
	return $rowCategory['med_id'];
	else
	return "-";
	
	
}

function getPrescriberName($id)
{
	global $database;
	$sqlCategory="select * from tbl_prescribers where pres_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	
	return $rowCategory['pres_forename']." ".$rowCategory['pres_surname'];
	
	
	
}

function getMedicinePrice($id)
{
	global $database;
	$sqlCategory="select med_price from tbl_medication where med_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['med_price']!="")
	return $rowCategory['med_price'];
	else
	return "-";
	
	
}


function getCategoryName_multi($ids)
{
	
		global $database;	
		$arrayDcat=array();
		$arrayDcat_r=array();
		$arrayDcat=explode(",",$ids);
		
		foreach ($arrayDcat as $val)
				{											
					$sql = "SELECT * FROM tbl_condition_categories where condition_categories_id='".$database->filter($val)."'";
					$dCategories = $database->get_results( $sql );
					$resultCategory = $dCategories[0];
													
					array_push($arrayDcat_r,$resultCategory['condition_categories_name']);
													//print $resultCategory['category_name'];
				}
			
			return $strDcat=implode(", ",$arrayDcat_r);
}


function getConditionName_multi($ids)
{
	
		global $database;	
		$arrayDcat=array();
		$arrayDcat_r=array();
		$arrayDcat=explode(",",$ids);
		
		foreach ($arrayDcat as $val)
				{											
					$sql = "SELECT * FROM tbl_conditions where condition_id='".$database->filter($val)."'";
					$dCategories = $database->get_results( $sql );
					$resultCategory = $dCategories[0];
													
					array_push($arrayDcat_r,$resultCategory['condition_title']);
													//print $resultCategory['category_name'];
				}
			
			return $strDcat=implode(", ",$arrayDcat_r);
}


function getMedicineName_multi($ids)
{
	
		global $database;	
		$arrayDcat=array();
		$arrayDcat_r=array();
		$arrayDcat=explode(",",$ids);
		
		foreach ($arrayDcat as $val)
				{											
					$sql = "SELECT * FROM tbl_medication where med_id='".$database->filter($val)."'";
					$dCategories = $database->get_results( $sql );
					$resultCategory = $dCategories[0];
													
					array_push($arrayDcat_r,$resultCategory['med_title']);
													//print $resultCategory['category_name'];
				}
			
			return $strDcat=implode(", ",$arrayDcat_r);
}

function formatTextareaContent($content)
{
	$str=str_replace("\n","<br>",$content);
	
	
	
	return $str;
	
}

function getPrescriptionStatus($status,$pid)
{
	global $database;
		
	if ($status==0)
	$val='<span class="tag tag-grey">Incomplete</span>';
	else if ($status==1)
	$val='<span class="tag tag-blue">Pending</span>';
	else if ($status==2)
	{
		
	$val='<span class="tag tag-orange">Query</span>';
	
		$sqlMesFrom="select * from tbl_messages where message_pres_id='".$pid."' order by message_id desc limit 0,1";
		$resMesFrom=$database->get_results($sqlMesFrom);
		$rowMes=$resMesFrom[0];
		
		if ($_SESSION['sess_prescriber_id']!="")
		{												
			if ($rowMes['message_sender_type']=="Clinician")
			$val.="<br><div style='padding-top:5px'><font style='color:#ff0000'>To be Responsed</font></div>";
			else
			$val.="<br><div><font style='color:#0C3'>Replied</font></div>";
		}
		
	
	}
	else if ($status==3)
	$val='<span class="tag tag-pink">Ready for Collection</span>';
	else if ($status==4)
	$val='<span class="tag tag-red">Rejected</span>';
	else if ($status==5)
	$val='<span class="tag tag-yellow">Cancelled</span>';
	else if ($status==6)
	$val='<span class="tag tag-green">Approved by Clinician</span>';
	
	return $val;
	
	
	
}

function getPrescriptionStatus_clinician($status,$pid)
{
	
	global $database;
		
	if ($status==1)
	$val='<span class="tag tag-blue">Pending</span>';
	else if ($status==2)
	{
	$val='<span class="tag tag-orange">Query</span>';	
	
			$sqlMesFrom="select pres_patient_query_status from tbl_prescriptions where pres_id='".$pid."' order by pres_id";
			$resMesFrom=$database->get_results($sqlMesFrom);
			$rowMes=$resMesFrom[0];
	
			if ($rowMes['pres_patient_query_status']=="0")
			$val.="<br><div style='padding-top:5px'><font style='color:orange'>Response awaited</font></div>";
			else
			$val.="<br><div><font style='color:#ff0000'>Action required</font></div>";
	
	
	 	/*$sqlMesFrom="select * from tbl_messages where message_pres_id='".$pid."' order by message_id desc limit 0,1";
		$resMesFrom=$database->get_results($sqlMesFrom);
		$rowMes=$resMesFrom[0];
																
			if ($rowMes['message_sender_type']=="Clinician")
			$val.="<br><div style='padding-top:5px'><font style='color:orange'>Response awaited</font></div>";
			else
			$val.="<br><div><font style='color:#ff0000'>Action required</font></div>";*/
	}
	else if ($status==4)
	$val='<span class="tag tag-red">Rejected</span>';
	else if ($status==5)
	$val='<span class="tag tag-yellow">Cancelled</span>';
	else if ($status==3 || $status==6)
	$val='<span class="tag tag-green">Approved</span>';
	
	return $val;
	
	
	
}

function getPrescriptionStatus_pharmacy($status)
{
		
	if ($status==1)
	$val='<span class="tag tag-blue">To Process</span>';
	else if ($status==2)
	$val='<span class="tag tag-blue">Query</span>';	
	
	else if ($status==4)
	$val='<span class="tag tag-yellow">Cancellation Requested</span>';

	else if ($status==3)
	$val='<span class="tag tag-pink">Ready for Collection</span>';
	
	else if ($status==5)
	$val='<span class="tag tag-green">Collected</span>';
	
	
	
	return $val;
	
	
	
}

function getTitleName($id)
{
	global $database;
	$sqlCategory="select * from tbl_titles where title_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['title_name']!="")
	return $rowCategory['title_name'];
	else
	return "-";
	
	
}
function getProfName($id)
{
	global $database;
	$sqlCategory="select * from tbl_professions where prof_id='".$database->filter($id)."'";
	$loadCategory=$database->get_results($sqlCategory);
	$rowCategory=$loadCategory[0];
	
	if ($rowCategory['prof_title']!="")
	return $rowCategory['prof_title'];
	else
	return "-";
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





function changeReadStatus($id)
{
	global $database;
	$sqlCategory="update tbl_messages set message_read_status=1 where message_id='".$database->filter($id)."'";
	
	$database->query($sqlCategory);
	
}


function getPresAction($pid,$uid,$utype,$action)
{
	global $database;
	
	$curDate=date("Y-m-d H:i:s");
	
	$names = array(
				'pa_user_type' => $utype,
				'pa_pres_id' => $pid, 
				'pa_user_id' => $uid, 
				'pa_action_details' => $action, 
				'pa_date_time' => $curDate			
				
				);

				$add_query = $database->insert( 'tbl_prescriptions_actions', $names );
	
	
	if ($utype=="patient")
	{
		
		$sql="select * from tbl_prescriptions where pres_id='".$database->filter($pid)."' and pres_patient_query_status=0";
		$res=$database->get_results($sql);
		if (count($res)>0)
		{
			$row=$res[0];
		
		 $sql="update tbl_prescriptions set
		 pres_patient_query_status=1,
		 pres_patient_query_date='".$curDate."'
		 where pres_id='".$database->filter($pid)."'";
		 
		 $database->query($sql);
		}
		  
		
	}
	
	if ($utype=="clinician")
	{
		
		
		 $sql="select * from tbl_prescriptions where pres_id='".$database->filter($pid)."'";
		$res=$database->get_results($sql);
		
		if (count($res)>0)
		{
			$row=$res[0];
			$presAssigned=$row['pres_prescriber'];
			
			if ($presAssigned==0)
			{
				
				
				 $sqlCategory="update tbl_prescriptions set pres_prescriber='".$uid."' where pres_id='".$database->filter($pid)."'";
				$database->query($sqlCategory);
				
				
			}
			else
			{
				$numbersArray = explode(",", $presAssigned);	
						
				if (!in_array($uid, $numbersArray))
				 {	
				 
				 
				 	array_push($numbersArray,$uid);	
					$strPres=implode(",",$numbersArray);	
					
					
				$sqlCategory="update tbl_prescriptions set pres_prescriber='".$strPres."' where pres_id='".$database->filter($pid)."'";
				$database->query($sqlCategory);		
					
				}
				
				
			}
			
			//-------- Changing patient status back to responded----
			
			 $sql="update tbl_prescriptions set
			 pres_patient_query_status=0
			 where pres_id='".$database->filter($pid)."'";
			 
			 $database->query($sql);
			
			//--------end changing patient status
		}
		
	}
	
	
	
	
}

function getUserNameByType($type,$id)
{
	global $database;
	if ($type=="patient")
	{
		$sqlCategory="select * from tbl_patients where patient_id='".$database->filter($id)."'";
		$loadCategory=$database->get_results($sqlCategory);
		$rowCategory=$loadCategory[0];
		$name=$rowCategory['patient_first_name']." ".$rowCategory['patient_last_name'];
		
	}
	else if ($type=="clinician")
	{
		
		$sqlCategory="select * from tbl_prescribers where pres_id='".$database->filter($id)."'";
		$loadCategory=$database->get_results($sqlCategory);
		$rowCategory=$loadCategory[0];
		$name=$rowCategory['pres_forename']." ".$rowCategory['pres_surname'];
	}
	
	else if ($type=="pharmacy")
	{
		
		$sqlCategory="select * from tbl_pharmacies where pharmacy_id='".$database->filter($id)."'";
		$loadCategory=$database->get_results($sqlCategory);
		$rowCategory=$loadCategory[0];
		$name=$rowCategory['pharmacy_name'];
	}
	
	return $name;
	
	
	
}

function getOverDueTotal()

	{

		global $database;
		$sql = "select count(*) as ctr from tbl_prescriptions where (pres_stage=1 && pres_date <= DATE_SUB(NOW(), INTERVAL 3 DAY) || (pres_stage=2 and pres_patient_query_status=1 && pres_patient_query_date <= DATE_SUB(NOW(), INTERVAL 3 DAY) ))";
		$res=$database->get_results($sql);
		$total=$res[0]['ctr'];
		return $total;

	}	
	


function createLogs($uid,$utype,$action)
{
	global $database;
	
	$curDate=date("Y-m-d H:i:s");
	
	$names = array(
				'log_user_type' => $utype,
				'log_user_id' => $uid, 
				'log_activity' => $action, 
				'log_date_time' => $curDate			
				
				);

				$add_query = $database->insert( 'tbl_logs', $names );
	

	
}

function getparentid($id)
{
		global $database;
	
		 $sqlCategory="select * from tbl_categories where categories_id='".$database->filter($id)."'";
		$loadCategory=$database->get_results($sqlCategory);
		$rowCategory=$loadCategory[0];
		return $name=$rowCategory['categories_name'];
}



?>