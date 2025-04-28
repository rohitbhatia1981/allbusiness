<?php include "../private/settings.php";
include PATH."include/headerhtml.php"; 
?>
<body>

  	<?php include PATH."include/header.php"; ?>

<div class="brokers_banner text-center" style="padding:10px">
	<div class="container" style="height:70px">
		<h2 style="font-size:24px; padding-top:20px">Login to Your Account</h2>
       
		<!--<p>Access your saved inquiries, favorites, and explore exciting business opportunities!</p>-->
	</div>
</div>

<div class="lets_get" id="login_form">
	<div class="container">
		<div class="row">
			<div class="col-xl-6 offset-xl-3">
			<div id="error-container" style="color:#F00;padding-bottom:10px" align="center"></div>
				<form class="form_box" id="frmLogin" method="POST">
					<div class="form-group">
						<div class="input-container">
							<input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Email" required>
							<label for="txtEmail">Email *</label>
						</div>
					</div>
					<div class="form-group">
						<div class="input-container">
							<input type="text" class="form-control" id="txtPassword" name="txtPassword" placeholder="Password" required>
							<label for="txtPassword">Password *</label>
						
						</div>
					</div>
					
					<button type="submit" id="loginBtn" class="btn btn-primary w100p mt-3 mb-2">Login</button>
					<div class="text-center mt-2">
						<a href="#" class="link1">Forgot Password?</a> | 
						<a href="<?php echo URL?>buyer-signup" class="link1">Create an Account</a>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>

<?php include PATH."include/footer.php"; ?>

<script src="<?php echo URL?>js/jquery.validate.js"></script>

<script>
$(document).ready(function() {
	$("#frmLogin").validate({
		rules: {
			txtEmail: { required: true, email: true },
			txtPassword: { required: true}
		},
		messages: {
			txtEmail: "Please enter a valid email address",
			txtPassword: "Please enter password"
		},
		 errorPlacement: function(error, element) {
      
      },
		highlight: function(element) {
			$(element).addClass("error-input");
		},
		unhighlight: function(element) {
			$(element).removeClass("error-input");
		},
		submitHandler: function(form) {
			$("#loginBtn").attr('disabled', 'disabled');
			$("#loginBtn").html("<i class='fa fa-spinner fa-spin'></i>");

			$.ajax({
				url: '<?php echo URL?>ajax/checklogin.php',
				type: 'POST',
				data: $(form).serialize(),
				success: function(response) {
					if (response == 1) {
						window.location = '<?php echo URL?>cms/member/';
					} else {
						$("#error-container").html(response);
						$("#loginBtn").removeAttr('disabled');
						$("#loginBtn").html('Login');
					}
				},
				error: function(xhr, status, error) {
					console.log(error);
				}
			});

			return false;
		}
	});
});

$('#txtPassword').on('focus', function() {
    $(this).attr('type', 'password');
});
</script>
