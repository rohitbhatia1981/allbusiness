<?php include "private/settings.php";
include PATH."include/headerhtml.php"; 
 ?>


  <body>

<?php include PATH."include/header.php"; ?>
  	
<section class="top_banner">
	<div class="container">
		<h3 class="title_h3 text-center mb-4">More Businesses, All the Time.</h3>
		<div class="top_from" style="display: block;">
			<div class="row">
				<div class="col-sm-5 mb-2">
					<div class="search_box">
					<i class="fa-regular fa-magnifying-glass fa-fw"></i>
					<input type="text" class="form-control" placeholder="Search by suburb, postcode, region"></div>
				</div>
				<div class="col-sm-7">
					<div class="form_control_box">
						<select class="form-control form-select">
							<option>Select categories</option>
						</select>
						<select class="form-control form-select">
							<option>Select States</option>
						</select>
						<select class="form-control form-select">
							<option>Select Region</option>
						</select>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="form_control_box">
						<select class="form-control form-select">
							<option>Min Price $</option>
						</select>
						<select class="form-control form-select">
							<option>Max Price $</option>
						</select>
					</div>
				</div>
				<div class="col-sm-7">
					<div class="search_box search_box_button">
						<i class="fa-regular fa-magnifying-glass fa-fw"></i>
					<input type="text" class="form-control" placeholder="Search by suburb, postcode, region">		

						<button><i class="fa-regular fa-magnifying-glass fa-fw"></i> Search</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="city_list">
	<div class="container">
		<h3 class="title_h3 text-center">View businesses by city</h3>
		<div class="city_list_outbox owl-carousel">
			<div class="city_list_box item">
				<img alt="Business for sale Melbourne" src="<?php echo URL?>images/city-01.png">
				<h5>Business for sale <br>Melbourne</h5>
			</div>
			<div class="city_list_box item">
				<img alt="Business for sale Sydney" src="<?php echo URL?>images/city-02.png">
				<h5>Business for sale Sydney</h5>
			</div>
			<div class="city_list_box item">
				<img alt="Business for sale Brisbane" src="<?php echo URL?>images/city-03.png">
				<h5>Business for sale Brisbane</h5>
			</div>
			<div class="city_list_box item">
				<img alt="Business for sale Perth" src="<?php echo URL?>images/city-04.png">
				<h5>Business for sale Perth</h5>
			</div>
			<div class="city_list_box item">
				<img alt="Business for sale Adelaide" src="<?php echo URL?>images/city-05.png">
				<h5>Business for sale Adelaide</h5>
			</div>
			<div class="city_list_box item">
				<img alt="Business for sale Hobart" src="<?php echo URL?>images/city-06.png">
				<h5>Business for sale Hobart</h5>
			</div>
			<div class="city_list_box item">
				<img alt="Business for sale Canberra" src="<?php echo URL?>images/city-07.png">
				<h5>Business for sale Canberra</h5>
			</div>
			<div class="city_list_box item">
				<img alt="Business for sale Melbourne" src="<?php echo URL?>images/city-08.png">
				<h5>Business for sale <br>Melbourne</h5>
			</div>
		</div>
	</div>
</section>


<section class="new_listings">
	<div class="container">
		<h3 class="title_h3 text-center">New listings</h3>
		<div class="new_listings_row">
        
        
        <?php
		$sqlProp="select * from tbl_business where business_active_status='1' and business_archive=0 ";
		
		if ($_GET['s']=='sold')
		$sqlProp.="and business_status='sold'";
		else
		$sqlProp.="and business_status='current'";
		
		if ($_GET['location']!="")
		{
		$search=$_GET['location'];
		$sqlProp .= "AND business_suburb LIKE '%$search%' ";
		}
		
		if ($_GET['minPrice']!="")
		{
		$sqlProp .= "AND business_price>='".$database->filter($_GET['minPrice'])."' ";
		}
		
		if ($_GET['maxPrice']!="")
		{
		$sqlProp .= "AND business_price<='".$database->filter($_GET['maxPrice'])."' ";
		}
		
		if ($_GET['category']!="")
		{
		$sqlProp .= "AND find_in_set (".$database->filter($_GET['category']).",business_category) ";
		}
		
		if ($_GET['state']!="")
		{
		$sqlProp .= "AND business_state='".$database->filter($_GET['state'])."' ";
		}
		
		$sqlProp.=" order by business_added_date desc limit 0,8";
		$getProp=$database->get_results($sqlProp);
		$totalProp=count($getProp);
?>
        
        <?php
if ($totalProp > 0) {
    for ($i = 0; $i < $totalProp; $i++) {
        $rowProp = $getProp[$i];
        $sqlImages = "select * from tbl_business_images where image_business_id='" . $rowProp['business_id'] . "' limit 0,1"; 
        $getImages = $database->get_results($sqlImages);
        $totalImages = count($getImages);

        if ($totalImages > 0) {
            $rowImages = $getImages[0];
            $imageurl = "";                
            if ($rowImages['image_s3'] == "") 
                $imageurl = URL . "classes/timthumb.php?src=" . URL . "images/business/" . $rowImages['image_local'] . "&w=500&h=300&zc=1";
            else 
                $imageurl = $rowImages['image_s3'];                

            if ($rowProp['business_status'] == "current") 
                $postfix = "for sale";
            else 
                $postfix = "Sold";
        } else {
            $imageurl = URL . "images/no-image.png";
        }

        $address = getBusinessAddress($rowProp['business_id']);
        $detailLink = generateBusinessLink($rowProp['business_id']);
  
  		$propertyDesc=str_replace("?","-",$rowProp['business_description']);				
		$propertyDesc=str_replace("&amp;","&",$rowProp['business_description']);				
		$propertyDesc=str_replace("\n","<br>",$propertyDesc);				
		$propertyDesc=str_replace("<br><br><br>","<br>",$propertyDesc);
		
?>  
        
			<?php include PATH."cms/listing-design.php"; ?>
			
			
   <?php
	}
}?>	
			
			
			
		</div>
	</div>
</section>

<section class="Subscribe_now">
	<div class="container">
		<div class="Subscribe_now_box">
			<h5>Sign up for weekly updates on business sales and new listings.</h5>
			<button class="btn btn-light">Subscribe now</button>
		</div>
	</div>
</section>

<section class="about_section">
	<div class="container">
		<h6>About Allbusinesses.com.au</h6>
		<h3 class="title_h3">Buy a Business</h3>
		<p>Starting a business from scratch is tough. Buying an established business for sale in Australia can be the answer. By buying an existing business, you can skip the startup hassle and start making profits right away. Magicbricks helps you find the right business for sale in Melbourne and across Victoria, with plans to expand into other states soon. Our platform simplifies the search process, allowing you to find businesses by industry, location, and price range.</p>
		<p>With Magicbricks, investing in an Australian business for sale means investing in certainty and a proven formula. Whether you're interested in small businesses or franchises, we can help you find the right opportunity. Buying a business gives you access to systems, clients, inventory, and leases. It's a smart move for any entrepreneur.</p>
		<p>Melbourne, as Victoria's capital, is a hub for businesses of all sizes. With its pro-business government and favourable taxation, it's a hub for small and start-up companies. Whether you're looking for large corporations or smaller retail operations, Melbourne has options for you.
Find your perfect business for sale today with Magicbricks.</p>
	</div>
</section>

<?php include PATH."include/footer.php"; ?>