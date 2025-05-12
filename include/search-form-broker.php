<div class="top_from" style="display: block;">
        <form action="<?php echo URL?>buy-business" method="GET">
    <div class="row">
        <!-- Row 1 -->
        <div class="col-sm-5 mb-2">
            <div style="position: relative; width: 100%;">
                <div class="search_box" style="position: relative;">
                    <input type="text" class="form-control" id="txtLocation" name="txtLocation" placeholder="Search by suburb, postcode, region" style="width: 100%; padding-left: 35px;">
                    <i class="fa-regular fa-magnifying-glass fa-fw" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); color: #ccc; font-size: 16px;"></i>
                </div>
                <input type="hidden" id="hdLocationId" name="location" value="">
                <div id="suggesstion-box"></div>
            </div>
        </div>

        <div class="col-sm-7 mb-2">
            <input type="text" class="form-control" name="broker" placeholder="Search by Broker Name">
        </div>

        <!-- Row 2 -->
        <div class="col-sm-12 mb-2">
            <div class="row">
                <div class="col-4">
                    <div class="form_control_box">
                        <div class="multi-select">
                            <div class="dropdown-disp" id="dropdown">
                                <span id="selectedCount"> Select Categories </span>
                            </div>
                            <div class="dropdown-options" id="dropdownOptions">
                                <?php
                                $preSelectedCategories = $_GET['selectedCategories'];
                                $sqlCategories = "SELECT * FROM tbl_business_category WHERE bc_status = 1 and bc_parent_id=0 ORDER BY bc_parent_id, bc_name";
                                $resCategories = $database->get_results($sqlCategories);
                                if (count($resCategories) > 0) {
                                    foreach ($resCategories as $rowCategories) {
                                        ?>
                                        <div class="option" data-value="<?php echo $rowCategories['bc_id'] ?>" style="background:#e6eaf2"><strong><?php echo $rowCategories['bc_name'] ?></strong></div>
                                        <?php
                                        $sqlSubcat = "SELECT * FROM tbl_business_category WHERE bc_status = 1 and bc_parent_id='" . $rowCategories['bc_id'] . "' ORDER BY bc_name";
                                        $resSubcat = $database->get_results($sqlSubcat);
                                        if (count($resSubcat) > 0) {
                                            foreach ($resSubcat as $rowSubcat) {
                                                ?>
                                                <div class="option" data-value="<?php echo $rowSubcat['bc_id'] ?>"><?php echo $rowSubcat['bc_name'] ?></div>
                                            <?php
                                            }
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <select class="form-control form-select" name="state" id="state_cont" onchange="fnGetRegion()">
                        <option value="">Select States</option>
                        <?php
                        $sqlStates = "SELECT * FROM tbl_states WHERE state_status=1 ORDER BY state_name";
                        $resStates = $database->get_results($sqlStates);
                        if (count($resStates) > 0) {
                            foreach ($resStates as $rowStates) {
                                ?>
                                <option value="<?php echo $rowStates['state_name'] ?>" <?php if ($_GET['state'] == $rowStates['state_name']) echo "selected"; ?>><?php echo $rowStates['state_name'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="col-4">
                    <select class="form-control form-select" name="region" id="region_cont">
                        <option value="">All Regions</option>
                        <!-- Options loaded dynamically -->
                    </select>
                </div>
            </div>
        </div>

        <!-- Search Button in full width -->
        <div class="col-sm-12 text-end mt-2">
            <button type="submit" class="btn btn-primary px-4">
                <i class="fa-regular fa-magnifying-glass fa-fw"></i> Search
            </button>
        </div>
    </div>

    <input type="hidden" name="selectedCategories" id="selectedCategories" value="<?php echo $preSelectedCategories; ?>">
</form>

		</div>
        
