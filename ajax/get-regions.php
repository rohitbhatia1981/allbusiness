<?php include "../private/settings.php"; ?>

<?php
$sqlRegion="select * from tbl_regions where region_status=1 and region_state='".$database->filter($_POST['state_id'])."'";
$resRegion=$database->get_results($sqlRegion);
$regionCount=count($resRegion);



?>
 <option value="">All Regions</option>
 <?php if ($regionCount>0) { 
	for ($j=0;$j<$regionCount;$j++)
		{
			 $rowRegion=$resRegion[$j];
		?>
          	<option value="<?php echo $rowRegion['region_id']; ?>" <?php if ($_POST['region_id']==$rowRegion['region_id']) echo "selected"; ?>><?php echo $rowRegion['region_name']; ?></option>
            <?php }
		}?>
		
        
        