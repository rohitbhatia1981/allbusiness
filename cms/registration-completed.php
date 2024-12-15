<?php include "../private/settings.php";
include PATH."include/headerhtml.php"; 
 ?>
  <body>

  	<?php include PATH."include/header.php"; ?>


 

<div class="lets_get" id="reg_broker_form">
	<div class="container">
    <p>&nbsp;</p>
		<h3 class="title_h3 text-center">Thank you for signing up!</h3>
		<div class="row">
		
		<div class="col-xl-6 offset-xl-3">
			
            <p>We've sent a verification email to your inbox. Please check your email and click the verification link to activate your account.

<br><br>
Once verified, you can log in and start exploring. <br><br>
If you don't see the email, please check your spam or junk folder.
</p>


	
		</div>
		</div>
	</div>
</div>	

<?php include PATH."include/footer.php"; ?>

<script src="<?php echo URL?>js/jquery.validate.js"></script>

<script>
  $(document).ready(function() {
    $("#frmReg").validate({
      rules: {
        txtFirstName: { required: true },
        txtLastName: { required: true },
        txtEmail: { required: true, email: true },
        txtPhone: { required: true, digits: true, minlength: 10, maxlength: 15 },
        txtCompanyName: { required: true },
        txtBusinessTradingName: { required: true },
        txtWebsite: { url: true },
        txtAddress: { required: true },
        chkAgreement: { required: true }
      },
      messages: {
        txtFirstName: "Please enter your first name",
        txtLastName: "Please enter your last name",
        txtEmail: "Please enter a valid email address",
        txtPhone: "Please enter a valid phone number",
        txtCompanyName: "Please enter your company name",
        txtBusinessTradingName: "Please enter your business trading name",
        txtWebsite: "Please enter a valid website URL",
        txtAddress: "Please enter your address",
        chkAgreement: "You must agree to the terms"
      },
      errorPlacement: function(error, element) {
        // Append error below the input without interfering with the label
        /*if (element.is(":checkbox")) {
          error.insertAfter(element.parent()); // Place errors for checkboxes properly
        } else {
          error.addClass("error-message"); // Add class for styling
          error.insertAfter(element.closest(".form-group"));
        }*/
      },
      highlight: function(element) {
        $(element).addClass("error-input"); // Optional: Add class to input field with error
      },
      unhighlight: function(element) {
        $(element).removeClass("error-input"); // Remove error class on valid input
      },
      submitHandler: function(form) {
        $("#submitBtn").attr('disabled', 'disabled');
        $("#submitBtn").html("<i class='fa fa-spinner fa-spin'></i>");

        $.ajax({
          url: '<?php echo URL?>ajax/send-broker-request.php',
          type: 'POST',
          data: $(form).serialize(),
          success: function(response) {
            if (response == 1) {
              window.location = '<?php echo URL?>cms/thanks';
            } else  {
              $("#error-container").html("Something went wrong, please contact us via contact us form");
              $("#submitBtn").removeAttr('disabled');
              $("#submitBtn").html('Submit');
            }
          },
          error: function(xhr, status, error) {
            console.log(error);
          }
        });

        return false; // Prevent default form submission
      }
    });
  });
</script>

