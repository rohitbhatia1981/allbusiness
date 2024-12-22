<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="DayOne - It is one of the Major Dashboard Template which includes - HR, Employee and Job Dashboard. This template has multipurpose HTML template and also deals with Task, Project, Client and Support System Dashboard." name="description">
		<meta content="Spruko Technologies Private Limited" name="author">
		<meta name="keywords" content="admin dashboard, admin panel template, html admin template, dashboard html template, bootstrap 4 dashboard, template admin bootstrap 4, simple admin panel template, simple dashboard html template,  bootstrap admin panel, task dashboard, job dashboard, bootstrap admin panel, dashboards html, panel in html, bootstrap 4 dashboard"/>

		<!-- Title -->
		<title><?php echo TITLE; ?>- Administration</title>

		<!--Favicon -->
		<link rel="icon" href="<?php echo URL?><?php echo FOLDER_MEMBER?>templates/black/assets/images/brand/favicon.ico" type="image/x-icon"/>

		<!-- Bootstrap css -->
		<link href="<?php echo URL?><?php echo FOLDER_MEMBER?>templates/black/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" />

		<!-- Style css -->
		<link href="<?php echo URL?><?php echo FOLDER_MEMBER?>templates/black/assets/css/style.css" rel="stylesheet" />
		<link href="<?php echo URL?><?php echo FOLDER_MEMBER?>templates/black/assets/css/dark.css" rel="stylesheet" />
		<link href="<?php echo URL?><?php echo FOLDER_MEMBER?>templates/black/assets/css/skin-modes.css" rel="stylesheet" />

		<!-- Animate css -->
		<link href="<?php echo URL?><?php echo FOLDER_MEMBER?>templates/black/assets/css/animated.css" rel="stylesheet" />

		<!---Icons css-->
		<link href="<?php echo URL?><?php echo FOLDER_MEMBER?>templates/black/assets/css/icons.css" rel="stylesheet" />

		<!-- Select2 css -->
		<link href="<?php echo URL?><?php echo FOLDER_MEMBER?>templates/black/assets/plugins/select2/select2.min.css" rel="stylesheet" />

		<!-- P-scroll bar css-->
		<link href="<?php echo URL?><?php echo FOLDER_MEMBER?>templates/black/assets/plugins/p-scrollbar/p-scrollbar.css" rel="stylesheet" />

	</head>

	<body>

		<div class="page login-bg">
			<div class="page-single">
				<div class="container">
					<div class="row">
						<div class="col mx-auto">
							<div class="row justify-content-center">
								<div class="col-md-7 col-lg-5">
									<div class="card" style="top:15%;">
										<div class="pt-3 text-center">
											<h1 class="mb-2">Login</h1>
											<p class="text-muted">Sign In to your account</p>
											<span class="error" align="center">
											<?php echo $error;?>
											</span>
										</div>
										<form class="card-body" id="login" name="login" method="post">
											<div class="form-group">
												<label class="form-label"> Username</label>
												
												<input class="form-control" placeholder="Username" type="test" name="username">
											</div>
											<div class="form-group">
												<label class="form-label">Password</label>
												<input class="form-control" placeholder="password" type="password" name="password">
											</div>
											<div class="form-group">
												<label class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1">
													<span class="custom-control-label">Remember me</span>
												</label>
											</div>
											<div class="submit">
												
												<input type="submit" name="submit" value="Login" class="btn btn-primary btn-block">
											</div>
										</form>
										<!--<div class="card-body border-top-0 pb-6 pt-2">
											<div class="text-center">
												<span class="avatar brround mr-3 bg-primary-transparent text-primary"><i class="ri-facebook-line"></i></span>
												<span class="avatar brround mr-3 bg-primary-transparent text-primary"><i class="ri-instagram-line"></i></span>
												<span class="avatar brround mr-3 bg-primary-transparent text-primary"><i class="ri-twitter-line"></i></span>
											</div>
										</div>-->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Jquery js-->
		<script src="<?php echo URL?><?php echo FOLDER_MEMBER?>templates/black/assets/plugins/jquery/jquery.min.js"></script>

		<!-- Bootstrap4 js-->
		<script src="<?php echo URL?><?php echo FOLDER_MEMBER?>templates/black/assets/plugins/bootstrap/popper.min.js"></script>
		<script src="<?php echo URL?><?php echo FOLDER_MEMBER?>templates/black/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

		<!-- Select2 js -->
		<script src="<?php echo URL?><?php echo FOLDER_MEMBER?>templates/black/assets/plugins/select2/select2.full.min.js"></script>

		<!-- P-scroll js-->
		<script src="<?php echo URL?><?php echo FOLDER_MEMBER?>templates/black/assets/plugins/p-scrollbar/p-scrollbar.js"></script>

		<!-- Custom js-->
		<script src="<?php echo URL?><?php echo FOLDER_MEMBER?>templates/black/assets/js/custom.js"></script>

	</body>
</html>
