<?php include "../private/settings.php";
/*
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

*/

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
    
    <div class="busiess_tag"><div class="container">Broker Detail <?php echo $address; ?></div></div>
<div class="listing_screen">
	
 
 <div class="list_detail">
 	<div class="container">
 	<div class="row">
 		<div class="col-sm-8 pe-2 pe-lg-4" id="information_containter">
         
 				
 			<div class="new_listings_bx" style="margin-top: 20px;">
             <img src="<?php echo URL?>images/logo_6700.jpeg" class="listing-image" alt="" style=" max-width: 200px; object-fit: contain; margin: 0px 0;">
            
          <h4>DoddePage in City Centre</h4>
          <h6>Broker Agency | 123 Main Street, Melbourne VIC 3000</h6>


          <!-- Overview (Optional) -->
          <div class="box2">
            <h4>Overview</h4>
            <h5>Specialisation: Cafes</h5>
            <h5>Location Serviced: Melbourne</h5>
            <h5>Website: www.doddepage.com</h5>
          </div>

          <!-- Description -->
          <div class="BusinessSummary" style="margin-top: 30px;">
            <h4>Profile Description</h4>
            <p>
              DoddePage is a leading brokerage agency based in the heart of Melbourne, specialising in hospitality businesses. 
              With over a decade of experience, we help connect buyers with curated listings tailored to their needs. Our team provides 
              expert guidance, from listing evaluation to deal closure.
            </p>
          </div>
        </div>
 		</div>
 		<div class="col-sm-4">
        <h4>Contact Broker</h4>
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
