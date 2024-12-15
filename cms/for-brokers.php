<?php include "../private/settings.php";
include PATH."include/headerhtml.php"; 
 ?>
  <body>

  	<?php include PATH."include/header.php"; ?>
<div class="brokers_banner text-center">
	<div class="container">
		<h5>Business Brokers: Sell on the Australia's largest business-for-sale marketplace.</h5>
		<h2>Advertise your business to over <br> 50,000+ serious buyers</h2>
		<p>Increase your reach and attract more buyers for your <br> businesses and ventures by advertising on Allbusinesses.</p>
		<a href="#reg_broker_form"><button class="btn btn-danger">Apply for a Broker Account</button></a>
	</div>
</div>
<div class="exclusive_offer">
	<div class="container">
		<div class="exclusive_offer_box">
		<div class="row align-items-center">
			<div class="col-sm-6">
				<h3><span>Exclusive Offer:</span> 6 months of Free Advertising to get you started</h3>
				<p>Get your listings in front of thousands of buyers daily. Choose from plans starting at just $89/month and give your business the exposure it deserves. </p>
				<a href="#reg_broker_form" class="link1">Apply for a Broker Account</a>
			</div>
		
		<div class="col-sm-6">
			<img class="mx-100" src="<?php echo URL?>images/Businessman-11.jpg">
		</div>
	</div>
	</div>
	</div>
</div>
<div class="transparent_pricing text-center">
	<div class="container">
		<h3>Transparent Pricing & No Hidden Costs</h3>
		<p>Our fixed package helps grow your business with no surprise costs.</p>
		<a href="#reg_broker_form"><button class="btn btn-danger">Apply for a Broker Account</button></a>
	</div>
</div> 

<div class="lets_get" id="reg_broker_form">
	<div class="container">
		<h3 class="title_h3 text-center">Let’s get you set up</h3>
		<div class="row">
		
		<div class="col-xl-6 offset-xl-3">
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
      <input type="text" class="form-control" id="txtPhone" name="txtPhone" placeholder="Phone" required>
      <label for="txtPhone">Phone *</label>
    </div>
  </div>
  <div class="form-group">
    <div class="input-container">
      <input type="text" class="form-control" id="txtCompanyName" name="txtCompanyName" placeholder="Company Name" required>
      <label for="txtCompanyName">Company Name *</label>
    </div>
  </div>
  <div class="form-group">
    <div class="input-container">
      <input type="text" class="form-control" id="txtBusinessTradingName" name="txtBusinessTradingName" placeholder="Business Trading Name" required>
      <label for="txtBusinessTradingName">Business Trading Name *</label>
    </div>
  </div>
  <div class="form-group">
    <div class="input-container">
      <input type="text" class="form-control" id="txtAddress" name="txtAddress" placeholder="Address" required>
      <label for="txtAddress">Address *</label>
    </div>
  </div>
  <div class="form-group">
    <div class="input-container">
      <input type="url" class="form-control" id="txtWebsite" name="txtWebsite" placeholder="Website">
      <label for="txtWebsite">Website </label>
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
              window.location = '<?php echo URL?>cms/request-sent';
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

