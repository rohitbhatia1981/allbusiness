		

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
		
<form name="adminForm" id="adminForm" action="?c=<?php echo $component?>" method="get">


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
                           
											
											<div class="col-md-12 col-lg-12 col-xl-2">
												<div class="form-group">
													<label class="form-label">Search by Keyword:</label>
													<input type="text" class="form-control" name="txtSearchByTitle" placeholder="Search by keyword" value="<?php echo $_GET['txtSearchByTitle'];?>">
                                                   
                                                  
												</div>
											</div>
                                            
                                            <div class="col-md-12 col-lg-12 col-xl-2">
												<div class="form-group">
													<label class="form-label">Posted by</label>
													<select name="cmbHO" class="form-control custom-select select2" data-placeholder="All"  > 
                                   <option label="All"></option>
                                    
                                   <?php
								$query = "SELECT * FROM tbl_homeowners where ho_status=1 order by ho_name";
								$results = $database->get_results( $query );							
								foreach ($results as $value) {
									?>
								<option value="<?php echo $value['ho_id']; ?>"  <?php if($_GET['cmbHO'] == $value['ho_id']) {	echo 'selected="selected"';}?>  ><?php echo $value['ho_name']; ?></option>

								<?php    
                                }
    
                                ?> 

                                    </select>
                                                   
                                                  
												</div>
											</div>
                                            
                                            <div class="col-md-12 col-lg-12 col-xl-2">
												<div class="form-group">
													<label class="form-label">Category:</label>
													<input type="text" class="form-control" name="txtCategory" placeholder="Search by category" value="<?php echo $_GET['txtCategory'];?>">
                                                   
                                                  
												</div>
											</div>
                                            
                                            <div class="col-md-12 col-lg-12 col-xl-2">
												<div class="form-group">
													<label class="form-label">Job Type:</label>
													<select name="jobType" class="form-control custom-select select2" data-placeholder="All"> 
                                                    <option value="">Select</option>
                                                    <option value="1" <?php if ($_GET['jobType']==1) echo "selected"; ?>>Builder</option>
                                                    <option value="2" <?php if ($_GET['jobType']==2) echo "selected"; ?>>Trade Professionals</option> 
                                                    </select>
                                                   
                                                  
												</div>
											</div>
                                            		   
                                            
											<div class="col-md-12 col-lg-12 col-xl-2">
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
												<th width="9%" class="border-bottom-0 wd-5" style="width:10%">
												<label class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" name="chkControl" value="yes" onClick="checkAll(this.form,this.checked);" />
														<span class="custom-control-label"></span>
												</label>
												</th>
												<th width="2%" class="border-bottom-0">ID</th>
                                                <th width="11%" class="border-bottom-0">Job Type</th>
                                                <th width="12%" class="border-bottom-0">Category</th>
                                                <th width="12%" class="border-bottom-0">Location</th>
                                                <th width="12%" class="border-bottom-0">Job Urgency</th>
                                                <th width="8%" class="border-bottom-0">Posted by</th>                                                
                                                <th width="8%" class="border-bottom-0">Post Date</th>
                                               
                                                
                                                
                                               
												
												<th width="8%" class="border-bottom-0">Actions</th>
												<th width="24%" class="border-bottom-0">Status</th>
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
				
				<input name="deletes[]" id="chkDelete" onClick="isChecked(this.checked);" class="custom-control-input" value="<?php echo $row['job_id']; ?>" type="checkbox"  />			
											<span class="custom-control-label"></span>
										</label>
									</td>
									<td class="align-middle">
										
												<a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['job_id']; ?>"  style="color:#06F; text-decoration:underline"><?php echo JOB_ID ?><?php echo $row['job_id'] ?></a>
											
									</td>
                                    <td class="align-middle">
										
												<?php if ($row['job_type']=="1") echo "I want to hire a builder";
												else if ($row['job_type']=="2") echo "Trade Professional";
												 ?> 
											
									</td>
                                    <td><?php echo $row['categories_name']; ?></td>
                                    <td><?php echo ucfirst($row['job_location']); ?></td>
                                    
                                    <td class="align-middle">
                                    
                                    			<?php echo $row['job_urgency'] ?>
										
												
											
									</td>
                                     <td class="align-middle"><?php echo $row['ho_name'] ?></td>
                                    
                                    
                                    <td class="align-middle"><?php echo displayDateTimeFormat($row['job_postdate']); ?></td>
                                    
                                    
                                    
                                    
                                    
									<td class="align-middle">
										<div class="btn-group align-top">
											<button class="btn btn-sm btn-white"  ><a href="?c=<?php echo $component?>&task=detail&Cid=<?php echo $menuid['component_headingid']; ?>&id=<?php echo $row['job_id']; ?>">View full details</a></button>
											


											

											
										</div>
									</td>

									<td class="align-middle">
										<div class="btn-group align-top">
										<?php if($row['job_status'] == 1){ ?>

										<span class="tag tag-green">Enabled</span>

										<?php }else if($row['job_status'] == 0){ ?>

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

		<th class="border-bottom-0 w-10" style="text-align:center;" colspan="10"> - No Record found - </th>
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
	<h4 class="page-title">Job : <?php if ($_GET['task']=="edit") echo 'Edit'; else if ($_GET['task']=="add") echo 'Add';  ?></h4>
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
                <!--3 steps to implement autocomplete

1) Copy style css
2) Id of input and div below it.
3) Javascript at the bottom.


-->                           
                           
<style>

@charset "utf-8";
#suggestions-container {
    position: absolute;
    width: auto;
    max-height: 150px;
	min-width:200px;
	background-color:#FFF;
    overflow-y: auto;
    border: 1px solid #ccc;
	z-index:1000;
    display: none;
}

#suggestions-container2 {
    position: absolute;
    width: auto;
    max-height: 150px;
	min-width:200px;
	background-color:#FFF;
    overflow-y: auto;
    border: 1px solid #ccc;
	z-index:1000;
    display: none;
}

.suggestion {
    padding: 8px;
    cursor: pointer;
	
}

.suggestion:hover {
    background-color: #f0f0f0;
}
/* CSS Document */

</style>

   <form name="adminForm" id="adminForm" action="?c=<?php echo $component?>&task=<?php echo $task;?>" method="post" class="form-horizontal" />
   <div class="card-body pb-2">
						
		 <!--<h4 style="text-transform:uppercase"><u>Job DETAILS</u></h4>-->
         <div style="height:20px"></div>
					
                            
                            <div class="form-group">
                            <div class="col-6">
  
                            
								<label class="form-label">Select Homeowner *</label>
                                    <select name="cmbHO" class="form-control" required > 
                                    <option value="">Select</option>
                                    
                                   <?php
								$query = "SELECT * FROM tbl_homeowners where ho_status=1 order by ho_name";
								$results = $database->get_results( $query );							
								foreach ($results as $value) {
									?>
								<option value="<?php echo $value['ho_id']; ?>"  <?php if($row['job_posted_by'] == $value['ho_id']) {	echo 'selected="selected"';}?>  ><?php echo $value['ho_name']; ?></option>

								<?php    
                                }
    
                                ?> 

                                    </select>
                             </div>
							</div>
                            
                            
                           <div class="form-group">
                            <div class="col-6">
  
                            
								<label class="form-label">What type of Job is it? *</label>
                                    <select name="cmbJobs" class="form-control" required > 
                                    <option value="">Select</option>
                                    <option value="1" <?php if ($row['job_type']==1) echo "selected"; ?>>I want to hire a builder</option>
                                    <option value="2" <?php if ($row['job_type']==2) echo "selected"; ?>>Trade Professionals</option> 
                                    </select>
                             </div>
							</div>
                            
                            
                            <div class="form-group">
                            <div class="col-6">
								<label class="form-label">What service do you need? *</label>
                                   <input style="margin:0px !important" class="form-control mb-4" id="search" autocomplete="off" placeholder="eg; Plumber, Electrician, Landscaper" type="text" name="txtCategory"  value="<?php echo $row['categories_name'] ?>" required>
                                  
                                   <div  id="suggestions-container"></div>
                             </div>
							</div>
                            
                            <div class="form-group">
                            <div class="col-6">
								<label class="form-label">Where do you need this done? *</label>
                                   <!--<div class="input-icon"> <span class="input-icon-addon"> <i class="fa fa-map-pin"></i> </span>--><input class="form-control mb-4" style="margin:0px !important" type="text" name="txtLocation"  id="search2" placeholder="Search by Suburb or Postcode" value="<?php echo $row['job_location']?>" required>
                                   
                                   <div  id="suggestions-container2"></div>
                                   <!--</div>-->
                             </div>
							</div>
                            
                            <div class="form-group">
                            <div class="col-6">
								<label class="form-label">How soon do you need it done? *</label>
                                    <select name="cmbTimeUrgency" class="form-control" onchange="checkSpecDate(this.value)" required > 
                                    <option value="">Select</option>
                                    <option value="Immediately" <?php if ($row['job_urgency']=="Immediately") echo "selected"; ?>>Immediately</option>
                                    <option value="In a Week" <?php if ($row['job_urgency']=="In a Week") echo "selected"; ?>>In a Week</option> 
                                    <option value="1-2 Weeks" <?php if ($row['job_urgency']=="1-2 Weeks") echo "selected"; ?>>1-2 Weeks</option> 
                                    <option value="Specific Date" <?php if ($row['job_urgency']=="Specific Date") echo "selected"; ?>>Specific Date</option> 
                                    </select>
                             </div>
                             
							</div>
                            
                            
                            <div class="form-group" id="cont_spec_date" <?php if ($row['job_urgency']!="Specific Date") { ?> style="display:none" <?php } ?>>
                            <div class="col-6">
								<label class="form-label">Select Specific Date *</label>
                                   <input class="form-control mb-4"   placeholder="" type="date" name="txtSpecDate" min="<?php echo date('Y-m-d', strtotime('+0 day')) ?>"  value="<?php echo $row['job_specific_date'] ?>" required>
                                  
                                  
                             </div>
							</div>
                            
                            
                            <div style="height:30px"></div>
                            <h4 ><u>Describe your Project</u></h4>
                            <div style="height:10px"></div>
                            <div class="form-group">
                            <div class="col-6">
								<label class="form-label">What do you need done? *</label>
                                    <textarea rows="5" class="form-control" placeholder="What would be helpful for professional to know?" cols="100" name="txtDescribe" required><?php echo fnUpdateHTML($row['job_description']) ?></textarea>
                             </div>
							</div>
                            
                            <div class="form-group">
                            <div class="col-6">
								<label class="form-label">What is your budget? *</label>
                                   <div class="input-icon"> <span class="input-icon-addon"> <i class="fa fa-usd"></i> </span> <input type="text" name="txtBudget" class="form-control" placeholder="Enter Budget" value="<?php echo $row['job_budget']; ?>" required> </div>
                             </div>
							</div>
                            

						<div class="form-group ">
                         <div class="col-6">
							<div class="form-label">Enabled</div>
                                <div class="custom-controls-stacked">
                                    <label class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="rdoPublished" id="rdoPublished" value="1" <?php if($row['page_status']=="1" || $row['page_status']=='') echo 'checked="checked"'; ?>>
                                        <span class="custom-control-label">Yes</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="rdoPublished" id="rdoPublished" value="0" <?php if($row['page_status']==0 && $row['page_status']!='') echo 'checked="checked"'; ?>>
                                        <span class="custom-control-label">No</span>
                                    </label>
                            
                                </div>
                           </div>
					</div>
                    
                    <!--<div class="card">
									<div class="card-header border-bottom-0">
										<h3 class="card-title">Send email to Pharmacy</h3>
									</div>
									<div class="card-body pb-2">
                                    
										
                                        
                                        <div class="form-group ">
						
                        				 <div class="row row-sm">
											<div class="col-lg-8">
                                            	<label class="form-label">Email Status</label>
												<?php if ($row['pharmacy_welcome_email']==0) echo "<font style='color:#F00'>Email not sent yet</font>"; else echo "<font style='color:#090'>Email was sent earlier</font>"; ?>
											</div>											
										</div>
                                        
                                        <div style="height:20px"></div>
                        
                        
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-radio">
                                                <input type="checkbox"  class="" name="ckEmail" id="ckEmail" value="1" >
                                                &nbsp;
                                                Send Welcome Email and Password to Pharmacy</label></div>
                                     </div>
                                  </div>	
                   				</div>-->
				
						
					<div class="row row-sm">
					<div class="col-lg">
					<button  class="btn btn-primary mt-4 mb-0">Submit</button>	
					</div>
					</div>	

<input type="hidden" name="pId" value="<?php echo $row['job_id']?>" />	
<input type="hidden" name="userId" value="<?php echo $row['user_id']?>" />

<input type="hidden" name="parentgroupId" value="<?php echo $_SESSION['groupid']?>" />

<input type="hidden" name="parentuserId" value="<?php echo $_SESSION['user_id']?>" />
	</form>					
								</div>
                                
             <?php if ($row['pharmacy_logo']!="")
			 $pImageStr="'".$row['pharmacy_logo']."'";		 
			  ?>


<script language="javascript">
function checkSpecDate(val)
{
	if (val=="Specific Date")
	$("#cont_spec_date").show();
	else
	$("#cont_spec_date").hide();
	
}
</script>


<script language="javascript">
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search');
    const suggestionsContainer = document.getElementById('suggestions-container');

    searchInput.addEventListener('input', function () {
        const query = this.value;

        if (query.length > 0) {
            fetch(`<?php echo URL?>autocomplete-ajax/categories.php?query=${query}`)
                .then(response => response.json())
                .then(data => showSuggestions(data));
        } else {
            suggestionsContainer.innerHTML = '';
            suggestionsContainer.style.display = 'none';
        }
    });
	
	
	 const searchInput2 = document.getElementById('search2');
    const suggestionsContainer2 = document.getElementById('suggestions-container2');

    searchInput2.addEventListener('input', function () {
        const query = this.value;

        if (query.length > 0) {
            fetch(`<?php echo URL?>autocomplete-ajax/locations.php?query=${query}`)
                .then(response => response.json())
                .then(data => showSuggestions2(data));
        } else {
            suggestionsContainer2.innerHTML = '';
            suggestionsContainer2.style.display = 'none';
        }
    });
	

    function showSuggestions(suggestions) {
        suggestionsContainer.innerHTML = '';
        suggestions.forEach(suggestion => {
            const suggestionElement = document.createElement('div');
            suggestionElement.classList.add('suggestion');
            suggestionElement.textContent = suggestion;

            suggestionElement.addEventListener('click', function () {
                searchInput.value = suggestion;
                suggestionsContainer.style.display = 'none';
            });

            suggestionsContainer.appendChild(suggestionElement);
        });

        suggestionsContainer.style.display = 'block';
    }
	
	
	 function showSuggestions2(suggestions) {
         suggestionsContainer2.innerHTML = '';
        suggestions.forEach(suggestion => {
            const suggestionElement = document.createElement('div');
            suggestionElement.classList.add('suggestion');
            suggestionElement.textContent = suggestion;

            suggestionElement.addEventListener('click', function () {
                searchInput2.value = suggestion;
                suggestionsContainer2.style.display = 'none';
            });

            suggestionsContainer2.appendChild(suggestionElement);
        });

        suggestionsContainer2.style.display = 'block';
    }
	
});
// JavaScript Document
</script>

 <script language="javascript">
 
 function openDiv(id)
 {
	 
	if ($("#ck_"+id).prop('checked')== true)
	$("#timings_"+id).show();
	else
	$("#timings_"+id).hide();
	 
	
	
	 
 }
 

 
$(document).ready(function(){
	$('#images4ex').orakuploader({
		orakuploader : true,
		orakuploader_path : 'orakuploader/',

		orakuploader_main_path : '../images/pharmacies',
		orakuploader_thumbnail_path : '../images/pharmacies',
		
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

<script language="javascript">

$("#adminForm").validate({
			rules: {
				txtPharmacyName: "required",
				txtAddress: "required",
				txtPostcode: "required"
			},
			messages: {
				txtPharmacyName: "Please enter pharmacy name",
				txtAddress: "Please enter pharmacy address",
				txtPostcode: "Please enter pharmacy postcode"
				
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
	<h4 class="page-title">Job : Details</h4>
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
								<h4 class="page-title"><span class="font-weight-normal text-muted mr-2">Job ID #<?php echo JOB_ID.$row['job_id'] ?></span></h4>
							</div>
							<div class="page-rightheader ml-md-auto">
								<div class="d-flex align-items-end flex-wrap my-auto right-content breadcrumb-right">
									<div class="btn-list">
										
										<a href="?c=<?php echo $component?>&task=edit&Cid=<?php echo $menuid['component_headingid']; ?>&id=<?php echo $row['job_id']; ?>" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Edit details"> <i class="feather feather-edit"></i> </a>
										
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
											<li class="ml-4"><a href="#tab5" <?php if ($_GET['order']!="1") { ?> class="active" <?php } ?>  data-toggle="tab">Job Details</a></li>
											<li><a href="#tab4"  data-toggle="tab" <?php if ($_GET['order']=="1") { ?> class="active" <?php } ?>>Assigned to Professionals</a></li>
                                            <li><a href="#tab6" data-toggle="tab">Message History</a></li>
											
											<li><a href="#tab11" data-toggle="tab">Logs</a></li>
										</ul>
									</div>
								</div>
								<div class="panel-body tabs-menu-body hremp-tabs1 p-0">
									<div class="tab-content">
										<div class="tab-pane <?php if ($_GET['order']!="1") { ?> active <?php } ?>" id="tab5">
											<div class="card-body">
												<!--<h5 class="mb-4 font-weight-semibold"></h5>-->
												<div class="table-responsive">
											<table class="table" width="100%">
												<tbody>
                                                <tr><td colspan="2">
                                                
                                                <?php if ($row['pharmacy_logo']!="") { ?>
										
												<img src="<?php echo URL; ?>classes/timthumb.php?src=<?php echo URL ?>images/pharmacies/<?php echo $row['pharmacy_logo']; ?>&w=150&h=70&zc=1">
                                                <?php } ?>
                                                </td></tr>
													<tr>
														<td width="22%">
															<span class="w-50">Job ID</span>
														</td>
														<td width="1%">:</td>
														<td width="77%">
															<span class="font-weight-semibold"><?php echo JOB_ID ?><?php echo $row['job_id'] ?></span>
														</td>
													</tr>
													<tr>
														<td>What type of Job is it?</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold">
															<?php if ($row['job_type']=="1") echo "I want to hire a builder";
												else if ($row['job_type']=="2") echo "Trade Professional";
												 ?> 
                                                            </span>
														</td>
													</tr>
                                                    <tr>
														<td>What service do you need?</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold">
															<?php echo $row['categories_name']; ?>
                                                            </span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>Where do you need this done?</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold">
															<?php echo $row['job_location'];
															
															?>
                                                            </span>
														</td>
													</tr>
                                                    <tr>
                                                    
                                                     <tr>
														<td>How soon do you need it done?</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold">
															<?php if ($row['job_urgency']=="Specific Date")
															echo "On Specific Date: ".$row['job_specific_date'];
															else
															echo $row['job_urgency']
															
															?>
                                                            </span>
														</td>
													</tr>
                                                    
                                                     <tr>
														<td>What do you need done?</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold">
															<?php echo fnUpdateHTML($row['job_description']);
															
															?>
                                                            </span>
														</td>
													</tr>
                                                    
                                                    <tr>
														<td>What is your budget?</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold">
															<?php echo "$".$row['job_budget'];
															
															?>
                                                            </span>
														</td>
													</tr>
                                                    
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Homeowner Contact Name</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold">
															<?php //echo $row['pharmacy_o_name'];
															
															?>
                                                            </span>
														</td>
													</tr>
													<tr>
														<td>
															<span class="w-50">Homeowner Contact Email</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php //echo $row['pharmacy_o_email']; ?></span>
														</td>
													</tr>
													<tr>
														<td>
															<span class="w-50">Homeowner Contact Mobile </span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php //echo $row['pharmacy_o_mobile']; ?></span>
														</td>
													</tr>
													
													
                                                    
                                                    
                                                   
                                                  
                                                    
                                                    
                                                    <tr>
														<td>
															<span class="w-50">Posted Date</span>
														</td>
														<td>:</td>
														<td>
															<span class="font-weight-semibold"><?php echo displayDateTimeFormat($row['job_postdate']); ?> </span>
														</td>
													</tr>
													
													
													
                                                    <tr>
														<td>
															<span class="w-50">Status</span>
														</td>
														<td>:</td>
														<td>
                                                        <?php if ($row['job_status']==1) $status="Enabled"; else $status="Disabled"; ?>
															<span class="badge badge-primary"><?php echo $status; ?></span>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
											</div>
										</div>
                                        
                                        <div class="tab-pane <?php if ($_GET['order']=="1") { ?> active <?php } ?>" id="tab4">
                                        
                                        <form name="adminForm" action="?c=<?php echo $component?>" method="get">
											<div class="card-body">
                                            
                                            <div class="row">
                                            
                           
                           						<div class="col-md-12 col-lg-12 col-xl-3">
														<div class="form-group">
															<label class="form-label">Search by Keyword:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtSearchByTitle" type="text" value="<?php echo $_GET['txtSearchByTitle']?>">
															</div>
														</div>
													</div>
                                                 
                                             		 <div class="col-md-12 col-lg-12 col-xl-3">
														<div class="form-group">
															<label class="form-label">Start Date:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtSDate" type="date" value="<?php echo $_GET['txtSDate']?>">
															</div>
														</div>
													</div> 
                                                    
                                                     <div class="col-md-12 col-lg-12 col-xl-3">
														<div class="form-group">
															<label class="form-label">End Date:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	
																</div><input class="form-control" name="txtEDate" type="date" value="<?php echo $_GET['txtEDate']?>">
															</div>
														</div>
													</div>   
                                                 
                           
                           
											
											
											
											<div class="col-md-12 col-lg-12 col-xl-1">
												<div class="form-group mt-5">
													<button type="submit" class="btn btn-primary btn-block">Search</button>
                                                    
                                                     <?php $qS=$_SERVER['QUERY_STRING'];
												   if (strstr($qS,"txtSearchByTitle"))
												   {
												    ?>
                                                    <a href="?c=<?php echo $_GET['c']?>&task=<?php echo $_GET['task']?>&id=<?php echo $_GET['id']?>&order=1" style="font-size:11px; color:#03C">Reset filter</a>
                                                   <?php } ?>
												</div>
											</div>
										</div>
												<div class="table-responsive">
                                                
                                               
													
													<div class="table-responsive table-lg mt-3">
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
												
												<th width="14%" class="border-bottom-0">Assigned Date</th>
                                                
                                                <th width="14%" class="border-bottom-0">Professional Name</th>  
                                                <th width="14%" class="border-bottom-0">Professional Phone</th> 
                                                <th width="14%" class="border-bottom-0">Professional Email</th>                                             
                                              
                                              
                                                
											</tr>
										</thead>
							<?php

							
					
						
						$sqlPres="select * from tbl_prescriptions,tbl_patients where patient_id=pres_patient_id and pres_stage>0 and patient_pharmacy='".$database->filter($_GET['id'])."'";
						
						
		if($_GET['txtSearchByTitle'] != "")

		{

			$sqlPres .= " and (pres_id like '%".$database->filter(str_replace("PH-","",$_GET['txtSearchByTitle']))."%' || patient_first_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_middle_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_last_name like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_id like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_phone like '%".$database->filter($_GET['txtSearchByTitle'])."%' || patient_email like '%".$database->filter($_GET['txtSearchByTitle'])."%'  || patient_dob like '%".$database->filter($_GET['txtSearchByTitle'])."%'|| patient_phone like '%".$database->filter($_GET['txtSearchByTitle'])."%') ";

		}
		
		if($_GET['cmbCategory'] != "")

		{

			$sqlPres .= " and pres_stage='".$database->filter($_GET['cmbCategory'])."'";

		}
		if($_GET['txtSDate'] != "")

		{
			$sqlPres.=" and pres_date >='".$_GET['txtSDate']."'";

		}
		
		if($_GET['txtEDate'] != "")

		{
			$sqlPres.=" and pres_date <='".$_GET['txtEDate']."'";

		}
						
						
						$resPres=$database->get_results($sqlPres);
						$totalRecords=count($resPres);
						
						if($totalRecords > 0) 

							{

						
						for ($k=0;$k<$totalRecords;$k++)
						{
							
							$rowPres=$resPres[$k];
						
						?>



									
							<tbody>
								<tr>
									
									
                                   
                                    
                                    
                                    <td class="align-middle">
										
										<?php echo  date("d/m/Y",strtotime($rowPres['pres_date'])); ?>
											
									</td>
                                    
                                    
                                    
                                    
                                    <td><?php echo $rowPres['patient_first_name']." ".$rowPres['patient_middle_name']." ".$rowPres['patient_last_name']; ?></td>
                                    
                                    <td><?php echo getGenderName($rowPres['patient_gender']) ?></td>
                                   
                                    <td class="align-middle">
										
												<?php echo getConditionName($rowPres['pres_condition']); ?>
											
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

												

										</div>
												</div>
											</div>
                                            
                                            
                                            <input type="hidden" name="order" value="1" />
                                            <input type="hidden" name="c" value="<?php echo $_GET['c']?>" />
                                             <input type="hidden" name="id" value="<?php echo $_GET['id']?>" />
                                            <input type="hidden" name="task" value="<?php echo $_GET['task']?>" />
                                            
                                            </form>
                                            
										</div>
                                        
										<div class="tab-pane" id="tab6">
											<div class="card-body">
							
                            
                            <?php 
							$sqlMes = "SELECT * FROM tbl_messages,tbl_prescriptions WHERE pres_id=message_pres_id and message_sender_id='".$database->filter($_GET['id'])."' and message_sender_type='Pharmacy' order by message_id desc";
							$resMes=$database->get_results($sqlMes);
							$totalRecordsM=count($resMes);
							
							?>
                            
                            
							
								<div class="table-responsive table-lg mt-3">
                                
                                 <!--<h4><?php echo getUserNameByType('patient',$_GET['id']); ?> has sent following messages</h4>-->
                                
									<table class="table table-bordered border-top text-nowrap" id="example1" width="100%">
										<thead>
											<tr>
												
												
                                                <th width="22%" class="border-bottom-0">Subject</th>
                                               
                                                <th width="50%" class="border-bottom-0">Sent To</th>                                                
                                                <th width="12%" class="border-bottom-0">Last replied</th>
                                                <th width="12%" class="border-bottom-0 w-20">Action</th>
											</tr>
										</thead>
                                        <tbody>
							<?php

							if($totalRecordsM > 0) 

							{

							for ($i = 0; $i < $totalRecordsM; $i++) 

							{

							$srno++;

							$row = $resMes[$i];



							?>				
							
								<tr  class="trrow"  >
									
									
                                    <td class="align-middle" >
                                    
                                    <!--<a href="?c=<?php echo $component?>&task=detail&id=<?php echo $row['patient_id']; ?>"><?php echo $row['patient_id'] ?></a>-->
                                    
									<div class="card-body pb-0 pt-3">
										<div>
											<label class="form-label mb-0"><?php echo $row['message_subject']; ?></label>
											<p class="" style="font-weight:<?php echo $readStatus?>">Order id: <?php echo $row['pres_id']; ?>, <?php echo getConditionName($row['pres_condition']); ?>, dt: <?php echo displayDateFormat($row['pres_date']); ?></p>
										</div>
									</div>	
												
											
									</td>
                                    
                                    
                                    
                                    
                                    
                                     <td><?php 
									 
									 $sqlP="select * from tbl_prescriptions where pres_id='".$row['message_pres_id']."'";
									 $resP=$database->get_results($sqlP);
									 $rowP=$resP[0];
									 
									 
									 echo getUserNameByType("clinician",$rowP['pres_prescriber']); ?></td>
                                    
                                    <td class="align-middle">
										
												<?php echo fn_formatDateTime($row['message_date']); ?>
											
									</td>
                                   
                                    
                                   
                                    
                                   
                                    
                                    <td class="align-middle">
										<div class="d-flex">
											<div class="ml-3 mt-1">
												
															<span class="tag tag-pink"><a href="?c=prescriptions&task=detail&id=<?php echo $row['pres_id']?>&message=1" class="tag tag-pink">View Message</a></span>
                                                            
                                                           <!-- <br /><br />
                                                            <a href="#" style="color:#06F">Response Required</a>-->
                                                          

                                                           
											</div>
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

												

										</div>
									</div>
										</div>
										
										
										
										<div class="tab-pane" id="tab10">
											<div class="card-body">
                                            
                                            No invoices yet!
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
												<div class="table-responsive">
                                                
                                                <div style="height:22px"></div>
                             
													
													<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="miles-tables">
														<thead>
															<tr>
																<th class="border-bottom-0 text-center w-5">No</th>
																<th class="border-bottom-0">Log Details</th>
																<th class="border-bottom-0">Date</th>
                                                               
															
																
															</tr>
														</thead>
														<tbody>
                                                        
                                                        <?php $sqlLogs="select * from tbl_logs where log_user_id='".$database->filter($_GET['id'])."' and log_user_type='pharmacy' order by log_id desc";
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
														
														}
														else
														echo "<tr><td colspan='3'>No logs yet!</td></tr>";
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
						<!-- End Row-->

					</div><!-- end app-content-->
				</div>
		</div>
</div>


             <?php } ?>
  