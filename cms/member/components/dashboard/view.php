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
						<div class="row">
							<div class="col-xl-3 col-lg-6 col-md-12">
								<div class="card">
									<a href="index.php?c=business">
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
													<div class="icon1 bg-danger my-auto  float-right"> <i class="feather feather-users"></i> </div>
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
													<div class="icon1 bg-primary my-auto  float-right"> <i class="feather feather-box"></i> </div>
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
													<div class="icon1 bg-secondary my-auto  float-right"> <i class="feather feather-briefcase"></i> </div>
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
													<div class="icon1 bg-success my-auto  float-right"> <i class="feather feather-file-text"></i> </div>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
						<!-- End Row -->

						

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
											$sqlLogs="select * from tbl_logs order by log_id desc limit 0,6";
											$resLogs=$database->get_results($sqlLogs);
											
											if (count($resLogs)>0)
											{
										
										
											for ($j=0;$j<count($resLogs);$j++)
											{
												$rowLogs=$resLogs[$j];
										
										 ?>
										
											<li class="primary mt-6">
												<a target="_blank" href="#" class="font-weight-semibold fs-14 ml-3"><?php echo $rowLogs['log_activity']; ?></a>
												<a href="#" class="text-muted float-right fs-13"><?php echo fn_formatDateTime($rowLogs['log_date_time']) ?></a>
												<!--<p class="mb-0 pb-0 text-muted fs-14 ml-3 mt-1">Mr. Liam Botham has registered as new Patient</p>-->
											</li>
                                          
                                          <?php }
											}?>
											
                                           
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