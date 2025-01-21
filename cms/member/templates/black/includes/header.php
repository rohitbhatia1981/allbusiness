						<!--app header-->
						<div class="app-header header">
							<div class="container-fluid">
								<div class="d-flex">
									<a class="header-brand" href="#">
										<img src="<?php echo URL?>images/logo.png" class="header-brand-img desktop-lgo" alt="">
										<img src="<?php echo URL?>images/logo.png" class="header-brand-img dark-logo" alt="">
										<img src="<?php echo URL?>images/logo.png" class="header-brand-img mobile-logo" alt="">
										<img src="<?php echo URL?>images/logo.png" class="header-brand-img darkmobile-logo" alt="">
									</a>
									<div class="app-sidebar__toggle" data-toggle="sidebar">
										<a class="open-toggle" href="#">
											<i class="feather feather-menu"></i>
										</a>
										<a class="close-toggle" href="#">
											<i class="feather feather-x"></i>
										</a>
									</div>
									<div class="mt-0">
										<form class="form-inline">
											<div class="search-element">
												<input type="search" class="form-control header-search" placeholder="Search…" aria-label="Search" tabindex="1">
												<button class="btn btn-primary-color" >
													<i class="feather feather-search"></i>
												</button>
											</div>
										</form>
									</div><!-- SEARCH -->
									<div class="d-flex order-lg-2 my-auto ml-auto">
										<a class="nav-link my-auto icon p-0 nav-link-lg d-md-none navsearch" href="#" data-toggle="search">
											<i class="feather feather-search search-icon header-icon"></i>
										</a>
										
								
										<div class="dropdown profile-dropdown">
											<a href="#" class="nav-link pr-1 pl-0 leading-none" data-toggle="dropdown">
												<span>
													<img src="../admin/templates/black/assets/images/users/16.jpg" alt="img" class="avatar avatar-md bradius">
												</span>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
												<!--<div class="p-3 text-center border-bottom">
													<a href="#" class="text-center user pb-0 font-weight-bold">Pharma Health</a>
													<p class="text-center user-semi-title">Admin</p>
												</div>-->
												<a class="dropdown-item d-flex" href="#">
													<i class="feather feather-user mr-3 fs-16 my-auto"></i>
													<div class="mt-1">Profile</div>
												</a>
												<a class="dropdown-item d-flex" href="#">
													<i class="feather feather-settings mr-3 fs-16 my-auto"></i>
													<div class="mt-1">Settings</div>
												</a>
												<a class="dropdown-item d-flex" href="#">
													<i class="feather feather-mail mr-3 fs-16 my-auto"></i>
													<div class="mt-1">Messages</div>
												</a>
												<a class="dropdown-item d-flex" href="#" data-toggle="modal" data-target="#changepasswordnmodal">
													<i class="feather feather-edit-2 mr-3 fs-16 my-auto"></i>
													<div class="mt-1">Change Password</div>
												</a>
												<a class="dropdown-item d-flex" href="<?php echo URL.FOLDER_MEMBER?>logout.php">
													<i class="feather feather-power mr-3 fs-16 my-auto"></i>
													<div class="mt-1">Sign Out</div>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--/app header-->