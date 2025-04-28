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
		<h3 class="title_h3 text-center mb-4">Find your perfect business in Australia</h3>
		
        <?php include PATH."include/search-form.php"; ?>
        
        <div style="background: #fff; border: 1px solid #e0e0e0; padding: 20px; margin-top: 20px;">
          <p>
            <strong>AllBusiness</strong> is Australia’s trusted business-for-sale listing marketplace, offering one of the largest directories for buying and selling businesses. 
            With thousands of listings across the country, we connect buyers with incredible business opportunities in 
            <strong>Melbourne</strong>, <strong>Sydney</strong>, <strong>Brisbane</strong>, <strong>Perth</strong>, <strong>Adelaide</strong>, <strong>Canberra</strong>, <strong>Gold Coast</strong>, <strong>Hobart</strong>, and beyond.
          </p>
          <p>
            Our mission is to simplify the process of buying and selling businesses, making it efficient, transparent, and stress-free for everyone involved.
          </p>
        </div>

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
			{
				if ($rowProp['business_imported']==1)
				$iURL="images/business/i/";
				else
				$iURL="images/business/";
			
           		 $imageurl = URL . "classes/timthumb.php?src=" . URL . $iURL . $rowImages['image_local'] . "&w=500&h=300&zc=1";
			}
               
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
<div style="display: flex; flex-wrap: wrap; margin-top: 30px; border-top: 1px solid #ddd; padding-top: 30px;">

  <!-- Buy a Business Section -->
  <div style="flex: 0 0 50%; padding: 20px; border-right: 1px solid #eee;">
    <h2>Buy a Business</h2>
    <p>
      Looking to become a business owner without the startup risks? 
      <strong>AllBusiness</strong> connects you with established businesses for sale across Australia.
    </p>
    <p>
      Skip the uncertainty of starting from zero. When you buy an existing business, you get proven customers, revenue, and systems from day one.
    </p>
    <p>
      We list businesses in every industry throughout 
      <strong>Queensland</strong>, <strong>New South Wales</strong>, <strong>Victoria</strong>, 
      <strong>South Australia</strong>, <strong>Western Australia</strong>, 
      <strong>Northern Territory</strong>, and <strong>Tasmania</strong>.
    </p>
    <p>
      Finding your perfect business is easy on our website. Just search by industry, location, and price to see businesses that match what you're looking for.
    </p>
    <div style="margin-top: 15px;">
      <a href="<?php echo URL?>buy-business" style="display: inline-block; background: #0073e6; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-weight: bold;">
        Find Businesses
      </a>
    </div>
  </div>

  <!-- Sell Your Business Section -->
  <div style="flex: 0 0 50%; padding: 20px;">
    <h2>Sell Your Business</h2>
    <p>
      Thinking about selling your business? <strong>AllBusiness</strong> can help you find the right buyer. We connect business owners like you with people who are ready to buy.
    </p>
    <p>
      Our platform makes it easy to showcase your business to interested buyers across Australia. From small businesses to established franchises, we help you reach the right audience.
    </p>
    <p>
      Start by creating your listing with photos, key business details, and reasons why someone would want to buy it. Manage all your buyer conversations in one place.
    </p>
    <p>
      We reach serious buyers in every Australian city - <strong>Sydney</strong>, <strong>Melbourne</strong>, <strong>Brisbane</strong>, <strong>Perth</strong>, <strong>Adelaide</strong>, <strong>Canberra</strong>, <strong>Hobart</strong>, <strong>Darwin</strong>, and beyond.
    </p>
    <p>
      Whether you're working with a broker or selling independently, <strong>AllBusiness</strong> gives you the visibility and tools you need for a successful business sale.
    </p>
    <div style="margin-top: 15px;">
      <a href="<?php echo URL?>private-sellers" style="display: inline-block; background: #28a745; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-weight: bold; margin-right: 10px;">
        Sell Your Business
      </a>
      <a href="<?php echo URL?>for-brokers" style="display: inline-block; background: #FC6B35; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-weight: bold;">
        For Business Brokers
      </a>
    </div>
  </div>

</div>


	</div>
</section>

<?php include PATH."include/footer.php"; ?>


