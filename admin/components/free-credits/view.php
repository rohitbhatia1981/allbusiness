		

		<!------ Listing Function ------------------->

		

		<?php function showRecordsListing(&$rows) { 

		

		global $component,$database,$pagingObject, $page;

		

		$totalRecords = count($rows);

		if ($page != 1)    

			$srno = (PAGELIMIT * $page) - PAGELIMIT;

		else

			$srno = 0;

		

		$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0]; 

		$sqlpermission="select * from tbl_rights_groups where rights_group_id='".$_SESSION['groupid']."' and rights_menu_id='".$menuid['component_id']."'";

			$permissions = $database->get_results( $sqlpermission );

			$permission = $permissions[0];

		?>	
		
<form name="adminForm" action="?c=<?php echo $component?>" method="get">

<!--Page header-->
<div class="page-header d-lg-flex d-block">
			<div class="page-leftheader">
				<h4 class="page-title"><?php echo pageheading(); ?></h4>
			</div>
			<div class="page-rightheader ml-md-auto">
				<div class=" btn-list">

								<?php if($permission['rights_add'] == 1) { ?>

<!--<a href="index.php?c=<?php echo $component?>&task=add&Cid=<?php echo $menuid['component_headingid']; ?>" title="Add" class="btn btn-light"><i class="feather feather-plus"></i></a>-->

<a href="index.php?c=<?php echo $component?>&task=add&Cid=<?php echo $menuid['component_headingid']; ?>" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addawardmodal">Free Credits to Broker</a>

<?php } ?>							
								
				
	
	

	
	
									<!-- <button  class="btn btn-light" data-toggle="tooltip" data-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </button>
									<button  class="btn btn-light" data-placement="top" data-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </button>
									<button  class="btn btn-primary" data-placement="top" data-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </button> -->
								</div>
				
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
							<div class="e-table">
                            
                            
                        
                            
							<div class="row">
                            
                            				<div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">Filter by Agency:</label>
                                                                                            
                                                                                          
                                                                                            
                                                                                            <?php
                                        // Fetch categories from the database
                                            $sqlCategories = "SELECT member_tradingname,member_id FROM tbl_members WHERE member_type=1  and member_imported=0 ORDER BY member_tradingname asc";
                                            $resCategories = $database->get_results($sqlCategories);
                                        
                                        
                                        ?>
                                        
                                        <select name="cmbAgency" class="form-control " data-placeholder="All">
                                            <option label="All"></option>
                                            <?php if (count($resCategories)>0) {
                                                
                                                for ($j=0;$j<count($resCategories);$j++)
                                                {
                                                    $rowCategories=$resCategories[$j];
                                                 ?>
                                            <option value="<?php echo $rowCategories['member_id'] ?>" <?php if ($rowCategories['member_id']==$_GET['cmbAgency']) echo "selected"; ?>><?php echo $rowCategories['member_tradingname'] ?></option>
                                            <?php }
                                            }?>
                                        </select>

												</div>
											</div>
                           
                           					<div class="col-md-12 col-lg-12 col-xl-3">
														<div class="form-group">
															<label class="form-label">Search by Order Id</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtSearchByTitle" type="text" value="<?php echo $_GET['txtSearchByTitle']?>">
															</div>
														</div>
													</div>
                                                 
                                                 
                                                    
                                                    <div class="col-md-12 col-lg-12 col-xl-2">
												<div class="form-group">
													<label class="form-label">From:</label>
                                                    
                                                  
                                                    
													<input class="form-control fc-datepicker" name="txtSDate" placeholder="" type="date" value="<?php echo $_GET['txtSDate']?>">
												</div>
											</div>
                                            
                                            
                                            <div class="col-md-12 col-lg-12 col-xl-2">
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
												
												
                                                <th width="7%" class="border-bottom-0">Order Id</th>
                                                <th width="11%" class="border-bottom-0">Broker Name</th> 
                                                <th width="58%" class="border-bottom-0">Order Details</th>                                                                                            
                                                <th width="24%" class="border-bottom-0">Payment Date</th>
                                                
                                                
                                              
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
                                   
                                    <a href="#" style="color:#06F; text-decoration:underline">#<?php echo $rowPres['ad_order_id']?></a>
									
												
											
									</td>
                                    
                                    <td class="align-middle">                                    
                                   
                                    <?php echo getAgencyName($rowPres['ad_agency_id'])?>
									
												
											
									</td>
                                    <td class="align-middle">
                                    
                                   		<table width="100%" style="background-color:#fff; border:2px solid; border-color:#069">
                                        <tr><td><strong>Ad Type</strong></td><td><strong>Quantity</strong></td><td><strong>Amount</strong></td></tr>
                                        <?php if ($rowPres['ad_premium_90_qty']!=0) { ?>
                                        	
                                        	<tr><td>Premium Ad (90 Days)</td><td><?php echo $rowPres['ad_premium_90_qty']?></td><td><?php echo CURRENCY.$rowPres['ad_premium_90_amount']?></td></tr>
                                         <?php } ?>
                                         
                                          <?php if ($rowPres['ad_premium_180_qty']!=0) { ?>
                                        	
                                        	<tr><td>Premium Ad (180 Days)</td><td><?php echo $rowPres['ad_premium_180_qty']?></td><td><?php echo CURRENCY.$rowPres['ad_premium_180_amount']?></td></tr>
                                         <?php } ?>
                                         
                                         <?php if ($rowPres['ad_advance_90_qty']!=0) { ?>
                                        	
                                        	<tr><td>Advanced Ad (90 Days)</td><td><?php echo $rowPres['ad_advance_90_qty']?></td><td><?php echo CURRENCY.$rowPres['ad_advance_90_amount']?></td></tr>
                                         <?php } ?>
                                         
                                          <?php if ($rowPres['ad_advance_180_qty']!=0) { ?>
                                        	
                                        	<tr><td>Advanced Ad (180 Days)</td><td><?php echo $rowPres['ad_advance_180_qty']?></td><td><?php echo CURRENCY.$rowPres['ad_advance_180_amount']?></td></tr>
                                         <?php } ?>
                                         
                                          <?php if ($rowPres['ad_total_gst']!=0) { ?>
                                        	
                                        	<tr style="background-color:#FF9"><td></td><td><strong>GST</strong></td><td><strong><?php echo "$".$rowPres['ad_total_gst']?></strong></td></tr>
                                         <?php } ?>
                                         
                                          <?php if ($rowPres['ad_net_total']!=0) { ?>
                                        	
                                        	<tr style="background-color:#FF9; font-size:17px"><td></td><td><strong>Net Total</strong></td><td><strong><?php echo "$".$rowPres['ad_net_total']?></strong></td></tr>
                                         <?php } ?>
                                         
                                         
                                        </table>						
												
											
									</td>
                                    
                                    <td width="24%" class="align-middle">
										
												<?php echo  date("d/m/Y",strtotime($rowPres['ad_order_date'])); ?>
											
									</td>
                                   

									
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

				<input type="hidden" name="hidCheckedBoxes" value="0" />

			</form>


             <?php } ?>

	<!-----------End Listing function------------------>

    

    

    <?php function createFormForPagesHtml(&$rows) {

	$row=array();

	global $component, $database;

	$row = &$rows[0];

	

	$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0];

	 ?>
	 
<!--Page header-->
<div class="page-header d-lg-flex d-block">
	<div class="page-leftheader">
	<h4 class="page-title">Free Credits to Broker : <?php if (@count($row)>0) echo 'Edit'; else echo 'Add'; ?></h4>
	</div>
	<div class="page-rightheader ml-md-auto">
		<div class=" btn-list">
		<a href="index.php?c=<?php echo $component?>&Cid=<?php echo $menuid['component_headingid']; ?>" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back">
																<i class="fa fa-close"></i>
															</a>
		</div>
	</div>
</div>
<!--End Page header-->	 

				
<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="card">

				<?php

						if ($_GET['task']=="edit")

						$task="saveedit";

						else

						$task="save";

				?>
   <form name="pages" id="pages" action="?c=<?php echo $component?>&task=<?php echo $task;?>" method="post" class="form-horizontal" />
   <div class="card-body pb-2">
						

						  
                            
                            <div class="form-group">
								<label class="form-label">Broker</label>
								
									<select class="form-control" name="cmbBroker" id="cmbBroker" required >
										<option label="Select Broker"></option>
										<?php
				$query = "SELECT * FROM tbl_members where member_type=1 and member_status=1 and member_imported=0 order by member_firstname";
				$results = $database->get_results( $query );
							
						foreach ($results as $value) {
							$name=$value['member_firstname']." ".$value['member_lastname'];

									?>

								<option value="<?php echo $value['member_id']; ?>" ><?php echo $name; ?></option>

							<?php	

							}

							?> 

									
									</select>
							
							
							</div>
                            
                            
					
							<div class="form-group">
								<label class="form-label">Premium Credits (90 Days)</label>
								<input class="form-control mb-4" type="number" id="txtPrem90" name="txtPrem90" value="" >
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Premium Credits (180 days)</label>
								<input class="form-control mb-4" type="number" id="txtPrem180" name="txtPrem180" value="" >
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Advanced Credits (90 Days)</label>
								<input class="form-control mb-4" type="number" id="txtAdv90" name="txtAdv90" value="" >
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Advanced Credits (180 Days)</label>
								<input class="form-control mb-4" type="number" id="txtAdv180" name="txtAdv180" value="" >
							</div>
                            
                            
                           
						

							
					
			

					   <!-- Image Upload -->

		
				
						
					<div class="row row-sm">
					<div class="col-lg">
					<button  class="btn btn-primary mt-4 mb-0">Submit</button>	
					</div>
					</div>	



	</form>					
								</div>

											


             <?php } ?>

    