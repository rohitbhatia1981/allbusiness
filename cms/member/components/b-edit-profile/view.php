		

		<!------ Listing Function ------------------->

		

		<?php function showRecordsListing(&$rows) { 

		

		global $component,$database,$pagingObject, $page;

		

		$row=$rows[0];

		

		$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0]; 

		$sqlpermission="select * from tbl_rights_groups where rights_group_id='".$_SESSION['groupid']."' and rights_menu_id='".$menuid['component_id']."'";

			$permissions = $database->get_results( $sqlpermission );

			$permission = $permissions[0];

		?>	
		



<!--Page header-->
<div class="page-header d-lg-flex d-block">
			<div class="page-leftheader">
				<h4 class="page-title"><?php echo pageheading(); ?></h4>
			</div>
			<div class="page-rightheader ml-md-auto">
        <?php if ($_GET['mode']=="edit") { ?>
		<div class=" btn-list">
		<a href="index.php?c=<?php echo $component?>&Cid=<?php echo $menuid['component_headingid']; ?>" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back">
																<i class="fa fa-close"></i>
		</a>
        
		</div>
        <?php } ?>
	</div>
		</div>
		<!--End Page header-->

			<!-- Row -->
          
          <?php if ($_GET['mode']=="edit") { ?>
            
           <div class="row">
							<div class="col-md-12 col-xl-3">
								<div class="card">
									<div class="nav flex-column admisetting-tabs" id="settings-tab" role="tablist" aria-orientation="vertical">
										<a class="nav-link <?php if ($_GET['type']=="") { ?> active <?php } ?>" data-toggle="pill" href="#tab-1" role="tab">
											<i class="nav-icon las la-cog"></i> Company Details
										</a>
										<a class="nav-link <?php if ($_GET['type']=="cp") { ?> active <?php } ?>"  data-toggle="pill" href="#tab-2" role="tab">
											<i class="nav-icon las la-user-circle"></i> Change Password
										</a>
										<!--<a class="nav-link <?php if ($_GET['type']=="ns") { ?> active <?php } ?>"  data-toggle="pill" href="#tab-3" role="tab">
											<i class="nav-icon las la-bell"></i> Notification Settings
										</a>-->
										
									</div>
								</div>
							</div>
							<div class="col-md-12 col-xl-9">
								<div class="tab-content adminsetting-content" id="setting-tabContent">
									<div class="tab-pane fade show <?php if ($_GET['type']=="") { ?> active <?php } ?>" id="tab-1" role="tabpanel">
                                    
                                   <form name="adminForm" id="adminForm" action="?c=<?php echo $component?>&task=saveedit" method="post" class="form-horizontal">
										<div class="card">
											<div class="card-header  border-0">
												<h4 class="card-title">Edit Company Details</h4>
											</div>
                                            
                                             
                                            
											<div class="card-body">
												
												<div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label class="form-label mb-0 mt-2">First Name</label>
														</div>
														<div class="col-md-9">
															<input type="text" name="txtFirstName" class="form-control" placeholder="" value="<?php echo $row['member_firstname']?>" required>
														</div>
													</div>
												</div>
                                                
                                                
                                                
                                                <div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label class="form-label mb-0 mt-2">Last Name</label>
														</div>
														<div class="col-md-9">
															<input type="text" class="form-control" placeholder="" name="txtLastName" value="<?php echo $row['member_lastname']?>" >
														</div>
													</div>
												</div>
                                                
                                                
                                                
												<div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label class="form-label mb-0 mt-2">Email</label>
														</div>
														<div class="col-md-9">
															<input type="text" class="form-control" placeholder="" name="txtEmail" value="<?php echo $row['member_email']?>">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label class="form-label mb-0 mt-2">Phone</label>
														</div>
														<div class="col-md-9">
															<input type="text" class="form-control" placeholder="" name="txtPhone" id="txtPhone" value="<?php echo $row['member_phone']?>">
														</div>
													</div>
												</div>
                                                
                                                <div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label class="form-label mb-0 mt-2">Company / Agency Name</label>
														</div>
														<div class="col-md-9">
															<input type="text" class="form-control" placeholder="" name="txtCompany" id="txtCompany" value="<?php echo $row['member_company']?>">
														</div>
													</div>
												</div>
                                                
                                                <div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label class="form-label mb-0 mt-2">Agency Trading Name</label>
														</div>
														<div class="col-md-9">
															<input type="text" class="form-control" placeholder="" name="txtAgency" id="txtAgency" value="<?php echo $row['member_tradingname']?>">
														</div>
													</div>
												</div>
                                                
                                                <div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label class="form-label mb-0 mt-2">Website</label>
														</div>
														<div class="col-md-9">
															<input type="text" class="form-control" placeholder="" name="txtWebsite" id="txtWebsite" value="<?php echo $row['member_website']?>">
														</div>
													</div>
												</div>
												
												<div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label class="form-label mb-0 mt-2">Address</label>
														</div>
														<div class="col-md-9">
															<input type="text" class="form-control" placeholder="" name="txtAddress" id="txtAddress" value="<?php echo $row['member_address']?>">
														</div>
													</div>
												</div>
                                                
                                                <div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label class="form-label mb-0 mt-2">About Us</label>
														</div>
														<div class="col-md-9">
															<textarea class="form-control" placeholder="" rows="4" name="txtAbout" id="txtAbout" ><?php echo $row['member_aboutus']?></textarea>
														</div>
													</div>
												</div>
                                                
                                                <div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label class="form-label mb-0 mt-2">Speciality</label>
														</div>
														<div class="col-md-9">
															<input type="text" class="form-control" placeholder="" name="txtSpeciality" id="txtSpeciality" value="<?php echo $row['member_speciality']?>">
														</div>
													</div>
												</div>
                                                
                                                 <div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label class="form-label mb-0 mt-2">Location Serviced</label>
														</div>
														<div class="col-md-9">
															<input type="text" class="form-control" placeholder="" name="txtLocations" id="txtLocations" value="<?php echo $row['member_locations']?>">
														</div>
													</div>
												</div>
                                                
                                                <div class="row" style="padding-top:15px">
                                                <div class="col-12">
                                                    <div id="images4ex" orakuploader="on"></div>
                                                </div>
                                            </div>
                                                
												
											</div>
											<div class="card-footer">
                                            	
												<button  class="btn btn-primary mt-4 mb-0">Submit</button>
											</div>
                                           
										</div>
                                     

				<input type="hidden" name="c" value="<?php echo $component?>" />
                
               

			</form>  
                                        
                                        
									</div>
                                    
                                    
									<div class="tab-pane fade <?php if ($_GET['type']=="cp") { ?> show active <?php } ?>" id="tab-2" role="tabpanel">
                                    <form method="post" id="frmChange" onsubmit="return fnChangePassword()" >
										<div class="card">
											<div class="card-header  border-0">
												<h4 class="card-title">Change Password</h4>
											</div>
											<div class="card-body">
												<div class="form-group">
                                                <div id="success-container" style="color:#090"></div>
													<div class="row">
														<div class="col-md-3">
															<label class="form-label mb-0 mt-2">Old Password</label>
														</div>
														<div class="col-md-9">
															<input type="password" id="txtOldPassword" name="txtOldPassword" class="form-control" placeholder="Please enter your existing password" value="">
														</div>
													</div>
												</div>
												
												<div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label class="form-label mb-0 mt-2">New Password</label>
														</div>
														<div class="col-md-9">
															<input type="password" id="txtPassword" name="txtPassword" class="form-control" placeholder="Please enter your new password" value="">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label class="form-label mb-0 mt-2">Confirm Password</label>
														</div>
														<div class="col-md-9">
															<input type="password" id="txtCPassword" name="txtCPassword"  class="form-control" placeholder="Re-enter your password" data-validation-error-msg="Password mismatched" value="">
														</div>
													</div>
												</div>
											</div>
											<div class="card-footer">
                                            
                                            <div id="errorMessage" style="color:#F00; padding-bottom:20px"></div>
                                            
                                            <div class="card-footer">
                                            <button  type="submit" id="submitBtn" name="submitBtn" class="btn btn-primary mt-4 mb-0">
                                            
												Submit
                                             </button>
                                             
                                           
                                            </div>
                                             
                                            
												
											</div>
										</div>
                                        
                                        </form>
									</div>
  <?php 
	 if ($row['member_agency_logo']!="")
	 $pImageStr="'".$row['member_agency_logo']."'"; ?>                                      
	<script language="javascript">
	$(document).ready(function(){
	$('#images4ex').orakuploader({
		orakuploader : true,
		orakuploader_path : 'orakuploader/',

		orakuploader_main_path : '../../images/agencylogo',
		orakuploader_thumbnail_path : '../../images/agencylogo',
		
		orakuploader_use_main : true,
		orakuploader_use_sortable : true,
		orakuploader_use_dragndrop : true,
		
		orakuploader_add_image : 'orakuploader/images/add.png',
		orakuploader_add_label : 'Browser for images',
		
		orakuploader_resize_to	     : 700,
		orakuploader_thumbnail_size  : 700,
		orakuploader_maximum_uploads : 1,
		orakuploader_attach_images: [<?php echo $pImageStr?>],
		
		orakuploader_main_changed    : function (filename) {
			$("#mainlabel-images").remove();
			$("div").find("[filename='" + filename + "']").append("<div id='mainlabel-images' class='maintext'>Main Image</div>");
		}

	});
	
	
});


$("#frmChange").validate({
    rules: {
        txtOldPassword: "required",
        txtPassword: {
            required: true,
            minlength: 6,
            passwordComplexity: true // Custom password complexity validation
        },
        txtCPassword: {
            required: true,
            equalTo: "#txtPassword"
        }
    },
    messages: {
        txtOldPassword: "Please enter your old password",
        txtPassword: {
            required: "Please enter your new password",
            minlength: "Password must be at least 6 characters long",
            passwordComplexity: "Password must contain at least one uppercase letter, one number, and letters"
        },
        txtCPassword: {
            required: "Please confirm your password",
            equalTo: "Passwords do not match"
        }
    },
    submitHandler: function(form) {
        $("#success-container").html("");
        $("#errorMessage").html("");
        $("#submitBtn").html("Please wait...");
        // Serialize the form data
        var formData = $(form).serialize();

        // AJAX call to submit the form data
        $.ajax({
            type: "POST",
            url: "ajax/update-password.php",
            data: formData,
            success: function(response) {
                if (response == 1)
                    $("#success-container").html("Your password is updated now");
                else if (response == 0)
                    $("#errorMessage").html("Your old password is incorrect, please check and try again");

                $("#submitBtn").html("Submit");
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error("Error submitting form: " + error);
            }
        });
    }
});

// Custom method to validate password complexity
$.validator.addMethod("passwordComplexity", function(value, element) {
    return this.optional(element) || /^(?=.*[A-Z])(?=.*\d)(?=.*[a-zA-Z]).{6,}$/.test(value);
}, "Password must contain at least one uppercase letter, one number, and letters");



</script>

                                  
                                   
                                    
                                    
									<div class="tab-pane fade <?php if ($_GET['type']=="ns") { ?> show active <?php } ?>" id="tab-3" role="tabpanel">
										<div class="card">
											<div class="card-header  border-0">
												<h4 class="card-title">Notification Settings</h4>
											</div>
											<div class="card-body">
												<div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label class="form-label">Receive marketing emails</label>
														</div>
														<div class="col-md-9">
															<label class="custom-switch">
																<input type="checkbox" name="custom-switch-checkbox" checked  class="custom-switch-input">
																<span class="custom-switch-indicator"></span>
																<span class="custom-switch-description">Enable/Disable</span>
															</label>
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label class="form-label">Receive blog or educational emails </label>
														</div>
														<div class="col-md-9">
															<label class="custom-switch">
																<input type="checkbox" name="custom-switch-checkbox" checked  class="custom-switch-input">
																<span class="custom-switch-indicator"></span>
																<span class="custom-switch-description">Enable/Disable</span>
															</label>
														</div>
													</div>
												</div>
												
												
												
												
												
											</div>
											<div class="card-footer">
												<a href="#" class="btn btn-success">Save Changes</a>
												<a href="#" class="btn btn-danger">Cancel</a>
											</div>
										</div>
									</div>
									
									
								</div>
							</div>
						</div>
                        
                        <?php } else { ?>
                        
                        <div class="row">
		<div class="col-lg-12 col-md-12">
        
        <div class="">
					<div class="container">
                    
                    
                  

						
						<!--End Page header-->

						<!-- Row -->
						<div class="row">
                        
                        
                        <div class="page-rightheader ml-md-auto">
								<div class="d-flex align-items-end flex-wrap my-auto right-content breadcrumb-right">
									<div class="btn-list" style="padding:10px">
                                    
                                    
                                    <a href="?c=b-edit-profile&mode=edit" class="btn btn-primary">Edit Profile</a>
										
										
									</div>
                                    
								</div>
							</div>
							
							<div class="col-xl-12 col-md-12 col-lg-12">
								<div class="tab-menu-heading hremp-tabs p-0 ">
									<div class="tabs-menu1">
										<!-- Tabs -->
										<!--<ul class="nav panel-tabs">
                                        <li><a href="#tab6" data-toggle="tab"  class="active" >Basic Details</a></li>
											<li ><a href="#tab5" data-toggle="tab">Medical Background</a></li>
											
											
										</ul>-->
									</div>
								</div>
                                
                                
                                
								<div class="panel-body tabs-menu-body hremp-tabs1 p-0">
									<div class="tab-content">
										<div class="tab-pane" id="tab5">
											<div class="card-body">
												<div class="table-responsive">
										No data found!
									</div>
											</div>
										</div>
										<div class="tab-pane active" id="tab6">
											<div class="card-body">
												<div class="table-responsive">
                                                
                                               <div class="table-responsive">
                                              
                                              <p style="font-size:18px; font-weight:bold">Basic Details
                                              </p> 
                                              
                                            
                                            
                                            
                                             
                                             
											<table class="table">
												<tbody>
                                                
                                                <?php 
												if (is_array($medication))
												foreach($medication as $que => $val) { ?>
													
													<tr valign="top" style="border-bottom:1px solid #CCC">
														<td>
															<?php echo base64_decode($que) ?> :
														</td>
														
														<td width="40%" style="color:#03C">
                                                        
                                                        <?php echo base64_decode($val) ?>
															
														</td>
													</tr>
                                                    
                                            <?php } ?>
                                            
                                            
                                            
                                                    
                                                    
                                                    
												</tbody>
											</table>
                                            
                                            
                                             
                                            	<div class="table-responsive">
											<table class="table" style="font-size:16px">
												<tbody>
                                                
                                                
                                                
                                                	<tr>
														<td>
															<span class="w-50">Agency Logo</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold">
															<?php if ($row['member_agency_logo']!="") { ?>
                                                            
                                                            <div style="width: 200px; height: 100px; overflow: hidden; display: flex; align-items: center; justify-content: center; border: 1px solid #ddd; padding: 10px; background: #f9f9f9;">
                                                              <img src="<?php echo URL ?>images/agencylogo/<?php echo $row['member_agency_logo']; ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;" alt="Agency Logo">
                                                            </div>

                                                            
                                                            <?php } ?>
                                                           
                                                            </span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span class="w-50">First Name</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold">
															<?php echo $name=$row['member_firstname'] ?>
                                                           
                                                            </span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Last Name</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold">
															<?php echo $name=$row['member_lastname'] ?>
                                                           
                                                            </span>
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
															<span class="w-50">Phone </span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['member_phone']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Company/Agency Name</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['member_company']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Agency Trading Name</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['member_tradingname']; ?></span>
														</td>
													</tr>
                                                    
                                                    
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Website</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['member_website']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Address</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['member_address']; ?></span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">About Us</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['member_aboutus']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Speciality</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['member_speciality']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Location Serviced </span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $row['member_locations']; ?></span>
														</td>
													</tr>
													
                                                    
												</tbody>
											</table>
										</div>
                                            
										</div>
													
													<!--<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="task-list">
														<thead>
															<tr>
																<th class="border-bottom-0 text-center">No</th>
																<th class="border-bottom-0">Task</th>
																<th class="border-bottom-0">Client</th>
																<th class="border-bottom-0">Assign To</th>
																<th class="border-bottom-0">Priority</th>
																<th class="border-bottom-0">Start Date</th>
																<th class="border-bottom-0">Deadline</th>
																<th class="border-bottom-0">Project Status</th>
																<th class="border-bottom-0">Actions</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td class="text-center">1</td>
																<td>
																	<a href="#" class="d-flex sidebarmodal-collpase">
																		<span>Design Updated</span>
																	</a>
																</td>
																<td>
																	<a href="#" class="font-weight-semibold">Julia Walker</a>
																</td>
																<td>
																	<a href="#" class="d-flex">
																		<span class="avatar avatar brround mr-3" style="background-image: url(../../assets/images/users/4.jpg)"></span>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-1 fs-14">Melanie Coleman</h6>
																		</div>
																	</a>
																</td>
																<td><span class="badge badge-danger-light">High</span></td>
																<td>12-02-2021</td>
																<td>16-06-2021</td>
																<td>
																	<div class="d-flex align-items-end justify-content-between">
																		<h6 class="fs-12">Status</h6>
																		<h6 class="fs-12">62%</h6>
																	</div>
																	<div class="progress h-1">
																		<div class="progress-bar bg-success w-60"></div>
																	</div>
																</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="feather feather-edit-2  text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="text-center">2</td>
																<td>
																	<a href="#" class="d-flex sidebarmodal-collpase">
																		<span>Code Updated</span>
																	</a>
																</td>
																<td>
																	<a href="#" class="font-weight-semibold">Diane Short</a>
																</td>
																<td>
																	<a href="#" class="d-flex">
																		<span class="avatar avatar brround mr-3" style="background-image: url(../../assets/images/users/15.jpg)"></span>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-1 fs-14">Justin Parr</h6>
																		</div>
																	</a>
																</td>
																<td><span class="badge badge-success-light">Low</span></td>
																<td>01-01-2021</td>
																<td>22-04-2021</td>
																<td>
																	<div class="d-flex align-items-end justify-content-between">
																		<h6 class="fs-12">Status</h6>
																		<h6 class="fs-12">45%</h6>
																	</div>
																	<div class="progress h-1">
																		<div class="progress-bar bg-success w-45"></div>
																	</div>
																</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="feather feather-edit-2  text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="text-center">3</td>
																<td>
																	<a href="#" class="d-flex sidebarmodal-collpase">
																		<span>Issues fixed </span>
																	</a>
																</td>
																<td>
																	<a href="#" class="font-weight-semibold">Pippa Welch</a>
																</td>
																<td>
																	<a href="#" class="d-flex">
																		<span class="avatar avatar brround mr-3" style="background-image: url(../../assets/images/users/5.jpg)"></span>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-1 fs-14">Amelia Russell</h6>
																		</div>
																	</a>
																</td>
																<td><span class="badge badge-warning-light">Medium</span></td>
																<td>11-04-2021</td>
																<td>16-06-2021</td>
																<td>
																	<div class="d-flex align-items-end justify-content-between">
																		<h6 class="fs-12">Status</h6>
																		<h6 class="fs-12">53%</h6>
																	</div>
																	<div class="progress h-1">
																		<div class="progress-bar bg-success w-50"></div>
																	</div>
																</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="feather feather-edit-2  text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="text-center">4</td>
																<td>
																	<a href="#" class="d-flex sidebarmodal-collpase">
																		<span>Testing</span>
																	</a>
																</td>
																<td>
																	<a href="#" class="font-weight-semibold">Lisa Vance</a>
																</td>
																<td>
																	<a href="#" class="d-flex">
																		<span class="avatar avatar brround mr-3" style="background-image: url(../../assets/images/users/14.jpg)"></span>
																		<div class="mr-3 mt-0 mt-sm-2 d-block">
																			<h6 class="mb-1 fs-14">Ryan Young</h6>
																		</div>
																	</a>
																</td>
																<td><span class="badge badge-success-light">Low</span></td>
																<td>11-04-2021</td>
																<td>16-06-2021</td>
																<td>
																	<div class="d-flex align-items-end justify-content-between">
																		<h6 class="fs-12">Status</h6>
																		<h6 class="fs-12">67%</h6>
																	</div>
																	<div class="progress h-1">
																		<div class="progress-bar bg-success w-65"></div>
																	</div>
																</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="feather feather-edit-2  text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
														</tbody>
													</table>-->
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab7">
											<div class="card-body">
                                            
                                            No messages yet!
                                            
												<!--<div class="table-responsive">
													<a href="#" class="btn btn-primary btn-tableview">Upload Files</a>
													<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="files-tables">
														<thead>
															<tr>
																<th class="border-bottom-0 text-center w-5">No</th>
																<th class="border-bottom-0">File Name</th>
																<th class="border-bottom-0">Upload By</th>
																<th class="border-bottom-0">Actions</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td class="text-center">1</td>
																<td>
																	<a href="#" class="font-weight-semibold fs-14 mt-5">document.pdf<span class="text-muted ml-2">(23 KB)</span></a>
																	<div class="clearfix"></div>
																	<small class="text-muted">2 hours ago</small>
																</td>
																<td>Client</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="text-center">2</td>
																<td>
																	<a href="#" class="font-weight-semibold fs-14 mt-5">image.jpg<span class="text-muted ml-2">(2.67 KB)</span></a>
																	<div class="clearfix"></div>
																	<small class="text-muted">1 day ago</small>
																</td>
																<td>Admin</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="text-center">3</td>
																<td>
																	<a href="#" class="font-weight-semibold fs-14 mt-5">Project<span class="text-muted ml-2">(578.6MB)</span></a>
																	<div class="clearfix"></div>
																	<small class="text-muted">1 day ago</small>
																</td>
																<td>Team Lead</td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
														</tbody>
													</table>
												</div>-->
											</div>
										</div>
										
										
										<div class="tab-pane" id="tab10">
											<div class="card-body">
                                            
                                            No Payments found!
												<!--<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="invoice-tables">
														<thead>
															<tr>
																<th class="border-bottom-0">InvoiceID</th>
																<th class="border-bottom-0">Amount</th>
																<th class="border-bottom-0">Invoice Date</th>
																<th class="border-bottom-0">Due Date</th>
																<th class="border-bottom-0">Payment</th>
																<th class="border-bottom-0">Status</th>
																<th class="border-bottom-0">Actions</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>
																	<a href="#">INV-0478</a>
																</td>
																<td>$345.00</td>
																<td>12-01-2021</td>
																<td>14-02-2021</td>
																<td>
																	<span class="text-primary">$345.000</span>
																</td>
																<td><span class="badge badge-success-light">Paid</span></td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td>
																	<a href="#">INV-1245</a>
																</td>
																<td>$834.00</td>
																<td>12-01-2021</td>
																<td>14-02-2021</td>
																<td>
																	<span class="text-primary">$834.000</span>
																</td>
																<td><span class="badge badge-danger-light">UnPaid</span></td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td>
																	<a href="#">INV-5280</a>
																</td>
																<td>$16,753.00</td>
																<td>21-01-2021</td>
																<td>15-01-2021</td>
																<td>
																	<span class="text-primary">$16,753.000</span>
																</td>
																<td><span class="badge badge-success-light">Paid</span></td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td>
																	<a href="#">INV-2876</a>
																</td>
																<td>$297.00</td>
																<td>05-02-2021</td>
																<td>21-02-2021</td>
																<td>
																	<span class="text-primary">$297.000</span>
																</td>
																<td><span class="badge badge-success-light">Paid</span></td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
															<tr>
																<td>
																	<a href="#">INV-1986</a>
																</td>
																<td>$12,897.00</td>
																<td>01-01-2021</td>
																<td>24-02-2021</td>
																<td>
																	<span class="text-primary">$12,897.00</span>
																</td>
																<td><span class="badge badge-danger-light">UnPaid</span></td>
																<td>
																	<div class="d-flex">
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather feather-eye  text-primary"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download"><i class="feather feather-download   text-success"></i></a>
																		<a href="#" class="action-btns1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
																	</div>
																</td>
															</tr>
														</tbody>
													</table>-->
											</div>
										</div>
										<div class="tab-pane" id="tab11">
											<div class="card-body">
												No log history yet!
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
	
			<!-- End Row -->
            
            <script language="javascript">

$("#adminForm").validate({
			rules: {
				txtPostcode: "required",
				txtAddress1: "required",
				txtCity: "required"
			},
			messages: {
				txtPostcode: "Postcode cannot be blank",
				txtAddress1: "Address cannot be blank",
				txtCity: "City cannot be blank"
				
				}			
		});

</script>

		</div>
	</div><!-- end app-content-->
</div>
				


             <?php } ?>

	<!-----------End Listing function------------------>

        
  