<form name="adminForm" id="adminForm" action="" method="post" class="form-horizontal">
   
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
                <label class="form-label">Price *</label>
                <input type="text" placeholder="" class="form-control" name="txtAskingPrice" value="<?php  echo $rowBusiness['business_asking_price']?>" required>
                
            </div>
            <div class="col-lg-6" style="padding-top:25px">
            
            		<div class="style-none d-flex filter-input pt-2 ps-2" >
                    <input type="checkbox" value="1" style="height:20px !important" name="ckPOA" <?php if ($rowBusiness['business_poa']==1) echo "checked"; ?>>
                    &nbsp;&nbsp;<label style="font-weight:400">POA (don't display price)</label>
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
                <label class="form-label">Plus Stock</label>
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
            <label class="form-label d-block mb-2">Period Count *</label>
            
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
            <label class="form-label fw-bold">Sales Revenue *</label>
            <div class="input-group">
                <input type="number" class="form-control" name="txtSalesRevenue" value="<?php echo $rowBusiness['business_turnover']?>" required>
                <span class="input-group-text bg-light"><span id="dispPeriod1">/Week</span></span>
            </div>
        </div>

        <div class="dash-input-wrapper mb-3">
            <label class="form-label fw-bold">Rent *</label>
            <div class="input-group">
                <input type="number" class="form-control" name="txtRent" value="<?php echo $rowBusiness['business_rent']?>" required>
                <span class="input-group-text bg-light"><span id="dispPeriod2">/Week</span></span>
            </div>
        </div>
    </div>

    <!-- Right Column (Financial Inputs) -->
    <div class="col-md-6 ps-3">
        <div class="dash-input-wrapper mb-3">
            <label class="form-label fw-bold">Expenses *</label>
            <div class="input-group">
                <input type="number" class="form-control" name="txtExpenses" value="<?php echo $rowBusiness['business_expenses']?>" required>
                <span class="input-group-text bg-light"><span id="dispPeriod3">/Week</span></span>
            </div>
        </div>

        <div class="dash-input-wrapper mb-3">
            <label class="form-label fw-bold">Net Profit *</label>
            <div class="input-group">
                <input type="number" class="form-control" name="txtNetProfit" value="<?php echo $rowBusiness['business_takings_value']?>" required>
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