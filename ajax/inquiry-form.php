 <?php include "../private/settings.php";

$bid=$_GET['listing_id'];

$sqlProp="select * from tbl_business,tbl_members where business_owner_id=member_id and business_id='".$database->filter($bid)."' and business_archive=0 and business_active_status='1'";			
$getProp=$database->get_results($sqlProp);
$totalProp=count($getProp);	
$rowProp = $getProp[0];	
 
 ?>

 
  

	
        <h3>Contact Business Owner</h3>
        <span id="success-container" style="color:#090;font-size:16px;font-weight:bold;display:none;margin-bottom:100px">Thank you for contacting, your inquiry has been sent to business owner</span>
      
        
        <div id="frmContainer">
        <p id="modalBusinessTitle" style="font-weight: bold;color:#213960"></p>
 
 			
            
       </div>     


<div class="datail_sidebar">
<h5><?php if ($rowProp['member_type']==2) echo "Private Seller";
				else if ($rowProp['member_type']==1) echo $rowProp['member_company']." Broker";
?></h5>
 				<div class="user_info">
 					<img src="<?php echo URL?>images/mask-group.png">
 					<h4><?php echo $rowProp['member_firstname']." ".$rowProp['member_lastname']; ?></h4>
 					<?php if ($rowProp['business_imported']==0) { ?>
                    <h5><!--0424 415 XXX--><?php echo $rowProp['member_phone']; ?></h5>
                    <?php } ?>
 				</div>

<form  id="frmContact" method="POST" class="compact-contact-form">
  <div class="form-group">
   <div class="form-group icon-input">
    <span class="input-icon">👤</span>
    <input type="text" class="form-control" id="txtName" name="txtName" placeholder="Full Name *" required>
  </div>
  
  <div class="form-group icon-input">
    <span class="input-icon">✉️</span>
    <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Email *" required>
  </div>
  
  <div class="form-group icon-input">
    <span class="input-icon">📞</span>
    <input type="text" class="form-control" id="txtPhone" name="txtPhone" placeholder="Phone *" required>
  </div>
  
  <div class="form-group" >
  	 <div class="input-container" style="margin-bottom:10px">
     <?php if ($bid!="") { 
	 $txtMessage="I am interested in ".getBusinessName($bid);
	 } ?>
 		<textarea class="form-control" rows="2" placeholder="" name="txtMessage" id="txtMessage"><?php echo $txtMessage; ?></textarea>
     </div>
 	</div>
  
 
 <!-- <div class="form-check mt-3">
    <input type="checkbox" class="form-check-input" id="chkAgreement" name="chkAgreement" >
   		<span style="font-size:13px">I I'd like to setup an account for quicker inquiries during my next visit.</span>
    </div>-->
  
  <button type="submit" id="submitBtn" class="btn btn-primary w100p mt-3 mb-2">Submit</button>
  
   <div id="error-container" style="color:#F00"></div>
   
  
   
   <input type="hidden" id="listingId" name="listingId" value="<?php echo $bid; ?>">
</form>
</div>

<script src="<?php echo URL?>js/jquery.validate.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<script>



  $(document).ready(function() {
	
    $("#frmContact").validate({
      rules: {
        txtName: { required: true },        
        txtEmail: { required: true, email: true },
        txtPhone: { required: true, digits: true, minlength: 10, maxlength: 15 },
		txtMessage: { required: true }
		
      },
      messages: {
        txtFirstName: "Please enter name",
      
        txtEmail: "Please enter a valid email address",
        txtPhone: "Please enter a valid phone number",
		txtMessage: "Please enter message",
       
      },
	   errorPlacement: function(error, element) {
      
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
          url: '<?php echo URL?>ajax/send-inquiry.php',
          type: 'POST',
          data: $(form).serialize(),
          success: function(response) {
            if (response == 1) {
             $("#success-container").show();
			 $("#frmContainer").hide();
			 
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