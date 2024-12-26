<?php include "../private/settings.php";
include PATH."include/headerhtml.php"; 
 ?>
  <body>

  	<?php include PATH."include/header.php"; ?>


 <div class="seller_banner text-center" style="padding:10px">
	<div class="container">
		
		<h2>Signup as a Private Seller</h2>
		<p>Sign up to list your business and get leads</p>
		
	</div>
</div>

<div class="lets_get" id="reg_broker_form">
	<div class="container">
		
		<div class="row">
		
		<div class="col-xl-6 offset-xl-3">
        <!--<h5 align="center">Signup and connect with Business Owners</h5>-->
 <form class="form_box" id="frmReg" method="POST">
  <div class="form-group">
    <div class="input-container">
      <input type="text" class="form-control" id="txtFirstName" name="txtFirstName" placeholder="First Name" required>
      <label for="txtFirstName">First Name *</label>
    </div>
  </div>
  <div class="form-group">
    <div class="input-container">
      <input type="text" class="form-control" id="txtLastName" name="txtLastName" placeholder="Last Name" required>
      <label for="txtLastName">Last Name *</label>
    </div>
  </div>
  <div class="form-group">
    <div class="input-container">
      <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Email" required>
      <label for="txtEmail">Email *</label>
    </div>
  </div>
  <div class="form-group">
    <div class="input-container">
      <input type="text" class="form-control" id="txtPassword" name="txtPassword" placeholder="Password " required>
      
      <label for="txtPassword">Password *</label>
      <span>(Minimum 6 character length)</span>
    </div>
  </div>
  <div class="form-group">
    <div class="input-container">
      <input type="text" class="form-control" id="txtPhone" name="txtPhone" placeholder="Phone" required>
      <label for="txtPhone">Phone *</label>
    </div>
  </div>
 
  <div class="form-check mt-3">
    <input type="checkbox" class="form-check-input" id="chkAgreement" name="chkAgreement" required>
    Kindly accept <a href="#">Terms and Conditions</a> of Allbusiness	
    </div>
  <div class="form-check mt-3">
  By providing your information, you agree to receive emails, phone calls, and/or texts from 
      <strong>Allbusinesses.com.au</strong> for the purpose of promoting products and services that may interest you 
      or benefit your business.
    
  </div>
  <button type="submit" id="submitBtn" class="btn btn-primary w100p mt-3 mb-2">Submit</button>
  
   <div id="error-container" style="color:#F00"></div>
</form>


	
		</div>
		</div>
	</div>
</div>	

<?php include PATH."include/footer.php"; ?>

<script src="<?php echo URL?>js/jquery.validate.js"></script>

<script>

$('#txtPassword').on('focus', function() {
    $(this).attr('type', 'password');
});

  $(document).ready(function() {
	
    $("#frmReg").validate({
      rules: {
        txtFirstName: { required: true },
        txtLastName: { required: true },
        txtEmail: { required: true, email: true },
        txtPhone: { required: true, digits: true, minlength: 10, maxlength: 15 },
		txtPassword: { required: true, minlength: 6, maxlength: 15 },
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
          url: '<?php echo URL?>ajax/insert-private-seller.php',
          type: 'POST',
          data: $(form).serialize(),
          success: function(response) {
            if (response == 1) {
              window.location = '<?php echo URL?>cms/registration-completed';
            } else  {
              $("#error-container").html(response);
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

