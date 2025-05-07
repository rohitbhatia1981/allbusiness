

<?php if ($rowProp['business_plan_id']==3)  
$styleListing="background-color:#f0f6ff; border:2px solid #016de4; ";
else if ($rowProp['business_plan_id']==2) 
$styleListing="background-color:#fff; border:1px solid #ff6b2c; ";
else
$styleListing="";
?>

<div class="new_listings_bx buy_business_item" style="<?php echo $styleListing ?>">
			
            <?php if ($rowProp['business_plan_id']==3) { ?>
            <div class="top_bar" style="background-color: #016de4" >
				<img class="site_log" src="<?php echo URL?>images/site_logo.jpg">
				<span><?php echo $rowProp['member_tradingname']; ?></span>
			</div>	
            <?php } ?>
			
            <div class="item_box" >
			<img src="<?php echo $imageurl; ?>" class="listing-image" onClick="window.location='<?php echo $detailLink; ?>'" style="cursor:pointer">

			<h3><a href="<?php echo $detailLink ; ?>" style="text-decoration:none"><?php echo $btitle=str_replace("amp;","",$rowProp['business_heading']); ?></a></h3>
			<h5><?php echo $address; ?></h5>
			<ul class="breadcrumb">
				<li><?php echo getBusinessCategoryName($rowProp['business_category']) ?></li>
				<li>></li>
				<li><a href="#" style="text-decoration:none"><?php echo getBusinessCategoryName($rowProp['business_subcat']) ?></a></li>
			</ul>
			<div class="price_tag"><?php echo str_replace("&amp;","&",$rowProp['business_asking_price']); ?> + SAV</div>
            
           <?php if ($rowProp['business_plan_id']==3) { ?>
			<?php if ($rowProp['business_takings_value']!="") { ?><h5>Takings: $<?php echo number_format($rowProp['business_takings_value'])?> <span><?php echo $rowProp['business_takings']?></span></h5> <?php } ?>
			<?php if ($rowProp['business_lease_amount']!="") { ?><h5>Lease: <?php echo $rowProp['business_lease_amount']; ?>   <span><?php echo $rowProp['business_lease_amount_period']; ?></span></h5><?php } ?>
			<?php if ($rowProp['business_net_profit']!="") { ?><h5>Net profit: <?php echo $rowProp['business_net_profit']; ?> </h5><?php } ?>
            <?php } ?>
            
             <?php if ($rowProp['business_plan_id']==2 || $rowProp['business_plan_id']==3) { ?>
			<p>
            
            <?php
						$propertyDesc = strip_tags($propertyDesc); // Remove HTML tags
						if (strlen($propertyDesc) > 200) {
							$truncatedDesc = substr($propertyDesc, 0, strrpos(substr($propertyDesc, 0, 200), ' ')) . '...';
							echo $truncatedDesc;
						} else {
							echo $propertyDesc;
						}
					?>
                    <div style="height:20px"></div>
                    </p>
            <?php } ?>
            
             <!--<a href="#" class="more">more</a>--> 
			<div class="bottom_bar">
				<button class="enquire_btn<?php if ($rowProp['business_plan_id']==3) echo "_blue"; ?> mb-3" data-listing-id="<?php echo $rowProp['business_id']; ?>">Enquire</button>
				<button class="heart_btn"><i class="fa-light fa-heart"></i> Save</button>
				 <?php if ($rowProp['business_plan_id']==2) { ?>
                <span><?php echo $rowProp['member_tradingname']; ?></span>
                <?php } ?>
			</div>
		</div>
	</div>
            
            
            
            <div id="inquiryModal" class="modal" style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000;">
            
            
    <div class="modal-content"  style="position: relative; margin: 2% auto; width: 80%; max-width: 500px; background: #fff; padding: 20px; border-radius: 8px;">
     <span class="close" style="position: absolute; top: 10px; right: 20px; font-size: 24px; cursor: pointer;">&times;</span>
      <div id="modalContent"></div>
    </div>
</div>



