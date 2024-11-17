		

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
                                               
                                                
                                               
                                                
                                                
                                                <th width="11%" class="border-bottom-0">Business Name</th>
                                                <th width="11%" class="border-bottom-0">Service Category</th>
                                                <th width="11%" class="border-bottom-0">Mobile Verified</th>
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
				
				<input name="deletes[]" id="chkDelete" onClick="isChecked(this.checked);" class="custom-control-input" value="<?php echo $row['prof_id']; ?>" type="checkbox"  />			
											<span class="custom-control-label"></span>
										</label>
									</td>
									<td class="align-middle">
										
												<a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['prof_id']; ?>" style="color:#06F; text-decoration:underline"><?php echo $row['prof_id'] ?></a>
											
									</td>
                                    <td class="align-middle">
										
												<?php echo $row['prof_name']; ?> 
											
									</td>
                                     
                                    
                                    <td class="align-middle">
										
												<?php echo $row['prof_email']; ?> 
											
									</td>
                                    
                                    <td class="align-middle">
										
												<?php echo $row['prof_phone']; ?> 
											
									</td>
                                    
                                   
                                    
                                  
                                    <td class="align-middle">
										
									</td>
                                    
                                    
                                   
                                    
                                   
                                    
                                   
                                    
                                    <td class="align-middle">
										
									</td>
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
															<?php if ($row['prof_phone_verify']==0) { ?>
															<span class="badge badge-danger-light">Un-verified</span>
                                                            <?php } else if ($row['prof_phone_verify']==1) { ?>
                                                            <span class="badge badge-success-light">Verified</span>
                                                            <?php } ?>
                                                            
											</div>
										</div>
									</td>
                                     <td class="align-middle">
										
												<?php echo displayDateFormat($row['prof_registered_date']); ?>
											
									</td>
									<td class="align-middle">
										<div class="btn-group align-top">
											<button class="btn btn-sm btn-white"  ><a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['prof_id']; ?>">View full record</a></button>
											



											

											
										</div>
									</td>

									<td class="align-middle">
										<div class="btn-group align-top">
										<?php if($row['prof_status'] == 1){ ?>

										<span class="tag tag-green">Enabled</span>

										<?php }else if($row['prof_status'] == 0){ ?>

										<span class="tag tag-red">Disabled</span>

										<?php } ?>
                                        
                                        
                                         


											
										</div>
                                        &nbsp;<br /><?php if ($row['prof_approve']==0) echo "<font style='color:#F00'>Inactive Account</font>"; else echo "<font style='color:#090'>Active Account</font>"; ?>
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
	<h4 class="page-title">Professional : <?php if ($_GET['task']=="edit") echo 'Edit'; else if ($_GET['task']=="add") echo 'Add'; else if ($_GET['task']=="detail") echo 'Detail'; ?></h4>
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

	<form name="adminForm" id="adminForm" action="?c=<?php echo $component?>&task=<?php echo $task;?>" method="post" class="form-horizontal" />			
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="card">
                <div class="col-lg-7 col-md-7">   
                                

				<?php

						if ($_GET['task']=="edit")

						$task="saveedit";

						else

						$task="save";

				?>
   
   <div class="card-body pb-2">
						
						 <div class="form-group">
                         <h4 style="color:#2C63F3">Basic Information</h4>
                         </div>
						 
                            
                           <div class="form-group">
								<label class="form-label">Name *</label>
								<input class="form-control mb-4" type="text" id="txtName" name="txtName" value="<?php echo $row['prof_name']?>" required>
							</div>
                            
                             
                            
                             <div class="form-group">
								<label class="form-label">Email *</label>
								<input class="form-control mb-4" type="email" id="txtEmail" name="txtEmail" value="<?php echo $row['prof_email']?>" required>
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Password <?php if ($_GET['task']=="add") { ?>*<?php } else echo " (enter password if you want to change)"; ?></label>
								<input class="form-control mb-4" type="text" id="txtPassword" name="txtPassword" value="" <?php if ($_GET['task']=="add") { ?>required <?php } ?>>
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Phone *</label>
								<input class="form-control mb-4" type="text" id="txtPhone" name="txtPhone" value="<?php echo $row['prof_phone']?>" required>
							</div>
                            
                      </div>
                  </div>
               </div>
             </div>
          </div>
             
      <div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="card">
                <div class="col-lg-7 col-md-7">    
                   <div class="card-body pb-2">  
                     
                            
                             <div class="form-group">
                             <h4 style="color:#2C63F3">Service Categories</h4>
                             </div>
                               <div class="form-group">
								<label class="form-label">Add your Service Category</label>
								<input class="form-control mb-4" type="text" id="txtService" name="txtService" value="" placeholder="Enter industry type like (Carpenter, builder etc)">
                                
                                
							</div>
                            
                            
                                    
                        
                      		</div>
                            
                            
                  </div>
            
           <?php
		   $sqlParentCat="select * from tbl_categories where categories_parent_id=0 and categories_status=1 order by categories_name"; 
		   $resParentCat=$database->get_results($sqlParentCat);
		   for ($i=0;$i<count($resParentCat);$i++)
		   {
			   $rowParentCat=$resParentCat[$i];
		   ?>
           <div id="id_service_category_<?php echo $rowParentCat['categories_id']?>"></div>
           <?php } ?>
           
           
          
           
                   
      <div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="card">
                <div class="col-lg-7 col-md-7">    
                   <div class="card-body pb-2">  
                            
                           
                            
                             <div class="form-group">
                             <h4 style="color:#2C63F3">Service Areas</h4>
                             </div>
                            
                             <div class="form-group">
								<label class="form-label">Add your Service Areas</label>
								<input class="form-control mb-4" type="text" id="txtAreas" name="txtAreas" value="">
							</div>
                   
                    </div>
                  </div>
               </div>
             </div>
          </div>   
          
           <div class="row">
			<div class="col-lg-12 col-md-12">
			<div class="card">
                <div class="col-lg-7 col-md-7">    
                   <div class="card-body pb-2">  
                            
                             <div class="form-group">
                             <h4 style="color:#2C63F3">Business Details</h4>
                             </div>
                            
                             <div class="form-group">
								<label class="form-label">Business Name</label>
								<input class="form-control mb-4" type="text" id="txtBusinessName" name="txtBusinessName" value="<?php echo $row['blog_title']?>">
							</div>
                            
                             <div class="form-group">
								<label class="form-label">ABN</label>
								<input class="form-control mb-4" type="text" id="txtABN" name="txtABN" value="<?php echo $row['blog_title']?>">
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Address</label>
								<input class="form-control mb-4" type="text" id="txtAddress1" name="txtAddress1" value="<?php echo $row['blog_title']?>">
							</div>
                            
                             
                            
                            <div class="form-group">
								<label class="form-label">City</label>
								<input class="form-control mb-4" type="text" id="txtCity" name="txtCity" value="<?php echo $row['blog_title']?>" >
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Postcode </label>
								<input class="form-control mb-4" type="text" id="txtPostcode" name="txtPostcode" value="<?php echo $row['blog_title']?>">
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Business Website </label>
								<input class="form-control mb-4" type="text" id="txtWebsite" name="txtWebsite" value="<?php echo $row['blog_title']?>">
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Business Phone</label>
								<input class="form-control mb-4" type="text" id="txtBPhone" name="txtBPhone" value="<?php echo $row['blog_title']?>">
							</div>
                            
                            <div class="form-group">
								<label class="form-label">About us </label>
								<textarea class="form-control mb-4" type="text" id="txtJobDesc" name="txtJobDesc"></textarea>
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Business Logo</label>
                                <div id="images4ex" orakuploader="on"></div>
								
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Profile Photo</label>
                                <div id="images4ex2" orakuploader="on"></div>
								
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Business License Number </label>
								<input class="form-control mb-4" type="text" id="txtLicense" name="txtLicense" value="<?php echo $row['blog_title']?>">
							</div>
                            
                             <div class="form-group">
								<label class="form-label">Upload Business Licence</label>
								<input class="form-control mb-4" type="file" id="flLicense" name="flLicense" value="<?php echo $row['blog_title']?>">
							</div>
                            
                             </div>
                  </div>
               </div>
             </div>
          </div>   
          
           <div class="row">
			<div class="col-lg-12 col-md-12">
			<div class="card">
                <div class="col-lg-7 col-md-7">    
                   <div class="card-body pb-2">  
                            
                            <div class="form-group">
                             <h4 style="color:#2C63F3">Social Media</h4>
                             </div>
                            
                            <div class="form-group">
								<label class="form-label">Facebook </label>
								<input class="form-control mb-4" type="text" id="txtFacebook" name="txtFacebook" value="<?php echo $row['blog_title']?>">
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Instagram </label>
								<input class="form-control mb-4" type="text" id="txtInstagram" name="txtInstagram" value="<?php echo $row['blog_title']?>">
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Linked In </label>
								<input class="form-control mb-4" type="text" id="txtLinkedin" name="txtLinkedin" value="<?php echo $row['blog_title']?>">
							</div>
                            
                            <div class="form-group">
								<label class="form-label">Twitter</label>
								<input class="form-control mb-4" type="text" id="txtTwitter" name="txtTwitter" value="<?php echo $row['blog_title']?>">
							</div>
					
                     </div>
                  </div>
               </div>
             </div>
          </div>   
          
           <div class="row">
			<div class="col-lg-12 col-md-12">
			<div class="card">
                <div class="col-lg-7 col-md-7">    
                   <div class="card-body pb-2">  		
                            
                           <div class="form-group">
                             <h4 style="color:#2C63F3">Status</h4>
                             </div> 

						<div class="form-group ">
						<div class="form-label">Email Verified</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoEmail" id="rdoEmail" value="1" <?php if($row['prof_email_verify']=="1" || $row['prof_email_verify']=='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Yes</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoEmail" id="rdoEmail" value="0" <?php if($row['prof_email_verify']==0 && $row['prof_email_verify']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">No</span>
							</label>
					
						</div>
					</div>	
                    
                    <div class="form-group ">
						<div class="form-label">Phone Verified</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPhone" id="rdoPhone" value="1" <?php if($row['prof_phone_verify']=="1" || $row['page_status']=='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Yes</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPhone" id="rdoPhone" value="0" <?php if($row['prof_phone_verify']==0 && $row['page_status']!='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">No</span>
							</label>
					
						</div>
					</div>

							
			
					



						<div class="form-group ">
						<div class="form-label">Enabled</div>
						<div class="custom-controls-stacked">
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPublished" id="rdoPublished" value="1" <?php if($row['prof_status']=="1" || $row['prof_status']=='') echo 'checked="checked"'; ?>>
								<span class="custom-control-label">Yes</span>
							</label>
							<label class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="rdoPublished" id="rdoPublished" value="0" <?php if($row['prof_status']==0 && $row['prof_status']!='') echo 'checked="checked"'; ?>>
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

<input type="hidden" name="pageId" value="<?php echo $row['prof_id']?>" />	
<input type="hidden" name="userId" value="<?php echo $row['user_id']?>" />

<input type="hidden" name="parentgroupId" value="<?php echo $_SESSION['groupid']?>" />

<input type="hidden" name="parentuserId" value="<?php echo $_SESSION['user_id']?>" />
	</form>					
								</div>
                                
                                
<script language="javascript">

$(function() {
		$("#txtService").autocomplete({
			 minLength: 2,
			source: "<?php echo URL?>autocomplete-ajax/services.php",
		   select: function( event, ui ) {
				event.preventDefault();
				$("#txtService").val("");
				var servId;
				servId=ui.item.id;
				if (servId!="")
				{
								
					var dataUrl = '<?php echo URL?>ajax/service-category-selection.php?id='+servId;
					$('#id_service_category_'+servId).load(dataUrl, function(response, status, xhr) {
						if (status == 'success') {
							//$('#id_service_category_1').append();
							
							var offset = 80;
							
							var targetDivId = 'id_service_category_'+servId;

							// Use animate to smoothly scroll to the target div
							$('html, body').animate({
								scrollTop: $('#' + targetDivId).offset().top-offset
							}, 1000); // Adjust the duration (in milliseconds) as needed
							
							
						}
   	
						else if (status == 'error') {
							console.log('Error loading data: ' + xhr.statusText);
						}
					});
				}
				
			}
		});

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
		
		
});

</script>   


			<?php if ($row['blog_image']!="")
			 $pImageStr="'".$row['blog_image']."'";		 
			  ?>

 <script language="javascript">
$(document).ready(function(){
	$('#images4ex').orakuploader({
		orakuploader : true,
		orakuploader_path : 'orakuploader/',

		orakuploader_main_path : '../images/blogs',
		orakuploader_thumbnail_path : '../images/blogs',
		
		orakuploader_use_main : true,
		orakuploader_use_sortable : true,
		orakuploader_use_dragndrop : true,
		
		orakuploader_add_image : 'orakuploader/images/add.png',
		orakuploader_add_label : 'Browser for images',
		
		orakuploader_resize_to	     : 800,
		orakuploader_thumbnail_size  : 400,
		orakuploader_maximum_uploads : 1,
		orakuploader_attach_images: [<?php echo $pImageStr?>],
		
		orakuploader_main_changed    : function (filename) {
			$("#mainlabel-images").remove();
			$("div").find("[filename='" + filename + "']").append("<div id='mainlabel-images' class='maintext'>Main Image</div>");
		}

	});
	
	$('#images4ex2').orakuploader({
		orakuploader : true,
		orakuploader_path : 'orakuploader/',

		orakuploader_main_path : '../images/blogs',
		orakuploader_thumbnail_path : '../images/blogs',
		
		orakuploader_use_main : true,
		orakuploader_use_sortable : true,
		orakuploader_use_dragndrop : true,
		
		orakuploader_add_image : 'orakuploader/images/add.png',
		orakuploader_add_label : 'Browser for images',
		
		orakuploader_resize_to	     : 800,
		orakuploader_thumbnail_size  : 400,
		orakuploader_maximum_uploads : 1,
		orakuploader_attach_images: [<?php echo $pImageStr?>],
		
		orakuploader_main_changed    : function (filename) {
			$("#mainlabel-images").remove();
			$("div").find("[filename='" + filename + "']").append("<div id='mainlabel-images' class='maintext'>Main Image</div>");
		}

	});
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
	<h4 class="page-title">Professional Details</h4>
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
								<h4 class="page-title"><span class="font-weight-normal text-muted mr-2">Professional ID #<?php echo $row['prof_id'] ?></span></h4>
							</div>
							<div class="page-rightheader ml-md-auto">
								<div class="d-flex align-items-end flex-wrap my-auto right-content breadcrumb-right">
									<div class="btn-list">
										
										<a href="?c=<?php echo $component?>&task=edit&Cid=<?php echo $menuid['component_headingid']; ?>&id=<?php echo $row['prof_id']; ?>" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Edit Patient"> <i class="feather feather-edit"></i> </a>
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
											<li class="ml-4"><a href="#tab1" class="active"  data-toggle="tab">Profile</a></li>
											<li><a href="#tab5" data-toggle="tab">Assigned Jobs</a></li>
                                            <li><a href="#tab6" data-toggle="tab">Direct Leads</a></li>										
											<li><a href="#tab10" data-toggle="tab">Messages</a></li>
											<li><a href="#tab11" data-toggle="tab">Logs</a></li>
										</ul>
									</div>
								</div>
								<div class="panel-body tabs-menu-body hremp-tabs1 p-0">
									<div class="tab-content">
                                    
                                    
                                    <div class="tab-pane active" id="tab1">
											<div class="card-body">
												<!--<h5 class="mb-4 font-weight-semibold"></h5>-->
												<div class="col-xl-12 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header  border-0">
										<div class="card-title">Profile</div>
									</div>
									<div class="card-body pt-2 pl-3 pr-3">
										<div class="row">
							<div class="col-xl-3 col-lg-4 col-md-12">
								<div class="card user-pro-list overflow-hidden">
									<div class="card-body">
										<div class="user-pic text-center">
											<span class="avatar avatar-xxl brround" style="background-image: url(../../assets/images/users/16.jpg)">
												<span class="avatar-status bg-green"></span>
											</span>
											<div class="pro-user mt-3">
												<h5 class="pro-user-username text-dark mb-1 fs-16">Abigali kelly</h5>
												<h6 class="pro-user-desc text-muted fs-12">abigali@gmail.com</h6>
												<div class="mb-3 clearfix">
													<span class="fa fa-star text-warning"></span>
													<span class="fa fa-star text-warning"></span>
													<span class="fa fa-star text-warning"></span>
													<span class="fa fa-star-half-o text-warning"></span>
													<span class="fa fa-star-o text-warning"></span>
												</div>
												<div class="btn-list">
													<a href="#" class="btn btn-primary mt-3">Edit Profile</a>
													
												</div>
											</div>
										</div>
									</div>
									<div class="card-footer p-0">
										<div class="row">
											<div class="col-6 text-center py-5 border-right">
												<h5 class="mb-2">
													<span class="fs-18 text-orange"><i class="fa fa-phone"></i></span>
												</h5>
															<div class="media-body">
																
																<div class="font-weight-semibold">
																	+245 354 654
																</div>
															</div>
												
											</div>
											<div class="col-6  py-5 text-center border-right">
												<h5 class="mb-2">
													<span class="fs-18 text-orange"><i class="fe fe-inbox"></i></span>
												</h5>
												<h5 class="fs-12 mb-0">yourdoamin@gmail.com</h5>
											</div>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-body">
										<h4 class="card-title">Personal Details</h4>
										<div class="table-responsive">
											<table class="table mb-0">
												<tbody>
													<tr>
														<td class="py-2 px-0">
															<span class="font-weight-semibold w-50">Name </span>
														</td>
														<td class="py-2 px-0">Abigali kelly</td>
													</tr>
													<tr>
														<td class="py-2 px-0">
															<span class="font-weight-semibold w-50">Location </span>
														</td>
														<td class="py-2 px-0">USA</td>
													</tr>
													<tr>
														<td class="py-2 px-0">
															<span class="font-weight-semibold w-50">Languages </span>
														</td>
														<td class="py-2 px-0">English, German</td>
													</tr>
													<tr>
														<td class="py-2 px-0">
															<span class="font-weight-semibold w-50">Website </span>
														</td>
														<td class="py-2 px-0">abigali.com</td>
													</tr>
													<tr>
														<td class="py-2 px-0">
															<span class="font-weight-semibold w-50">Email </span>
														</td>
														<td class="py-2 px-0">yourdoamin@gmail.com</td>
													</tr>
													<tr>
														<td class="py-2 px-0">
															<span class="font-weight-semibold w-50">Phone </span>
														</td>
														<td class="py-2 px-0">+125 254 3562s</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-9 col-lg-8 col-md-12">
								<div class="main-content-body main-content-body-profile card mg-b-20">
									<!-- main-profile-body -->
									<div class="main-profile-body">
										<div class="tab-content">
											<div class="tab-pane show active" id="about">
												<div class="card-body">
													
													<h5 class="font-weight-semibold">About us</h5>
													<div class="main-profile-bio mb-0">
														<p>simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy  when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries nchanged.</p>
														<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
														<p class="mb-0">pleasure rationally encounter but because pursue consequences that are extremely painful.occur in which toil and pain can procure him some great pleasure.. <a href="">More</a></p>
													</div>
												</div>
												<div class="card-body border-top">
													<h5 class="font-weight-semibold">Business Information</h5>
													<div class="main-profile-contact-list d-lg-flex">
														<div class="media mr-5">
															
															<div class="media-body">
																<h6 class="font-weight-semibold mb-1">Business Name</h6>
																<span>Address, address2, city, postcode</span>
																<p>+44 03043334</p>
															</div>
														</div>
														<div class="media mr-5">
															<div class="tool-icon bg-danger-transparent text-danger mr-4">
																<i class="fa fa-briefcase"></i>
															</div>
															<div class="media-body">
																<h6 class="font-weight-semibold mb-1">Service Areas</h6>
																<span>Tarneit, 3029, Victoria - 20 KM Radius</span>
																
															</div>
														</div>
													</div>
												</div>
												<div class="card-body border-top">
													<h5 class="font-weight-semibold">Services</h5>
													<a class="btn btn-sm btn-white mt-1" href="#">HTML5</a>
													<a class="btn btn-sm btn-white mt-1" href="#">CSS</a>
													<a class="btn btn-sm btn-white mt-1" href="#">Java Script</a>
													<a class="btn btn-sm btn-white mt-1" href="#">Photo Shop</a>
													<a class="btn btn-sm btn-white mt-1" href="#">Php</a>
													<a class="btn btn-sm btn-white mt-1" href="#">Wordpress</a>
													<a class="btn btn-sm btn-white mt-1" href="#">Sass</a>
													<a class="btn btn-sm btn-white mt-1" href="#">Angular</a>
												</div>
												<div class="card-body border-top">
													<h5 class="font-weight-semibold">Social Media</h5>
													<div class="main-profile-contact-list d-lg-flex">
														<div class="media mr-4">
															<div class="media-icon bg-primary-transparent text-primary mr-3 mt-1">
																<i class="fa fa-phone"></i>
															</div>
															<div class="media-body">
																<small class="text-muted">Mobile</small>
																<div class="font-weight-semibold">
																	+245 354 654
																</div>
															</div>
														</div>
														<div class="media mr-4">
															<div class="media-icon bg-warning-transparent text-warning mr-3 mt-1">
																<i class="fa fa-slack"></i>
															</div>
															<div class="media-body">
																<small class="text-muted">Stack</small>
																<div class="font-weight-semibold">
																	@spruko.com
																</div>
															</div>
														</div>
														<div class="media">
															<div class="media-icon bg-info-transparent text-info mr-3 mt-1">
																<i class="fa fa-map"></i>
															</div>
															<div class="media-body">
																<small class="text-muted">Current Address</small>
																<div class="font-weight-semibold">
																	San Francisco, USA
																</div>
															</div>
														</div>
													</div><!-- main-profile-contact-list -->
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
										
									</div>
								</div>
								
							</div>
											</div>
										</div>
                                    
                                    
										<div class="tab-pane" id="tab5">
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
  