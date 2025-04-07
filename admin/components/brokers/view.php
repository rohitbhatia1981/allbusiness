		

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

<a href="index.php?c=<?php echo $component?>&task=add&Cid=<?php echo $menuid['component_headingid']; ?>" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addawardmodal">Add New</a>

<?php } ?>							
								
					<a href="" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" role="button" title="Actions" aria-haspopup="true" aria-expanded="false">
									Action
								</a>
                                
                  
                  
                                
				<ul class="dropdown-menu dropdown-menu-right" role="menu">


				<?php if($permission['rights_delete'] == 1) { ?>

				<li><a href="javascript:if (document.adminForm.hidCheckedBoxes.value == 0){ alert('Please make a selection from the list to delete'); } else if (confirm('Are you sure you want to delete selected items?')){ submitbutton('remove');}"><i class="feather feather-trash-2 mr-2"></i> Delete</a></li>

				<?php } ?>

				<?php if($permission['rights_enable'] == 1) { ?>

				<li><a href="javascript:if (document.adminForm.hidCheckedBoxes.value == 0){ alert('Please make a selection from the list to enable'); } else {submitbutton('publishList', '');}"><i class="fa fa-check-circle mr-2"></i> Enable</a></li>

				<li><a href="javascript:if (document.adminForm.hidCheckedBoxes.value == 0){ alert('Please make a selection from the list to disable'); } else {submitbutton('unpublishList', '');}"><i class="fa fa-ban mr-2"></i> Disable</a></li>

				<?php } ?>
					

				</ul>
	
	

	
	
									<!-- <button  class="btn btn-light" data-toggle="tooltip" data-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </button>
									<button  class="btn btn-light" data-placement="top" data-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </button>
									<button  class="btn btn-primary" data-placement="top" data-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </button> -->
								</div>
				
			</div>
		</div>
		<!--End Page header-->
        
       <div class="row flex-lg-nowrap">
		<div class="col-12">
        <div class="row">
			<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									
                                   
                                    
										<div class="card-body">
											<div class="row">
												<div class="col-7" style="cursor:pointer" onclick="window.location='?c=brokers'">
													<div class="mt-0 text-left">
														<span class="fs-13 font-weight-semibold">Registered</span>
														<h3 class="mb-0 mt-1 text-success  fs-25">
                                                        
                                                        <?php
													$statsSql = "SELECT * FROM tbl_members where member_imported=0 and member_type=1 ";
													$stats = $database->get_results( $statsSql );
													echo $statsCount = count($stats);
									
													?>
                                                        
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-danger-transparent my-auto  float-right"> <i class="feather feather-briefcase"></i> </div>
												</div>
											</div>
										</div>
									
								</div>
							</div>
                            
                            <div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									
                                   
                                    
										<div class="card-body">
											<div class="row">
												<div class="col-7" style="cursor:pointer" onclick="window.location='?c=brokers&ty=unreg'">
													<div class="mt-0 text-left">
														<span class="fs-13 font-weight-semibold">Un-registered</span>
														<h3 class="mb-0 mt-1 text-orange  fs-25">
                                                       
                                                       <?php
													$statsSql = "SELECT * FROM tbl_members where member_imported=1 and member_type=1 ";
													$stats = $database->get_results( $statsSql );
													echo $statsCount = count($stats);
									
													?>
                                                        
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-danger-transparent my-auto  float-right"> <i class="feather feather-briefcase"></i> </div>
												</div>
											</div>
										</div>
									
								</div>
							</div>
                            
                            <div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									
                                   
                                    
										<div class="card-body">
											<div class="row">
												<div class="col-7" style="cursor:pointer" onclick="window.location='?c=brokers&ty=unreg'">
													<div class="mt-0 text-left">
														<span class="fs-13 font-weight-semibold">Active</span>
														<h3 class="mb-0 mt-1 text-success  fs-25">
                                                       
                                                        <?php
													$statsSql = "SELECT * FROM tbl_members where member_status=1 and member_type=1";
													$stats = $database->get_results( $statsSql );
													echo $statsCount = count($stats);
									
													?>
                                                        
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-danger-transparent my-auto  float-right"> <i class="feather feather-briefcase"></i> </div>
												</div>
											</div>
										</div>
									
								</div>
							</div>
                            
                            <div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									
                                   
                                    
										<div class="card-body">
											<div class="row">
												<div class="col-7" style="cursor:pointer" onclick="window.location='?c=brokers&ty=unreg'">
													<div class="mt-0 text-left">
														<span class="fs-13 font-weight-semibold">Disabled</span>
														<h3 class="mb-0 mt-1 text-danger  fs-25">
                                                        <?php
													$statsSql = "SELECT * FROM tbl_members where member_status=0 and member_type=1";
													$stats = $database->get_results( $statsSql );
													echo $statsCount = count($stats);
									
													?>
                                                        
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-danger-transparent my-auto  float-right"> <i class="feather feather-briefcase"></i> </div>
												</div>
											</div>
										</div>
									
								</div>
							</div>
                            
                            
                         </div>
                       </div>
                    </div>

			<!-- Row -->
	<div class="row flex-lg-nowrap">
		<div class="col-12">
        <div class="tab-menu-heading hremp-tabs p-0 ">

        <div class="tabs-menu1">

										<!-- Tabs -->

										<ul class="nav panel-tabs panel-tabs_a">

                                        <li><a href="?c=<?php echo $_GET['c']?>"  <?php if ($_GET['ty']=="") { ?> class="active" <?php } ?> >Registered Brokers</a></li>

										<li ><a href="?c=<?php echo $_GET['c']?>&ty=unreg" <?php if ($_GET['ty']=="unreg") { ?> class="active" <?php } ?>>Un-registered Brokers</a></li>
                                        
                                       

											

											

											

										</ul>

									</div>

             </div>
			<div class="row flex-lg-nowrap">
				<div class="col-12 mb-3">
					<div class="e-panel card">
						<div class="card-body">
							<div class="e-table">
                            	
                                <div class="row">
											<div class="col-md-3 col-lg-3 col-xl-3">
												<div class="form-group">
													<label class="form-label">Search by Keyword:</label>
													<input type="text" class="form-control" name="txtSearchByTitle" placeholder="Search by keyword" value="<?php echo $_GET['txtSearchByTitle'];?>">
                                                    
                                                    <input type="hidden" class="form-control" name="ty"  value="<?php echo $_GET['ty'];?>">
                                                   
                                                  
												</div>
											</div>
											
											<div class="col-md-2 col-lg-2 col-xl-2">
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
										</div>
								<div class="table-responsive table-lg mt-3">
									<table class="table table-bordered border-top" id="example1">
										<thead>
											<tr>
												<th width="10%" class="border-bottom-0 wd-5" style="width:10%">
												<label class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" name="chkControl" value="yes" onClick="checkAll(this.form,this.checked);" />
														<span class="custom-control-label"></span>
												</label>
												</th>
												
                                                
                                                <th width="19%" class="border-bottom-0">Broker Name</th>
                                                <th width="19%" class="border-bottom-0">Company</th>                                                
                                              <th width="13%" class="border-bottom-0">Email</th>                                                
                                              <th width="13%" class="border-bottom-0">Phone</th>
                                              <!--  <th width="13%" class="border-bottom-0">Mobile </th>
                                                <th width="13%" class="border-bottom-0">Email </th>-->
                                                <th width="13%" class="border-bottom-0">Registered Date</th>                                               
											  
												<th width="9%" class="border-bottom-0 w-20">Status</th>
											</tr>
										</thead>
							<?php

							if($totalRecords > 0) 

							{

							for ($i = 0; $i < $totalRecords; $i++) 

							{

							$srno++;

							$row = &$rows[$i];



							?>				
							<tbody>
								<tr>
									<td class="align-middle">
										<label class="custom-control custom-checkbox">
				
				<input name="deletes[]" id="chkDelete" onClick="isChecked(this.checked);" class="custom-control-input" value="<?php echo $row['member_id']; ?>" type="checkbox"  />			
											<span class="custom-control-label"></span>
										</label>
									</td>
									
                                    <td class="align-middle">
										
												<a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['member_id']; ?>"><?php echo $row['member_firstname']." ".$row['member_lastname']; ?></a>
											
									</td>
                                     <td class="align-middle">
										
												<?php echo $row['member_company']; ?> 
											
									</td>
                                    <td class="align-middle">
										
												<?php echo $row['member_email']; ?> 
											
									</td>
                                    
                                    <td class="align-middle">
										
												<?php echo $row['member_phone']; ?>
											
									</td>
                                    
                                    <!--<td class="align-middle">
										
												<div class="ml-3 mt-1">
															<?php if ($row['member_phone_verify']==0) { ?>
															<span class="badge badge-danger-light">Un-verified</span>
                                                            <?php } else if ($row['member_phone_verify']==1) { ?>
                                                            <span class="badge badge-success-light">Verified</span>
                                                            <?php } ?>
                                                            
											</div>
											
									</td>
                                    
                                    <td class="align-middle">
										
												<div class="ml-3 mt-1">
															<?php if ($row['member_email_verify']==0) { ?>
															<span class="badge badge-danger-light">Un-verified</span>
                                                            <?php } else if ($row['member_email_verify']==1) { ?>
                                                            <span class="badge badge-success-light">Verified</span>
                                                            <?php } ?>
                                                            
											</div>
											
									</td>-->
                                    <td><?php echo displayDateTimeFormat($row['member_regdate']); ?></td>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                   
                                    
                                   
                                    
                                   
                                    
                                    
									

									<td class="align-middle">
										<div class="btn-group align-top">
										<?php if($row['member_status'] == 1){ ?>

										<span class="tag tag-green">Enabled</span>

										<?php }else if($row['member_status'] == 0){ ?>

										<span class="tag tag-red">Disabled</span>

										<?php } ?>
                                        
                                        
                                        
                                        
                                         


											
										</div>
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
                
                <input type="hidden" name="Cid" value="<?php echo $_GET['Cid']?>" />

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
	<h4 class="page-title">Agency : <?php if ($_GET['task']=="edit") echo 'Edit'; else if ($_GET['task']=="add") echo 'Add'; else if ($_GET['task']=="detail") echo 'Detail'; ?></h4>
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
								

				<?php

						if ($_GET['task']=="edit")
						{
						$task="saveedit";
						$firstName=$row['member_firstname'];
						$lastName=$row['member_lastname'];
						$email=$row['member_email'];
						$phone=$row['member_phone'];
						$company=$row['member_company'];
						$website=$row['member_website'];
						$crm=$row['member_crm'];
						$address=$row['member_address'];
						$director=$row['member_director'];
						$tradingName=$row['member_tradingname'];
						
						}
						else
						{
						$task="save";
						
						$sqlReq="select * from tbl_broker_request where br_id='".$database->filter(base64_decode($_GET['request']))."'";
						$resReq=$database->get_results($sqlReq);
						$rowReq=$resReq[0];
						$firstName=$rowReq['br_first_name'];
						$lastName=$rowReq['br_last_name'];
						$email=$rowReq['br_email'];
						$phone=$rowReq['br_phone'];
						$company=$rowReq['br_company'];
						$website=$rowReq['br_website'];
						$crm=$rowReq['br_crm'];
						$address=$rowReq['br_address'];
						$director=$rowReq['br_director_name'];
						$tradingName=$rowReq['br_trading_name'];
						
						
						}

				?>
   <form name="adminForm" id="adminForm" action="?c=<?php echo $component?>&task=<?php echo $task;?>" method="post" class="form-horizontal" enctype="multipart/form-data">
   
   						
                                
   

<div class="card">
									
									<div class="card-body pb-2">
                                    
										<div class="row row-sm">
											<div class="col-lg-4">
                                            	<label class="form-label">First Name *</label>
												<input class="form-control mb-4" placeholder="" type="text" value="<?php echo $firstName ?>" name="txtFirstName" required>
											</div>	
                                            
                                            <div class="col-lg-4">
                                            	<label class="form-label">Last Name *</label>
												<input class="form-control mb-4" placeholder="" type="text" value="<?php echo $lastName?>" name="txtLastName" required="required">
											</div>										
										</div>
                                        
                                        <div class="row row-sm">
                                        	<div class="col-lg-4">
                                            	<label class="form-label">Email Address *</label>
												<input class="form-control mb-4" placeholder="" type="email" value="<?php echo $email?>" name="txtEmail" required="required">
											</div>
											<div class="col-lg-4">
                                            	<label class="form-label">Phone *</label>
												<input class="form-control mb-4" placeholder="" type="text" value="<?php echo $phone ?>" name="txtPhone" required="required">
											</div>											
										</div>
                                        
                                        <div class="row row-sm">
											<div class="col-lg-4">
                                            	<label class="form-label">Company *</label>
												<input class="form-control mb-4" placeholder="" type="text" value="<?php echo $company?>" name="txtCompany" required>
											</div>	
                                            
                                            <div class="col-lg-4">
                                            	<label class="form-label">Website</label>
												<input class="form-control mb-4" placeholder="" type="text" value="<?php echo $website?>" name="txtWebsite" >
											</div>	
                                            
                                            										
										</div>
                                        
                                        
                                        
                                        <div class="row row-sm">
											<div class="col-lg-4">
                                            	<label class="form-label">Address</label>
												<input class="form-control mb-4" placeholder="" type="text" value="<?php echo $address?>" name="txtAddress" >
											</div>	
                                            
                                            <div class="col-lg-4">
                                            	<label class="form-label">CRM</label>
												 <?php
		$sqlCRM="select * from tbl_crm where crm_status=1";
		$resCRM=$database->get_results($sqlCRM);
			
			
	?>
    
    
      <select class="form-control form-select" name="cmbCRM" id="cmbCRM" required>
      <option value="">Select CRM *</option>
         <?php if (count($resCRM)>0)
			{
				for ($j=0;$j<count($resCRM);$j++)
				{
					$rowCRM=$resCRM[$j];
					 ?>
                <option value="<?php echo $rowCRM['crm_name']; ?>" <?php if ($crm==$rowCRM['crm_name']) echo "selected"; ?>><?php echo $rowCRM['crm_name']; ?></option>
                <?php } 
			}
		?>
            
            
      </select>
											</div>
                                            
                                            										
										</div>
                                        
                                        <div class="row row-sm">
                                        
                                        	<div class="col-lg-4">
                                            	<label class="form-label">Director Name *</label>
												<input class="form-control mb-4" placeholder="" type="text" value="<?php echo $director?>"  name="txtDirector" required >
											</div>
                                            
                                            <div class="col-lg-4">
                                            	<label class="form-label">Business Trading Name *</label>
												<input class="form-control mb-4" placeholder="" type="text" value="<?php echo $tradingName?>" name="txtTradingName" required>
											</div>
											
                                            
                                            										
										</div>
                                       
		</div>
                                
                                </div>
                                
                                
                                
                              
                                
                                
                                <div class="card">
									<div class="card-header border-bottom-0">
										<h3 class="card-title">Enable/disable account</h3>
									</div>
									<div class="card-body pb-2">
                                    
										
                                        
                                        <div class="form-group ">
						<div class="form-label">Enabled</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPublished" id="rdoPublished" value="1" <?php if($row['member_status']=="1" || $row['member_status']=='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Yes</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPublished" id="rdoPublished" value="0" <?php if($row['member_status']==0 && $row['member_status']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">No</span>
							</label>
                            </div>
                                  </div>	
                   				</div>
                                
                             </div>   
                                
                                
                             
                                
                                <div class="card">
									<div class="card-header border-bottom-0">
										<h3 class="card-title">Activate registration and send email to Broker</h3>
									</div>
									<div class="card-body pb-2">
                                    
										
                                        
                                       
                                        
                                        <div style="height:20px"></div>
                        
                        
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-radio">
                                                <input type="checkbox"  class="" name="ckEmail" id="ckEmail" value="1" >
                                                &nbsp;
                                                Send Welcome Email and Password to Broker</label></div>
                                     </div>
                                  </div>	
                   				</div>
                                
                            
                <div class="row row-sm">
					<div class="col-lg">
					<button  class="btn btn-primary mt-4 mb-0">Submit</button>	
					</div>
					</div>	

<input type="hidden" name="pid" value="<?php echo $row['member_id']?>" />

<input type="hidden" name="rid" value="<?php echo $_GET['request']?>" />	

	</form>			            
                            	
            
            <script language="javascript">
			
			function addMoreFile(val)
					{
						if (val==1)
						{
						str='<div><input style="margin-top:15px" class="form-control" name="flCert[]" type="file" accept=".pdf,.jpg,.png"></div>';
						$("#cont_addmore_"+val).append(str);
						} 
					}

$("#adminForm").validate({
			rules: {
				/*txtEmpNumber: "required",*/
				
				
							
			},
			messages: {
				/*txtEmpNumber: "Please enter employee number"*/
				
				
				}			
		});

</script>                
                          
					
						</div>
					</div>
		</div>
                                
                                </div>

             <?php } ?>

     <?php function createFormForPagesHtml_details(&$rows) {

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
	<h4 class="page-title">Brokers : Full detail</h4>
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
        
        <div class="main-content">
					<div class="container">

						<!--Page header-->
						<div class="page-header d-xl-flex d-block">
							<div class="page-leftheader">
								<h4 class="page-title"><span class="font-weight-normal text-muted mr-2"><?php echo $row['member_firstname']." ".$row['member_lastname']; ?></span></h4>
							</div>
							<div class="page-rightheader ml-md-auto">
								<div class="d-flex align-items-end flex-wrap my-auto right-content breadcrumb-right">
									<div class="btn-list">
										
										<a href="?c=<?php echo $component?>&task=edit&Cid=<?php echo $menuid['component_headingid']; ?>&id=<?php echo $row['member_id']; ?>" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Edit Details"> <i class="feather feather-edit"></i> </a>
										<!--<a href="#" class="btn btn-light" data-placement="top" data-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </a>
										<a href="#" class="btn btn-primary" data-placement="top" data-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </a>-->
									</div>
								</div>
							</div>
						</div>
						<!--End Page header-->

						<!-- Row -->
						<div class="row">
							
							<div class="col-xl-12 col-md-12 col-lg-12">
								<div class="tab-menu-heading hremp-tabs p-0 ">
									<div class="tabs-menu1">
										<!-- Tabs -->
										<ul class="nav panel-tabs">
											<li class="ml-4"><a href="#tab5" class="active"  data-toggle="tab">Details</a></li>
											<!--<li><a href="#tab6" data-toggle="tab">Business Listings</a></li>-->
											<li><a href="#tab11" data-toggle="tab">Leads</a></li>
										</ul>
									</div>
								</div>
								<div class="panel-body tabs-menu-body hremp-tabs1 p-0">
									<div class="tab-content">
										<div class="tab-pane active" id="tab5">
											<div class="card-body">
												<!--<h5 class="mb-4 font-weight-semibold"></h5>-->
												<div class="col-xl-12 col-md-12 col-lg-12">
								<div class="card">
									
								  <div class="card-body pt-2 pl-3 pr-3">
										<div class="table-responsive">
											<table class="table" width="100%">
												<tbody>
													
                                                    
                                                    
                                                    
													<tr>
														<td width="26%">
															<span class="w-50">First Name</span>
														</td>
														<td width="1%">:</td>
														<td width="73%">
															<span class="font-weight-semibold"><?php echo $row['member_firstname'] ?>
                                                            
                                                            </span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td width="26%">
															<span class="w-50">Last Name</span>
														</td>
														<td width="1%">:</td>
														<td width="73%">
															<span class="font-weight-semibold"><?php echo $row['member_lastname'] ?>
                                                            
                                                            </span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Company</span>
														</td>
														<td>:</td>
														<td>
                                                      
															<span class="font-weight-semibold"><?php echo $row['member_company']; ?></span>
														</td>
													</tr>
                                                    <tr>
														<td>
															<span class="w-50">Email</span>
														</td>
														<td>:</td>
														<td>
                                                      
															<span class="font-weight-semibold"><?php echo $row['member_email']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Mobile</span>
														</td>
														<td>:</td>
														<td>
                                                      
															<span class="font-weight-semibold"><?php echo $row['member_phone']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Address</span>
														</td>
														<td>:</td>
														<td>
                                                        <?php
														$address=$row['member_address'];
														
														
														
														?>
															<span class="font-weight-semibold"><?php echo $address; ?></span>
														</td>
													</tr>
                                                    
                                                    
                                                    
													
                                                    
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Business Trading Name</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['member_tradingname']; ?> </span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Webiste</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['member_website']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Registered on</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo displayDateTimeFormat($row['member_regdate']); ?> </span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Registered IP</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['member_ip']; ?> </span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Last Login</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo displayDateTimeFormat($row['member_lastlogin']); ?> </span>
														</td>
													</tr>
                                                   
                                                   <!-- <tr>
														<td>
															<span class="w-50">Status</span>
														</td>
														<td>:</td>
														<td>
                                                        <?php if ($row['patient_status']==1) $status="Active"; else $status="Blocked"; ?>
															<span class="badge badge-primary"><?php echo $status; ?></span>
														</td>
													</tr>-->
												</tbody>
											</table>
									  </div>
										
									</div>
								</div>
								
							</div>
											</div>
										</div>
										<div class="tab-pane" id="tab6">
											<div class="card-body">
                        
							<div class="e-table">
                            
                            
                          
                            
							<!--<div class="row">
                            
                            
           
                           
                           					<div class="col-md-12 col-lg-12 col-xl-4">
                                            
                                            
														<div class="form-group">
															<label class="form-label">Search</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtSearchByTitle" type="text" value="<?php echo $_GET['txtSearchByTitle']?>" placeholder="Search by Order No.">
															</div>
														</div>
													</div>
                                                 
                                           <?php if ($_GET['ty']!='od') { ?>      
                                                 
                           
                           				
											
											
											
                                            <?php } ?>
											<div class="col-md-12 col-lg-12 col-xl-1">
												<div class="form-group mt-5">
                                                <input type="hidden" name="ty" value="<?php echo $_GET['ty']?>" />
													<button type="submit" class="btn btn-primary btn-block">Search</button>
                                                    
                                                     <?php $qS=$_SERVER['QUERY_STRING'];
												   if (strstr($qS,"txtSearchByTitle"))
												   {
													   
												    ?>
                                                    <a href="?c=<?php echo $_GET['c']?>&ty=<?php echo $_GET['ty']?>" style="font-size:11px; color:#03C">Reset filter</a>
                                                   <?php }
												   
												    ?>
												</div>
											</div>
										</div>-->
                                        
                               
								<div class="table-responsive table-lg mt-3">
                                <div style="height:22px"></div>
                                <h4>Business Listings Coming soon</h4>
									<!--<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
												
												
                                                <th width="19%" class="border-bottom-0">Order No.</th>
                                                <th width="14%" class="border-bottom-0">Date</th>
                                                <th width="14%" class="border-bottom-0">Nominated Pharmacy</th>
                                                <th width="14%" class="border-bottom-0">Patient Name</th>
                                                <th width="14%" class="border-bottom-0">Age</th>
                                                <th width="14%" class="border-bottom-0">Biological <br /> Sex</th>
                                                 
                                                <th width="27%" class="border-bottom-0">Medical <br /> Condition</th>                                                
                                                <th width="25%" class="border-bottom-0">Medication</th>
                                                <th width="15%" class="border-bottom-0 w-20">Status</th>
                                               
                                                <th width="15%" class="border-bottom-0 w-20">Risk Level</th>
											</tr>
										</thead>
							<?php

							
					
						
						$sqlPres="select * from tbl_prescriptions where FIND_IN_SET(".$database->filter($_GET['id']).",pres_prescriber) order by pres_id desc";
						$resPres=$database->get_results($sqlPres);
						$totalRecords=count($resPres);
						
						if($totalRecords > 0) 

							{

						
						for ($k=0;$k<$totalRecords;$k++)
						{
							
							$rowPres=$resPres[$k];
							
							$sqlPatient="select * from tbl_patients where patient_id='".$rowPres['pres_patient_id']."'";
							$resPatient=$database->get_results($sqlPatient);
							$rowPatient=$resPatient[0];
							
						
						?>



									
							<tbody>
								<tr>
									
									
                                    <td class="align-middle">
                                    
                                    <!--<a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['patient_id']; ?>"><?php echo $row['patient_id'] ?></a>-->
                                    <a href="?c=prescriptions&task=detail&id=<?php echo $rowPres['pres_id']; ?>" style="color:#06F; text-decoration:underline">PH-<?php echo $rowPres['pres_id'] ?></a>
										
												
											
									</td>
                                    
                                    <td class="align-middle">
										
										<?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?>
											
									</td>
                                    <td><?php echo getPharmacyName($rowPatient['patient_pharmacy']); ?></td>
                                    <td><?php echo $rowPatient['patient_first_name']." ".$rowPatient['patient_middle_name']." ".$rowPres['patient_last_name']; ?></td>
                                     <td><?php 
									
									$from = new DateTime($rowPatient['patient_dob']);
									$to   = new DateTime('today');
									echo $from->diff($to)->y;
									
									$rowPatient['patient_dob'] ?></td>
                                    <td><?php echo getGenderName($rowPatient['patient_gender']) ?></td>
                                    
                                    <td class="align-middle">
										
												<?php echo getConditionName($rowPres['pres_condition']); ?>
											
									</td>
                                    
                                    
                                    
                                    <td class="align-middle" >
										
												 <?php 
																$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($rowPres['pres_id'])."'";
																$resMedicine=$database->get_results($sqlMedicine);
																for ($m=0;$m<count($resMedicine);$m++)
																{
																	$rowMedicine=$resMedicine[$m];
																	
																	echo $rowMedicine['pm_med']." - ".$rowMedicine['pm_med_qty'];
															
                                                            
                                                            
                                                           }
														   
														   ?>
											
									</td>
                                    
                                   
                                    
                                   
                                    
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												
															<?php 
															
															echo getPrescriptionStatus_clinician($rowPres['pres_stage'],$rowPres['pres_id']); 
															?>
                                                            
                                                            <?php
if ($_GET['ty']=="od") { 															// Your date in the format "Y-m-d" (e.g., "2023-07-25")
$yourDate = $rowPres['pres_date'];

// Create DateTime objects for the current date and your date
$currentDate = new DateTime();
$yourDateTime = new DateTime($yourDate);

// Calculate the difference between the two dates
$interval = $currentDate->diff($yourDateTime);

// Get the difference in days
$daysDifference = $interval->days;

// Check if the difference is more than 3 days
if ($daysDifference > 3) {
    echo "<br><br><font style='color:red'>".$daysDifference. " days older</font>";
} 
}


?>
                                                           
                                                            
                                                           
											</div>
										</div>
									</td>
                                    
                                    <?php
									$overallRisk=$rowPres['pres_overall_risk'];
									if ($overallRisk==1) { $btnClr="green"; }
									else if ($overallRisk==2) { $btnClr="orange";  }
									else if ($overallRisk==3) { $btnClr="red";  }
									?>
                                   
                                    <td><div style="width:40px; height:40px" class="circle-<?php echo $btnClr; ?>"></div></td>
									

									
								</tr>
                                
                                

								<?php 

}

}

else

{

	?>

	<tr>

		<th class="border-bottom-0 w-10" style="text-align:center;" colspan="12"> - No Record found - </th>
	</tr>

	<?php

}



?>				
							
							</tbody>
											</table>-->

											

										</div>
									</div>
								</div>
										</div>
										
										
										
										
										<div class="tab-pane" id="tab11">
											<div class="card-body">
												
                                                
                                                <div class="table-responsive">
                                                
                                                <div style="height:22px"></div>
                                <h6>No leads yet</h6>
													
													
                                                    
                                                    
												</div>
                                                
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Row-->

					</div><!-- end app-content-->
				</div>
		</div>
</div>

             <?php } ?>
  