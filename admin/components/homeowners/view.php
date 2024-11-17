		

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
													<label class="form-label">Search by Keyword:</label>
													<input type="text" class="form-control" name="txtSearchByTitle" placeholder="ID, Name, Email, Phone" value="<?php echo $_GET['txtSearchByTitle'];?>">
                                                   
                                                  
												</div>
											</div>
											<div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">Filter Status:</label>
                                                    
                                                  
                                                    
													<select name="cmbStatus"  class="form-control custom-select select2" data-placeholder="All">
														<option label="All"></option>
                                                        <option value="1" <?php if ($_GET['cmbStatus']==1) echo "selected"; ?>>Enabled</option>
                                                        <option value="0" <?php if ($_GET['cmbStatus']==2) echo "selected"; ?>>Disabled</option>
                                                        
														
													</select>
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
									<table class="table table-bordered border-top text-nowrap" id="example1">
										<thead>
											<tr>
												<th width="4%" class="border-bottom-0 wd-5" style="width:10%">
												<label class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" name="chkControl" value="yes" onClick="checkAll(this.form,this.checked);" />
														<span class="custom-control-label"></span>
												</label>
												</th>
												<th width="3%" class="border-bottom-0">ID</th>
                                                <th width="6%" class="border-bottom-0">Name</th>
                                                
                                                
                                                <th width="11%" class="border-bottom-0">Email</th>
                                                
                                                <th width="11%" class="border-bottom-0">Phone</th>
                                               
                                                
                                               
                                                
                                                
                                                <th width="11%" class="border-bottom-0">Mobile Verification</th>
                                                <th width="11%" class="border-bottom-0">Email Verification</th>
                                                
                                                 <th width="11%" class="border-bottom-0">Registered Date</th>
												
												<th width="8%" class="border-bottom-0 w-20">Actions</th>
												<th width="14%" class="border-bottom-0 w-20">Status</th>
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
				
				<input name="deletes[]" id="chkDelete" onClick="isChecked(this.checked);" class="custom-control-input" value="<?php echo $row['ho_id']; ?>" type="checkbox"  />			
											<span class="custom-control-label"></span>
										</label>
									</td>
									<td class="align-middle">
										
												<a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['ho_id']; ?>" style="color:#06F; text-decoration:underline"><?php echo $row['ho_id'] ?></a>
											
									</td>
                                    <td class="align-middle">
										
												<?php echo $row['ho_name']; ?> 
											
									</td>
                                     
                                    
                                    <td class="align-middle">
										
												<?php echo $row['ho_email']; ?> 
											
									</td>
                                    
                                    <td class="align-middle">
										
												<?php echo $row['ho_phone']; ?> 
											
									</td>
                                    
                                   
                                    
                                  
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
															<?php if ($row['ho_phone_verify']==0) { ?>
															<span class="badge badge-danger-light">Un-verified</span>
                                                            <?php } else if ($row['ho_phone_verify']==1) { ?>
                                                            <span class="badge badge-success-light">Verified</span>
                                                            <?php } ?>
                                                            
											</div>
										</div>
									</td>
                                    
                                    
                                   
                                    
                                   
                                    
                                   
                                    
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												<?php if ($row['ho_email_verify']==0) { ?>
															<span class="badge badge-danger-light">Un-verified</span>
                                                            <?php } else if ($row['ho_email_verify']==1) { ?>
                                                            <span class="badge badge-success-light">Verified</span>
                                                            <?php } ?>
											</div>
										</div>
									</td>
                                     <td class="align-middle">
										
												<?php echo displayDateFormat($row['ho_registered_date']); ?>
											
									</td>
									<td class="align-middle">
										<div class="btn-group align-top">
											<button class="btn btn-sm btn-white"  ><a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['ho_id']; ?>">View full record</a></button>
											



											

											
										</div>
									</td>

									<td class="align-middle">
										<div class="btn-group align-top">
										<?php if($row['ho_status'] == 1){ ?>

										<span class="tag tag-green">Enabled</span>

										<?php }else if($row['ho_status'] == 0){ ?>

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
	<h4 class="page-title">Homeowners : <?php if ($_GET['task']=="edit") echo 'Edit'; else if ($_GET['task']=="add") echo 'Add'; else if ($_GET['task']=="detail") echo 'Detail'; ?></h4>
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
                                
                             <div class="col-lg-8 col-md-8">   
                                

				<?php

						if ($_GET['task']=="edit")

						$task="saveedit";

						else

						$task="save";

				?>
   <form name="adminForm" id="adminForm" action="?c=<?php echo $component?>&task=<?php echo $task;?>" method="post" class="form-horizontal" />
   <div class="card-body pb-2">
						

					
                            
                           <div class="form-group">
								<label class="form-label">Name *</label>
								<input class="form-control mb-4" type="text" id="txtName" name="txtName" value="<?php echo $row['ho_name']?>" required>
							</div>
                            
                             
                            
                             <div class="form-group">
								<label class="form-label">Email *</label>
								<input class="form-control mb-4" type="email" id="txtEmail" name="txtEmail" value="<?php echo $row['ho_email']?>" required>
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Password <?php if ($_GET['task']=="add") { ?>*<?php } else echo " (enter password if you want to change)"; ?></label>
								<input class="form-control mb-4" type="text" id="txtPassword" name="txtPassword" value="" <?php if ($_GET['task']=="add") { ?>required <?php } ?>>
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Phone *</label>
								<input class="form-control mb-4" type="text" id="txtPhone" name="txtPhone" value="<?php echo $row['ho_phone']?>" required>
							</div>
                            
                            
                            
                            <div class="form-group">
								<label class="form-label">Address 1</label>
								<input class="form-control mb-4" type="text" id="txtAddress1" name="txtAddress1" value="<?php echo $row['blog_title']?>">
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Address 2</label>
								<input class="form-control mb-4" type="text" id="txtAddress2" name="txtAddress2" value="<?php echo $row['blog_title']?>">
							</div>
                            
                            <div class="form-group">
								<label class="form-label">City</label>
								<input class="form-control mb-4" type="text" id="txtCity" name="txtCity" value="<?php echo $row['blog_title']?>" >
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Postcode </label>
								<input class="form-control mb-4" type="text" id="txtPostcode" name="txtPostcode" value="<?php echo $row['blog_title']?>">
							</div>
					
                    		
                            
                            

						<div class="form-group ">
						<div class="form-label">Email Verified</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoEmail" id="rdoEmail" value="1" <?php if($row['ho_email_verify']=="1" || $row['ho_email_verify']=='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Yes</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoEmail" id="rdoEmail" value="0" <?php if($row['ho_email_verify']==0 && $row['ho_email_verify']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">No</span>
							</label>
					
						</div>
					</div>	
                    
                    <div class="form-group ">
						<div class="form-label">Phone Verified</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPhone" id="rdoPhone" value="1" <?php if($row['ho_phone_verify']=="1" || $row['page_status']=='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Yes</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPhone" id="rdoPhone" value="0" <?php if($row['ho_phone_verify']==0 && $row['page_status']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">No</span>
							</label>
					
						</div>
					</div>

							
			
					



						<div class="form-group ">
						<div class="form-label">Enabled</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPublished" id="rdoPublished" value="1" <?php if($row['ho_status']=="1" || $row['ho_status']=='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Yes</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPublished" id="rdoPublished" value="0" <?php if($row['ho_status']==0 && $row['ho_status']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">No</span>
							</label>
					
						</div>
					</div>
				
						
					<div class="row row-sm">
					<div class="col-lg">
					<button  class="btn btn-primary mt-4 mb-0">Submit</button>	
					</div>
					</div>	
                   </div>

<input type="hidden" name="pageId" value="<?php echo $row['ho_id']?>" />	
<input type="hidden" name="userId" value="<?php echo $row['user_id']?>" />

<input type="hidden" name="parentgroupId" value="<?php echo $_SESSION['groupid']?>" />

<input type="hidden" name="parentuserId" value="<?php echo $_SESSION['user_id']?>" />
	</form>					
								</div>
                                
                                
<script language="javascript">

$("#adminForm").validate({
			rules: {
				txtName: "required",
				txtEmail: "required",
				
				txtPhone: "required"
			},
			messages: {
				txtName: "Please enter homeowner name",
				txtEmail: "Please enter email",
				txtPassword: "Please enter password",
				txtPhone: "Please enter phone"
				
				}			
		});

</script>       
                                


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
<style>
.circle-red {
  width: 40px;
  height: 40px;
  background: red;
  border-radius: 50%
}
</style>
<div class="page-header d-lg-flex d-block">
	<div class="page-leftheader">
	<h4 class="page-title">Homeower Details</h4>
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
								<h4 class="page-title"><span class="font-weight-normal text-muted mr-2">Homeowner ID #<?php echo $row['ho_id'] ?></span></h4>
							</div>
							<div class="page-rightheader ml-md-auto">
								<div class="d-flex align-items-end flex-wrap my-auto right-content breadcrumb-right">
									<div class="btn-list">
										
										<a href="?c=<?php echo $component?>&task=edit&Cid=<?php echo $menuid['component_headingid']; ?>&id=<?php echo $row['ho_id']; ?>" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Edit Patient"> <i class="feather feather-edit"></i> </a>
										<!--<a href="#" class="btn btn-light" data-placement="top" data-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </a>
										<a href="#" class="btn btn-primary" data-placement="top" data-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </a>-->
									</div>
								</div>
							</div>
						</div>
						<!--End Page header-->

						<!-- Row -->
						<div class="row">
							<div class="col-xl-3 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header  border-0">
										<div class="card-title">Personal Details</div>
									</div>
									<div class="card-body pt-2 pl-3 pr-3">
										<div class="table-responsive">
											<table class="table">
												<tbody>
													<tr>
														<td>
															<span class="w-50"> ID</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['ho_id'] ?></span>
														</td>
													</tr>
													<tr>
														<td>
															<span class="w-50">Name</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['ho_name'] ?>
                                                           
                                                            </span>
														</td>
													</tr>
                                                 
                                                    
													
                                                    <tr>
														<td>
															<span class="w-50">Email</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['ho_email']; ?></span>
														</td>
													</tr>
                                                    
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Phone</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['ho_phone']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Mobile Verification </span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php if ($row['ho_phone_verify']==0) { ?>
															<span class="badge badge-danger-light">Un-verified</span>
                                                            <?php } else if ($row['ho_phone_verify']==1) { ?>
                                                            <span class="badge badge-success-light">Verified</span>
                                                            <?php } ?></span>
														</td>
													</tr>
													
                                                    <tr>
														<td>
															<span class="w-50">Email Verification </span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php if ($row['ho_email_verify']==0) { ?>
															<span class="badge badge-danger-light">Un-verified</span>
                                                            <?php } else if ($row['ho_phone_verify']==1) { ?>
                                                            <span class="badge badge-success-light">Verified</span>
                                                            <?php } ?></span>
														</td>
													</tr>
													
													
                                                    <tr>
														<td>
															<span class="w-50">Status</span>
														</td>
														<td>:</td>
														<td>
                                                        <div class="btn-group align-top">
										<?php if($row['ho_status'] == 1){ ?>

										<span class="tag tag-green">Enabled</span>

										<?php }else if($row['ho_status'] == 0){ ?>

										<span class="tag tag-red">Disabled</span>

										<?php } ?>


											
										</div>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
										
									</div>
								</div>
								
							</div>
							<div class="col-xl-9 col-md-12 col-lg-12">
								<div class="tab-menu-heading hremp-tabs p-0 ">
									<div class="tabs-menu1">
										<!-- Tabs -->
										<ul class="nav panel-tabs">
											<li class="ml-4"><a href="#tab5" class="active"  data-toggle="tab">Jobs</a></li>
											<!--<li><a href="#tab6" data-toggle="tab">Direct Leads</a></li>	-->									
											<!--<li><a href="#tab10" data-toggle="tab">Messages</a></li>-->
											<li><a href="#tab11" data-toggle="tab">Logs</a></li>
										</ul>
									</div>
								</div>
								<div class="panel-body tabs-menu-body hremp-tabs1 p-0">
									<div class="tab-content">
										<div class="tab-pane active" id="tab5">
											<div class="card-body">
												<!--<h5 class="mb-4 font-weight-semibold"></h5>-->
												<div class="table-responsive table-lg mt-3">
									

											No jobs posted yet!	

										</div>
											</div>
										</div>
										<div class="tab-pane" id="tab6">
											<div class="card-body">
							
                            
                           No leads yet!
                            
							
								
									</div>
								
										</div>
										
                                        
                                       
                                        
										
										
										
										<div class="tab-pane" id="tab10">
											<div class="card-body">
                                            
                                            No messages yet!
											
											</div>
										</div>
										<div class="tab-pane" id="tab11">
											<div class="card-body">
												<div class="table-responsive">
                                                
                                                <div style="height:22px"></div>
                             
													No logs yet!
													<!--<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="miles-tables">
														<thead>
															<tr>
																<th class="border-bottom-0 text-center w-5">No</th>
																<th class="border-bottom-0">Log Details</th>
																<th class="border-bottom-0">Date</th>
                                                               
															
																
															</tr>
														</thead>
														<tbody>
                                                        
                                                        <?php $sqlLogs="select * from tbl_logs where log_user_id='".$database->filter($_GET['id'])."' and log_user_type='patient' order by log_id desc";
														$resLogs=$database->get_results($sqlLogs);
														if (count($resLogs)>0)
														{
															for ($j=0;$j<count($resLogs);$j++)
															{
																$rowLogs=$resLogs[$j];
														 ?>
															<tr>
																<td class="text-center"><?php echo $j+1; ?></td>
																<td>
																	<?php echo $rowLogs['log_activity']?>
																</td>
																<td><?php echo fn_formatDateTime($rowLogs['log_date_time'])?></td>
																
																
															</tr>
														<?php }
														}?>	
															
														</tbody>
													</table>-->
                                                    
                                                    
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
  