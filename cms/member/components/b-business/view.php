		

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
                                        <div class="alert alert-success" role="alert"><button class="close" data-dismiss="alert" aria-hidden="true">×</button>
										<i class="fa fa-check-circle-o mr-2" aria-hidden="true"></i> Thank you for making payment, your Listing ID: AB-<?php echo $_SESSION['sessListingId']; ?> is upgraded and Live.</div>
                                        <?php 
											unset($_SESSION['sessListingId']);
										} ?>
								<div class="table-responsive table-lg mt-3">
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
                                            	<th width="9%" height="27" class="border-bottom-0 wd-5" style="width:10%">
												<label class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" name="chkControl" value="yes" onClick="checkAll(this.form,this.checked);" />
														<span class="custom-control-label"></span>
												</label>
												</th>
												<th width="4%" class="border-bottom-0">Ad Image & ID.</th>
                                                <th width="3%" class="border-bottom-0">Title</th> 
                                                
                                                <th width="8%" class="border-bottom-0">Searched</th>
                                                <th width="9%" class="border-bottom-0">Viewed</th>
                                                <th width="13%" class="border-bottom-0">Enquiries</th>
                                                <th width="9%" class="border-bottom-0">Contact Views</th>
                                                
												<th width="4%" class="border-bottom-0">Added Date</th>
                                                <th width="5%" class="border-bottom-0">Last Bumped Up</th>
                                                <th width="4%" class="border-bottom-0">Expires</th>
                                                                                               
                                              
                                               
                                               
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
                                    <br />
                                    ID: <a href="?c=<?php echo $component?>&task=edit&id=<?php echo $row['business_id']; ?>" style="color:#06F; text-decoration:underline">AB-<?php echo $row['business_id'] ?></a>
                                    
                                   
                                   
										
												
											
									</td>
                                    <td><?php
$fullTitle = fnUpdateHTML($row['business_heading']);
$shortTitle = mb_substr($fullTitle, 0, 45) . (strlen($fullTitle) > 45 ? '...' : '');
?>

<span title="<?php echo htmlspecialchars($fullTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <?php echo htmlspecialchars($shortTitle, ENT_QUOTES, 'UTF-8'); ?>
</span> <br />
                                    
                                    <font style="color:#999"><?php echo getBusinessCategoryName($row['business_category']); ?></font>
                                    <br /><br />
                                    <a href="#" class="btn btn-orange btn-sm mb-1">Live Preview</a> &nbsp;&nbsp; <a href="?c=<?php echo $component?>&task=upgrade&id=<?php echo $row['business_id']; ?>" class="btn btn-indigo btn-sm mb-1">Upgrade Ad</a> 
                                   <!-- <br />
                                    <font style="color:#999"><?php echo getBusinessCategoryName($row['business_subcat']); ?></font>-->
                                    </td>
                                    
                                     <td><?php echo $row['business_stats_searched']; ?></td>
                                                <td><?php echo $row['business_stats_viewed']; ?></th>
                                                <td>-</th>
                                                <td><?php echo $row['business_stats_contact_viewed']; ?></th>
                                                
												<td><?php echo  date("d/m/Y",strtotime($row['business_added_date'])); ?></th>
                                                <td>-</th>
                                                <td>-</th>
                                    
                                    
                                    
                                    
                                    
                                    
                               
                                    
                                    
                                   
                                   
                                    
                                    
                                    
                                    
                                    
                                  
                                    
                                   
                                    
                                   
                                    
                                    
                                     <?php
									$overallRisk=$rowPres['pres_overall_risk'];
									if ($overallRisk==1) { $btnClr="green"; }
									else if ($overallRisk==2) { $btnClr="orange";  }
									else if ($overallRisk==3) { $btnClr="red";  }
									?>
                                   
                                    
									

									
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
                <div id="suggesstion-box"></div>
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
                        <label style="font-weight:400">State</label>
                     </label>
                    </li>
                </ul>
                <div id="checkbox-error-container"></div>
            </div>
        </div>
    </div>
</div>

   <div class="card">
   <h4 class="dash-title-three mb-4" style="padding:10px; background-color:#069; color:#FFF">Business Details</h4>
    <div class="card-body">
    
        
        <div class="row" style="padding-top:15px">
            <div class="col-lg-5">
                <label class="form-label">Business Name *</label>
                <input type="text" class="form-control mb-2" name="txtBusinessName" value="<?php echo $rowBusiness['business_name']?>" required>
                
            </div>
            <div class="col-lg-5">
                <label class="form-label">ABN</label>
                <input type="text" class="form-control mb-2" name="txtABN" value="<?php echo $rowBusiness['business_abn']?>">
                
            </div>
        </div>

        <div class="row" style="padding-top:15px">
            <div class="col-lg-5">
            
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
            <div class="col-lg-5">
                <label class="form-label">Subcategory</label>
                <div id="showSubcategory1">
                    <select class="form-control" name="cmbSubCategory[]" id="cmbSubCategory1">
                        <option value="">Select Subcategory</option>
                    </select>
                </div>
            </div>
        </div>

      
      
      <div class="row align-items-center mb-3" id="rowCat2" <?php if ($totalCategory < 2) { ?> style="display:none;padding-top:15px" <?php } ?>>
    <div class="col-md-5">
        <div class="form-group">
            <label for="cmbCategory2">Category 2</label>
            <select class="form-control" name="cmbCategory[]" id="cmbCategory2" onChange="getSubcategory(this.value, 2)" required>
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
    <div class="col-md-5">
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

<div class="row align-items-center mb-3" id="rowCat3" <?php if ($totalCategory < 3) { ?> style="display:none" <?php } ?>>
    <div class="col-md-5">
        <div class="form-group">
            <label for="cmbCategory3">Category 3</label>
            <select class="form-control" name="cmbCategory[]" id="cmbCategory3" onChange="getSubcategory(this.value, 3)" required>
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
    <div class="col-md-5">
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

<div class="text-end" id="rowAddmore" style="margin-top:10px; margin-bottom:20px;">
    <a href="javascript:;" onClick="showRow()" class="text-primary">Add more +</a>
</div>


        <div class="row" style="padding-top:15px">
            <div class="col-lg-5">
                <label class="form-label">Is the property sold with the business (Freehold) or leased ?*</label>
                <select class="form-control" name="cmbPropertyWithBus" id="cmbPropertyWithBus" required>
                    <option value="">Select</option>
                    <option value="Leasehold" <?php if ($rowBusiness['business_property_included'] == "Leasehold") echo "selected"; ?>>Leasehold</option>
                    <option value="Freehold" <?php if ($rowBusiness['business_property_included'] == "Freehold") echo "selected"; ?>>Freehold</option>
                    <option value="N/A" <?php if ($rowBusiness['business_property_included'] == "N/A") echo "selected"; ?>>N/A</option>
                </select>
            </div>
            <div class="col-lg-5">
                <div class="row" >
                    <div class="col-lg-6">
                        <label class="form-label">Lease Amount</label>
                        <input type="text" class="form-control mb-2" name="txtLeaseAmount" value="<?php echo $rowBusiness['business_lease_amount']; ?>">
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Period</label>
                        <select class="form-control" name="cmbLeaseAmountPeriod">
                            <option value="">Select</option>
                            <option value="Weekly" <?php if ($rowBusiness['business_lease_amount_period'] == "Weekly") echo "selected"; ?>>Weekly</option>
                            <option value="Monthly" <?php if ($rowBusiness['business_lease_amount_period'] == "Monthly") echo "selected"; ?>>Monthly</option>
                            <option value="Annually" <?php if ($rowBusiness['business_lease_amount_period'] == "Annually") echo "selected"; ?>>Annually</option>
                        </select>
                    </div>
                    
                    
                </div>     
                
            </div>
            
            
        </div>
        
        
        <div class="row" style="padding-top:15px">
            <div class="col-lg-5">
                <label class="form-label">Current lease ends</label>
               <input type="date" placeholder="" class="form-control" name="txtLeaseEnd" value="<?php echo $rowBusiness['business_lease_end']?>">
            </div>
            <div class="col-lg-5">
                
                        <label class="form-label">Further options</label>
                        <input type="text" class="form-control" placeholder="" name="txtFurther" value="<?php echo $rowBusiness['business_further_option']?>">
                      
                
            </div>
            
            
        </div>
        
        <div class="row" style="padding-top:15px">
            <div class="col-lg-5">
                <label class="form-label">Terms*</label>
                <input type="text" placeholder="" class="form-control" name="txtTerms" value="<?php echo $rowBusiness['business_terms']?>">
          </div>
            <div class="col-lg-5">
                <label class="form-label">Building area*</label>
                <input type="text" class="form-control" placeholder="" name="txtBuilding" value="<?php echo $rowBusiness['business_building_area']?>">
          </div>
            
            
        </div>
        
        <div class="row" style="padding-top:15px">
            <div class="col-lg-5">
                <label class="form-label">Is this a Franchisee business? *</label>
                <select class="form-control" name="cmbFranchisee" id="cmbFranchisee" required>
									<option value="">Select</option>
                                    
                                    <option value="Yes" <?php if ($rowBusiness['business_franchise']=="Yes") echo "selected"; ?>>Yes</option>
                                    <option value="No" <?php if ($rowBusiness['business_franchise']=="No") echo "selected"; ?>>No</option>
                                   
                                  
								</select>
            </div>
            <div class="col-lg-5">
                
                        <label class="form-label">Management Type *</label>
                        
                        <select class="form-control" name="cmbManageType" id="cmbManageType" required>
									<option value="">Select</option>
                                    
                                    <option value="Self managed" <?php if ($rowBusiness['business_manage_type']=="Self managed") echo "selected"; ?>>Self Managed</option>
                                    <option value="Fully Managed Investment" <?php if ($rowBusiness['business_manage_type']=="Fully Managed Investment") echo "selected"; ?>>Fully Managed Investment</option>
                                   
                                  
								</select>
                      
                
            </div>
            
            
        </div>
        

        <!-- Continue similar updates for remaining fields -->
    </div>
</div>

<div class="card mt-4">
<h4 class="dash-title-three mb-4" style="padding:10px; background-color:#069; color:#FFF">Financials</h4>
    <div class="card-body">
       
        <div class="row" style="padding-top:15px">
            <div class="col-5">
                <label class="form-label">Asking price (price view)? *</label>
                <input type="text" placeholder="" class="form-control" name="txtAskingPrice" value="<?php echo $rowBusiness['business_asking_price']?>" required>
                  <div class="style-none d-flex  filter-input" style="padding-left:10px; padding-top:10px; ">
                                       
                                            <input type="checkbox"  value="1" style="height:20px !important" name="ckPlusSav" <?php if ($rowBusiness['business_plus_sav']==1) echo "checked"; ?>>
                                            &nbsp;&nbsp;<label style="font-weight:400">Plus Sav?</label>
                                       
                               		  </div>
            </div>
            <div class="col-5">
                <label class="form-label">Tax *</label>
                <select class="form-control" name="cmbTax" id="cmbTax">
									<option value="">Select Tax</option>
                                    
                                    <option value="Unknown" <?php if ($rowBusiness['business_tax']=="Unknown") echo "selected"; ?>>Unknown</option>
                                    <option value="Exempt" <?php if ($rowBusiness['business_tax']=="Exempt") echo "selected"; ?>>Exempt</option>
                                    <option value="Inclusive" <?php if ($rowBusiness['business_tax']=="Inclusive") echo "selected"; ?>>Inclusive</option>
                                    <option value="Exclusive" <?php if ($rowBusiness['business_tax']=="Exclusive") echo "selected"; ?>>Exclusive</option>
                                  
								</select>
            </div>
        </div>
        
        <div class="row align-items-end" style="padding-top:15px">
                        
                        <div class="col-md-3">
                            <div class="dash-input-wrapper mb-30">
                                <label class="form-label">Takings *</label>
                                
                                <input type="text" class="form-control" placeholder="" name="txtTakingsValue" value="<?php echo $rowBusiness['business_takings_value']; ?>" required>
                                
                               
                                 
                               
                                
                            </div>
                            
                           
                        </div>
                        
                        <div class="col-md-2">
                            <div class="dash-input-wrapper mb-30">
                                <label class="form-label"></label>
                                
                                <select class="form-control" name="cmbTakings" id="cmbTakings"  required>
									<option value="">Select</option>
                                    
                                    <option value="Weekly" <?php if ($rowBusiness['business_takings']=="Weekly") echo "selected"; ?>>Weekly</option>
                                    <option value="Monthly" <?php if ($rowBusiness['business_takings']=="Monthly") echo "selected"; ?>>Monthly </option>
                                    <option value="Annually" <?php if ($rowBusiness['business_takings']=="Annually") echo "selected"; ?>>Annually</option>
                                    
                                  
								</select>
                                
                               
                                 
                              
                                
                            </div>
                            
                           
                        </div>
                        
                        
                        <div class="col-md-5">
                            <div class="dash-input-wrapper mb-30">
                                <label for="">Turnover (annual sales) *</label>
                                <select name="cmbTurnover" id="cmbTurnover" class="form-control" required>
                                <option value="">Select</option>
                                <option value="under_50000" <?php if ($rowBusiness['business_turnover']=="under_50000") echo "selected"; ?>>Under $50,000</option>
                                <option value="50k_100k" <?php if ($rowBusiness['business_turnover']=="50k_100k") echo "selected"; ?>>$50k - $100k</option>
                                <option value="100k_200k" <?php if ($rowBusiness['business_turnover']=="100k_200k") echo "selected"; ?>>$100k - $200k</option>
                                <option value="200k_300k" <?php if ($rowBusiness['business_turnover']=="200k_300k") echo "selected"; ?>>$200k - $300k</option>
                                <option value="300k_500k" <?php if ($rowBusiness['business_turnover']=="300k_500k") echo "selected"; ?>>$300k - $500k</option>
                                <option value="500k_750k" <?php if ($rowBusiness['business_turnover']=="500k_750k") echo "selected"; ?>>$500k - $750k</option>
                                <option value="750k_1m" <?php if ($rowBusiness['business_turnover']=="750k_1m") echo "selected"; ?>>$750k - $1m</option>
                                <option value="1m_1.5m" <?php if ($rowBusiness['business_turnover']=="1m_1.5m") echo "selected"; ?>>$1m - $1.5m</option>
                                <option value="1.5m_2m" <?php if ($rowBusiness['business_turnover']=="1.5m_2m") echo "selected"; ?>>$1.5m - $2m</option>
                                <option value="2m_3m" <?php if ($rowBusiness['business_turnover']=="2m_3m") echo "selected"; ?>>$2m - $3m</option>
                                <option value="3m_4m" <?php if ($rowBusiness['business_turnover']=="3m_4m") echo "selected"; ?>>$3m - $4m</option>
                                <option value="4m_5m" <?php if ($rowBusiness['business_turnover']=="4m_5m") echo "selected"; ?>>$4m - $5m</option>
                                <option value="over_5m" <?php if ($rowBusiness['business_turnover']=="over_5m") echo "selected"; ?>>Over $5m</option>
                                <option value="undisclosed" <?php if ($rowBusiness['business_turnover']=="undisclosed") echo "selected"; ?>>Undisclosed</option>
								</select>

                               
                                 
                               <div id="turnover-error-container"></div>    
                                 
                                
                            </div>
                            
                           
                        </div>
                       
                       
                        
                        
                  
				</div>
        
        <div class="row" style="padding-top:15px">
                        <div class="col-md-5">
                            <div class="dash-input-wrapper mb-30">
                                <label class="form-label">Net profit</label>
                                <select name="txtNetProfit" id="txtNetProfit" class="form-control">
                                    <option value="">Select</option>
                                    <option value="0_5k" <?php if ($rowBusiness['business_net_profit']=="0_5k") echo "selected"; ?>>$0 - $5k</option>
                                    <option value="5k_10k" <?php if ($rowBusiness['business_net_profit']=="5k_10k") echo "selected"; ?>>$5k - $10k</option>
                                    <option value="10k_50k" <?php if ($rowBusiness['business_net_profit']=="10k_50k") echo "selected"; ?>>$10k - $50k</option>
                                    <option value="50k_100k" <?php if ($rowBusiness['business_net_profit']=="50k_100k") echo "selected"; ?>>$50k - $100k</option>
                                    <option value="100k_150k" <?php if ($rowBusiness['business_net_profit']=="100k_150k") echo "selected"; ?>>$100k - $150k</option>
                                    <option value="150k_200k" <?php if ($rowBusiness['business_net_profit']=="150k_200k") echo "selected"; ?>>$150k - $200k</option>
                                    <option value="200k_250k" <?php if ($rowBusiness['business_net_profit']=="200k_250k") echo "selected"; ?>>$200k - $250k</option>
                                    <option value="250k_300k" <?php if ($rowBusiness['business_net_profit']=="250k_300k") echo "selected"; ?>>$250k - $300k</option>
                                    <option value="300k_400k" <?php if ($rowBusiness['business_net_profit']=="300k_400k") echo "selected"; ?>>$300k - $400k</option>
                                    <option value="400k_500k" <?php if ($rowBusiness['business_net_profit']=="400k_500k") echo "selected"; ?>>$400k - $500k</option>
                                    <option value="500k_600k" <?php if ($rowBusiness['business_net_profit']=="500k_600k") echo "selected"; ?>>$500k - $600k</option>
                                    <option value="600k_700k" <?php if ($rowBusiness['business_net_profit']=="600k_700k") echo "selected"; ?>>$600k - $700k</option>
                                    <option value="700k_800k" <?php if ($rowBusiness['business_net_profit']=="700k_800k") echo "selected"; ?>>$700k - $800k</option>
                                    <option value="800k_900k" <?php if ($rowBusiness['business_net_profit']=="800k_900k") echo "selected"; ?>>$800k - $900k</option>
                                    <option value="900k_1m" <?php if ($rowBusiness['business_net_profit']=="900k_1m") echo "selected"; ?>>$900k - $1m</option>
                                    <option value="1m_1.5m" <?php if ($rowBusiness['business_net_profit']=="1m_1") echo "selected"; ?>>$1m - $1.5m</option>
                                    <option value="1.5m_2m" <?php if ($rowBusiness['business_net_profit']=="5m_2m") echo "selected"; ?>>$1.5m - $2m</option>
                                    <option value="2m_3m" <?php if ($rowBusiness['business_net_profit']=="2m_3m") echo "selected"; ?>>$2m - $3m</option>
                                    <option value="over_3m" <?php if ($rowBusiness['business_net_profit']=="over_3m") echo "selected"; ?>>Over $3m</option>
                                    <option value="undisclosed" <?php if ($rowBusiness['business_net_profit']=="undisclosed") echo "selected"; ?>>Undisclosed</option>
								</select>


                                 
                                 
                                
                            </div>
                            
                           
                        </div>
                      </div>
        
        
        
    </div>
</div>

<div class="card mt-4">
<h4 class="dash-title-three mb-4" style="padding:10px; background-color:#069; color:#FFF">Description</h4>
    <div class="card-body">
       
        <div class="row" style="padding-top:15px">
            <div class="col-12">
                <label class="form-label">Heading *</label>
                <input type="text" class="form-control mb-3" name="txtHeading" value="<?php echo $rowBusiness['business_heading']; ?>" required>
            </div>
            <div class="col-12">
                <label class="form-label">Description *</label>
                <textarea class="form-control mb-3" rows="6" name="txtDescription" required><?php echo $rowBusiness['business_description']; ?></textarea>
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
                             
                                
                                
                              
                                
                                
                                   
                                
                                
                             
                                
                                	
                   				</div>
                                
                            
                <div class="row row-sm">
					<div class="col-lg">
					<button  class="btn btn-primary mt-4 mb-0">Submit</button>	
					</div>
					</div>	

		<input type="hidden" name="bid" value="<?php echo base64_encode($rowBusiness['business_id'])?>" />	

	</form>	
    
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
        $(document).ready(function() {
            $('input[type="checkbox"][name="rdAddressDisp"]').on('change', function() {
                $('input[type="checkbox"][name="rdAddressDisp"]').not(this).prop('checked', false);
            });
			
			
			 
    </script>
 



  <script>
       $(document).ready(function() {
    $('input[type="checkbox"][name="rdAddressDisp[]"]').on('change', function() {
        $('input[type="checkbox"][name="rdAddressDisp[]"]').not(this).prop('checked', false);
    });

    $.validator.addMethod("atLeastOneChecked", function(value, element) {
        return $('input[name="rdAddressDisp[]"]:checked').length > 0;
    }, "*");

    $("#adminForm").validate({
        rules: {
            txtAddress: "required",
            txtSuburb: "required",
            'rdAddressDisp[]': {
                atLeastOneChecked: true
            }
        },
        messages: {
            txtAddress: "This field is required.",
            txtSuburb: "This field is required.",
            'rdAddressDisp[]': {
                atLeastOneChecked: "Please select at least one option."
            }
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "rdAddressDisp[]") {
                error.appendTo("#checkbox-error-container");
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            // Directly submit the form
            form.submit();
        }
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
            url: "<?php echo URL?>ajax/load-location.php",
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


function selectLocation(val,lid) {

$("#txtLocation").val(val);
$("#hdLocationId").val(lid);
$("#suggesstion-box").hide();

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
	<h4 class="page-title">Order Details</h4>
	</div>
	<div class="page-rightheader ml-md-auto">
		<div class=" btn-list">
		<a href="javascript:history.back()" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back">
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
					
						
						
						$rowPres = &$rows[0];
							
					?>

						
						<!--End Page header-->

						<!-- Row -->
						<div class="row" style="padding-top:15px">
							<div class="col-xl-4 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header  border-0">
										<div class="card-title">Prescription Status: <?php echo getPrescriptionStatus($rowPres['pres_stage'],$rowPres['pres_id']); ?></div>
									</div>
									<div class="card-body pt-2 pl-3 pr-3">
										<div class="table-responsive">
											<table class="table">
												<tbody>
                                                
                                                	<tr>
														<td>
															<span class="w-50">Order Number</span>
														</td>
														<td>:</td>
														<td>
															PH-<?php echo $rowPres['pres_id'] ?>
														</td>
													</tr>
                                                
                                               		 <tr>
														<td>
															<span class="w-50">Patient Name</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $rowPres['patient_first_name']." ".$rowPres['patient_middle_name']." ".$rowPres['patient_last_name']; ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50"> DOB</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php 
									
									/*$from = new DateTime($rowPres['patient_dob']);
									$to   = new DateTime('today');
									echo $from->diff($to)->y;*/
									$date=date_create($rowPres['patient_dob']);
									echo date_format($date,"d/m/Y");
									//echo date_format($rowPres['patient_dob'],'d/m/Y') ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Gender</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo getGenderName($rowPres['patient_gender']) ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Phone</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $rowPres['patient_phone'] ?></span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>
															<span class="w-50">Email</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo $rowPres['patient_email'] ?></span>
														</td>
													</tr>
													
													
													
													
													<tr>
														<td>
															<span class="w-50">Condition</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo getConditionName($rowPres['pres_condition']) ?></span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Medication</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php 
																$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($rowPres['pres_id'])."'";
																$resMedicine=$database->get_results($sqlMedicine);
																for ($m=0;$m<count($resMedicine);$m++)
																{
																	$rowMedicine=$resMedicine[$m];
																	
																	echo $rowMedicine['pm_med']." - ".$rowMedicine['pm_med_qty'];
															
                                                            
                                                            
                                                           } ?></span>
														</td>
													</tr>
                                                    
                                                    
                                                    
													
													
													<tr>
														<td>
															<span class="w-50">Submitted Date</span>
														</td>
														<td>:</td>
														<td>
                                                        
                                                        	<?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?>
                                                            
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Prescription Expires</span>
														</td>
														<td>:</td>
														<td>
                                                        
                                                        	-
															
														</td>
													</tr>
                                                    
												</tbody>
											</table>
										</div>
										
									</div>
								</div>
								
							</div>
							<div class="col-xl-8 col-md-12 col-lg-12">
								<div class="tab-menu-heading hremp-tabs p-0 ">
									<div class="tabs-menu1">
										<!-- Tabs -->
										<ul class="nav panel-tabs">
                                        <li><a href="#tab6" data-toggle="tab"  <?php if ($_GET['message']!=1) { ?> class="active" <?php } ?> >Completed Medical Assessment</a></li>
											
											
											<li><a href="#tab7"  data-toggle="tab" <?php if ($_GET['message']==1) { ?> class="active" <?php } ?>>Messages</a></li>
											
										</ul>
									</div>
								</div>
								<div class="panel-body tabs-menu-body hremp-tabs1 p-0">
									<div class="tab-content">
										
										<div class="tab-pane <?php if ($_GET['message']!=1) echo "active";  ?>" id="tab6">
											<div class="card-body">
                                            
                                            <div class="row" style="padding-top:15px" >
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f5f5f5; color:#444; border:1px solid #d8d8d8">
														<table class="table row table-borderless w-100 m-0 text-nowrap">
															<tbody class="col-lg-12 col-xl-6 p-0">
																<tr>
														<td><span class="font-weight-semibold">Date :</span> <?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?></td>
<td><span class="font-weight-semibold">Overall Risk Stratification :</span> 
<?php $overallRisk=$rowPres['pres_overall_risk'];
if ($overallRisk==1) { $btnClr="green"; $btnText="Low"; }
else if ($overallRisk==2) { $btnClr="orange"; $btnText="Moderate"; }
else if ($overallRisk==3) { $btnClr="red"; $btnText="High"; }

 ?>
<span style="background-color:<?php echo $btnClr; ?>; color:#FFF; padding:10px; font-weight:bold"><?php echo $btnText; ?></span>


</td>
<td><span class="font-weight-semibold">Condition :</span> <span class="btn btn-primary" style="cursor:text"><?php echo  getConditionName($rowPres['pres_condition']) ?></span></td>																																														                                                   </tr>
                                                                    </tbody>
                                                               </table>     
														</div>
													</div>
                                </div>
                                
                               			 <div class="row" style="padding-top:15px" >
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                    	<h4 style="background:#648bff; color:#fff; padding:15px">Medication</h4>
                                                   
														<div class="table-responsive">
											<table class="table border-top" style="background:#fff; width:95%; margin:auto; border:1px solid #d9d9d9; margin-bottom:15px">
												<thead style="padding-left:20px">
                                                
													<tr>
														<th>Medication</th>
														<th>Strength</th>
														<th>Quantity</th>
														<th>Price</th>
                                                        <th>Dosage Instruction</th>
                                                        <th></th>
                                                        <th></th>
													</tr>
												</thead>
												<tbody style="padding-left:20px">
                                                
                                                 <?php
																$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($rowPres['pres_id'])."'";
																$resMedicine=$database->get_results($sqlMedicine);
																for ($m=0;$m<count($resMedicine);$m++)
																{
																	$rowMedicine=$resMedicine[$m];
												 ?>
													<tr>
														<th scope="row"><?php echo $rowMedicine['pm_med']; ?></th>
														<td>-</td>
														<td><?php echo $rowMedicine['pm_med_qty']; ?></td>
														<td><?php echo CURRENCY?><?php echo $rowMedicine['pm_med_price']; ?></td>
                                                        <td>-</td>
                                                       
													</tr>
                                               
                                                <?php } ?>
                                               
                                               
												</tbody>
											</table>
                                            
                                            
                                           
										</div>   
														</div>
													</div>
                                </div>
                                
                                
                                
                                
                               				 <div class="row" style="padding-top:15px;margin-bottom:30px" >
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                     <h4 style="background:#648bff; color:#fff; padding:15px">About You</h4>
                                                     
                                                 <?php 
											 $aboutYou=unserialize(fnUpdateHTML($rowPres['pres_about_you']));									 
											
											  ?>
								<div class="panel-body p-0">
									<div class="tab-content">
										<div class="tab-pane active" id="tab5">
											<div class="card-body" style="padding-top:0px">
												
												<div class="form-group">
                                                
                                                
                                                  <?php foreach($aboutYou as $que => $val) { ?>
													<div class="row alternate-item">
														<div class="col-md-5">
															<label class="form-label mb-0 mt-2" style="color:#777"><?php echo base64_decode($que) ?></label>
														</div>
														<div class="col-md-7 mt-2">
															<h5 style="vertical-align:middle"> <?php echo base64_decode($val) ?></h5>
														</div>
													</div>
                                                   <?php } ?>
                                                    
                                                    
                                                        
                                                       
                                                    
                                                     
												</div>
												
												
												
												
											
										</div>
                                        </div>
										
									</div>
								</div> 
														</div>
													</div>
                                			</div>
                                            
												 <div class="row" style="padding-top:15px;margin-bottom:30px">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                     <h4 style="background:#648bff; color:#fff; padding:15px">Symptoms</h4>
												<div class="panel-body p-0">
                                     
                                     <?php  $symptoms=unserialize(fnUpdateHTML($rowPres['pres_symptoms'])); ?>           
                                                
                                                
									<div class="tab-content">
										<div class="card" style="background-color:transparent">
									
									<div class="card-body pb-0 pt-3">
                                    
                                     <?php 
												if (is_array($symptoms))
												for($a=0;$a<count($symptoms);$a++) { ?>
										<div class="alternate-item">
											<label class="form-label mb-0"><?php echo base64_decode($symptoms[$a]['question']);  ?> :</label>
											<p style="margin-top:10px">
											
                                            <table width="100%">
                                            <tr><td width="3%" >
											
											<?php
											$answer=base64_decode($symptoms[$a]['answer']);
											
											$riskVal="";
											$riskVal=base64_decode($symptoms[$a]['risk']);
											
											$position=strpos($answer, "~~~");
											if ($position=="")
											{
												if ($riskVal==1)
												echo '<div class="circle-green"></div>';
												else if ($riskVal==2)
												echo '<div class="circle-orange"></div>';
												else if ($riskVal==3)
												echo '<div class="circle-red"></div>';
											 
											?>
                                            </td><td style="font-size:14px">
											
											 <?php echo $answer; ?>
                                             
                                              
                                             
                                           </td>
                                           <?php }
										   else
											{
												echo '<table width="100%" border="0px" style="border-color:#CCC">
                                                            	<tr>';
															$arrAnswer=explode("|",$answer);
															
															for ($k=0;$k<count($arrAnswer);$k++)
															{
																$arrAnsB=explode("~~~",$arrAnswer[$k]);
																
																$riskVal=$arrAnsB[1];
																
																	if ($riskVal==1)
																	echo '<td width="3%"><div class="circle-green"></div></td>';
																	else if ($riskVal==2)
																	echo '<td width="3%"><div class="circle-orange"></div></td>';
																	else if ($riskVal==3)
																	echo '<td width="3%"><div class="circle-red"></div></td>';
																
																echo "<td style='font-size:14px'>".$arrAnsB[0]."</td>";
																echo "</tr>";
																
															}
															
															echo "</tr></table>";
											}
											
											
										   
										    ?>
                                            
                                           
                                                        
                                                        
                                           
                                           </tr>
                                           </table>
                                           
                                           <?php
														if ($symptoms[$a]['more']!="")
														 echo " <br /><br /><font style='color:#000; font-size:15px'>Additional information:</font> ".base64_decode($symptoms[$a]['more']) ?>
                                            
                                            
                                            </p>
										</div>
									
                                    <?php } ?>	
										
										
										
									</div>
									
								</div>
										
									</div>
								</div> 
														</div>
													</div>
                                			</div>
												
                                                
                                                 <div class="row" style="padding-top:15px"  style="margin-bottom:30px">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                     <h4 style="background:#648bff; color:#fff; padding:15px">Your Medical History</h4>
												<div class="panel-body p-0">
                                     
                                     <?php   $medicalHistory=unserialize(fnUpdateHTML($rowPres['pres_medical_history'])); ?>           
                                                
                                                
									<div class="tab-content">
										<div class="card" style="background-color:transparent">
									
									<div class="card-body pb-0 pt-3">
                                    
                                     <?php 
												if (is_array($medicalHistory))
												for($a=0;$a<count($medicalHistory);$a++) { ?>
										<div class="alternate-item">
											<label class="form-label mb-0"><?php echo base64_decode($medicalHistory[$a]['question']);  ?> :</label>
											<p style="margin-top:10px">
											
                                            <table width="100%">
                                            <tr><td width="3%" >
											
											<?php
											$answer=base64_decode($medicalHistory[$a]['answer']);
											
											$riskVal="";
											$riskVal=base64_decode($medicalHistory[$a]['risk']);
											
											$position=strpos($answer, "~~~");
											if ($position=="")
											{
												if ($riskVal==1)
												echo '<div class="circle-green"></div>';
												else if ($riskVal==2)
												echo '<div class="circle-orange"></div>';
												else if ($riskVal==3)
												echo '<div class="circle-red"></div>';
											 
											?>
                                            </td><td style="font-size:14px">
											
											 <?php echo $answer; ?>
                                           </td>
                                           <?php }
										   else
											{
												echo '<table width="100%" border="0px" style="border-color:#CCC">
                                                            	<tr>';
															$arrAnswer=explode("|",$answer);
															
															for ($k=0;$k<count($arrAnswer);$k++)
															{
																$arrAnsB=explode("~~~",$arrAnswer[$k]);
																
																$riskVal=$arrAnsB[1];
																
																	if ($riskVal==1)
																	echo '<td width="3%"><div class="circle-green"></div></td>';
																	else if ($riskVal==2)
																	echo '<td width="3%"><div class="circle-orange"></div></td>';
																	else if ($riskVal==3)
																	echo '<td width="3%"><div class="circle-red"></div></td>';
																
																echo "<td style='font-size:14px'>".$arrAnsB[0]."</td>";
																echo "</tr>";
																
															}
															
															echo "</tr></table>";
											}
										   
										    ?>
                                            
                                            
                                           
                                           </tr>
                                           </table>
                                             <?php
														if ($medicalHistory[$a]['more']!="")
														 echo "<br><br><font style='color:#000; font-size:15px'>Additional information: ".base64_decode($medicalHistory[$a]['more']) ?></font>
                                            
                                            </p>
										</div>
									
                                    <?php } ?>	
										
										
										
									</div>
									
								</div>
										
									</div>
								</div> 
														</div>
													</div>
                                			</div>
                                            
                                             <div class="row" style="padding-top:15px"  style="margin-bottom:30px">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                     <h4 style="background:#648bff; color:#fff; padding:15px">Your Medication History</h4>
												<div class="panel-body p-0">
                                     
                                     <?php   $medication=unserialize(fnUpdateHTML($rowPres['pres_medication'])); ?>           
                                                
                                                
									<div class="tab-content">
										<div class="card" style="background-color:transparent">
									
									<div class="card-body pb-0 pt-3">
                                    
                                     <?php 
												if (is_array($medication))
												for($a=0;$a<count($medication);$a++) { ?>
										<div class="alternate-item">
											<label class="form-label mb-0"><?php echo base64_decode($medication[$a]['question']);  ?> :</label>
											<p style="margin-top:10px">
											
                                            <table width="100%">
                                            <tr><td width="3%" >
											
											<?php
											$answer=base64_decode($medication[$a]['answer']);
											
											$riskVal="";
											$riskVal=base64_decode($medication[$a]['risk']);
											
											$position=strpos($answer, "~~~");
											if ($position=="")
											{
												if ($riskVal==1 || $riskVal=="")
												echo '<div class="circle-green"></div>';
												else if ($riskVal==2)
												echo '<div class="circle-orange"></div>';
												else if ($riskVal==3)
												echo '<div class="circle-red"></div>';
											 
											?>
                                            </td><td style="font-size:14px">
											
											 <?php echo $answer; ?>
                                           </td>
                                           <?php }
										   else
											{
												echo '<table width="100%" border="0px" style="border-color:#CCC">
                                                            	<tr>';
															$arrAnswer=explode("|",$answer);
															
															for ($k=0;$k<count($arrAnswer);$k++)
															{
																$arrAnsB=explode("~~~",$arrAnswer[$k]);
																
																$riskVal=$arrAnsB[1];
																
																	if ($riskVal==1)
																	echo '<td width="3%"><div class="circle-green"></div></td>';
																	else if ($riskVal==2)
																	echo '<td width="3%"><div class="circle-orange"></div></td>';
																	else if ($riskVal==3)
																	echo '<td width="3%"><div class="circle-red"></div></td>';
																
																echo "<td style='font-size:14px'>".$arrAnsB[0]."</td>";
																echo "</tr>";
																
															}
															
															echo "</tr></table>";
											}
										   
										    ?>
                                            
                                             
                                           
                                           </tr>
                                           </table>
                                           
                                           <?php
														if ($medication[$a]['more']!="")
														 echo "<br><br><font style='color:#000; font-size:15px'>Additional information: ".base64_decode($medication[$a]['more']) ?></font>
                                            
                                            
                                            </p>
										</div>
									
                                    <?php } ?>	
										
										
										
									</div>
									
								</div>
										
									</div>
								</div> 
														</div>
													</div>
                                			</div>
                                            
                                            <div class="row" style="padding-top:15px"  style="margin-bottom:30px">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                     <h4 style="background:#648bff; color:#fff; padding:15px">Disclaimer, Consent &amp; Agreement</h4>
												<div class="panel-body p-0">
									<div class="tab-content">
										<div class="card" style="background-color:transparent">
									
                                    <div class="card-body pb-0 pt-3">
                                    	<table class="table">
                                                <?php if ($rowPres['pres_disclaimer_file']!="") { ?>
													<tr><td>Disclaimer</td><td><a href="<?php echo URL?>uploads/patients/agreement/<?php echo $rowPres['pres_disclaimer_file']?>" target="_blank">View</a></td></tr>
                                                    <?php } ?>
                                                    <?php if ($rowPres['pres_agreement_file']!="") { ?>
                                                    <tr><td>Agreement</td><td><a href="<?php echo URL?>uploads/patients/agreement/<?php echo $rowPres['pres_agreement_file']?>" target="_blank">View</a></td></tr>
                                                     <?php } ?>
                                                </table>
                                    	
												<table class="table">
												<tbody>
                                                <?php  
													 $sqlGP="select * from tbl_patient_gps where pg_patient_id='".$rowPres['pres_patient_id']."'";
													$resGP=$database->get_results($sqlGP);
													$rowGP=$resGP[0];
													
													if ($rowGP['pg_option']==1)
													{									
												 ?>
                                                	<tr><td>GP Name</td><td><?php echo $rowGP['pg_gp'] ?></td></tr>
                                                    
                                                    <?php }
													
													else if ($rowGP['pg_option']==2)
													{									
												 ?>
                                                	<tr><td>GP Practise</td><td><?php echo $rowGP['pg_gp_name'] ?></td></tr>
                                                    <tr><td>Address</td><td><?php echo $rowGP['pg_gp_address'] ?></td></tr>
                                                    <tr><td>Email</td><td><?php echo $rowGP['pg_gp_email'] ?></td></tr>
                                                    <tr><td>Telephone</td><td><?php echo $rowGP['pg_gp_phone'] ?></td></tr>
                                                    
                                                    <?php }
													
													else if ($rowGP['pg_option']==3)
													{									
												 ?>
                                                	<tr><td colspan=2>I don’t know my GP Practice details</td></tr>
                                                    
                                                    
                                                    <?php }
													
													else if ($rowGP['pg_option']==4)
													{									
												 ?>
                                                	<tr><td colspan=2> I do not have a registered GP in the UK</td></tr>
                                                    
                                                    
                                                    <?php }
													
													else if ($rowGP['pg_option']==5)
													{									
												 ?>
                                                	<tr><td colspan=2> I will take responsibility to inform my GP</td></tr>
                                                    
                                                    
                                                    <?php }
													
													
													 ?>
                                                    
                                                    
                                                </tbody>
                                                </table>
												
									</div>
									
								</div>
										
									</div>
								</div> 
														</div>
													</div>
                                			</div>
                                            
                                            
                                             <div class="row" style="padding-top:15px" style="margin-bottom:30px" id="notes">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                    	<h4 style="background:#648bff; color:#fff; padding:15px">Clinician Consultation Notes</h4>
                                                        <div class="card-body pt-1">
                                                        
                                                       
                                                       
                                                        <!--<a class="btn btn-light" href="#">Contact by email</a>-->
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        <table style="margin-top:10px" width="100%" class="table  table-vcenter table-bordered border-bottom" id="miles-tables">
														<thead>
															<tr>
																<th width="2%" class="border-bottom-0 text-center w-5">No</th>
																<th class="border-bottom-0" width="57%">Notes</th>
																<th width="17%" class="border-bottom-0">Date</th>
                                                                <th width="24%" class="border-bottom-0">Added by</th>
															
																
															</tr>
														</thead>
														<tbody>
                                                        
                                                        <?php $sqlNotes="select * from tbl_prescriptions_notes where pn_pres_id='".$database->filter($_GET['id'])."' order by pn_id desc";
														$resNotes=$database->get_results($sqlNotes);
														if (count($resNotes)>0)
														{
															for ($j=0;$j<count($resNotes);$j++)
															{
																$rowNotes=$resNotes[$j];
														 ?>
															<tr>
																<td class="text-center"><?php echo $j+1; ?></td>
																<td>
																	<?php echo $rowNotes['pn_action_details']?>
																</td>
																<td><?php echo fn_formatDateTime($rowNotes['pn_date_time'])?></td>
																<td>
                                                                
                                                                	<?php
																		
																		echo getUserNameByType($rowNotes['pn_user_type'],$rowNotes['pn_user_id'])
																	
																	?>
                                                                
                                                                </td>
																
															</tr>
														<?php }
														} else {?>
                                                        <tr><td colspan="4">No notes added!</td></tr>
                                                        <?php } ?>	
															
														</tbody>
													</table>
                                                        
                                                   </div>
														
                                            
										</div>   
														</div>
													</div>
                                                    
                                                <div class="row" style="padding-top:15px" style="margin-bottom:30px">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                    	<h4 style="background:#648bff; color:#fff; padding:15px">Completed Past Medical Assessment</h4>
                                                   
														<div class="table-responsive">
											<table class="table border-top" style="background:#fff; width:95%; margin:auto; border:1px solid #d9d9d9; margin-bottom:15px">
												<thead style="padding-left:20px">
                                                
													<tr>
														<th>Date </th>
														<th>Medical Condition</th>
														<th>Medication Supplied</th>
													
                                                        <th></th>
                                                        
													</tr>
												</thead>
												<tbody style="padding-left:20px">
                                                
                                                <?php 
													$sqlAss="select * from tbl_prescriptions,tbl_patients where patient_id=pres_patient_id and (pres_stage=3 || pres_stage=6) and pres_condition='".$rowPres['pres_condition']."' ";
													
													$resAss=$database->get_results($sqlAss);
													if (count($resAss)>0)
													{
													
													for ($j=0;$j<count($resAss);$j++)
													{
												
														$rowAss=$resAss[$j];
												?>
                                                
													<tr>
														<th scope="row"><?php echo  date("d/m/Y",strtotime($rowAss['pres_date'])); ?></th>
														<td><?php echo getConditionName($rowAss['pres_condition']); ?></td>
														<td><?php 
																$sqlMedicine="select * from tbl_prescription_medicine where pm_pres_id='".$database->filter($rowAss['pres_id'])."'";
																$resMedicine=$database->get_results($sqlMedicine);
																for ($m=0;$m<count($resMedicine);$m++)
																{
																	$rowMedicine=$resMedicine[$m];
																	
																	echo $rowMedicine['pm_med']." - ".$rowMedicine['pm_med_qty'];
															
                                                            
                                                            
                                                           }
														   
														   ?></td>
									
                                                        <td><a class="btn btn-primary" href="#">View Detail</a></td>
													</tr>
                                                    
                                                    <?php }
													} else {?>
                                                    <tr><td colspan="4">No previous record found</td></tr>
                                                    <?php } ?>
                                                    
												</tbody>
											</table>
                                            
                                         
										</div>   
														</div>
													</div>
                               				 </div>
                                                 
                                                    
                                                  <div class="row" style="padding-top:15px" style="margin-bottom:30px">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                    	<h4 style="background:#648bff; color:#fff; padding:15px">Message for pharmacy</h4>
                                                   
														<div class="card-body pt-3">
														<?php if ($rowPres['pres_pharmacy_note']!="") { ?>
                                                        <p><?php echo $rowPres['pres_pharmacy_note']; ?></p>
                                            			<?php } else echo "-"; ?>
                                                       
                                            
                                            			
                                         
										</div>   
														</div>
													</div>
                               				 </div>
                                             
                                              <div class="row" style="padding-top:15px" style="margin-bottom:30px">
                                				<div class="col-sm-12 col-md-12">
													<div style="background:#f9f9f9; color:#444; border:1px solid #d8d8d8">
                                                    
                                                    	<h4 style="background:#648bff; color:#fff; padding:15px">Actions / Logs</h4>
                                                        <div class="card-body">
												<div class="table-responsive">
													
													<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="miles-tables">
														<thead>
															<tr>
																<th class="border-bottom-0 text-center w-5">No</th>
																<th class="border-bottom-0">Log Details</th>
																<th class="border-bottom-0">Date</th>
                                                                <th class="border-bottom-0">Action Taken by</th>
															
																
															</tr>
														</thead>
														<tbody>
                                                        
                                                        <?php $sqlLogs="select * from tbl_prescriptions_actions where pa_pres_id='".$database->filter($_GET['id'])."' order by pa_id desc";
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
																	<?php echo $rowLogs['pa_action_details']?>
																</td>
																<td><?php echo fn_formatDateTime($rowLogs['pa_date_time'])?></td>
																<td>
                                                                
                                                                	<?php
																		
																		echo getUserNameByType($rowLogs['pa_user_type'],$rowLogs['pa_user_id'])
																	
																	?>
                                                                
                                                                </td>
																
															</tr>
														<?php }
														}?>	
															
														</tbody>
													</table>
                                                    
                                                    
												</div>
											</div>
														
                                            
										</div>   
														</div>
													</div>
                                                 
                                                 
                                              		<input type="hidden" name="hdOutcomes" id="hdOutcomes" value="" />
                                                    
                                                  
                                                    
                               				 </div>
										</div>
										<div class="tab-pane <?php if ($_GET['message']==1) echo "active";  ?>" id="tab7">
											<div class="card-body">
												
                                                
                                                
                                                
                                                
												
                                                
                                                 <?php 
														$sqlMessage="select * from tbl_messages where  message_pres_id='".$database->filter($_GET['id'])."' order by message_id desc";
														$resMessage=$database->get_results($sqlMessage);
														if (count($resMessage)>0)
														{
															
															for ($i=0;$i<count($resMessage);$i++)
															{
																
																$rowMessage=$resMessage[$i];																
																$mysqlDate = $rowMessage['message_date'];
																$timestamp = strtotime($mysqlDate);
																$formattedDate = date("d M Y", $timestamp);
																
																$formattedTime = date("H:i", $timestamp);
																
																			if ($rowMessage['message_sender_type']=="Patient")
																				{
																				$sqlSender="select * from tbl_patients where patient_id='".$rowMessage['message_sender_id']."'";
																				//else if ($rowMessage['message_sender_type']=="Clinician")
																				//$sqlSender="select * from tbl_prescribers where pres_id='".$rowMessage['message_sender_id']."'";
																				$resSender=$database->get_results($sqlSender);
																				$rowSender=$resSender[0];
																				$replierName=$rowSender['patient_first_name']." ".$rowSender['patient_middle_name']." ".$rowSender['patient_last_name']." (".$rowMessage['message_sender_type'].")";
																				$colorCss="danger";
																				}
																				else if ($rowMessage['message_sender_type']=="Clinician")
																				{
																					
																				$sqlSender="select * from tbl_prescribers where pres_id='".$rowMessage['message_sender_id']."'";
																				$resSender=$database->get_results($sqlSender);
																				$rowSender=$resSender[0];
																				$replierName=$rowSender['pres_forename']." ".$rowSender['pres_surname']." (".$rowMessage['message_sender_type'].")";
																					
																					
																				
																					$colorCss="primary";
																				}
																				
																				else if ($rowMessage['message_sender_type']=="Pharmacy")
																				{
																					
																				$sqlSender="select * from tbl_pharmacies where pharmacy_id='".$rowMessage['message_sender_id']."'";
																				$resSender=$database->get_results($sqlSender);
																				$rowSender=$resSender[0];
																				$replierName=$rowSender['pharmacy_name']." (".$rowMessage['message_sender_type'].")";
																					
																					
																				
																					$colorCss="secondary";
																				}



														
													?>
                                                    <div class="card shadow-none border">
													<div class="d-sm-flex p-5">
													
                                                    
                                                    
                                                    
                                                    	
														<div class="media-body">
															<h5 class="mt-1 mb-1 font-weight-semibold"><?php echo $rowMessage['message_subject']?> <span class="badge badge-<?php echo $colorCss; ?>-light badge-md ms-2"><?php echo $replierName; ?></span></h5>
															<small class="text-muted"><i class="fa fa-calendar"></i> <?php echo $formattedDate; ?> <i class=" ms-3 fa fa-clock-o"></i> <?php echo $formattedTime; ?></small>
															<p class="fs-13 mb-2 mt-1">
															   <?php echo $rowMessage['message_text']?>
															</p>
															 <!---------Attachment of new message------------>
                                                            
                                                             <?php if ($rowMessage['message_attachment']!="") {
																 
																 $arrUnSerMes=unserialize(fnUpdateHTML($rowMessage['message_attachment']));
																
																  ?>
                                                                    
                                                                    <div class="row" style="padding-top:15px">
                                                                    
                                                                    <?php for ($j=0;$j<count($arrUnSerMes);$j++) {
																		
																		
															$fileExtension = pathinfo($arrUnSerMes[$j], PATHINFO_EXTENSION);
															
															// Check if the file extension is PDF
															if (strtolower($fileExtension) === 'pdf') {
																// The file is a PDF
																$type="pdf";
															} elseif (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png'])) {
																// The file is an image
																$type="image";
															} 
																		
																		 ?>
                                                                        <div class="col-lg-2 col-md-3">
                                                                            <a  href="<?php echo URL?>uploads/patients/<?php echo $arrUnSerMes[$j]; ?>" download class="attach-supportfiles">
                                                                                
                                                                                <?php if ($type=="image") { ?>
                                                                                <img src="<?php echo URL?>uploads/patients/<?php echo $arrUnSerMes[$j]; ?>" style="max-height:100px" alt="<?php echo $arrUnSerMes[0]; ?>" title="<?php echo $arrUnSerMes[0]; ?>" class="img-fluid">
                                                                                <div class="attach-title"><?php echo $arrUnSerMes[0]; ?></div>
                                                                                <?php } else { ?>
                                                                                <img src="<?php echo URL?>images/pdf.png" style="max-height:100px" alt="<?php echo $arrUnSerMes[0]; ?>" title="<?php echo $arrUnSerMes[0]; ?>" class="img-fluid">
                                                                                <div class="attach-title"><?php echo $arrUnSerMes[0]; ?></div>
                                                                                <?php } ?>
                                                                                
                                                                            </a>
                                                                        </div>
                                                                      <?php } ?>
												
											</div>
                                            <?php } ?> 
                                            <!-----------end attachment------->
                                                            
                                                          
                                                                
                                                               
                                                            
														</div>
                                                        
                                                        
                                                        
                                                        
													</div>
                                                    </div>
                                                    
                                                    <?php }
														}
														else
														
														echo "<p style='font-size:18px; padding:30px'>No communication yet for this order</p>";
														?>
												
												
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
          <td>1 Free bump ad</td>
          <td class="price-display"><input type="checkbox" class="price-check" name="selected[]" value="premium_1_90|90"> $90</td>
          <td class="price-display"><input type="checkbox" class="price-check" name="selected[]" value="premium_1_180|140"> $140</td>
        </tr>
        <tr>
          <td>5 Free bump ads</td>
          <td class="price-display"><input type="checkbox" class="price-check" name="selected[]" value="premium_5_90|400"> $400</td>
          <td class="price-display"><input type="checkbox" class="price-check" name="selected[]" value="premium_5_180|640"> $640</td>
        </tr>
        <tr>
          <td>10 Free bump ads</td>
          <td class="price-display"><input type="checkbox" class="price-check" name="selected[]" value="premium_10_90|700"> $700</td>
          <td class="price-display"><input type="checkbox" class="price-check" name="selected[]" value="premium_10_180|1120"> $1,120</td>
        </tr>
        <tr>
          <td>30 Free bump ads</td>
          <td class="price-display"><input type="checkbox" class="price-check" name="selected[]" value="premium_30_90|1800"> $1,800</td>
          <td class="price-display"><input type="checkbox" class="price-check" name="selected[]" value="premium_30_180|2880"> $2,880</td>
        </tr>
        <tr>
          <td>50 Free bump ads</td>
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
          <td>1 Free bump ad</td>
          <td class="price-display"><input type="checkbox" class="price-check2" name="selected[]" value="advance_1_90|45"> $45</td>
          <td class="price-display"><input type="checkbox" class="price-check2" name="selected[]" value="advance_1_180|70"> $70</td>
        </tr>
        <tr>
          <td>5 Free bump ads</td>
          <td class="price-display"><input type="checkbox" class="price-check2" name="selected[]" value="advance_5_90|200"> $200</td>
          <td class="price-display"><input type="checkbox" class="price-check2" name="selected[]" value="advance_5_180|320"> $320</td>
        </tr>
        <tr>
          <td>10 Free bump ads</td>
          <td class="price-display"><input type="checkbox" class="price-check2" name="selected[]" value="advance_10_90|350"> $350</td>
          <td class="price-display"><input type="checkbox" class="price-check2" name="selected[]" value="advance_10_180|560"> $560</td>
        </tr>
        <tr>
          <td>30 Free bump ads</td>
          <td class="price-display"><input type="checkbox" class="price-check2" name="selected[]" value="advance_30_90|900"> $900</td>
          <td class="price-display"><input type="checkbox" class="price-check2" name="selected[]" value="advance_30_180|1440"> $1440</td>
        </tr>
        <tr>
          <td>50 Free bump ads</td>
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
        <p style="font-size:18px; color:#F6591F">Net Total to Pay: <strong>$<span id="net-total">0</span></strong></p>
        
        <input type="checkbox" name="ckTerms"  required /> Accept <a href="#" style="color:#C60">Terms and Conditions</a>
        <button class="btn btn-primary mt-3 w-100" id="submitBtn" disabled="disabled" type="submit">Submit Order</button>
      </div>
    </div>
  </div>
</div>

</form>
 
<?php } else { ?>

<div class="table-responsive mb-5">
    <table class="table card-table table-vcenter text-nowrap table-primary mb-0">
    	<tr><td><h4>Your Order Has Been Placed</h4>Thank you for your recent Ad package purchase! Credits purchased now credited under your account.<br /><br />   	      
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
      $('.price-check:checked').each(function () {
        total1 += parseFloat($(this).val().split('|')[1]);
      });

      let total2 = 0;
      $('.price-check2:checked').each(function () {
        total2 += parseFloat($(this).val().split('|')[1]);
      });

      let netTotal = total1 + total2;

      $('#total-price').text(total1.toLocaleString());
      $('#total-price2').text(total2.toLocaleString());
      $('#net-total').text(netTotal.toLocaleString());
	  
	  if (netTotal>0)
	$('#submitBtn').prop('disabled', false);
	else
	$('#submitBtn').prop('disabled', true);
    }
	
	
	

    $('.price-check, .price-check2').on('change', updateTotals);
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
  