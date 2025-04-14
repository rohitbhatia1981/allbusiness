<?php function showRecordsListing()
{
global $database;

?>



			

						<!--Page header-->
						<div class="page-header d-xl-flex d-block">
							<div class="page-leftheader">
								<h4 class="page-title">Overview<span class="font-weight-normal text-muted ml-2"></span></h4>
							</div>
							<div class="page-rightheader ml-md-auto">
								<div class="d-flex align-items-end flex-wrap my-auto right-content breadcrumb-right">
									<div class="d-lg-flex d-block">
										<div class="btn-list">
											<!--<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newtaskmodal"><i class="feather feather-plus fs-15 my-auto mr-2"></i>Create New Task</a>-->
											<a href="#" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </a>
											<a href="#" class="btn btn-light" data-placement="top" data-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </a>
											<a href="#" class="btn btn-primary" data-placement="top" data-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--End Page header-->
                        
                        <div class="row">
    <div class="col-md-12">
        <div class="card" style="border: 2px solid #4a90e2; border-radius: 10px;">
            <div class="card-header border-bottom-0" style="background: linear-gradient(135deg, #4a90e2 0%, #8e54e9 100%);">
                <h4 class="card-title mb-0" style="color: white; font-weight: 600; text-shadow: 1px 1px 3px rgba(0,0,0,0.3);">Ads Overview</h4>
            </div>
            <div class="card-body" style="background-color: #f8f9fa;">
                <div class="panel panel-primary">
                    <div class="tab-menu-heading p-0" style="background: linear-gradient(to right, #ff9966, #ff5e62);">
                        <div class="tabs-menu1">
                            <!-- Tabs -->
                            <ul class="nav panel-tabs">
                                <li class=""><a href="#tabApril" class="active" data-toggle="tab" style="color: white; font-weight: bold; ">April</a></li>
                                <li class=""><a href="#tabPrevious" data-toggle="tab" style="color: white; font-weight: bold;">Previous Month</a></li>
                                <li><a href="#tabOverall" data-toggle="tab" style="color: white; font-weight: bold;">Overall</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body tabs-menu-body" style="background-color: white; border-radius: 0 0 8px 8px;">
                        <div class="tab-content">

                            <!-- April Tab -->
                            <div class="tab-pane active" id="tabApril">
                                <div class="row mb-0 pb-0">
                                    <?php
                                    $statsSql = "SELECT * FROM tbl_business 
                                        WHERE business_owner_id = '".$database->filter($_SESSION['sess_member_id'])."' 
                                        AND MONTH(business_added_date) = MONTH(CURDATE()) 
                                        AND YEAR(business_added_date) = YEAR(CURDATE())";
                                    $stats = $database->get_results($statsSql);
                                    $postCount = count($stats);
                                    ?>
                                    
                                    <div class="col-md-6 col-lg-2 text-center py-5" style="border-right: 1px dashed #e0e0e0;">
                                        <span class="avatar avatar-md bradius fs-20" style="background-color: #4a90e2; color: white; box-shadow: 0 4px 8px rgba(74,144,226,0.3);"><?php echo $postCount; ?></span>
                                        <h5 class="mb-0 mt-3" style="color: #4a90e2;">Posted in <?php echo date("F") ?></h5>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-2 text-center py-5" style="border-right: 1px dashed #e0e0e0;">
                                        <span class="avatar avatar-md bradius fs-20" style="background-color: #2ecc71; color: white; box-shadow: 0 4px 8px rgba(46,204,113,0.3);">
                                            <?php
                                            $statsSql = "SELECT * FROM tbl_ad_usage 
                                                WHERE usage_agency_id = '".$database->filter($_SESSION['sess_member_id'])."' 
                                                AND MONTH(usage_date) = MONTH(CURDATE()) 
                                                AND YEAR(usage_date) = YEAR(CURDATE())";
                                            $stats = $database->get_results($statsSql);
                                            echo $postCount = count($stats);
                                            ?>
                                        </span>
                                        <h5 class="mb-0 mt-3" style="color: #2ecc71;">Upgraded Ads</h5>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-2 text-center py-5" style="border-right: 1px dashed #e0e0e0;">
                                        <span class="avatar avatar-md bradius fs-20" style="background-color: #e67e22; color: white; box-shadow: 0 4px 8px rgba(230,126,34,0.3);">0</span>
                                        <h5 class="mb-0 mt-3" style="color: #e67e22;">Ad Views</h5>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-2 text-center py-5" style="border-right: 1px dashed #e0e0e0;">
                                        <span class="avatar avatar-md bradius fs-20" style="background-color: #f39c12; color: white; box-shadow: 0 4px 8px rgba(243,156,18,0.3);">0</span>
                                        <h5 class="mb-0 mt-3" style="color: #f39c12;">Search Views</h5>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-2 text-center py-5" style="border-right: 1px dashed #e0e0e0;">
                                        <span class="avatar avatar-md bradius fs-20" style="background-color: #d35400; color: white; box-shadow: 0 4px 8px rgba(211,84,0,0.3);">0</span>
                                        <h5 class="mb-0 mt-3" style="color: #d35400;">Contact View</h5>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-2 text-center py-5">
                                        <span class="avatar avatar-md bradius fs-20" style="background-color: #e74c3c; color: white; box-shadow: 0 4px 8px rgba(231,76,60,0.3);">0</span>
                                        <h5 class="mb-0 mt-3" style="color: #e74c3c;">Leads Received</h5>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Previous Month Tab -->
                            <div class="tab-pane" id="tabPrevious">
                                <div class="row mb-0 pb-0">
                                    <?php
                                    $statsSql = "SELECT * FROM tbl_business 
                                        WHERE business_owner_id = '".$database->filter($_SESSION['sess_member_id'])."' 
                                        AND MONTH(business_added_date) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)) 
                                        AND YEAR(business_added_date) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))";
                                    $stats = $database->get_results($statsSql);
                                    $postCount = count($stats);
                                    ?>
                                    
                                    <div class="col-md-6 col-lg-2 text-center py-5" style="border-right: 1px dashed #e0e0e0;">
                                        <span class="avatar avatar-md bradius fs-20" style="background-color: #4a90e2; color: white;"><?php echo $postCount; ?></span>
                                        <h5 class="mb-0 mt-3" style="color: #4a90e2;">Posted in <?php echo date("F", strtotime("first day of last month")); ?></h5>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-2 text-center py-5" style="border-right: 1px dashed #e0e0e0;">
                                        <span class="avatar avatar-md bradius fs-20" style="background-color: #2ecc71; color: white;">
                                            <?php
                                            $statsSql = "SELECT * FROM tbl_ad_usage 
                                                WHERE usage_agency_id = '".$database->filter($_SESSION['sess_member_id'])."' 
                                                AND MONTH(usage_date) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)) 
                                                AND YEAR(usage_date) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))";
                                            $stats = $database->get_results($statsSql);
                                            echo $postCount = count($stats);
                                            ?>
                                        </span>
                                        <h5 class="mb-0 mt-3" style="color: #2ecc71;">Upgraded Ads</h5>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-2 text-center py-5" style="border-right: 1px dashed #e0e0e0;">
                                        <span class="avatar avatar-md bradius fs-20" style="background-color: #e67e22; color: white;">15</span>
                                        <h5 class="mb-0 mt-3" style="color: #e67e22;">Ad Views</h5>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-2 text-center py-5" style="border-right: 1px dashed #e0e0e0;">
                                        <span class="avatar avatar-md bradius fs-20" style="background-color: #f39c12; color: white;">0</span>
                                        <h5 class="mb-0 mt-3" style="color: #f39c12;">Search Views</h5>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-2 text-center py-5" style="border-right: 1px dashed #e0e0e0;">
                                        <span class="avatar avatar-md bradius fs-20" style="background-color: #d35400; color: white;">0</span>
                                        <h5 class="mb-0 mt-3" style="color: #d35400;">Contact View</h5>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-2 text-center py-5">
                                        <span class="avatar avatar-md bradius fs-20" style="background-color: #e74c3c; color: white;">0</span>
                                        <h5 class="mb-0 mt-3" style="color: #e74c3c;">Leads Received</h5>
                                    </div>
                                </div>
                            </div>

                            <!-- Overall Tab -->
                            <div class="tab-pane" id="tabOverall">
                                <div class="row mb-0 pb-0">
                                    <div class="col-md-6 col-lg-2 text-center py-5" style="border-right: 1px dashed #e0e0e0;">
                                        <span class="avatar avatar-md bradius fs-20" style="background-color: #4a90e2; color: white;">
                                            <?php
                                            $statsSql = "SELECT * FROM tbl_business 
                                                WHERE business_owner_id = '".$database->filter($_SESSION['sess_member_id'])."'";
                                            $stats = $database->get_results($statsSql);
                                            echo $postCount = count($stats);
                                            ?>
                                        </span>
                                        <h5 class="mb-0 mt-3" style="color: #4a90e2;">Total Ads Posted</h5>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-2 text-center py-5" style="border-right: 1px dashed #e0e0e0;">
                                        <span class="avatar avatar-md bradius fs-20" style="background-color: #2ecc71; color: white;">
                                            <?php
                                            $statsSql = "SELECT * FROM tbl_ad_usage 
                                                WHERE usage_agency_id = '".$database->filter($_SESSION['sess_member_id'])."'";
                                            $stats = $database->get_results($statsSql);
                                            echo $postCount = count($stats);
                                            ?>
                                        </span>
                                        <h5 class="mb-0 mt-3" style="color: #2ecc71;">Upgraded Ads</h5>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-2 text-center py-5" style="border-right: 1px dashed #e0e0e0;">
                                        <span class="avatar avatar-md bradius fs-20" style="background-color: #e67e22; color: white;">0</span>
                                        <h5 class="mb-0 mt-3" style="color: #e67e22;">Ad Views</h5>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-2 text-center py-5" style="border-right: 1px dashed #e0e0e0;">
                                        <span class="avatar avatar-md bradius fs-20" style="background-color: #f39c12; color: white;">0</span>
                                        <h5 class="mb-0 mt-3" style="color: #f39c12;">Search Views</h5>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-2 text-center py-5" style="border-right: 1px dashed #e0e0e0;">
                                        <span class="avatar avatar-md bradius fs-20" style="background-color: #d35400; color: white;">0</span>
                                        <h5 class="mb-0 mt-3" style="color: #d35400;">Contact View</h5>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-2 text-center py-5">
                                        <span class="avatar avatar-md bradius fs-20" style="background-color: #e74c3c; color: white;">0</span>
                                        <h5 class="mb-0 mt-3" style="color: #e74c3c;">Leads Received</h5>
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
                        
                        
                        <div class="container mt-4">
                        
                        			<?php
													
													$DaysPremium90=0;
													$DaysPremium180=0;
													$DaysAdvanced90=0;
													$DaysAdvanced180=0;
													
													$statsSql = "SELECT * FROM tbl_agency_ads_inventory where inventory_agency_id='".$database->filter($_SESSION['sess_member_id'])."'";
													$resAdsStats = $database->get_results( $statsSql );
													//$statsCount = count($stats);
													if (count($resAdsStats)>0)
													{
														$rowAdsStats=$resAdsStats[0];
														$DaysPremium90=$rowAdsStats['inventory_premium_90'];
														$DaysPremium180=$rowAdsStats['inventory_premium_180'];
														$DaysAdvanced90=$rowAdsStats['inventory_advanced_90'];
														$DaysAdvanced180=$rowAdsStats['inventory_advanced_180'];
														
													}
														?>
                        
                        

  <!-- Account Header -->
 <div class="row">
  <!-- Ads Card -->
  <div class="col-xl-5 col-lg-12 col-md-12">
								<div class="card">
									<div class="card-header border-0">
										<h4 class="card-title">Ad Balance</h4>
										<div class="card-options mr-3">
											<a href="?c=b-business&task=upgrade&id=<?php echo $row['business_id']; ?>" class="btn btn-indigo btn-sm mb-1">Buy Ad Credits</a>
										</div>
									</div>
									<div class="table-responsive leave_table fs-13 mt-5">
										<table class="table mb-0 text-nowrap">
											<thead class="border-top">
												<tr>
													<th class="text-left">Ad Type</th>
													<th class="text-left">Used</th>
													<th class="text-center">Available</th>
													
												</tr>
											</thead>
											<tbody>
                                            
                                            	<tr class="border-bottom fs-15">
													<td class="text-center d-flex"><span class="bg-info brround d-block mr-3 mt-1 h-3 w-3"></span><span class="font-weight-semibold fs-15">Premium 90 Days</span></td>
													<td class="font-weight-semibold">
                                                    <?php
			 $statsSql = "SELECT * FROM tbl_ad_usage 
             WHERE usage_agency_id = '".$database->filter($_SESSION['sess_member_id'])."'
			 and usage_description='Premium 90 Days'";
			 
          	$stats = $database->get_results($statsSql);
			echo $postCount = count($stats);
?>
                                                    </td>
													<td class="text-center text-muted"><?php echo $DaysPremium90?></td>
													
												</tr>
                                            
												<tr class="border-bottom fs-15">
													<td class="text-center d-flex"><span class="bg-info brround d-block mr-3 mt-1 h-3 w-3"></span><span class="font-weight-semibold fs-15">Premium 180 Days</span></td>
													<td class="font-weight-semibold">8</td>
													<td class="text-center text-muted"><?php echo $DaysPremium180?></td>
													
												</tr>
												<tr class="border-bottom fs-15">
													<td class="text-center d-flex"><span class="bg-orange brround d-block mr-3 mt-1 h-3 w-3"></span><span class="font-weight-semibold fs-15">Advanced 90 Days</span></td>
													<td class="font-weight-semibold">4.5</td>
													<td class="text-center text-muted"><?php echo $DaysAdvanced90; ?></td>
													
												</tr>
												<tr class="border-bottom fs-15">
													<td class="text-center d-flex"><span class="bg-orange brround d-block mr-3 mt-1 h-3 w-3"></span><span class="font-weight-semibold fs-15">Advanced 180 Days</span></td>
													<td class="font-weight-semibold">4.5</td>
													<td class="text-center text-muted"><?php echo $DaysAdvanced180; ?></td>
													
												</tr>
												
											</tbody>
										</table>
									</div>
									
								</div>
							</div>
                            
                            
                            
                            <!--- 7 cols--->
                            
                            <div class="col-xl-7 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header border-0">
										<h4 class="card-title">Recent Leads</h4>
										<div class="card-options mr-3">
											<div> <a href="#" class="btn ripple btn-outline-light dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> See All  </a>
												
											</div>
										</div>
									</div>
									<div class="card-body pt-2">
										<ul class="timeline ">
                                        
                                        
                                        <?php 
											$sqlLogs="select * from tbl_inquiry,tbl_business where business_id=`inquiry_listing_id` and business_owner_id='".$database->filter($_SESSION['sess_member_id'])."'  order by inquiry_id desc limit 0,6";  //
											$resLogs=$database->get_results($sqlLogs); 
											
											if (count($resLogs)>0)
											{
										
										
											for ($j=0;$j<count($resLogs);$j++)
											{
												$rowLogs=$resLogs[$j];
										
										 ?>
										
											<li class="primary mt-6">
												<span class="font-weight-semibold fs-14 ml-3"><?php echo $rowLogs['inquiry_message']; ?></span>
												<span class="float-right fs-13"><?php echo fn_formatDateTime($rowLogs['inquiry_date']) ?></span>
												<p class="mb-0 pb-0 fs-14 ml-3 mt-1">
    <i class="feather feather-user"></i> <?php echo ucfirst($rowLogs['inquiry_name']); ?> &nbsp;|&nbsp;
    <i class="feather feather-phone"></i> <?php echo $rowLogs['inquiry_phone']; ?> &nbsp;|&nbsp; 
    <i class="feather feather-mail"></i> <?php echo $rowLogs['inquiry_email']; ?>
</p>

											</li>
                                          
                                          <?php }
											} else echo "No leads received";?>
											
                                           
										</ul>
									</div>
								</div>
							</div>
                            
                            
						</div>



  <!-- Action Panel -->
  

</div>


						<!-- Row -->
                        


                
  <?php } ?>              