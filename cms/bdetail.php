<?php include "../private/settings.php";

$bid=str_replace(".php","",$_GET['id']);
$sqlProp="select * from tbl_business,tbl_members where business_owner_id=member_id and business_id='".$database->filter($bid)."' and business_archive=0 and business_active_status='1'";			
$getProp=$database->get_results($sqlProp);
$totalProp=count($getProp);			

if ($totalProp == 0) {
    print "<script>window.location='" . URL . "404'</script>";
    exit;
} else {
    $rowProp = $getProp[0];
}

$categoryName=getBusinessCategoryName($rowProp['business_category']);
$address = getBusinessAddress($rowProp['business_id']);

$suburb=ucfirst(strtolower($rowProp['business_suburb']));
$fullLocation=ucwords(strtolower($rowProp['business_suburb']))." ".strtoupper($rowProp['business_state'])." ".$rowProp['business_postcode'];

$categoryNameLink=htCategoryName($categoryName)."-for-sale";

$SEO_TITLE = $categoryName." | Business for Sale | ".$address;
$ogTitle = $categoryName." | Business for Sale | ".$address;

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || 
$_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$ogURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];


updateStats('impressions', $rowProp['business_id'], $rowProp['business_agent_id']);

$sqlImages = "SELECT * FROM tbl_business_images WHERE image_business_id='" . $rowProp['business_id'] . "'";
$getImages = $database->get_results($sqlImages);
$totalImages = count($getImages);

if ($totalImages > 0) {
    $ogImg = $getImages[0]['image_s3'];
}


// $address = str_replace(", AUS", "", $rowProp['business_address']);

// Get the current URL
$currentUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$shareUrl = urlencode($currentUrl);

$propertyDesc = str_replace("?", "-", $rowProp['business_description']);
$propertyDesc = str_replace("&amp;", "&", $rowProp['business_description']);

if ($getImages[0]['image_s3'] == "") {
	
	if ($rowImages['image_s3'] == "") 
			{
				if ($rowProp['business_imported']==1)
				$iURL="images/business/i/";
				else
				$iURL="images/business/";
			
           		 $imageurl = URL . "classes/timthumb.php?src=" . URL . $iURL . $rowImages['image_local'] . "&w=500&h=300&zc=1";
			}
	
    $mainImageURL = URL . $iURL . $getImages[0]['image_local'];
} else {
    $imageurl = $getImages[0]['image_s3'];
    $mainImageURL = $getImages[0]['image_s3'];
}


$ogDescription = substr($propertyDesc, 0, 100);
$ogImage = $mainImageURL; // URL to an image representing the page



include PATH."include/headerhtml.php"; 

 ?>
 <style>
 .share-dropdown {
  position: relative;
}

.share-dropdown .share-list {
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  background: #fff;
  border: 1px solid #ddd;
  list-style: none;
  padding: 5px 0;
  z-index: 999;
  min-width: 140px;
}

.share-dropdown:hover .share-list {
  display: block;
}

.share-dropdown .share-list li {
  padding: 5px 15px;
}

.share-dropdown .share-list li a {
  color: #333;
  text-decoration: none;
  display: block;
}

</style>
  <body>

  	<?php include PATH."include/header.php"; ?>
    
    <div class="busiess_tag"><div class="container"><a href="<?php echo URL?>buy-business" style="color:#7A7F87;text-decoration:none " >Business for Sale</a> - <a href="<?php echo URL?>buy-business?location=<?php echo $suburb?>&txtLocation=<?php echo $fullLocation;?>" style="color:#7A7F87; text-decoration:none"><?php echo $suburb;?> Business for Sale</a> - <a href="<?php echo URL?><?php echo $categoryNameLink; ?>" style="color:#7A7F87; text-decoration:none "><?php echo $categoryName; ?> Business </a> - <?php echo $address; ?></div></div>
<div class="listing_screen">
	
 
 <div class="list_detail">
 	<div class="container">
 	<div class="row">
 		<div class="col-sm-8 pe-2 pe-lg-4" id="information_containter">
          <?php if ($rowProp['business_plan_id']==3) {
			  
			  if ($rowProp['member_agency_color']=="")
				$agencyColor="#016de4";
				else
				$agencyColor=$rowProp['member_agency_color'];
			  
			   ?>
            <div class="top_bar" style="background-color: <?php echo $agencyColor; ?>; color:#FFF; display: flex; align-items: center; justify-content: space-between; padding: 10px;">
    <?php if ($rowProp['member_agency_logo'] != "") { ?>
        <div style="width: 200px; height: 40px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
            <img src="<?php echo URL ?>images/agencylogo/<?php echo $rowProp['member_agency_logo']; ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;" alt="">
        </div>
        <span style="font-size: 18px; font-weight: 500;"><?php echo $rowProp['member_tradingname']; ?></span>
    <?php } ?>
</div>

	
            <?php 
			$styleBorderRadius='style="border-radius:0px !important"';
			} ?>
 			<div class="product_img">
 				<img class="detail-image" <?php echo $styleBorderRadius; ?>  src="<?php echo $mainImageURL; ?>">
 				<ul class="share_icon">
  <li><a href="#"><i class="fa-light fa-bookmark"></i> Save</a></li>

  <li class="share-dropdown">
    <a href="#"><i class="fa-solid fa-share-nodes"></i> Share</a>
    <ul class="share-list">
      <li><a href="javascript:;" onClick="shareTo('facebook')">Facebook</a></li>
      <li><a href="javascript:;" onClick="shareTo('twitter')">Twitter</a></li>
      <li><a href="javascript:;" onClick="shareTo('linkedin')">LinkedIn</a></li>
      <li><a href="javascript:;" onClick="shareTo('whatsapp')">WhatsApp</a></li>
    </ul>
  </li>

  <!--<li><a href="javascript:;" onclick=""><i class="fa-solid fa-print"></i> Print</a></li>-->
</ul>

 			</div>	
 			<div class="new_listings_bx">
 			<h4><?php echo str_replace("amp;","",$rowProp['business_heading']); ?></h4>
 			<h6>Business for Sale | <?php echo $address; ?></h6>
 			<ul class="breadcrumb">
				<li><?php echo getBusinessCategoryName($rowProp['business_category']) ?></li> 
				<li>></li>
				<li><?php echo getBusinessCategoryName($rowProp['business_subcat']) ?></li>
			</ul>
			<div class="price_tag"><?php echo str_replace("&amp;","&",$rowProp['business_asking_price']); ?></div>
			<div class="box2">
            
            
            <?php
			$arrBusiness = array();
			
			if ($rowProp['business_category'] != "")
				$arrBusiness['Category'] = getBusinessCategoryName($rowProp['business_category']);
			
			if ($rowProp['business_takings_value'] != "")
				$arrBusiness['Takings'] = "$" . number_format($rowProp['business_takings_value']);
			
			if ($rowProp['business_turnover'] != "")
				$arrBusiness['Turnover'] = str_replace("_", " - ", $rowProp['business_turnover']);
			
			if ($rowProp['business_net_profit'] != "")
				$arrBusiness['Net Profit'] = str_replace("_", " - ", $rowProp['business_net_profit']);
			
			if ($rowProp['business_building_area'] != "")
				$arrBusiness['Building Area'] = $rowProp['business_building_area'];
			
			if ($rowProp['business_property_included'] != "")
				$arrBusiness['Property Sold with Business'] = $rowProp['business_property_included'];
			
			if ($rowProp['business_lease_amount'] != "")
				$arrBusiness['Lease Amount'] = $rowProp['business_lease_amount'] . " " . $rowProp['business_lease_amount_period'];
			
			if ($rowProp['business_lease_end'] != "" && $rowProp['business_lease_end'] != "0000-00-00")
				$arrBusiness['Lease End'] = $rowProp['business_lease_end'];
			
			if ($rowProp['business_further_option'] != "")
				$arrBusiness['Business Further Option'] = $rowProp['business_further_option'];
			
			if ($rowProp['business_franchise'] == "Yes")
				$arrBusiness['Is this a Franchise?'] = "Yes";
			
			if ($rowProp['business_manage_type'] != "--select--" && $rowProp['business_manage_type'] != "")
				$arrBusiness['Management Type'] = $rowProp['business_manage_type'];
			
			if ($rowProp['business_terms'] != "")
				$arrBusiness['Business Terms'] = $rowProp['business_terms'];
			
			if ($rowProp['business_id'] != "")
				$arrBusiness['Listing ID'] = $rowProp['business_id'];

// Uncomment below if necessary
// if ($rowProp['business_plus_sav'] == "1")
//     $arrBusiness['Plus Sav'] = "Yes";

// print_r($arrBusiness);
?>

            
				<h4>Overview</h4>
                
                <?php foreach ($arrBusiness as $key => $value)  { ?>
				<h5><?php echo $key?>: <?php echo $value?> <!--<span>per week</span>--></h5>
                <?php } ?>
				
			</div>
			<div class="BusinessSummary">
				<h4>Description</h4>
             
				<?php //$propertyDesc=str_replace("\n","<br>",$propertyDesc);	
					  //echo $propertyDesc=str_replace("<br><br><br>","<br>",$propertyDesc);
					  
					 echo formatDescriptionSmart($propertyDesc);
				?> 
            
               
			</div>
					
					</div>
 		</div>
 		<div class="col-sm-4">
     	 <?php include PATH."include/inquiry-form.php"; ?>
 		</div>
 	</div>
 	</div>
 </div>
 
 <!--<div class="links_box">
 	<div class="container">
 		<div class="row">
 			<div class="col-sm-3">
 				<h5>Browse by Capital Cities</h5>
 				<ul class="site_map">
 					<li><a href="#">Business for Sale Sydney</a></li>
 					<li><a href="#">Business for Sale Melbourne</a></li>
 					<li><a href="#">Business for Sale Brisbane</a></li>
 					<li><a href="#">Business for Sale Adelaide</a></li>
 					<li><a href="#">Business for Sale Perth</a></li>
 					<li><a href="#">Business for Sale Darwin</a></li>
 					<li><a href="#">Business for Sale Hobart</a></li>
 					<li><a href="#">Business for Sale Canberra</a></li>
 					<li><a href="#">Business for Sale Geelong</a></li>
 					<li><a href="#">Business for Sale Newcastle</a></li>
 					<li><a href="#">Business for Sale Gold Coast</a></li>
 				</ul>
 			</div>
 			<div class="col-sm-3">
 				<h5>Businesses for Sale by States </h5>
 				<ul class="site_map">
 					<li><a href="#">Business for sale in NSW</a></li>
 					<li><a href="#">Business for sale in VIC</a></li>
 					<li><a href="#">Business for sale in QLD</a></li>
 					<li><a href="#">Business for sale in SA</a></li>
 					<li><a href="#">Business for sale in WA</a></li>
 					<li><a href="#">Business for sale in ACT</a></li>
 					<li><a href="#">Business for sale in NT</a></li>
 					<li><a href="#">Business for sale in TAS</a></li>
 				</ul>
 			</div>
 			<div class="col-sm-3">
 				<h5>Browse by Businesses by category</h5>
 				<ul class="site_map">
 					<li><a href="#">Business for sale in NSW</a></li>
 					<li><a href="#">Business for sale in VIC</a></li>
 					<li><a href="#">Business for sale in QLD</a></li>
 					<li><a href="#">Business for sale in SA</a></li>
 					<li><a href="#">Business for sale in WA</a></li>
 					<li><a href="#">Business for sale in ACT</a></li>
 					<li><a href="#">Business for sale in NT</a></li>
 					<li><a href="#">Business for sale in TAS</a></li>
 				</ul>
 			</div>
 		</div>
 	</div>
 </div>-->

<!--<section class="about_section">
	<div class="container">
	
		<h3 class="title_h3">Buy a Business</h3>
		<p>Starting a business from scratch is tough. Buying an established business for sale in Australia can be the answer. By buying an existing business, you can skip the startup hassle and start making profits right away. Magicbricks helps you find the right business for sale in Melbourne and across Victoria, with plans to expand into other states soon. Our platform simplifies the search process, allowing you to find businesses by industry, location, and price range.</p>
		<p>With Magicbricks, investing in an Australian business for sale means investing in certainty and a proven formula. Whether you're interested in small businesses or franchises, we can help you find the right opportunity. Buying a business gives you access to systems, clients, inventory, and leases. It's a smart move for any entrepreneur.</p>
		<p>Melbourne, as Victoria's capital, is a hub for businesses of all sizes. With its pro-business government and favourable taxation, it's a hub for small and start-up companies. Whether you're looking for large corporations or smaller retail operations, Melbourne has options for you.
Find your perfect business for sale today with Magicbricks.</p>
	</div>
</section>-->

<div style="height:60px"></div>

</div>

<?php include PATH."include/footer.php"; ?>

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
			 $("#frmContact").hide();
			 
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
  

function shareTo(platform) {
  const url = encodeURIComponent(window.location.href);
  const title = encodeURIComponent(document.title);

  let shareUrl = '';

  switch (platform) {
    case 'facebook':
      shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
      break;
    case 'twitter':
      shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
      break;
    case 'linkedin':
      shareUrl = `https://www.linkedin.com/shareArticle?mini=true&url=${url}&title=${title}`;
      break;
    case 'whatsapp':
      shareUrl = `https://wa.me/?text=${title}%20${url}`;
      break;
    default:
      return;
  }

  window.open(shareUrl, '_blank', 'width=600,height=500');
}





</script>
