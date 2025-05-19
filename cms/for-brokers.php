<?php include "../private/settings.php";
include PATH."include/headerhtml.php"; 
 ?>
  <body>

  	<?php include PATH."include/header.php"; ?>
<div class="brokers_banner text-center">
	<div class="container">
		<h5>Business Brokers</h5>
		<h2>Advertise your business to over <br> 50,000+ serious buyers</h2>
		<p>List your business on <b>AllBusiness</b> and connect with <br>serious buyers seeking oppurtunities.</p>
		<a href="#reg_broker_form"><button class="btn btn-danger">Apply for a Broker Account</button></a>
	</div>
</div>
<div class="exclusive_offer">
	<div class="container">
		<div class="exclusive_offer_box">
		<div class="row align-items-center">
			<div class="col-sm-6">
				<h3>Unlimited business listings, one fixed price</h3>
				<h5 style="padding-bottom:12px"></h5>
                <p>Get your listings in front of thousands of buyers. Transform your brokerage business with our unlimited listing subscription. Whether you have 5 or 500 listings, your cost stays the same. No hidden fees, no listing caps, no restrictions.</p>
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
		<h3>Transparent pricing & no hidden costs</h3>
		<p>Our fixed subscription helps grow your business with no surprise costs.</p>
		<a href="#reg_broker_form"><button class="btn btn-danger">Apply for a Broker Account</button></a>
	</div>
</div> 


<div class="text-area">
	<div class="container">
    	<div class="text-area-box">
	<h2><b>Sell your Business in Australia</b></h2>
    <h5><b>Advertising Solutions for Business Brokers</b></h5>
   <p>Explore flexible and affordable advertising options crafted specifically for business brokers. Our range of services is designed to help you showcase your business online and attract attention. Whether you're a small or large business broker, we offer customized solutions to meet your unique needs and enhance your visibility.</p> 
   
   <h5><b>Standard Unlimited Listings - Base level  </b></h5>
   
   <h4 style="padding-top:20px"><b>Featured listing products</b></h4>
   <p>Get more views and engage serious buyers with AllBusiness upgraded listing positions. Designed for business brokers who want to accelerate their sales process and maximise listing visibility. Choose between Advanced Placement for better visibility or Ultimate Position for maximum exposure at the top of search results.</p>
   <ul>
   		<li><img class="mx-100" src="<?php echo URL?>images/advance.jpg"> &nbsp; <strong>Advanced ad </strong> <br> Take your listing to the next level with priority placement. Advanced listings appear above standard listings in search results, ensuring better visibility to potential buyers. Available in 90 and 180 day options, this package includes bump credits to refresh your listing's position and analytics to track performance.</li>
        <li><img class="mx-100" src="<?php echo URL?>images/ultimate.jpg"> &nbsp; <strong>Ultimate ad </strong> <br>Get premium visibility with top search placement. Ultimate listings appear at the very top of search results, above both standard and Advanced listings, giving you maximum exposure. With double the bump credits and advanced analytics, your listings maintain premium positioning throughout your campaign. Choose between 90 or 180 days for consistent, top-tier visibility.</li>
   </ul>
   </div>
	</div>
</div>    
<div class="clear"></div>

<div class="lets_get" id="reg_broker_form">
	<div class="container">
		<h3 class="title_h3 text-center">Let's get you set up</h3>
        <p style="text-align:center; width:75%; margin:auto; padding-bottom:15px">Submit the form to register your account, and we'll provide you with the standard listing price and an overview of our upgraded listing products.</p>
		<div class="row">
		
		<div class="col-xl-6 offset-xl-3">
			<form class="form_box" id="frmReg" method="POST">
  <div class="form-row">
    <div class="form-group">
      <label for="txtFirstName">First Name *</label>
      <input type="text" class="form-control" id="txtFirstName" name="txtFirstName" required>
    </div>
    <div class="form-group">
      <label for="txtLastName">Last Name *</label>
      <input type="text" class="form-control" id="txtLastName" name="txtLastName" required>
    </div>
  </div>
  
  <div class="form-row">
    <div class="form-group">
      <label for="txtEmail">Email *</label>
      <input type="email" class="form-control" id="txtEmail" name="txtEmail" required>
    </div>
    <div class="form-group">
      <label for="txtPhone">Phone *</label>
      <input type="text" class="form-control" id="txtPhone" name="txtPhone" required>
    </div>
  </div>
  
  <div class="form-row">
    <div class="form-group">
      <label for="txtCompanyName">Agency Name *</label>
      <input type="text" class="form-control" id="txtCompanyName" name="txtCompanyName" required>
    </div>
    <div class="form-group">
      <label for="txtDirector">Director Name *</label>
      <input type="text" class="form-control" id="txtDirector" name="txtDirector" required>
    </div>
  </div>
   <div class="form-row">
  <div class="form-group">
    <label for="txtBusinessTradingName">Business Trading Name *</label>
    <input type="text" class="form-control" id="txtBusinessTradingName" name="txtBusinessTradingName" required>
  </div>
  
  <div class="form-group">
    <label for="cmbCRM">Select CRM *</label>
    
 <?php
		$sqlCRM="select * from tbl_crm where crm_status=1";
		$resCRM=$database->get_results($sqlCRM);
			
			
	?>
<select class="form-control form-select" name="cmbCRM" id="cmbCRM" required>
      <option value="">Select CRM *</option>
         <?php if (count($resCRM)>0)
			{
				for ($j=0;$j<count($resCRM);$j++)
				{
					$rowCRM=$resCRM[$j];
					 ?>
                <option value="<?php echo $rowCRM['crm_name']; ?>"><?php echo $rowCRM['crm_name']; ?></option>
                <?php } 
			}
		?>
            
            
      </select>
  </div>
  
   <div class="form-group">
    <label for="txtAddress">Address *</label>
    <input type="text" class="form-control" id="txtAddress" name="txtAddress" required>
  </div>
  
  <div class="form-group">
    <label for="txtWebsite">Website (full url with http)</label>
    <input type="url" class="form-control" id="txtWebsite" name="txtWebsite">
  </div>
  
 
  
  <div class="form-check mt-3" style="padding-left:40px">
    <input type="checkbox" class="form-check-input" id="chkAgreement" name="chkAgreement" required>
    <label class="form-check-label" for="chkAgreement">Kindly accept <a href="#">Terms and Conditions</a> of Allbusiness</label>
  </div>
 </div> 
  <div class="form-check mt-3">
    <p class="disclaimer-text">
      By providing your information, you agree to receive emails, phone calls, and/or texts from 
      <strong>Allbusinesses.com.au</strong> for the purpose of promoting products and services that may interest you 
      or benefit your business.
    </p>
  </div>
  
  <button type="submit" id="submitBtn" class="btn btn-primary w100p mt-3 mb-2">Submit</button>
  
  <div id="error-container" style="color:#F00"></div>
</form>

<style>
.form_box {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  border:2px solid #069;
}

.form-row {
  display: flex;
  flex-wrap: wrap;
  margin-right: -15px;
  margin-left: -15px;
}

.form-group {
  flex: 0 0 50%;
  padding: 0 15px;
  margin-bottom: 1rem;
  display: flex;
  flex-direction: column;
}

.form-group label {
  margin-bottom: 0.5rem;
  font-weight: 500;
  text-align: left;
}

.form-control {
  width: 100%;
  padding: 0.375rem 0.75rem;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
}

.form-select {
  height: calc(2.25rem + 2px);
}

.form-check {
  margin-bottom: 1rem;
  text-align: left;
}

.form-check-input {
  margin-top: 0.3rem;
  margin-left: 0;
  margin-right: 0.5rem;
}

.disclaimer-text {
  font-size: 0.9rem;
  color: #6c757d;
}

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}

.w100p {
  width: 100%;
}

.mt-3 {
  margin-top: 1rem;
}

.mb-2 {
  margin-bottom: 0.5rem;
}

@media (max-width: 768px) {
  .form-group {
    flex: 0 0 100%;
  }
}
</style>


	
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

