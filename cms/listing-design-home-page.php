
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
					<button class="enquire_btn mb-3" id="enquire_btn" data-listing-id="<?php echo $rowProp['business_id']; ?>" data-business-title="<?php echo $btitle; ?>" >Enquire</button>
					<!--<img alt="" src="<?php echo URL?>images/site_logo.jpg">-->
				</div>
			</div>
            
            
            
            





