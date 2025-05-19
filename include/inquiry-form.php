
<div class="datail_sidebar sticky-form">
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

<form id="frmContact" method="POST" class="compact-contact-form">
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
  
  <div class="form-group">
    <textarea class="form-control" rows="3" name="txtMessage" id="txtMessage" placeholder="Your message..."><?php 
      if ($bid != "") { 
        echo "I am interested in ".getBusinessName($bid); 
      } 
    ?></textarea>
  </div>
  
  <input type="hidden" id="listingId" name="listingId" value="<?php echo $bid; ?>">
  
  <button type="submit" id="submitBtn" class="btn btn-primary w100p">Send Message</button>
  
  <!--<div id="error-container" class="error-message"></div>-->
</form>

<style>

</style>


<div id="success-container" style="color:#093;display:none">Thank you for contacting us! Your inquiry has been sent, and you will be contacted soon.</div>
</div>

<style>
.sticky-form {
  position: sticky;
  top: 50px; /* Adjust this offset as needed (e.g., height of your header) */
  z-index: 99;
}

</style>

