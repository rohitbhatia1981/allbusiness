<div class="top_from" style="display: block;">
    <form action="" method="GET">
        <div class="row align-items-center">
            <!-- Location Search -->
            <div class="col-md-4 mb-2">
                <div style="position: relative; width: 100%;">
                    <div class="search_box" style="position: relative;">
                        <input type="text" class="form-control" id="txtLocation" name="txtLocation" placeholder="Search by suburb, postcode, region" style="width: 100%; padding-left: 35px;">
                        <i class="fa-regular fa-magnifying-glass fa-fw" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); color: #ccc; font-size: 16px;"></i>
                    </div>
                    <input type="hidden" id="hdLocationId" name="location" value="">
                    <div id="suggesstion-box"></div>
                </div>
            </div>

            <!-- Broker Search -->
            <div class="col-md-3 mb-2">
                <input type="text" class="form-control" name="broker" placeholder="Search by Broker Name">
            </div>

            <!-- State Dropdown -->
            <div class="col-md-2 mb-2">
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

            <!-- Region Dropdown -->
            <div class="col-md-2 mb-2">
                <select class="form-control form-select" name="region" id="region_cont">
                    <option value="">All Regions</option>
                    <!-- Options loaded dynamically -->
                </select>
            </div>

            <!-- Search Button -->
            <div class="col-md-1 mb-2 text-end">
                <button type="submit" class="btn btn-primary px-3">
                    <i class="fa-regular fa-magnifying-glass fa-fw"></i> Search
                </button>
            </div>
        </div>

        <input type="hidden" name="selectedCategories" id="selectedCategories" value="<?php echo $preSelectedCategories; ?>">
    </form>
</div>