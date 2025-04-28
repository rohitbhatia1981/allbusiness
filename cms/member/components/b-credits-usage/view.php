		

		<!------ Listing Function ------------------->

		

		<?php function showRecordsListing(&$rows) { 

		

		global $component,$database,$pagingObject, $page;

		

		$totalRecords = count($rows);

		if ($page != 1)    

			$srno = (1 * $page) - 1;

		else

			$srno = 0;

		

		$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0]; 

		$sqlpermission="select * from tbl_rights_groups where rights_group_id='".$_SESSION['sess_member_groupid']."' and rights_menu_id='".$menuid['component_id']."'";

			$permissions = $database->get_results( $sqlpermission );

			$permission = $permissions[0];

		?>	
		
<form name="adminForm" action="?c=<?php echo $component?>" method="get">


<!--Page header-->
<div class="page-header d-lg-flex d-block">
			<div class="page-leftheader">
				<h4 class="page-title">Credit Usage Report</h4>
			</div>
			<div class="page-rightheader ml-md-auto">
				
				
			</div>
		</div>
		<!--End Page header-->

			<!-- Row -->
	<div class="row flex-lg-nowrap">
		<div class="col-12">
        
			<div class="row flex-lg-nowrap">
				<div class="col-12 mb-3">
					<div class="e-panel card">
						<div class="card-body">
                        
                         <?php if ($_GET['ty']=="") { ?>    
							<div class="e-table">
                            
                            
                        
                            
							<div class="row">
                           
                           					<div class="col-md-12 col-lg-12 col-xl-3">
														<div class="form-group">
															<label class="form-label">Search by Refernce ID or Ad ID</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtSearchByTitle" type="text" value="<?php echo $_GET['txtSearchByTitle']?>">
															</div>
														</div>
													</div>
                                                 
                                                 
                                                    
                                                    <div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">From:</label>
                                                    
                                                  
                                                    
													<input class="form-control fc-datepicker" name="txtSDate" placeholder="" type="date" value="<?php echo $_GET['txtSDate']?>">
												</div>
											</div>
                                            
                                            
                                            <div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">To:</label>
                                                    
                                                  
                                                    
													<input class="form-control fc-datepicker" name="txtEDate" value="<?php echo $_GET['txtEDate']?>" placeholder="" type="date">
												</div>
											</div>
                                                 
                                                 
                                                 
                           
                           
											
											
											
											<div class="col-md-12 col-lg-12 col-xl-1">
												<div class="form-group mt-5">
													<button type="submit" class="btn btn-primary btn-block">Search</button>
                                                    
                                                     <?php $qS=$_SERVER['QUERY_STRING'];
												   if (strstr($qS,"txtSearchByTitle"))
												   {
												    ?>
                                                    <a href="?c=<?php echo $_GET['c']?>" style="font-size:11px; color:#03C">Reset filter</a>
                                                   <?php } ?>
												</div>
											</div>
										</div>
                                        
								<div class="table-responsive table-lg mt-3">
                                
                               
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
												
												
                                                <th width="12%" class="border-bottom-0">Reference  Id</th>
                                                <th width="30%" class="border-bottom-0">Usage for Ad Id</th>
                                                <th width="38%" class="border-bottom-0">Ad Type</th>                                                                                            
                                                <th width="20%" class="border-bottom-0">Usage Date</th>
                                                
                                                
                                              
											</tr>
										</thead>
					
									
							<tbody>
                            
                            <?php
							if($totalRecords > 0) 
							{

						
									for ($k=0;$k<$totalRecords;$k++)
									{
										
										$rowPres=&$rows[$k];
							?>
								<tr>
									
									<td class="align-middle">                                    
                                   
                                    <a href="#" style="color:#06F; text-decoration:underline">#<?php echo $rowPres['usage_id']?></a>
									
												
											
									</td>
                                    <td class="align-middle">
                                    
                                   		<a href="?c=b-business&task=edit&id=<?php echo $rowPres['usage_ad_id']; ?>" style="color:#06F; text-decoration:underline"><?php echo $rowPres['usage_ad_id'] ?></a>						
												
											
									</td>
                                    
                                    <td class="align-middle">
										
									<?php echo $rowPres['usage_description'] ?>			
											
								  </td>
                                    <td><?php echo  date("d/m/Y",strtotime($rowPres['usage_date'])); ?></td>
                                   

									
								</tr>
                                
                                

								<?php

}

}

else

{

	?>

	<tr>

		<th class="border-bottom-0 w-10" style="text-align:center;" colspan="11"> - No Record found - </th>
	</tr>

	<?php

}



?>				
							
							</tbody>
											</table>

												<?php

												$pagingObject->displayLinks_Front(); 

												?>
                                                
                              

										</div>
									</div>
                                    
                                    <?php } else {
										
									include "components/".$_GET['c']."/"."subscription-tab.php";
										 ?>
                                    
                                    
                                    <?php } ?>
                                    
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Row -->

		</div>
	</div><!-- end app-content-->
</div>
				<input type="hidden" name="task" value="" />

				<input type="hidden" name="c" value="<?php echo $component?>" />
                
                <input type="hidden" name="Cid" value="<?php echo $_GET['Cid']?>" />

				<input type="hidden" name="hidCheckedBoxes" value="0" />

			</form>


             <?php } ?>

	<!-----------End Listing function------------------>

    

    

 
  