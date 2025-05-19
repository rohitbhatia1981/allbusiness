<?php include "../private/settings.php";
include PATH."include/headerhtml.php"; 
 ?>
  <body>

  	<?php include PATH."include/header.php"; ?>


 

<div class="lets_get" id="reg_broker_form">
	<div class="container">
		
		<div class="row">
		
		<div class="col-xl-6 offset-xl-3">
        <h4 align="center">Signup and connect with Business Owners</h4>
        <br><br>
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
  
  <div class="form-group">
    <label for="txtEmail">Email *</label>
    <input type="email" class="form-control" id="txtEmail" name="txtEmail" required>
  </div>
  
  <div class="form-group">
    <label for="txtPassword">Password * <span class="hint-text">(Minimum 6 character length)</span></label>
    <div class="password-wrapper">
      <input type="text" class="form-control" id="txtPassword" name="txtPassword" required minlength="6">
      <button type="button" class="toggle-password" aria-label="Show password">👁️</button>
    </div>
  </div>
  
  <div class="form-group">
    <label for="txtPhone">Phone *</label>
    <input type="tel" class="form-control" id="txtPhone" name="txtPhone" required>
  </div>
  
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="chkAgreement" name="chkAgreement" required>
    <label class="form-check-label" for="chkAgreement">Kindly accept <a href="#">Terms and Conditions</a> of Allbusiness</label>
  </div>
  
  <div class="disclaimer-box">
    <p>
      By providing your information, you agree to receive emails, phone calls, and/or texts from 
      <strong>Allbusinesses.com.au</strong> for the purpose of promoting products and services that may interest you 
      or benefit your business.
    </p>
  </div>
  
  <button type="submit" id="submitBtn" class="btn btn-primary w100p mt-3 mb-2">Submit</button>
  
  <div id="error-container" class="error-message"></div>
</form>

<style>
.form_box {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  
}

.form-row {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  margin-bottom: 15px;
}

.form-row .form-group {
  flex: 1;
  min-width: 200px;
}

.form-group {
  margin-bottom: 1.5rem;
}

.form-group label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 500;
  color: #333;
}

.hint-text {
  font-size: 0.8rem;
  color: #666;
  font-weight: normal;
}

.form-control {
  width: 100%;
  padding: 10px 15px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 1rem;
  transition: border-color 0.3s;
}

.form-control:focus {
  border-color: #007bff;
  outline: none;
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
}

.password-wrapper {
  position: relative;
}

.toggle-password {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  cursor: pointer;
  font-size: 1rem;
  padding: 5px;
}

.form-check {
  margin: 1.5rem 0;
  display: flex;
  align-items: flex-start;
}

.form-check-input {
  margin-right: 10px;
  margin-top: 3px;
}

.form-check-label {
  line-height: 1.4;
}

.disclaimer-box {
  background-color: #f8f9fa;
  border-left: 3px solid #6c757d;
  padding: 10px 15px;
  margin: 1.5rem 0;
  font-size: 0.9rem;
  color: #555;
}

.btn-primary {
  background-color: #007bff;
  border: none;
  padding: 12px;
  font-size: 1rem;
  font-weight: 500;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.btn-primary:hover {
  background-color: #0069d9;
}

.error-message {
  margin-top: 1rem;
  color: #dc3545;
  font-size: 0.9rem;
}

@media (max-width: 600px) {
  .form-row {
    flex-direction: column;
    gap: 0;
  }
  
  .form-row .form-group {
    min-width: 100%;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Toggle password visibility
  const togglePassword = document.querySelector('.toggle-password');
  const passwordInput = document.getElementById('txtPassword');
  
  if (togglePassword && passwordInput) {
    togglePassword.addEventListener('click', function() {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      this.textContent = type === 'password' ? '👁️' : '👁️‍🗨️';
    });
  }
});
</script>


	
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
       
        chkAgreement: { required: true }
      },
      messages: {
        txtFirstName: "Please enter your first name",
        txtLastName: "Please enter your last name",
        txtEmail: "Please enter a valid email address",
        txtPhone: "Please enter a valid phone number",
      
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
          url: '<?php echo URL?>ajax/insert-buyer.php',
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

