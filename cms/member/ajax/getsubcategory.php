<?php include "../../../private/settings.php";

if ($_POST['cid']!="")
{
	
	
	
	
		$subCat="<option value='1'>Select Subcategory</option>";
		
		$sqlCategory="select * from tbl_business_category where bc_parent_id='".$database->filter($_POST['cid'])."' and bc_status=1 order by bc_name asc";
		$resCategory=$database->get_results($sqlCategory);
								
		for ($k=0;$k<count($resCategory);$k++)
		{
			$rowCategory=$resCategory[$k];
			
			if ($_POST['selectedValue']==$rowCategory['bc_id'])
			$selected="selected"; 
			else
			$selected="";
			
			$subCat.="<option value='".$rowCategory['bc_id']."' $selected>".$rowCategory['bc_name']."</option>";
		}
		
		echo $subCat;
}
else
echo $subCat="<option value='1'>Select Subcategory</option>";

 ?>
 