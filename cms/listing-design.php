
<div class="new_listings_bx">
				<div class="left">
					<a href="<?php echo $detailLink ; ?>"><img alt="" src="<?php echo $imageurl; ?>" class="listing-image"></a>
				</div>
				<div class="center">
					<ul class="breadcrumb">
						<li><?php echo getBusinessCategoryName($rowProp['business_category']) ?></li> 
						<li>></li>
						<li><a href="#"><?php echo getBusinessCategoryName($rowProp['business_subcat']) ?></a></li>
					</ul>
                    <?php $btitle=str_replace("amp;","",$rowProp['business_heading']); ?>
					<h4><a href="<?php echo $detailLink ; ?>"><?php echo $btitle ?></a></h4>
					<h6><?php echo $address; ?></h6>
					<div class="price_tag"><?php echo str_replace("&amp;","&",$rowProp['business_asking_price']); ?></div>
					<?php if ($rowProp['business_takings_value']!="") { ?><h5>Takings: $<?php echo number_format($rowProp['business_takings_value'])?> <span><?php echo $rowProp['business_takings']?></span></h5> <?php } ?>
					<?php if ($rowProp['business_net_profit']!="") { ?><h5>Net profit: <?php echo $rowProp['business_net_profit']; ?> </h5><?php } ?>
					<p><?php
						$propertyDesc = strip_tags($propertyDesc); // Remove HTML tags
						if (strlen($propertyDesc) > 200) {
							$truncatedDesc = substr($propertyDesc, 0, strrpos(substr($propertyDesc, 0, 200), ' ')) . '...';
							echo $truncatedDesc;
						} else {
							echo $propertyDesc;
						}
					?>
</p>
				</div>
				<div class="right">
					<button class="enquire_btn mb-3" data-listing-id="<?php echo $rowProp['business_id']; ?>" data-business-title="<?php echo $btitle; ?>" >Enquire</button>
					<!--<img alt="" src="<?php echo URL?>images/site_logo.jpg">-->
				</div>
			</div>
            
            
            
            <div id="inquiryModal" class="modal" style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000;">
            
            
    <div class="modal-content" style="position: relative; margin: 2% auto; width: 80%; max-width: 500px; background: #fff; padding: 20px; border-radius: 8px;">
       <span class="close" style="position: absolute; top: 10px; right: 20px; font-size: 24px; cursor: pointer;">&times;</span>

	
        <h3>Contact Business Owner</h3>
        <span id="success-container" style="color:#090;font-size:16px;font-weight:bold;display:none;margin-bottom:100px">Thank you for contacting, your inquiry has been sent to business owner</span>
      
        
        <div id="frmContainer">
        <p id="modalBusinessTitle" style="font-weight: bold;color:#213960"></p>
        
        

        <div class="datail_sidebar">
 				
 				<h5>Advance Business Brokers</h5>
 				<div class="user_info">
 					<img src="<?php echo URL?>images/mask-group.png">
 					<h4>Rick Chang</h4>
 					<h5>0424 415 XXX</h5>
 				</div>
                
                
 				                
                <?php include PATH."include/inquiry-form.php"; ?>
 			</div>
            
       </div>     
            
    </div>
</div>





