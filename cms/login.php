<?php include "../private/settings.php";
include PATH."include/headerhtml.php"; 
?>
<body>

  	<?php include PATH."include/header.php"; ?>



<div class="lets_get" id="login_form">
	<div class="container">
		<div class="row">
			<div class="col-xl-6 offset-xl-3">
            <br><br>
			<div id="error-container" style="color:#F00;padding-bottom:10px" align="center"></div>
				<form class="form_box" id="frmLogin" method="POST">
  <div class="form-header">
    <h2>Welcome Back</h2>
    <p>Please enter your credentials to login</p>
  </div>
  
  <div class="form-group">
    <label for="txtEmail">Email Address *</label>
    <div class="input-with-icon">
      <input type="email" class="form-control" id="txtEmail" name="txtEmail" tabindex="1" required>
      <span class="input-icon">✉️</span>
    </div>
  </div>
  
  <div class="form-group">
    <div class="label-row">
      <label for="txtPassword">Password *</label>
      <a href="#" class="forgot-password" >Forgot Password?</a>
    </div>
    <div class="input-with-icon">
      <input type="password" tabindex="2" class="form-control" id="txtPassword" name="txtPassword" required>
      <span class="input-icon">🔒</span>
      <button type="button" tabindex="3" class="toggle-password" aria-label="Toggle password visibility">👁️</button>
    </div>
  </div>
  
 <br>
  
  <button type="submit" tabindex="4" id="loginBtn" class="btn btn-primary w100p">
    <span class="btn-text">Login</span>
    <span class="spinner hidden"></span>
  </button>
  
  <div class="form-footer">
    <p>Don't have an account? <a href="<?php echo URL?>buyer-signup" class="signup-link">Create one</a></p>
  </div>
  
  <div id="login-error" class="error-message hidden"></div>
</form>

<style>
.form_box {
  max-width: 400px;
  margin: 0 auto;
  padding: 2rem;
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.form-header {
  text-align: center;
  margin-bottom: 2rem;
}

.form-header h2 {
  font-size: 1.5rem;
  color: #2d3748;
  margin-bottom: 0.5rem;
}

.form-header p {
  color: #718096;
  font-size: 0.9rem;
}

.form-group {
  margin-bottom: 1.5rem;
}

.form-group label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 500;
  color: #4a5568;
}

.input-with-icon {
  position: relative;
}

.input-with-icon .input-icon {
  position: absolute;
  left: 12px;
  top: 50%;
  transform: translateY(-50%);
  color: #a0aec0;
}

.input-with-icon .form-control {
  width: 100%;
  padding: 12px 12px 12px 40px;
  border: 1px solid #e2e8f0;
  border-radius: 6px;
  font-size: 1rem;
  transition: all 0.3s ease;
}

.input-with-icon .form-control:focus {
  border-color: #4299e1;
  box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2);
  outline: none;
}

.toggle-password {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  cursor: pointer;
  color: #a0aec0;
  padding: 0;
}

.label-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.forgot-password {
  font-size: 0.85rem;
  color: #4299e1;
  text-decoration: none;
}

.forgot-password:hover {
  text-decoration: underline;
}

.form-options {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
}

.remember-me {
  display: flex;
  align-items: center;
}

.remember-me input {
  margin-right: 8px;
}

.btn-primary {
  width: 100%;
  padding: 12px;
  background-color: #4299e1;
  color: white;
  border: none;
  border-radius: 6px;
  font-size: 1rem;
  font-weight: 500;
  cursor: pointer;
  transition: background-color 0.3s;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 8px;
}

.btn-primary:hover {
  background-color: #3182ce;
}
.btn-text {color:#FFF !important;
font-size:18px !important;
}

.spinner {
  width: 18px;
  height: 18px;
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-radius: 50%;
  border-top-color: white;
  animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

.hidden {
  display: none;
}

.form-footer {
  text-align: center;
  margin-top: 1.5rem;
  color: #718096;
  font-size: 0.9rem;
}

.signup-link {
  color: #4299e1;
  text-decoration: none;
  font-weight: 500;
}

.signup-link:hover {
  text-decoration: underline;
}

.error-message {
  color: #e53e3e;
  font-size: 0.9rem;
  margin-top: 1rem;
  padding: 8px 12px;
  background-color: #fff5f5;
  border-radius: 4px;
  border-left: 3px solid #e53e3e;
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

  // Form submission loading state
  const loginForm = document.getElementById('frmLogin');
  const loginBtn = document.getElementById('loginBtn');
  const btnText = loginBtn.querySelector('.btn-text');
  const spinner = loginBtn.querySelector('.spinner');
  const errorContainer = document.getElementById('login-error');

  if (loginForm) {
    loginForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Show loading state
      btnText.textContent = 'Logging in...';
      spinner.classList.remove('hidden');
      loginBtn.disabled = true;
      errorContainer.classList.add('hidden');
      
      // Simulate form submission (replace with actual AJAX call)
      setTimeout(() => {
        // Reset form state
        btnText.textContent = 'Login';
        spinner.classList.add('hidden');
        loginBtn.disabled = false;
        
        // Show error for demo purposes (remove in production)
        errorContainer.textContent = 'Invalid email or password';
        errorContainer.classList.remove('hidden');
      }, 1500);
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
