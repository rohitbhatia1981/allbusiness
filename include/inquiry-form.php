
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

<form  id="frmContact" method="POST">
  <div class="form-group">
    <div class="input-container" style="margin-bottom:10px">
      <input type="text" class="form-control" id="txtName" name="txtName" placeholder="Full Name" required>
      <label for="txtName">Your Full Name *</label>
    </div>
  </div>
  
  <div class="form-group">
    <div class="input-container" style="margin-bottom:10px">
      <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Email" required>
      <label for="txtEmail">Your Email *</label>
    </div>
  </div>
  
  <div class="form-group" >
    <div class="input-container" style="margin-bottom:10px">
      <input type="text" class="form-control" id="txtPhone" name="txtPhone" placeholder="Phone" required>
      <label for="txtPhone">Your Phone *</label>
    </div>
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

