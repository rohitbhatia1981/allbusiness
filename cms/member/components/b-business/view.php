		

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

<style>
.circle-red {
  width: 40px;
  height: 40px;
  background: red;
  border-radius: 50%
}
    .parent {
        font-weight: bold;
        background-color: #f0f0f0;
    }
    .child {
        padding-left: 10px;
    }

 .radio-label {
            display: inline-block;
            cursor: pointer;
            padding: 8px 15px;
            border-radius: 20px;
            border: 2px solid #4CAF50;
            color: #4CAF50;
            transition: 0.3s;
        }
        input[type="radio"] {
            display: none;
        }
        input[type="radio"]:checked + .radio-label {
            background-color: #4CAF50;
            color: white;
        }
</style>
	
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
                            
                            
                            
                            
							<div class="row" style="padding-top:15px">
                           
                           						<div class="col-md-12 col-lg-12 col-xl-4">
														<div class="form-group">
															<label class="form-label">Search by Keyword:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtSearchByTitle" type="text" value="<?php echo $_GET['txtSearchByTitle']?>" placeholder="Business Name, ID, Seller name, Phone, Email">
															</div>
														</div>
													</div>
                                                 
                                             		  
                                                    
                                                        
                                                 
                           
                           
											
											
											<div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">Filter by Category:</label>
                                                    
                                                  
                                                    
													<?php
// Fetch categories from the database
$sqlCategories = "SELECT * FROM tbl_business_category WHERE bc_status = 1 ORDER BY bc_parent_id, bc_name";
$resCategories = $database->get_results($sqlCategories);

// Function to generate dropdown options recursively
function generateCategoryOptions($categories, $parent_id = 0, $indent = '') {
    $options = '';
    foreach ($categories as $category) {
        if ($category['bc_parent_id'] == $parent_id) {
            // Add the category as an option
			if ($parent_id==0)
			$cssCls='parent';
			else
			$cssCls='child';
			
			if ($category['bc_id']==$_GET['cmbCategory'])
			$selected="selected";
			else
			$selected="";
			
            $options .= '<option value="' . $category['bc_id'] . '" class="'.$cssCls.'" '.$selected.' >' . $indent . $category['bc_name'] . '</option>';
            // Recursively add subcategories
            $options .= generateCategoryOptions($categories, $category['bc_id'], $indent . '&nbsp;&nbsp;');
        }
    }
    return $options;
}

// Generate dropdown options
$dropdownOptions = generateCategoryOptions($resCategories);
?>

<select name="cmbCategory" class="form-control " data-placeholder="All">
    <option label="All"></option>
    <?php echo $dropdownOptions; ?>
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
                                        <?php if ($_GET['payment']==1 && $_SESSION['sessListingId']!="") { ?>
                                        <div class="alert alert-success" role="alert"><button class="close" data-dismiss="alert" aria-hidden="true">Ãƒâ€”</button>
										<i class="fa fa-check-circle-o mr-2" aria-hidden="true"></i> Thank you for making payment, your Listing ID: AB-<?php echo $_SESSION['sessListingId']; ?> is upgraded and Live.</div>
                                        <?php 
											unset($_SESSION['sessListingId']);
										} ?>
                                        
                                        
                                        <h5 style="color:#06C">
											<?php 
												if ($_GET['status']==1) echo 'Active Listings';
												else if ($_GET['status']==2) echo 'Pending Drafts';
												else if ($_GET['status']==3) echo 'Withdrawn';
												else if ($_GET['status']==4) echo 'Sold';
												else if ($_GET['status']==5) echo 'Under Offers';
											
											
											 ?></h5>
								<div class="table-responsive table-lg mt-3">
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
                                            	<th width="10%" height="27" class="border-bottom-0 wd-5" style="width:10%">
												<label class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" name="chkControl" value="yes" onClick="checkAll(this.form,this.checked);" />
														<span class="custom-control-label"></span>
												</label>
												</th>
												<th width="12%" class="border-bottom-0">Ad Image & ID.</th>
                                                <th width="8%" class="border-bottom-0">Title</th> 
                                                <th width="11%" class="border-bottom-0">Status</th>
                                                
                                                <th width="11%" class="border-bottom-0">Searched</th>
                                                <th width="12%" class="border-bottom-0">Viewed</th>
                                                <th width="14%" class="border-bottom-0">Enquiries</th>
                                                <th width="11%" class="border-bottom-0">Contact Views</th>
                                                
												<th width="11%" class="border-bottom-0">Added Date</th>
                                                
                                               
                                                                                               
                                              
                                               
                                               
											</tr>
										</thead>
							<?php

							
					
						
						/*$sqlPres="select * from tbl_prescriptions where pres_patient_id='".$database->filter($_SESSION['sess_patient_id'])."' order by pres_id desc";
						$resPres=$database->get_results($sqlPres);
						$totalRecords=count($resPres);*/
						
						if($totalRecords > 0) 

							{

						
						for ($k=0;$k<$totalRecords;$k++)
						{
							
							$row=&$rows[$k];
						
						?>



									
							<tbody>
								<tr>
                                
                                	<td class="align-middle">
										<label class="custom-control custom-checkbox">
				
										<input name="deletes[]" id="chkDelete" onClick="isChecked(this.checked);" class="custom-control-input" value="<?php echo $row['business_id']; ?>" type="checkbox"  />			
											<span class="custom-control-label"></span>
										</label>
									</td>
									
									
                                    <td class="align-middle" >
                                    
      <?php
		$sqlImages = "select * from tbl_business_images where image_business_id='" . $row['business_id'] . "' limit 0,1"; 
        $getImages = $database->get_results($sqlImages);
        $totalImages = count($getImages);

        if ($totalImages > 0) {
            $rowImages = $getImages[0];
            $imageurl = "";                
            if ($rowImages['image_s3'] == "") 
                $imageurl = URL . "classes/timthumb.php?src=" . URL . "images/business/" . $rowImages['image_local'] . "&w=150&zc=1";
            else 
                $imageurl = $rowImages['image_s3'];  
		}
				?>
                                    
                                    
                                    <img alt="" src="<?php echo $imageurl; ?>" >
                                    <!--<a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['patient_id']; ?>"><?php echo $row['patient_id'] ?></a>-->
                                    <div style="height:10px"></div>
                                    ID: <a href="?c=<?php echo $component?>&task=edit&id=<?php echo $row['business_id']; ?>" style="color:#06F; text-decoration:underline"><?php echo $row['business_id'] ?></a>
                                    <br /><br />
                                    
                                    
                                    <?php  $detailLink = generateBusinessLink($row['business_id']); ?>
                                   
                                   <?php if ($row['business_status']=="current") { ?>
                                    <div style="margin-bottom:8px;"><a href="<?php echo $detailLink; ?>" target="_blank" ><i class="fe fe fe-eye" style="color:#F60"></i>&nbsp;Live Preview</a></div>
                              		<?php } ?>
                                    <div><a href="?c=<?php echo $component?>&task=edit&id=<?php echo $row['business_id']; ?>" ><i class="fe fe fe-edit" style="color:#F60"></i>&nbsp;Edit Ad</a></div>
                                    
                                    
                                   
                                   
										
												
											
									</td>
                                    <td><?php
$fullTitle = fnUpdateHTML($row['business_heading']);
$shortTitle = mb_substr($fullTitle, 0, 45) . (strlen($fullTitle) > 45 ? '...' : '');
?>

<span title="<?php echo htmlspecialchars($fullTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <?php echo htmlspecialchars($shortTitle, ENT_QUOTES, 'UTF-8'); ?>
</span> <br />
                                    
                                    <font style="color:#999"><?php echo getBusinessCategoryName($row['business_category']); ?></font>
                                    <div style="padding-top:10px">
                                    
                                     <?php if ($row['business_plan_id']==1) { ?>
                                    <span class="badge bg-grey-transparent">Basic Ad</span>
                                    <?php } ?>
                                    
                                     <?php if ($row['business_plan_id']==2 ) { ?>
                                    <span class="badge bg-orange-transparent">Advanced Ad</span>
                                    	<?php if ($row['business_plan_expiry_date']!="") { ?> 
                                    		| <font style="font-size:14px">Expiry date: <?php echo fn_GiveMeDateInDisplayFormat($row['business_plan_expiry_date']); ?></font>
                                    	<?php } ?>
                                    <?php } ?>
                                    
                                     <?php if ($row['business_plan_id']==3) { ?>
                                    <span class="badge bg-success-transparent">Premium Ad</span>
                                    <font style="font-size:14px">| Expiry date: <?php echo fn_GiveMeDateInDisplayFormat($row['business_plan_expiry_date']); ?></font>
                                    <?php } ?>
                                    </div>
                                    <br /><br />
                                    <?php if ($row['business_plan_id']<3 && $row['business_status']=="current" ) { ?>
                                    <a href="#" data-toggle="modal" data-target="#newModel" data-id="<?php echo base64_encode($row['business_id'])?>" data-name="Premium" class="btn btn-indigo btn-sm mb-1">Upgrade to Premium</a> &nbsp;&nbsp;
                                    <?php } ?>
                                    
                                    <?php if ($row['business_plan_id']==1 && $row['business_status']=="current") { ?>
                                    
                                     <a href="#" data-toggle="modal" data-target="#newModel" data-id="<?php echo base64_encode($row['business_id'])?>" data-name="Adavnced" class="btn btn-orange btn-sm mb-1">Upgrade to Advanced</a> 
                                    <?php } ?>
                                   <!-- <br />
                                    <font style="color:#999"><?php echo getBusinessCategoryName($row['business_subcat']); ?></font>-->
                                    </td>
                                    <td style="font-weight:bold"><?php if ($row['business_status']=="current") echo "Active"; else echo ucfirst($row['business_status']);  ?></td>
                                    
                                     <td><?php echo $row['business_stats_searched']; ?></td>
                                                <td><?php echo $row['business_stats_viewed']; ?></td>
                                                <td>-</td>
                                                <td><?php echo $row['business_stats_contact_viewed']; ?></td>
                                                
												<td><?php echo  date("d/m/Y",strtotime($row['business_added_date'])); ?></td>
                                               
                                                
                                    
                                    
                                    
                                    
                                    
                                    
                               
                                    
                                    
                                   
                                   
                                    
                                    
                                    
                                    
                                    
                                  
                                    
                                   
                                    
                                   
                                    
                                    
                                    
                                   
                                    
									

									
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
            
            
            <div class="modal fade" id="newModel">                 
    			<div class="modal-dialog modal-lg" role="document">
       			 <div class="modal-content" id="modalContent" style="max-height: 90vh; overflow-y: auto; padding: 20px;"> 
                     
                    
				</div>
			</div>
           	</div>
            
             <script language="javascript">
			
			$(document).ready(function() {
   
				$('#newModel').on('show.bs.modal', function (e) {
				 var dataId = $(e.relatedTarget).data('id');
				 var dataName = $(e.relatedTarget).data('name');
					$.ajax({
						url: 'ajax/upgrade-ad.php',  // Replace with your server-side script
						method: 'GET',
						data: { id: dataId,name: dataName },
						success: function(response) {
						 
							$('#modalContent').html(response);
						},
						error: function() {
						  
							$('#modalContent').html('<p>Error loading content. Please try again later.</p>');
						}
					});
				});
			
				
				$('#newModel').on('hidden.bs.modal', function () {
					$('#modalContent').html('<p>Loading...</p>');
				});
			});
			

			
			</script>
            
                     <style>
    /* For WebKit browsers (Chrome, Safari, Edge) */
    #modalContent::-webkit-scrollbar {
        width: 10px; /* Width of the scrollbar */
    }

    #modalContent::-webkit-scrollbar-track {
        background: #f1f1f1; /* Light grey track */
    }

    #modalContent::-webkit-scrollbar-thumb {
        background: #003366; /* Dark blue thumb */
        border-radius: 5px; /* Rounded corners */
    }

    #modalContent::-webkit-scrollbar-thumb:hover {
        background: #F0F; /* Darker blue on hover */
    }

    /* For Firefox */
    #modalContent {
        scrollbar-width: thin; /* "auto" or "thin" */
        scrollbar-color: #F0F #f1f1f1; /* Dark blue thumb and light grey track */
    }
</style>




             <?php } ?>

	<!-----------End Listing function------------------>

    

        <?php function createFormForPagesHtml(&$rows) {

	$row=array();
	global $component, $database;
	$rowBusiness = &$rows[0];	

	$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";
	$getmenuid = $database->get_results( $sqlmenuid );
	$menuid = $getmenuid[0];

	 ?>
	 
<!--Page header-->
<div class="page-header d-lg-flex d-block">
	<div class="page-leftheader">
	<h4 class="page-title">Business : <?php if ($_GET['task']=="edit") echo 'Edit'; else if ($_GET['task']=="add") echo 'Add'; else if ($_GET['task']=="detail") echo 'Detail'; ?></h4>
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

				
<div class="row" style="padding-top:15px">
							<div class="col-lg-12 col-md-12">
								

				<?php

						if ($_GET['task']=="edit")

						$task="saveedit";

						else

						$task="save";

				?>
  	
    
    
    <form name="adminForm" id="adminForm" action="?c=<?php echo $component?>&task=<?php echo $task;?>" method="post" class="form-horizontal">
   
  <!-- Step Navigation -->
 
  
  <!-- Step 1 Content -->
  <div class="step-content" id="step-1">
   					
    <div class="card mt-4">
      <h4 class="dash-title-three mb-4" style="padding:10px; background-color:#069; color:#FFF">Business Summary</h4>
      <div class="card-body">
      
      <?php if ($_GET['task']=="edit") { ?>
       <div class="row" style="padding-top:15px">
            <div class="col-lg-4">
                <label class="form-label">Ad Status *</label>
                <select class="form-control" name="cmbStatus" id="cmbStatus" required>
                    <option value="" hidden>Select</option>
                    <option value="current" <?php if ($rowBusiness['business_status'] == "current") echo "selected"; ?>>Active</option>
                    <option value="offmarket" <?php if ($rowBusiness['business_status'] == "offmarket") echo "selected"; ?>>Withdrawn</option>
                    <option value="sold" <?php if ($rowBusiness['business_status'] == "sold") echo "selected"; ?>>Sold</option>
                    <option value="underoffer" <?php if ($rowBusiness['business_status'] == "underoffer") echo "selected"; ?>>Under Offer</option>
                    <option value="draft" <?php if ($rowBusiness['business_status'] == "draft") echo "selected"; ?>>Draft</option> 
                   
                </select>
            </div>
         </div>
        <?php } ?>
        <div class="row" style="padding-top:15px">
            <div class="col-12">
                <label class="form-label">Ad Title *</label>
                <input type="text" class="form-control mb-3" name="txtHeading" value="<?php echo $rowBusiness['business_heading']; ?>" required>
            </div>
            
            
         </div>
         
         
         <div class="row row-sm">
    <div class="col-lg-12">
        <label class="form-label">Agents </label>
        <div class="row">
            <!-- First Column (6 items) -->
            <div class="col-md-4">
                <ul class="style-none filter-input" style="list-style: none; padding-left: 0;">
                
                <?php $sqlAgents="select * from tbl_member_agents where agent_agency_id='".$database->filter($_SESSION['sess_member_id'])."' and agent_status=1";
				$resAgents=$database->get_results($sqlAgents);
				
				if (count($resAgents)>0)
				{
					
					$arrAgents=array();
					$arrAgents = explode(',', $rowBusiness['business_agent_id']);
					
					for ($a=0;$a<count($resAgents);$a++)
					{
						
						$rowAgents=$resAgents[$a];
				
				 ?>
                    <li class="mb-2">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" name="rdAgent[]" value="<?php echo $rowAgents['agent_id']; ?>" <?php if (in_array($rowAgents['agent_id'], $arrAgents)) echo "checked"; ?>>
                            <span class="ml-2"><?php echo $rowAgents['agent_name']." ".$rowAgents['agent_lastname']; ?></span>
                        </label>
                    </li>
                
                <?php }
				}?>
                    
                     
                    
                    
                </ul>
            </div>
            
           
            
            
            
        </div>
        <div id="checkbox-error-container"></div>
    </div>
</div>
         
         
         
         <div class="row" style="padding-top:15px">   
            
            <div class="col-12">
                <label class="form-label">Description *</label>
                <textarea class="form-control mb-3" rows="3" name="txtDescription" required><?php echo $rowBusiness['business_description']; ?></textarea>
            </div>
            
            
            
        </div>
        
        <?php 
		$selectedTypes=array();
		$selectedTypes = explode(',', $rowBusiness['business_ad_type']);
		
		
		
		 ?>
        
        <div class="row row-sm">
    <div class="col-lg-12">
        <label class="form-label">Ad Type *</label>
        <div class="row">
            <!-- First Column (6 items) -->
            <div class="col-md-4">
                <ul class="style-none filter-input" style="list-style: none; padding-left: 0;">
                    <li class="mb-2">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" name="rdAdType[]" value="Independent Business" <?php if (in_array("Independent Business", $selectedTypes)) echo "checked"; ?>>
                            <span class="ml-2">Independent Business</span>
                        </label>
                    </li>
                    <li class="mb-2">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" name="rdAdType[]" value="Work from home" <?php if (in_array("Work from home", $selectedTypes)) echo "checked"; ?>>
                            <span class="ml-2">Work from home</span>
                        </label>
                    </li>
                    <li class="mb-2">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" name="rdAdType[]" value="Online" <?php if (in_array("Online", $selectedTypes)) echo "checked"; ?>>
                            <span class="ml-2">Online</span>
                        </label>
                    </li>
                </ul>
            </div>
            
            <!-- Second Column (6 items) -->
            <div class="col-md-3">
                <ul class="style-none filter-input" style="list-style: none; padding-left: 0;">
                    <li class="mb-2">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" name="rdAdType[]" value="Franchise" <?php if (in_array("Franchise", $selectedTypes)) echo "checked"; ?>>
                            <span class="ml-2">Franchise</span>
                        </label>
                    </li>
                    <li class="mb-2">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" name="rdAdType[]" value="Self managed" <?php if (in_array("Self managed", $selectedTypes)) echo "checked"; ?>>
                            <span class="ml-2">Self-managed</span>
                        </label>
                    </li>
                    <li class="mb-2">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" name="rdAdType[]" value="Fully managed" <?php if (in_array("Fully managed", $selectedTypes)) echo "checked"; ?>>
                            <span class="ml-2">Fully-managed</span>
                        </label>
                    </li>
                </ul>
            </div>
            
            <div class="col-lg-4">
            
           
                <label class="form-label"> Realestate *</label>
                <select class="form-control" name="cmbPropertyWithBus" id="cmbPropertyWithBus" required>
                    <option value="">Select</option>
                    <option value="Leasehold" <?php if ($rowBusiness['business_property_included'] == "Leasehold") echo "selected"; ?>>Leasehold</option>
                    <option value="Freehold" <?php if ($rowBusiness['business_property_included'] == "Freehold") echo "selected"; ?>>Freehold</option>
                   
                </select>
            
            
            </div>
        </div>
        <div id="checkbox-error-container"></div>
    </div>
</div>
     
        
     <div class="row" style="padding-top:15px">
     
     	 <div class="col-lg-6">
         
          <div class="row">
         
            <div class="col-lg-6">
            
             <?php 
							 
							    $arrCategory=array();
							 	$categoryIds=$rowBusiness['business_category'];
								if ($categoryIds!="")
								{
									$arrCategory=explode(",",$rowBusiness['business_category']);
								}
								$totalCategory=count($arrCategory);							
								
								
								$arrSubCategory=array();
							 	$subCatIds=$rowBusiness['business_subcat'];
								if ($subCatIds!="")
								{
									$arrSubCategory=explode(",",$rowBusiness['business_subcat']);
								}								
								
								$totalSubCategory=count($arrSubCategory);							 
							 	$sqlCategory="select * from tbl_business_category where bc_parent_id=0 and bc_status=1 order by bc_name asc";
								$resCategory=$database->get_results($sqlCategory);
							 
							 
							  ?>
            
            
                <label class="form-label">Category *</label>
                <select class="form-control" name="cmbCategory[]" id="cmbCategory1" onChange="getSubcategory(this.value,1)" required>
                    <option value="">Select Category</option>
                    <?php foreach ($resCategory as $rowCategory): ?>
                        <option value="<?php echo $rowCategory['bc_id']; ?>" <?php if ($arrCategory[0] == $rowCategory['bc_id']) echo "selected"; ?>>
                            <?php echo $rowCategory['bc_name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-lg-6">
                <label class="form-label">Subcategory</label>
                <div id="showSubcategory1">
                    <select class="form-control" name="cmbSubCategory[]" id="cmbSubCategory1">
                        <option value="">Select Subcategory</option>
                    </select>
                </div>
            </div>
          
          </div>
            
          </div>
            
            
                  
      
        </div>
        
        <div class="row align-items-center mb-3" id="rowCat2" <?php if ($totalCategory < 2) { ?> style="display:none;padding-top:15px" <?php } ?>>
    
     <div class="col-lg-6">
         
          <div class="row" style="padding-top:15px">
         
            <div class="col-lg-6">
    
    	
        <div class="form-group">
            <label for="cmbCategory2">Category 2</label>
            <select class="form-control" name="cmbCategory[]" id="cmbCategory2" onChange="getSubcategory(this.value, 2)" >
                <option value="">Select Category</option>
                <?php 
                $sqlCategory = "select * from tbl_business_category where bc_parent_id=0 and bc_status=1 order by bc_name asc";
                $resCategory = $database->get_results($sqlCategory);
                for ($i = 0; $i < count($resCategory); $i++) {
                    $rowCategory = $resCategory[$i];
                ?>
                    <option value="<?php echo $rowCategory['bc_id']; ?>" <?php if ($arrCategory[1] == $rowCategory['bc_id']) echo "selected"; ?>>
                        <?php echo $rowCategory['bc_name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="cmbSubCategory2">Subcategory 2</label>
            <div id="showSubcategory2">
                <select class="form-control" name="cmbSubCategory[]" id="cmbSubCategory2">
                    <option value="">Select Subcategory</option>
                </select>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>

<div class="row align-items-center mb-3" id="rowCat3" <?php if ($totalCategory < 3) { ?> style="display:none" <?php } ?>>
   <div class="col-lg-6">
   		<div class="row" style="padding-top:15px">
     		<div class="col-lg-6">
        <div class="form-group">
            <label for="cmbCategory3">Category 3</label>
            <select class="form-control" name="cmbCategory[]" id="cmbCategory3" onChange="getSubcategory(this.value, 3)" >
                <option value="">Select Category</option>
                <?php 
                $sqlCategory = "select * from tbl_business_category where bc_parent_id=0 and bc_status=1 order by bc_name asc";
                $resCategory = $database->get_results($sqlCategory);
                for ($i = 0; $i < count($resCategory); $i++) {
                    $rowCategory = $resCategory[$i];
                ?>
                    <option value="<?php echo $rowCategory['bc_id']; ?>" <?php if ($arrCategory[2] == $rowCategory['bc_id']) echo "selected"; ?>>
                        <?php echo $rowCategory['bc_name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="cmbSubCategory3">Subcategory 3</label>
            <div id="showSubcategory3">
                <select class="form-control" name="cmbSubCategory[]" id="cmbSubCategory3">
                    <option value="">Select Subcategory</option>
                </select>
            </div>
        </div>
    </div>
   </div>
 </div>
</div>

<div class="text-end" id="rowAddmore" style="margin-top:10px; margin-bottom:20px;">
    <a href="javascript:;" onClick="showRow()" class="text-primary">Add more +</a>
</div>
        
        
    </div>
    </div>
    
    <div class="card">
 <h4 class="dash-title-three mb-4" style="padding:10px; background-color:#069; color:#FFF">Business Location</h4>
    <div class="card-body pb-2">
   
        <div class="row row-sm">
            <div class="col-lg-5">
                <label class="form-label">Street Address *</label>
                <input class="form-control mb-4" placeholder="Street Address" type="text" value="<?php echo $rowBusiness['business_street']; ?>" name="txtAddress" required>
            </div>

            <?php 
            if ($rowBusiness['business_suburb'] != "" && $rowBusiness['business_state'] != "" && $rowBusiness['business_postcode'] != "")
                $suburb = $rowBusiness['business_suburb'] . ', ' . $rowBusiness['business_state'] . ', ' . $rowBusiness['business_postcode']; 
            ?>
            <div class="col-lg-5">
                <label class="form-label">Suburb *</label>
                <input class="form-control mb-4" placeholder="Enter your suburb" type="text" value="<?php echo $suburb; ?>" name="txtSuburb" id="txtLocation" required>
                <input type="hidden" id="hdLocationId" name="location" value="">
                
                <input type="hidden" id="hdRegion" name="hdRegion" value="">
                <div id="suggesstion-box"></div>
                <div id="showRegion"></div>
            </div>
        </div>

        <div class="row row-sm">
            <div class="col-lg-12">
                <label class="form-label">Address Display *</label>
                <ul class="style-none d-flex flex-wrap filter-input">
                    <li style="margin-top:8px !important">
                    <label class="custom-control custom-radio">
                        <input type="checkbox" name="rdAddressDisp[]" id="rdAddressDisp1" value="1" <?php if ($rowBusiness['business_address_display'] == 1) echo "checked"; ?>>
                        <label style="font-weight:400">Full address</label>
                     </label>
                    </li>
                    <li style="margin-top:8px !important">
                     <label class="custom-control custom-radio">
                        <input type="checkbox" name="rdAddressDisp[]" id="rdAddressDisp2" value="2" <?php if ($rowBusiness['business_address_display'] == 2) echo "checked"; ?>>
                        <label style="font-weight:400">Suburb and state</label>
                     </label>
                    </li>
                    <li style="margin-top:8px !important">
                     <label class="custom-control custom-radio">
                        <input type="checkbox" name="rdAddressDisp[]" id="rdAddressDisp3" value="3" <?php if ($rowBusiness['business_address_display'] == 3) echo "checked"; ?>>
                        <label style="font-weight:400">Suburb, State and Region only </label>
                     </label>
                    </li>
                    <li style="margin-top:8px !important">
                     <label class="custom-control custom-radio">
                        <input type="checkbox" name="rdAddressDisp[]" id="rdAddressDisp4" value="4" <?php if ($rowBusiness['business_address_display'] == 3) echo "checked"; ?>>
                        <label style="font-weight:400">State and Region Only </label>
                     </label>
                    </li>
                </ul>
                <div id="checkbox-error-container"></div>
            </div>
        </div>
   
    </div>
</div>

    <div class="card mt-4">
<h4 class="dash-title-three mb-4" style="padding:10px; background-color:#069; color:#FFF">Vendor Details</h4>
    <div class="card-body">
       
        <div class="row" style="padding-top:15px">
          <div class="col-lg-4">
                <label class="form-label">Name</label>
                <input type="text" class="form-control mb-3" name="txtVendorName" value="<?php echo $rowBusiness['business_vendor_name']; ?>" >
            </div>
          <div class="col-lg-4">
                <label class="form-label">Email</label>
                <input type="email" class="form-control mb-3" name="txtVendorEmail" value="<?php echo $rowBusiness['business_vendor_email']; ?>" >
            </div>
          <div class="col-lg-4">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control mb-3" name="txtVendorPhone" value="<?php echo $rowBusiness['business_vendor_phone']; ?>" >
            </div>
        </div>
    </div>
</div>
    
  
  
  <!-- Step 2 Content -->
  <div class="step-content" >
   
    
    <div class="card mt-4">
    <h4 class="dash-title-three mb-4" style="padding:10px; background-color:#069; color:#FFF">Pricing & Financials</h4>
    <div class="card-body">
        <div class="row">
    <div class="col-md-6">
        <h4><u>Price Details</u></h4>

        <!-- Price -->
        <div class="row pt-3">
            <div class="col-lg-6">
                <label class="form-label">Price (Asking Price)*</label>
                <input type="text" placeholder="" class="form-control" name="txtAskingPrice" value="<?php  echo $rowBusiness['business_asking_price']?>" required>
                
            </div>
            <div class="col-lg-6" style="padding-top:25px">
            
            		<div class="style-none d-flex filter-input pt-2 ps-2" >
                   
                    &nbsp;&nbsp;<label style="font-weight:400"></label>
                </div>
            
            </div>
            
        </div>

        <!-- Price Display -->
        <div class="row pt-3">
            <div class="col-lg-6">
                <label class="form-label">Price Display</label>
                <select class="form-control" name="cmbPriceDisplay" id="cmbPriceDisplay" onchange="showPriceView()">
                    <option value="1" <?php if ($rowBusiness['business_price_display']=="1") echo "selected"; ?>>Display price</option>
                    <option value="2" <?php if ($rowBusiness['business_price_display']=="2") echo "selected"; ?>>Do not display price</option>
                    <option value='3' <?php if ($rowBusiness['business_price_display']=="3") echo "selected"; ?>>Display "price view" instead</option>
                    <option value='4' <?php if ($rowBusiness['business_price_display']=="4") echo "selected"; ?>>POA (don't display price)</option>
                    
                    
                   
                </select>
            </div>
             <div class="col-lg-6">
             
             	<span id="spanPriceVal" style="display:none">
             	<label class="form-label">Price View</label>
                <input type="text" placeholder="" class="form-control" name="txtPriceViewVal" id="txtPriceViewVal" value="<?php  echo $rowBusiness['business_price_value']?>" >
             	</span>
            
             </div>
        </div>

        <!-- Plus Stock & Search Price in two columns -->
        <div class="row pt-3">
            <div class="col-md-6">
                <label class="form-label">Plus stock (SAV - stock at value)</label>
                <input type="text" placeholder="" class="form-control" name="txtPlusStock" value="<?php  echo $rowBusiness['business_plus_stock']?>" >
            </div>
           <div class="col-md-6">
                <label class="form-label">Search Price *</label>
                <div class="input-group">
                    <span class="input-group-text bg-light">$</span>
                    <input type="number" placeholder="" class="form-control" name="txtSearchPrice" value="<?php echo $rowBusiness['business_asking_price']?>" required>
                </div>
			</div>

        </div>
    </div>
</div>

        
        
        
        <div class="row" style="padding-top:45px">
            
            <div class="col-md-6">
                <h4><u>Financials</u></h4> 
                
                <div class="row align-items-end" style="padding-top:15px">
    <div class="col-12">
        <div class="dash-input-wrapper mb-30">
            <label class="form-label d-block mb-2">Period Count </label>
            
               <?php //if ($rowBusiness['business_takings']=="Weekly") echo "checked"; ?>
            <div class="btn-radio-group d-flex flex-wrap">
            
                <input type="radio" id="periodWeekly"  name="cmbPeriodCount" value="Weekly" <?php if ($rowBusiness['business_takings']=="Weekly" || $rowBusiness['business_takings']=="") echo "checked"; ?> required checked="checked" />
                 
                <label class="btn btn-outline-primary" for="periodWeekly">Per Week</label>

                <input type="radio" id="periodMonthly" name="cmbPeriodCount" value="Monthly" <?php if ($rowBusiness['business_takings']=="Monthly" ) echo "checked"; ?> />
                
                <label class="btn btn-outline-primary" for="periodMonthly">Per Month</label>

                <input type="radio" id="periodQuarterly" name="cmbPeriodCount" value="Quarterly" <?php if ($rowBusiness['business_takings']=="Quarterly") echo "checked"; ?> />
                
                <label class="btn btn-outline-primary" for="periodQuarterly">Per Quarter</label>

                <input type="radio" id="periodYearly" name="cmbPeriodCount" value="Annually" <?php if ($rowBusiness['business_takings']=="Annually") echo "checked"; ?>  />              
                <label class="btn btn-outline-primary" for="periodYearly">Per Year</label>
            </div>
        </div>
    </div>
</div>


                
                <div class="row" style="padding-top:30px">
    <!-- Left Column (Financial Inputs) -->
    <div class="col-md-6 pe-3">
        <div class="dash-input-wrapper mb-3">
            <label class="form-label fw-bold">Sales Revenue </label>
            <div class="input-group">
                <input type="number" class="form-control" name="txtSalesRevenue" value="<?php echo $rowBusiness['business_turnover']?>" >
                <span class="input-group-text bg-light"><span id="dispPeriod1">/Week</span></span>
            </div>
        </div>

        <div class="dash-input-wrapper mb-3">
            <label class="form-label fw-bold">Rent </label>
            <div class="input-group">
                <input type="number" class="form-control" name="txtRent" value="<?php echo $rowBusiness['business_rent']?>" >
                <span class="input-group-text bg-light"><span id="dispPeriod2">/Week</span></span>
            </div>
        </div>
    </div>

    <!-- Right Column (Financial Inputs) -->
    <div class="col-md-6 ps-3">
        <div class="dash-input-wrapper mb-3">
            <label class="form-label fw-bold">Expenses </label>
            <div class="input-group">
                <input type="number" class="form-control" name="txtExpenses" value="<?php echo $rowBusiness['business_expenses']?>" >
                <span class="input-group-text bg-light"><span id="dispPeriod3">/Week</span></span>
            </div>
        </div>

        <div class="dash-input-wrapper mb-3">
            <label class="form-label fw-bold">Net Profit </label>
            <div class="input-group">
                <input type="number" class="form-control" name="txtNetProfit" value="<?php echo $rowBusiness['business_takings_value']?>" >
                <span class="input-group-text bg-light"><span id="dispPeriod4">/Week</span></span>
            </div>
        </div>
    </div>
</div>
            
          
            
        </div>
        
        
    </div>
</div>

   <div class="card mt-4">
<h4 class="dash-title-three mb-4" style="padding:10px; background-color:#069; color:#FFF">Photos</h4>
    <div class="card-body">
      
        <div class="row" style="padding-top:15px">
            <div class="col-12">
                <div id="images4ex" orakuploader="on"></div>
            </div>
        </div>
    </div>
</div>

<div class="row row-sm mt-4">
      
      <div class="col-lg-12 text-center">
      
      <?php if ($_GET['task']=="add") { ?>
      <button type="submit"  class="btn btn-outline-primary btn-draft" >Save in Draft</button>
      <?php } ?>
      &nbsp;
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
    
  <div style="height:20px"></div>
    
    
  </div>

  <input type="hidden" name="bid" value="<?php echo base64_encode($rowBusiness['business_id'])?>" />	
</form>

<style>


	.input-error {
		border: 1px solid red !important;
	}


    .btn-radio-group .btn {
        border-radius: 5px;
        margin-right: 8px;
    }
	
	.btn-radio-group .btn:hover {
		  background-color: #0d6efd !important;
        border-radius: 5px;
        margin-right: 8px;
    }
    .btn-radio-group input[type="radio"] {
        display: none;
    }
    .btn-radio-group input[type="radio"]:checked + label {
        background-color: #0d6efd;
        color: #fff !important;
        border-color: #0d6efd;
    }
	
	/* Hide number input arrows for all browsers */
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input[type=number] {
    -moz-appearance: textfield; /* Firefox */
}
</style>

<script>

function showPriceView()
{
	
	
	valP=$("#cmbPriceDisplay").val();
	
	
	if (valP==3)
	$("#spanPriceVal").show();
	else
	$("#spanPriceVal").hide();
	
	
}
<?php if ($rowBusiness['business_price_display']=="3") { ?>
showPriceView();
<?php } ?>

    document.addEventListener("DOMContentLoaded", function () {
        const radios = document.querySelectorAll('input[name="cmbPeriodCount"]');
        const periodSpans = [
            document.getElementById("dispPeriod1"),
            document.getElementById("dispPeriod2"),
            document.getElementById("dispPeriod3"),
            document.getElementById("dispPeriod4")
        ];

        function updatePeriods(value) {
			
            let text = "/Week"; // default fallback

            if (value === "Monthly") text = "/Month";
            else if (value === "Quarterly") text = "/Quarter";
            else if (value === "Annually") text = "/Year";

            periodSpans.forEach(span => {
                span.textContent = text;
            });
        }

        // Initial load (for pre-checked value)
        const selected = document.querySelector('input[name="cmbPeriodCount"]:checked');
        if (selected) {
            updatePeriods(selected.value);
        }

        // Update on change
        radios.forEach(radio => {
            radio.addEventListener("change", function () {
                updatePeriods(this.value);
            });
        });
    });
</script>

    
    <?php
			$pImageStr="";
		$_SESSION['sessImageArr']=array();
		$sqlImages="select * from tbl_business_images where image_business_id='".$database->filter($rowBusiness['business_id'])."'";
		
		$resImages=$database->get_results($sqlImages);
		
		
		
		if (count($resImages)>0)
		{
			$imagesArray=array();
		
			for ($k=0;$k<count($resImages);$k++)
			{
				
				$rowImages=$resImages[$k];
				array_push($imagesArray,"'".$rowImages['image_local']."'");
				array_push($_SESSION['sessImageArr'],$rowImages['image_local']);
				
				
				
				
			}
			
			//print_r ($imagesArray);
			
			 if (count($imagesArray)>0)
			$pImageStr=implode(",",$imagesArray);
			
			
			 
			
			
		}
		
		?>		            
                            	
            
            <script language="javascript">
			
			function addMoreFile(val)
					{
						if (val==1)
						{
						str='<div><input style="margin-top:15px" class="form-control" name="flCert[]" type="file" accept=".pdf,.jpg,.png"></div>';
						$("#cont_addmore_"+val).append(str);
						} 
					}


		
$(document).ready(function(){
	$('#images4ex').orakuploader({
		orakuploader : true,
		orakuploader_path : 'orakuploader/',

		orakuploader_main_path : '../../images/business',
		orakuploader_thumbnail_path : '../../images/business',
		
		orakuploader_use_main : true,
		orakuploader_use_sortable : true,
		orakuploader_use_dragndrop : true,
		
		orakuploader_add_image : 'orakuploader/images/add.png',
		orakuploader_add_label : 'Browser for images',
		
		orakuploader_resize_to	     : 1200,
		orakuploader_thumbnail_size  : 1200,
		orakuploader_maximum_uploads : 10,
		orakuploader_attach_images: [<?php echo $pImageStr?>],
		
		orakuploader_main_changed    : function (filename) {
			$("#mainlabel-images").remove();
			$("div").find("[filename='" + filename + "']").append("<div id='mainlabel-images' class='maintext'>Main Image</div>");
		}

	});
	
	
});





</script>
<script src="<?php echo URL?>js/jquery.validate.js"></script>

 



 <script>
$(document).ready(function () {
    $('input[type="checkbox"][name="rdAddressDisp[]"]').on('change', function () {
        $('input[type="checkbox"][name="rdAddressDisp[]"]').not(this).prop('checked', false);
    });

    $.validator.addMethod("atLeastOneChecked", function (value, element) {
        return $('input[name="rdAddressDisp[]"]:checked').length > 0;
    }, "*");

    var validator = $("#adminForm").validate({
        rules: {
            txtAddress: "required",
            txtSuburb: "required",
            'rdAddressDisp[]': {
                atLeastOneChecked: true
            }
        },
        messages: {
            txtAddress: "",
            txtSuburb: "",
            'rdAddressDisp[]': ""
        },
        errorPlacement: function (error, element) {
            // do nothing â€” suppress error messages
        },
        highlight: function(element) {
            $(element).addClass('input-error'); // highlight with a CSS class
        },
        unhighlight: function(element) {
            $(element).removeClass('input-error'); // remove highlight when valid
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    $(".btn-draft").on("click", function (e) {
        e.preventDefault();
        $("<input>").attr({
            type: "hidden",
            name: "is_draft",
            value: "1"
        }).appendTo("#adminForm");

        validator.resetForm();
        $("#adminForm").off("submit");
        $("#adminForm")[0].submit();
    });
});



		
		/*function putCatVal()
		{
			valC=$("#cmbCategory1").val();			
			$("#cmbCat1").val(valC);			
			$("#category-error-container").html("");
			
			
		}
		function putTakings()
		{
			valC=$("#cmbTakings").val();			
			$("#hdTakings").val(valC);			
			$("#takings-error-container").html("");
		
			
		}
		function putTurnover()
		{
			valC=$("#cmbTurnover").val();			
			$("#hdTurnover").val(valC);			
			$("#turnover-error-container").html("");
		
			
		}*/
		
		function getSubcategory(val,idCont,selval='')
		{
			
		
			$.ajax({
			url: 'ajax/getsubcategory.php', 
			type: 'POST',
			data: { cid: val, selectedValue: selval },
			success: function(response) {
				$("#cmbSubCategory"+idCont).html(response);
			}
			})
			
		}
		
		<?php
		if ($arrCategory[0]!="") { ?>
		selCat1=$("#cmbCategory1").val();
		getSubcategory(selCat1,1,<?php echo $arrSubCategory[0]?>);
		<?php } ?>
		
		<?php
		if ($arrCategory[1]!="") { ?>
		selCat2=$("#cmbCategory2").val();
		getSubcategory(selCat2,2,<?php echo $arrSubCategory[1]?>);
		<?php } ?>
		
		<?php
		if ($arrCategory[2]!="") { ?>
		selCat3=$("#cmbCategory3").val();
		getSubcategory(selCat3,3,<?php echo $arrSubCategory[2]?>);
		<?php } ?>
		
		function showRow() {
			if ($('#rowCat2').is(':hidden')) {
				// If rowCat2 is hidden, display it
				$('#rowCat2').show();
			} else if ($('#rowCat2').is(':visible')) {
				// If rowCat2 is already visible, display rowCat3
				$('#rowCat3').show();
				$("#rowAddmore").hide();
			}
		}
		


$(document).ready(function(){
    $("#txtLocation").keyup(function(){
        $.ajax({
            type: "POST",
            url: "<?php echo URL?>ajax/load-location-post.php",
            data: { keyword: $(this).val() },
            beforeSend: function(){
                // Optionally, you can add a loading indicator here
                // $("#txtLocation").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data){
                $("#suggesstion-box").show();
                $("#suggesstion-box").html(data);
                // Optionally, you can remove the loading indicator here
                // $("#txtLocation").css("background", "#FFF");
            }
        });
    });
});


function selectLocation(val,lid,regName) {

$("#txtLocation").val(val);
$("#hdLocationId").val(lid);
$("#suggesstion-box").hide();

$("#showRegion").html("Region: <strong>"+regName+"</strong>");
$("#hdRegion").val(regName);

}



$('body').click(function() {
$("#suggesstion-box").hide();
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

	

	

	$sqlmenuid = "select * from tbl_components where component_option='".$database->filter($_GET['c'])."'";

			$getmenuid = $database->get_results( $sqlmenuid );

			//print_r($getmenuid);

			$menuid = $getmenuid[0];

	 ?>
	 
<!--Page header-->
<div class="page-header d-lg-flex d-block">
	<div class="page-leftheader">
	<h4 class="page-title">Ad Submitted</h4>
	</div>
	<div class="page-rightheader ml-md-auto">
		<div class=" btn-list">
		<a href="?c=b-business&status=1" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back">
																<i class="fa fa-close"></i>
															</a>
		</div>
	</div>
</div>
<!--End Page header-->	 

				
<div class="row" style="padding-top:15px">
		<div class="col-lg-12 col-md-12">
        
        <div class="main-content">
					<div class="container">
                    
                    
                    <?php
					
						
						
						$row = &$rows[0];
						
						 $detailLink = generateBusinessLink($row['business_id']);
							
					?>

						
						<!--End Page header-->

						<!-- Row -->
						<div class="row" style="padding-top:15px">
							<div class="col-xl-12 col-md-12 col-lg-12">
								<div class="card">
									
									<div class="card-body pt-2 pl-3 pr-3">
										<div class="table-responsive">
											<div class="ad-success-container">
    <div class="ad-success-message">
        <h2>Your Ad has been successfully created!</h2>
        <p>Your advertisement is now live. You can view, edit, or upgrade your ad.
        <p>Ad ID: <strong><?php echo $row['business_id']; ?></strong><br>
        Ad Type: 
        
         <?php if ($row['business_plan_id']==1) { ?>
                                    <strong>Basic Ad</strong>
                                    <?php } ?>
                                    
                                     <?php if ($row['business_plan_id']==2 ) { ?>
                                    <strong>Advanced Ad</strong>
                                    	<?php if ($row['business_plan_expiry_date']!="") { ?> 
                                    		| <font style="font-size:14px">Expiry date: <?php echo fn_GiveMeDateInDisplayFormat($row['business_plan_expiry_date']); ?></font>
                                    	<?php } ?>
                                    <?php } ?>
                                    
                                     <?php if ($row['business_plan_id']==3) { ?>
                                   <strong> Premium Ad</strong>
                                    <font style="font-size:14px">| Expiry date: <?php echo fn_GiveMeDateInDisplayFormat($row['business_plan_expiry_date']); ?></font>
                                    <?php } ?>
                      </div>
        
        </p>
    </div>
  
    <div class="ad-success-buttons">
    
    
        <a href="<?php echo $detailLink?>" target="_blank" class="btn-primary btn-sm mb-1">View Ad</a>
        
        <?php if ($row['business_plan_id']==1) { ?>
        <a href="#" data-toggle="modal" data-target="#newModel" data-id="<?php echo base64_encode($row['business_id'])?>" data-name="Premium" class="btn btn-indigo btn-sm mb-1">Upgrade to Premium</a> 
        <a href="#" data-toggle="modal" data-target="#newModel" data-id="<?php echo base64_encode($row['business_id'])?>" data-name="Adavnced" class="btn btn-orange btn-sm mb-1">Upgrade to Advanced</a>
        <?php } ?>
        <a href="?c=b-business&task=edit&id=<?php echo base64_decode($_GET['id'])?>" class="btn-outline btn-sm mb-1">Edit Ad</a>
    </div>
</div>

<div class="modal fade" id="newModel">                 
    			<div class="modal-dialog modal-lg" role="document">
       			 <div class="modal-content" id="modalContent" style="max-height: 90vh; overflow-y: auto; padding: 20px;"> 
                     
                    
				</div>
			</div>
           	</div>
            
            
            
      



<style>
.ad-success-container {
    max-width: 700px;
    margin: 40px auto;
    padding: 30px;
    background: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.ad-success-message h2 {
    color: #2e7d32;
    margin-bottom: 10px;
}

.ad-success-message p {
    color: #555;
    font-size: 16px;
    margin-bottom: 30px;
}

.ad-success-buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
    flex-wrap: wrap;
}

.ad-success-buttons a {
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-weight: bold;
    transition: all 0.3s ease;
    font-size: 14px;
}

.btn-primary {
    background-color: #1976d2;
    color: #fff;
}

.btn-primary:hover {
    background-color: #125aa2;
}

.btn-secondary {
    background-color: #388e3c;
    color: #fff;
}

.btn-secondary:hover {
    background-color: #2e7d32;
}

.btn-outline {
    background-color: transparent;
    color: #1976d2;
    border: 2px solid #1976d2;
}

.btn-outline:hover {
    background-color: #1976d2;
    color: #fff;
}

/* For WebKit browsers (Chrome, Safari, Edge) */
    #modalContent::-webkit-scrollbar {
        width: 10px; /* Width of the scrollbar */
    }

    #modalContent::-webkit-scrollbar-track {
        background: #f1f1f1; /* Light grey track */
    }

    #modalContent::-webkit-scrollbar-thumb {
        background: #003366; /* Dark blue thumb */
        border-radius: 5px; /* Rounded corners */
    }

    #modalContent::-webkit-scrollbar-thumb:hover {
        background: #F0F; /* Darker blue on hover */
    }

    /* For Firefox */
    #modalContent {
        scrollbar-width: thin; /* "auto" or "thin" */
        scrollbar-color: #F0F #f1f1f1; /* Dark blue thumb and light grey track */
    }

</style>

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

 <script language="javascript">
			
			$(document).ready(function() {
   
				$('#newModel').on('show.bs.modal', function (e) {
				 var dataId = $(e.relatedTarget).data('id');
				 var dataName = $(e.relatedTarget).data('name');
					$.ajax({
						url: 'ajax/upgrade-ad.php',  // Replace with your server-side script
						method: 'GET',
						data: { id: dataId,name: dataName },
						success: function(response) {
						 
							$('#modalContent').html(response);
						},
						error: function() {
						  
							$('#modalContent').html('<p>Error loading content. Please try again later.</p>');
						}
					});
				});
			
				
				$('#newModel').on('hidden.bs.modal', function () {
					$('#modalContent').html('<p>Loading...</p>');
				});
			});
			

			
			</script>

             <?php } ?>
             
 
 <?php function createPageForSubscription(&$rows) {

	$row=array();
	global $component, $database;
	$row = &$rows[0];
	 ?>
     
 <style>
 .price-display {font-weight:bold; font-size:17px}
 .price-check { height:20px; width:17px}
 </style>
	 
<!--Page header-->




<div class="page-header d-lg-flex d-block">
	<div class="page-leftheader">
	<h4 class="page-title">Buy Ad Credits</h4>
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
<?php if ($_GET['cI']=="" && $_GET['paid']=="") { ?>
<form action="?c=<?php echo $_GET['c']?>&task=adorder" method="POST">			
<div class="row">
  <!-- Left Column: Pricing Tables -->
  <div class="col-md-8">

  <h2>Premium Ad</h2>
  <div class="table-responsive mb-5">
    <table class="table card-table table-vcenter text-nowrap table-primary mb-0">
      <thead class="bg-indigo">
        <tr>
          <th style="color:#FFF">Ad Packs</th>
          <th style="color:#FFF">90 Days</th>
          <th style="color:#FFF">180 Days</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1 Premium Ad</td>
          <td class="price-display"><input type="checkbox" class="price-check" name="selected[]" value="premium_1_90|90"> $90</td>
          <td class="price-display"><input type="checkbox" class="price-check" name="selected[]" value="premium_1_180|140"> $140</td>
        </tr>
        <tr>
          <td>5 Premium Ads</td>
          <td class="price-display"><input type="checkbox" class="price-check" name="selected[]" value="premium_5_90|400"> $400</td>
          <td class="price-display"><input type="checkbox" class="price-check" name="selected[]" value="premium_5_180|640"> $640</td>
        </tr>
        <tr>
          <td>10 Premium Ads</td>
          <td class="price-display"><input type="checkbox" class="price-check" name="selected[]" value="premium_10_90|700"> $700</td>
          <td class="price-display"><input type="checkbox" class="price-check" name="selected[]" value="premium_10_180|1120"> $1,120</td>
        </tr>
        <tr>
          <td>30 Premium Ads</td>
          <td class="price-display"><input type="checkbox" class="price-check" name="selected[]" value="premium_30_90|1800"> $1,800</td>
          <td class="price-display"><input type="checkbox" class="price-check" name="selected[]" value="premium_30_180|2880"> $2,880</td>
        </tr>
        <tr>
          <td>50 Premium Ads</td>
          <td class="price-display"><input type="checkbox" class="price-check" name="selected[]" value="premium_50_90|2500"> $2,500</td>
          <td class="price-display"><input type="checkbox" class="price-check" name="selected[]" value="premium_50_180|4000"> $4,000</td>
        </tr>
      </tbody>
    </table>
  </div>

  <h2>Advanced Ad</h2>
  <div class="table-responsive">
    <table class="table card-table table-vcenter text-nowrap table-warning mb-0">
      <thead class="bg-orange">
        <tr>
          <th style="color:#FFF">Ad Packs</th>
          <th style="color:#FFF">90 Days</th>
          <th style="color:#FFF">180 Days</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1 Premium Ad</td>
          <td class="price-display"><input type="checkbox" class="price-check2" name="selected[]" value="advance_1_90|45"> $45</td>
          <td class="price-display"><input type="checkbox" class="price-check2" name="selected[]" value="advance_1_180|70"> $70</td>
        </tr>
        <tr>
          <td>5 Premium Ads</td>
          <td class="price-display"><input type="checkbox" class="price-check2" name="selected[]" value="advance_5_90|200"> $200</td>
          <td class="price-display"><input type="checkbox" class="price-check2" name="selected[]" value="advance_5_180|320"> $320</td>
        </tr>
        <tr>
          <td>10 Premium Ads</td>
          <td class="price-display"><input type="checkbox" class="price-check2" name="selected[]" value="advance_10_90|350"> $350</td>
          <td class="price-display"><input type="checkbox" class="price-check2" name="selected[]" value="advance_10_180|560"> $560</td>
        </tr>
        <tr>
          <td>30 Premium Ads</td>
          <td class="price-display"><input type="checkbox" class="price-check2" name="selected[]" value="advance_30_90|900"> $900</td>
          <td class="price-display"><input type="checkbox" class="price-check2" name="selected[]" value="advance_30_180|1440"> $1440</td>
        </tr>
        <tr>
          <td>50 Premium Ads</td>
          <td class="price-display"><input type="checkbox" class="price-check2" name="selected[]" value="advance_50_90|1250"> $1250</td>
          <td class="price-display"><input type="checkbox" class="price-check2" name="selected[]" value="advance_50_180|2000"> $2000</td>
        </tr>
      </tbody>
    </table>
  </div>

</div>


  <!-- Right Column: Summary -->
  
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Selection Summary</h4>
        <p><strong>Premium Ad Total:</strong> $<span id="total-price">0</span></p>
        <p><strong>Advanced Ad Total:</strong> $<span id="total-price2">0</span></p>
        <hr>
        <p style="font-size:18px; color:#F6591F">Total to Pay: <strong>$<span id="net-total">0</span></strong></p>
        
      
        <button class="btn btn-primary mt-3 w-100" id="submitBtn" disabled="disabled" type="button">Review Your Order</button>

<br /><br />
		<div style="border: 1px solid #ccc; background-color: #f9f9f9; padding: 15px; border-radius: 5px; font-size: 15px; line-height: 1.6;">
  <strong>How ad packs work</strong><br>
  &bull;&nbsp;No upfront payment required<br>
  &bull;&nbsp;No lock-in contract<br>
  &bull;&nbsp;Ad packs do not expire<br>
  &bull;&nbsp;You can add a mix of premium and advanced ad packs to suit your needs.<br><br>

  <strong>Need Help?</strong> Email us at <a href="mailto:sales@allbusiness.com.au">sales@allbusiness.com.au</a>, and we'll assist you with your ad packs.
</div>


      </div>
    </div>
  </div>
</div>

</form>


<!-- Terms and Conditions Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <form id="confirmForm">
        <div class="modal-header">
          <h5 class="modal-title" id="termsModalLabel" style="color:#F30; font-size:22px">Confirm your order</h5>
          <button type="button" class="close" onclick="closeModal_terms()" aria-label="Close">
								<span aria-hidden="true">X</span>
							</button>
        </div>
        <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
        <h4 align="center">You've selected the following ad packs</h4>
        
        <div style="margin:auto;border: 1px solid #e0e0e0; border-radius: 6px; padding: 20px; max-width: 600px;  font-size: 14px; color: #1c1e21;">
  <div style="font-size: 16px; font-weight: bold; margin-bottom: 10px;">Order summary</div>

  <div id="dispPremium" style="display: none; justify-content: space-between; margin-bottom: 4px;">
    <div><span id='dispcountPremium'></span> X Premium Ad</div>
    <div id="totalPremiumAd"></div>
  </div>
  
  
  <div id="dispAdvanced" style="display: none; justify-content: space-between; margin-bottom: 4px;">
    <div><span id='dispcountAdvanced'></span> X Advanced Ad</div>
    <div id="totalAdvancedAd"></div>
  </div>
  
  <div style="color: #6a6a6a; font-size: 13px; margin-bottom: 15px;"></div>

  <hr style="border: none; border-top: 1px solid #e0e0e0; margin: 15px 0;">

  <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
    <div>Subtotal</div>
    <div><span id="subTotal"></span></div>
  </div>
  <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
    <div>GST</div>
    <div><span id="subGST"></span></div>
  </div>

  <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 15px;">
    <div>Total to pay</div>
    <div><span id="netTotal"></span></div>
  </div>
</div>

       <br /><br />
  <div style="padding:20px">
 <div style="padding: 20px; font-family: Arial, sans-serif; font-size: 14px; line-height: 1.6; color: #333;">
  
  <h3 style="margin-bottom: 10px;">Order Agreement</h3>
  <p><strong>By checking the box and clicking "Confirm Order", you acknowledge that:</strong></p>
  
  <ul style="list-style-type: disc; padding-left: 20px; margin-bottom: 20px;">
    <li>You are authorized to place this order on behalf of your organization, forming a binding agreement.</li>
    <li>You have read and understood AllBusiness - Terms and Conditions, including limitations on liability.</li>
    <li>You accept the obligation to pay according to the Advertising Terms.</li>
    <li>You agree to comply with AllBusiness's platform policies and usage guidelines.</li>
  </ul>

  <h4 style="margin-top: 20px;">Payment Method</h4>
  <p>
    An invoice will be sent within <strong>5 business days</strong>, and payment is <strong>due within 14 days</strong> of invoice generation.
    Your ad pack will be available immediately after you click &quot;Confirm Order&quot; below.
  </p>

  <h4 style="margin-top: 20px;">Cancellation</h4>
  <p>
    Once the order is submitted, <strong>it cannot be cancelled</strong>.
  </p>

  <h4 style="margin-top: 20px;">Usage and Activation</h4>
  <p>
    Your ad pack will be activated immediately, and credits will be allotted to your agency account once the order is confirmed.
  </p>

  <h4 style="margin-top: 20px;">Non-Transferability</h4>
  <p>
    Ordered ad packages are <strong>non-transferable</strong> and can only be used by the agency account that placed the order.
  </p>

</div>

     
        </div>
        <div class="modal-footer">
          <div class="form-check me-auto">
            <input class="form-check-input" type="checkbox" id="agreeCheck">
            <label class="form-check-label" for="agreeCheck">I have read and accept the terms and conditions</label>
          </div>
          <button type="submit" id="finalSubmitBtn" class="btn btn-primary" disabled>Confirm order</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script language="javascript">
	function closeModal_terms()
					{
						 $('#termsModal').modal('hide');
					
					}
</script>


 
<?php } else { ?>

<div class="table-responsive mb-5">
    <table class="table card-table table-vcenter text-nowrap table-primary mb-0">
    	<tr><td><h4>Ad Upgraded</h4>Thank you for your recent Ad package purchase! Credits purchased now credited under your account.<br /><br />   	      
    	Your  Order ID is: <strong><?php echo decryptId($_GET['cI']); ?></strong></td></tr>
    
    </table>
</div>


<?php } ?>					
		
				
	</div>
    
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

  $(document).ready(function () {
    function updateTotals() {
    let total1 = 0;
  let total2 = 0;
  let countPremium = 0;
  let countAdvancedAd = 0;

  $('.price-check:checked').each(function () {
    let parts = $(this).val().split('|'); // ["premium_5_90", "400"]
    let meta = parts[0].split('_');       // ["premium", "5", "90"]
    let price = parseFloat(parts[1]);
    let adCount = parseInt(meta[1]);

    total1 += price;
    countPremium += adCount;
  });

  $('.price-check2:checked').each(function () {
    let parts = $(this).val().split('|'); // ["advance_5_180", "320"]
    let meta = parts[0].split('_');       // ["advance", "5", "180"]
    let price = parseFloat(parts[1]);
    let adCount = parseInt(meta[1]);

    total2 += price;
    countAdvancedAd += adCount;
  });

  let netTotal = total1 + total2;

  $('#total-price').text(total1.toLocaleString());
  $('#total-price2').text(total2.toLocaleString());
  $('#net-total').text(netTotal.toLocaleString());

  // Update modal content
  if (total1 != 0) {
    $('#dispPremium').css('display', 'flex');
    $('#dispcountPremium').text(countPremium);
    $('#totalPremiumAd').text("$" + total1.toLocaleString());
  } else {
    $('#dispPremium').css('display', 'none');
  }

  if (total2 != 0) {
    $('#dispAdvanced').css('display', 'flex');
    $('#dispcountAdvanced').text(countAdvancedAd);
    $('#totalAdvancedAd').text("$" + total2.toLocaleString());
  } else {
    $('#dispAdvanced').css('display', 'none');
  }
	  
	  
	  //---------end display settings in modal---
	  
	 if (netTotal > 0) {
    $('#submitBtn').prop('disabled', false);
    
    let gstAmount = (netTotal * 0.10);
    let grandTotal = netTotal + gstAmount;

    $("#subTotal").text("$" + netTotal.toLocaleString());
    $("#subGST").text("$" + gstAmount.toLocaleString());
    $("#netTotal").text("$" + grandTotal.toLocaleString());
	}
	else
	$('#submitBtn').prop('disabled', true);
    }
	
	
	

    $('.price-check, .price-check2').on('change', updateTotals);
  });
  
  
  $(document).ready(function () {
  // Show modal on clicking submitBtn
  $("#submitBtn").on("click", function () {
    $("#termsModal").modal("show");
  });

  // Enable Accept & Submit only when checkbox is checked
  $("#agreeCheck").on("change", function () {
    $("#finalSubmitBtn").prop("disabled", !this.checked);
  });

  // On Accept & Submit inside modal
  $("#confirmForm").on("submit", function (e) {
    e.preventDefault();
    $("#termsModal").modal("hide");
    $("form[action*='task=adorder']")[0].submit(); // Submit original form
  });
});


</script>

    
    


             <?php } ?>
 
 
             
<?php function createPageForPayment(&$rows) {

	$row=array();

	global $component, $database;

	$row = &$rows[0];

	

	 ?>
     


	 
<!--Page header-->
<div class="page-header d-lg-flex d-block">
	<div class="page-leftheader">
	<h4 class="page-title">Subscribe</h4>
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
  <div class="tabs" style="padding-top:50px">
    <button class="tab-btn active" data-tab="90-days" id="btn90">90 Days</button>
    <button class="tab-btn" data-tab="180-days" id="btn180">180 Days</button>
</div>

   <div class="card-body pb-2">
						
<div class="plan_box" id="plan_box">
 	<div class="container">
 		<h3 class="title_h3 text-center">Choose a Plan</h3>
 		<div class="row">
        
        <?php 
		$sqlPlans="select * from tbl_plans_ps where plan_status=1 limit 0,3";
		$resPlans=$database->get_results($sqlPlans);
		
		for ($p=0;$p<count($resPlans);$p++)
		{
			$rowPlans=$resPlans[$p];
		 ?>
         
 			<div class="col-sm-6 col-lg-4" >
            <div class="plan_box_1"  >
 					<h1>$<?php echo $rowPlans['plan_price']; ?></h1>
 					<h5><?php echo $rowPlans['plan_name']; ?></h5>
 					<p><?php echo $rowPlans['plan_short_desc']; ?></p>
 					<?php echo $rowPlans['plan_description']; ?>
         <a href="payment_redirect.php?p=<?php echo $rowPlans['plan_id']?>&l=<?php echo encryptId($_GET['id'])?>"><button class="btn btn-outline-primary" id="checkout-button">Buy Now <i class="fa-light fa-arrow-up-right"></i></button></a>	
 			</div>
 			

 		</div>
        
        <?php } ?>
 	</div>
 </div>
 </div>
 
 <div class="plan_box" id="plan_box2" style="display:none">
 	<div class="container">
 		<h3 class="title_h3 text-center">Choose a Plan</h3>
 		<div class="row">
        
        <?php 
		$sqlPlans="select * from tbl_plans_ps where plan_status=1 limit 3,3";
		$resPlans=$database->get_results($sqlPlans);
		
		for ($p=0;$p<count($resPlans);$p++)
		{
			$rowPlans=$resPlans[$p];
		 ?>
         
 			<div class="col-sm-6 col-lg-4" >
            <div class="plan_box_1"  >
 					<h1>$<?php echo $rowPlans['plan_price']; ?></h1>
 					<h5><?php echo $rowPlans['plan_name']; ?></h5>
 					<p><?php echo $rowPlans['plan_short_desc']; ?></p>
 					<?php echo $rowPlans['plan_description']; ?>
         <a href="payment_redirect.php?p=<?php echo $rowPlans['plan_id']?>&l=<?php echo encryptId($_GET['id'])?>"><button class="btn btn-outline-primary" id="checkout-button">Buy Now <i class="fa-light fa-arrow-up-right"></i></button></a>	
 			</div>
 			

 		</div>
        
        <?php } ?>
 	</div>
 	</div>
 </div>
					
				

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('pk_test_51QXdQWK81eXYN2UMYhA5qtW5pGSf4vduSELNk0G9ngEzDl1fqIeZdIVTUl8Zg5gVkFwA0RHSpbCQVgc1fqPaM49k00zsurjwnq'); // Replace with your Stripe Publishable Key

    document.getElementById('checkout-button').addEventListener('click', function () {
        fetch('create-checkout-session.php', { // URL to your PHP script
            method: 'POST',
        })
        .then(response => response.json())
        .then(session => {
            return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .then(result => {
            if (result.error) {
                alert(result.error.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>

<script>
$(document).ready(function () {
    // On clicking the 90 Days button
    $("#btn90").on("click", function () {
        // Highlight the active tab
        $(".tab-btn").removeClass("active");
        $(this).addClass("active");

        // Show the 90 Days content and hide the 180 Days content
        $("#plan_box").show();
        $("#plan_box2").hide();
    });

    // On clicking the 180 Days button
    $("#btn180").on("click", function () {
        // Highlight the active tab
        $(".tab-btn").removeClass("active");
        $(this).addClass("active");

        // Show the 180 Days content and hide the 90 Days content
        $("#plan_box2").show();
        $("#plan_box").hide();
    });
});
</script>							
				
	</div>
    
    


             <?php } ?>
             
             <?php function createPaynow(&$rows) {

	$row=array();

	global $component, $database;

	$row = &$rows[0];

	

	 ?>
	 
<!--Page header-->
<div class="page-header d-lg-flex d-block">
	<div class="page-leftheader">
	<h4 class="page-title">Pay Now</h4>
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
     
     <style>
	 /* General Form Styling */


</style>
  
   <div class="card-body pb-2">
						
<form action="" method="POST" name="frmCheckout" id="frmCheckout">
               <div class="row">
                   <div class="col-sm-7 left">
                       <h4 class="title_4">Please enter your Debit or Credit Card details for payment</h4>
                       
                       <div id="payment-errors" style="color:#F00;padding-top:40px"></div>
                       <div class="card_info" style="border:1px solid; " >
                       
                       <div class="payment-tab-content" >
                    
                   <div align="center" style="padding-bottom:20px"> <img src="templates/black/assets/images/card-icons.png" style="max-width:200px"></div>
                    
                    <div class="row">

							<div class="col-md-12">
								<div class="card-label">
									<label for="cardNumber">Cardholder Name</label>
									<input type="text" value=""  name="txtCCName" id="txtCCName"  placeholder="" required >
								</div>
							</div>
                            </div>
						
                         
                          <div class="row">
                            <div class="col-md-12">
                                <div class="card-label">
                                    <label for="cardNumber">Card Number</label>
                                    <input type="tel" data-stripe="number" name="txtNumber" id="txtNumber" placeholder="" value="" required>
                                    <img class="card-icon" id="cardTypeIcon" src="" alt="">
                                </div>
                            </div>
                        </div>
                            
                             <div class="row">
                <div class="col-md-6">
                    <div class="card-label">
                        <label for="expiryDate">Expiry Date (MM/YY)</label>
                        <input id="expiryDate" class="form-control" placeholder="MM/YY" value="" name="expiryDate" type="text" required>
                        
                        <input type="hidden" name="txtMM" id="txtMM" value="06" data-stripe="exp_month">
                        <input type="hidden" name="txtYY" id="txtYY" value="28" data-stripe="exp_year">
                        
                        
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-label">
                        <label for="cvv">CVV</label>
                        <input id="cvv" class="form-control" type="text" name="cvv" data-stripe="cvc" value="" maxlength="4" required>
                    </div>
                </div>
            </div>
					</div>
                           
                        
                        </div>
                       
                       
                       <div class="bottom_form">
                        <div class="row">
                            
                         
                          
                            
                            <div class="col-sm-10">
                                <button type="submit" id="submitBtn" class="mt-3 btn btn-primary w100p">Confirm & Pay</button>
                            </div>
                        </div>
                    </div>
                   </div>
                   <div class="col-sm-5">
                       <div class="gray_box">
                           <h4 class="title_4">Order Summary</h4>
                           <ul class="card_list mb-5 mt-4">
                               <li>Total Medication Cost:  <span><?php echo CURRENCY?><?php //echo formatToTens($_SESSION['sessMedicationCost']); ?></span></li>
                               
                                 <?php if (isset($_SESSION['sessDiscountAmt'])) { ?>
                               <li style="color:#066">Discount: <span style="color:#066; font-weight:bold">- <?php echo CURRENCY?><?php //echo formatToTens($_SESSION['sessDiscountAmt']); ?></span></li>
                               <?php } ?>
                              
                               
                               <?php if (isset($_SESSION['sessSameDayCost'])) { ?>
                               <li>Same-day Service: <span><?php echo CURRENCY?><?php echo $_SESSION['sessSameDayCost']; ?></span></li>
                               <?php } ?>
                               <li>Total Medication Cost:  <span><?php echo CURRENCY?><?php //$_SESSION['sessNetTotal']=formatToTens($_SESSION['sessMedicationCost']+$_SESSION['sessSameDayCost']-$_SESSION['sessDiscountAmt']); echo formatToTens($_SESSION['sessNetTotal']); ?></span></li>
                              
                              
                           </ul>
                           
                          
                           
                       </div>
                   </div>
                    
               </div>
               </form>
					
				

							
				
	</div>
    
 
    


 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/3.0.0/jquery.payment.min.js"></script>
<script>
 $(document).ready(function() {
    $('#txtNumber').payment('formatCardNumber');
    $('#cvv').payment('formatCardCVC');

    $('#expiryDate').on('input', function(e) {
        var input = $(this).val().replace(/[^0-9]/g, '');
        var formattedInput = '';

        // Get the current year and calculate the maximum year
        var currentYear = new Date().getFullYear();
        var maxYear = (currentYear + 30) % 100; // Only take the last two digits of the year

        if (input.length === 1 && input > '1') {
            formattedInput = '0' + input + '/';
        } else if (input.length === 1 && input <= '1') {
            formattedInput = input;
        } else if (input.length === 2) {
            var month = parseInt(input);
            if (month > 12) {
                formattedInput = '12/';
            } else {
                formattedInput = input + '/';
            }
        } else if (input.length > 2) {
            var month = input.substring(0, 2);
            var year = input.substring(2, 4);
            if (parseInt(month) > 12) {
                month = '12';
            }
            if (parseInt(year) > maxYear) {
                year = maxYear.toString().padStart(2, '0');
            }
            formattedInput = month + '/' + year;
        } else {
            formattedInput = input;
        }

        $(this).val(formattedInput);
    });
	
	
	//--------Card type script
	
	$('#txtNumber').on('input', function() {
        var cardNumber = $(this).val().replace(/ /g, '');

        // Remove all card type images initially
        $('#visaIcon, #mastercardIcon, #amexIcon, #discoverIcon').hide();

        // Regular expressions for card types
        var cardRegex = {
            visa: /^4[0-9]{12}(?:[0-9]{3})?$/,
            mastercard: /^5[1-5][0-9]{14}$/,
            amex: /^3[47][0-9]{13}$/,
            discover: /^6(?:011|5[0-9]{2})[0-9]{12}$/
        };

        // Check each card type and display corresponding icon
        if (cardRegex.visa.test(cardNumber)) {
            $('#cardTypeIcon').attr('src', $('#visaIcon').attr('src')).show();
        } else if (cardRegex.mastercard.test(cardNumber)) {
            $('#cardTypeIcon').attr('src', $('#mastercardIcon').attr('src')).show();
        } else if (cardRegex.amex.test(cardNumber)) {
            $('#cardTypeIcon').attr('src', $('#amexIcon').attr('src')).show();
        } else if (cardRegex.discover.test(cardNumber)) {
            $('#cardTypeIcon').attr('src', $('#discoverIcon').attr('src')).show();
        }
    });	
	
	
	//--------Putting expiry month and year into hidden inputbox
	
	 $('#expiryDate').on('input', function() {
        var expiryDate = $(this).val();
        var parts = expiryDate.split('/');
        
        if (parts.length === 2) {
            $('#txtMM').val(parts[0]);
            $('#txtYY').val(parts[1]);
        }
    });
	
});

    </script>
 
 <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<!-- TO DO : Place below JS code in js file and include that JS file -->
<script type="text/javascript">

	Stripe.setPublishableKey('<?php echo $pubkey; ?>');
  
	$(function() {
	  var $form = $('#frmCheckout');
	 
	  $form.submit(function(event) {
		  
		
		 
		 
	//if ($("#txtPhone").val()=="" || $("#txtFirstName").val()=="" || $("#txtLastName").val()==""  || $("#cmbCity").val()=="" ||  $("#txtAddress").val()=="" ||  $("#txtEmail").val()=="" ||  $("#txtPostCode").val()=="")   
	//return false;
		  
		 
		
		// Disable the submit button to prevent repeated clicks:
		$form.find('#submitBtn').prop('disabled', true);
		
		 $("#submitBtn").attr('disabled','disabled');
		 $("#submitBtn").html("Please wait..");
	
		// Request a token from Stripe:
		Stripe.card.createToken($form, stripeResponseHandler);
	
		// Prevent the form from being submitted:
		return false;
	  });
	});

	function stripeResponseHandler(status, response) {
	  // Grab the form:
	   
	 
	  var $form = $('#frmCheckout');
	
	  if (response.error) { // Problem!
	 //alert (response.error.message);
		// Show the errors on the form:
		$('#payment-errors').html(response.error.message);
		$form.find('#submitBtn').prop('disabled', false); // Re-enable submission
		$("#submitBtn").html("Confirm & Pay");
	
	  } else { // Token was created!
	
		// Get the token ID:
		var token = response.id;

		// Insert the token ID into the form so it gets submitted to the server:
		$form.append($('<input type="hidden" name="stripeToken">').val(token));
	
		// Submit the form:
		$form.get(0).submit();
	  }
	};
	
	
</script>	


             <?php } ?>
  