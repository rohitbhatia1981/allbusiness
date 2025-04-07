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

						<!-- Row -->
                         <h5>Ads Performance</h5>
						<div class="row">
							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									<a href="index.php?c=b-business">
										<div class="card-body">
											<div class="row">
                                           
												<div class="col-7">
													<div class="mt-0 text-left" >
                                                    
                                                    <?php
													//$statsSql = "SELECT * FROM tbl_patients where 1";
													//$stats = $database->get_results( $statsSql );
													//$statsCount = count($stats);
									
													?>
                                                    
														<span class="fs-16 font-weight-semibold">Total Business</span>
													  <h3 class="mb-0 mt-1 text-danger  fs-25"><?php
													$statsSql = "SELECT * FROM tbl_business where business_owner_id='".$database->filter($_SESSION['sess_member_id'])."'";
													$stats = $database->get_results( $statsSql );
													echo $statsCount = count($stats);
									
													?></h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-danger my-auto  float-right"> <i class="feather feather-briefcase"></i> </div>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>
							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									<a href="index.php?c=brokers">
										<div class="card-body">
											<div class="row">
												<div class="col-7">
													<div class="mt-0 text-left">
														<span class="fs-16 font-weight-semibold">Total Views</span>
														<h3 class="mb-0 mt-1 text-primary  fs-25">
                                                        
                                                        <?php
													/*$statsSql = "SELECT * FROM tbl_members where member_type=1";
													$stats = $database->get_results( $statsSql );
													echo $statsCount = count($stats);*/
													
									
													?>0
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-primary my-auto  float-right"> <i class="feather feather-eye"></i> </div>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>
							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									<a href="index.php?c=private-sellers">
										<div class="card-body">
											<div class="row">
												<div class="col-7">
													<div class="mt-0 text-left">
														<span class="fs-16 font-weight-semibold">Total Clicks</span>
														<h3 class="mb-0 mt-1 text-secondary fs-25">
                                                        
                                                         <?php
													/*$statsSql = "SELECT * FROM tbl_members where member_type=2";
													$stats = $database->get_results( $statsSql );
													echo $statsCount = count($stats);*/
													
									
													?>0
                                                        
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-secondary my-auto  float-right"> <i class="feather feather-target"></i> </div>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>
							<div class="col-xl-3 col-lg-6 col-md-12">
								<a href="index.php?c=messages">
									<div class="card">
										<div class="card-body">
											<div class="row">
												<div class="col-7">
													<div class="mt-0 text-left">
														<span class="fs-16 font-weight-semibold">Leads</span>
														<h3 class="mb-0 mt-1 text-success fs-25">
                                                        
                                                        
                                                        <?php
													//$statsSql = "SELECT * FROM tbl_prescriptions where pres_stage>0";
													//$stats = $database->get_results( $statsSql );
													//echo $statsCount = count($stats);
													
													echo "0";
									
													?>
                                                        
                                                        
                                                        </h3>
													</div>
												</div>
												<div class="col-5">
													<div class="icon1 bg-success my-auto  float-right"> <i class="feather feather-inbox"></i> </div>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
                        
                        <?php 		
						
						if ($_SESSION['sess_member_groupid']==5) { ?>
						<!-- End Row -->
                         <h5>Premium and Advanced Ads Credits &nbsp;&nbsp;<a href="?c=b-business&task=upgrade&id=<?php echo $row['business_id']; ?>" class="btn btn-indigo btn-sm mb-1">Buy Ad Credits</a></h5>
                        <div class="row">
							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									
										<div class="card-body">
											<div class="row">
												<div class="col-12">
													<div class="mt-0 text-left" >
                                                    
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
														
														<span class="fs-16 font-weight-semibold">Premium Ads (90 Days)</span>
														  <h3 class="mb-0 mt-1 text-danger  fs-25"><?php
														echo $DaysPremium90;
													
									
													?></h3>
													</div>
												</div>
												
											</div>
										</div>
									
								</div>
							</div>
							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									
										<div class="card-body">
											<div class="row">
												<div class="col-12">
													<div class="mt-0 text-left" >
                                                    
                                                  
                                                    
													<span class="fs-16 font-weight-semibold">Premium Ads (180 Days)</span>
													  <h3 class="mb-0 mt-1 text-danger  fs-25"><?php
													echo $DaysPremium180;
									
													?></h3>
													</div>
												</div>
												
											</div>
										</div>
									
								</div>
							</div>
							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									
										<div class="card-body">
											<div class="row">
												<div class="col-12">
													<div class="mt-0 text-left" >
                                                    
                                                    
                                                    
													<span class="fs-16 font-weight-semibold">Advanced Ads (90 Days)</span>
													  <h3 class="mb-0 mt-1 text-danger  fs-25"><?php
													echo $DaysAdvanced90;
									
													?></h3>
													</div>
												</div>
												
											</div>
										</div>
									
								</div>
							</div>
							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									
										<div class="card-body">
											<div class="row">
												<div class="col-12">
													<div class="mt-0 text-left" >
                                                    
                                                    
                                                    
													<span class="fs-16 font-weight-semibold">Advanced Ads (180 Days)</span>
													  <h3 class="mb-0 mt-1 text-danger  fs-25"><?php
													echo $DaysAdvanced180;
									
													?></h3>
													</div>
												</div>
												
											</div>
										</div>
									
								</div>
							</div>
						</div>

						<?php } ?>

						<!--Row-->
						<div class="row">
                        
                        <div class="col-xl-12 col-md-12 col-lg-12">
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
						<!-- End Row -->

						<!--Row-->
						
						<!-- End Row-->

						<!--Row-->
						
						<!-- End Row-->


                
  <?php } ?>              