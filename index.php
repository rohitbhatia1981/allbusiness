<?php include "private/settings.php";
include PATH."include/headerhtml.php"; 
 ?>

<style>
#country-list {
    list-style: none;
    margin: 0;
    padding: 0;
    width: 100%; /* Ensures the dropdown matches the input width */
    max-width: 100%; /* Prevent overflow */
    position: absolute;
    text-align: left;
    z-index: 999;
    border: 1px solid #dfe1e5;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
    border-radius: 4px;
    background-color: #fff;
	max-height: 300px;
	overflow-y: auto;
}

#txtLocation {
    position: relative; /* Helps position the dropdown relative to this input */
}

#country-list li {
    padding: 5px 15px;
    font-size: 15px;
    color: #202124;
    border-bottom: 1px solid #e8eaed;
    cursor: pointer;
	
}

#country-list li:last-child {
    border-bottom: none;
}

#country-list li:hover {
    background-color: #f1f3f4;
}

#country-list li:active {
    background-color: #e8f0fe;
}


</style>
  <body>

<?php include PATH."include/header.php"; ?>


  	
<section class="top_banner">

	<div class="container">
		<h3 class="title_h3 text-center mb-4">More Businesses, All the Time.</h3>
		
        <?php include PATH."include/search-form.php"; ?>
        
	</div>
    
    
</section>
<section class="city_list">
	<div class="container">
		<h3 class="title_h3 text-center">View businesses by city</h3>
		<div class="city_list_outbox owl-carousel">
        
        <?php 
			$sqlCities="select * from tbl_cities where city_status=1 and city_popular=1";
			$resCities=$database->get_results($sqlCities);
			
			if (count($resCities)>0)
			{
			for ($j=0;$j<count($resCities);$j++)
			{
				$rowCities=$resCities[$j];
				$cityName=htCategoryName($rowCities['city_name']);
				$cityPostcode=$rowCities['city_postcode'];
				$cityState=strtolower($rowCities['city_state']);
				$cityImage=$rowCities['city_image'];
		
		 ?>
        
			<a href="<?php echo URL?>business-for-sale/<?php echo $cityState; ?>/<?php echo $cityName; ?>" style="text-decoration:none"><div class="city_list_box item" >
				<img  alt="Business for sale <?php echo $cityName; ?>" src="<?php echo URL?>images/cities/<?php echo $cityImage; ?>">
				<h5 style="color:#333">Business for sale <br><?php echo $rowCities['city_name'] ?></h5>
			</div></a>
          
          <?php } 
			}?>
           
		</div>
	</div>
</section>


<section class="new_listings">
	<div class="container">
		<h3 class="title_h3 text-center">New listings</h3>
		<div class="new_listings_row">
        
        
        
        
        
        <?php
		$sqlProp="select * from tbl_business,tbl_members where business_owner_id=member_id and business_active_status='1' and business_archive=0 ";
		
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
        
			<?php include PATH."cms/listing-design-home-page.php"; ?>
			
			
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


