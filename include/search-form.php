<div class="top_from" style="display: block;">
        <form action="<?php echo URL?>buy-business" method="GET">
			<div class="row">
				<div class="col-sm-5 mb-2">
<div style="position: relative; width: 100%;">
    <div class="search_box" style="position: relative;">
       
        
       
        <input type="text" class="form-control"  id="txtLocation" name="txtLocation" placeholder="Search by suburb, postcode, region" style="width: 100%; padding-left: 35px;">
        <i class="fa-regular fa-magnifying-glass fa-fw" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); color: #ccc; font-size: 16px;"></i>
    </div>
    <input type="hidden" id="hdLocationId" name="location" value="">
    <div id="suggesstion-box"></div>
</div>

				</div>
				<div class="col-sm-7">
      
      <div class="row">
      	<div class="col-6">
                                <div class="form_control_box">
                                    <div class="multi-select">
                <div class="dropdown-disp" id="dropdown" >
                   <span id="selectedCount"> Select Categories </span>
                </div>
                <div class="dropdown-options" id="dropdownOptions">
                
                <?php
				
				$preSelectedCategories=$_GET['selectedCategories'];
				
					$sqlCategories = "SELECT * FROM tbl_business_category WHERE bc_status = 1 and bc_parent_id=0 ORDER BY bc_parent_id, bc_name";
					$resCategories = $database->get_results($sqlCategories);
					if (count($resCategories)>0)
					{
						for ($j=0;$j<count($resCategories);$j++)
						{
							$rowCategories=$resCategories[$j];
							
							
				?>
                
                
                    	<div class="option"  data-value="<?php echo $rowCategories['bc_id'] ?>" style="background:#e6eaf2"><strong><?php echo $rowCategories['bc_name'] ?></strong></div>
                        
                        <?php
							$sqlSubcat = "SELECT * FROM tbl_business_category WHERE bc_status = 1 and bc_parent_id='".$rowCategories['bc_id']."' ORDER BY bc_name";
							$resSubcat = $database->get_results($sqlSubcat);
							if (count($resSubcat)>0)
							{
								for ($k=0;$k<count($resSubcat);$k++)
								{
									$rowSubcat=$resSubcat[$k];
						?>
                        <div class="option" data-value="<?php echo $rowSubcat['bc_id'] ?>"><?php echo $rowSubcat['bc_name'] ?></div>
							
						<?php }
							}?>	
				
                    
                    <?php }
					}?>
                    
                </div>
            </div>
                                    <!--<select class="form-control form-select">
                                        <option>Select States</option>
                                    </select>
                                    <select class="form-control form-select">
                                        <option>Select Region</option>
                                    </select>-->
                                </div>
            </div>
            
          
          	<div class="col-3">
            
             <?php
					$sqlStates = "SELECT * FROM tbl_states where state_status=1 order by state_name";
					$resStates = $database->get_results($sqlStates);
					
							
							
				?>
            
            	<select class="form-control form-select" name="state">
                   <option value="">Select States</option>
                   <?php if (count($resStates)>0)
					{
						for ($j=0;$j<count($resStates);$j++)
						{
							$rowStates=$resStates[$j];
					?>
                    <option value="<?php echo $rowStates['state_name'] ?>" <?php if ($_GET['state']==$rowStates['state_name']) echo "selected"; ?>><?php echo $rowStates['state_name'] ?></option>
                    <?php } 
					}?>
                </select>
            
            </div>
            
            <div class="col-3">
            
            	 <select class="form-control form-select" name="region">
                     <option value="">Select Region</option>
                  </select>
            
            </div>
            
            
            
          </div>
          
          
          
				</div>
				<div class="col-sm-5">
					<div class="form_control_box">
						<select class="form-control form-select" name="min-price">
   					 <option value="">Min Price $</option>
				<?php
                // Generate options for $50,000 to $500,000 with $50,000 increments
                for ($price = 50000; $price <= 500000; $price += 50000) {
                    echo "<option value='{$price}'>\$" . number_format($price) . "</option>";
                }
            
                // Generate options for $500,000 to $10,000,000 with $100,000 increments
                for ($price = 600000; $price <= 10000000; $price += 100000) {
                    echo "<option value='{$price}'>\$" . number_format($price) . "</option>";
                }
                ?>
</select>

						<select class="form-control form-select" name="max-price">
							<option>Max Price $</option>
                            
                             <?php
						// Generate options for $50,000 to $500,000 with $50,000 increments
						for ($price = 50000; $price <= 500000; $price += 50000) {
							echo "<option value='{$price}'>\$" . number_format($price) . "</option>";
						}
					
						// Generate options for $500,000 to $10,000,000 with $100,000 increments
						for ($price = 600000; $price <= 10000000; $price += 100000) {
							echo "<option value='{$price}'>\$" . number_format($price) . "</option>";
						}
    				?>
						</select>
					</div>
				</div>
				<div class="col-sm-7">
					<div class="search_box search_box_button">
						<i class="fa-regular fa-magnifying-glass fa-fw"></i>
					<input type="text" class="form-control" placeholder="Keyword or Business ID">		

						<button><i class="fa-regular fa-magnifying-glass fa-fw"></i> Search</button>
					</div>
				</div>
			</div>
             <input type="hidden" name="selectedCategories" id="selectedCategories" value="<?php echo $preSelectedCategories; ?>">
             </form>
		</div>