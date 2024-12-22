<?php include "../private/settings.php";
include PATH . "include/headerhtml.php"; 
?>
<body>
    <?php include PATH . "include/header.php"; ?>

    <!-- Hero Section -->
    <div class="city_banner text-center" style="padding:20px; background-color: #f7f7f7;">
        <div class="container">
            <h1>Businesses for Sale in Melbourne</h1>
            
        </div>
    </div>

    <!-- City Information Section -->
    <div class="city_info_section py-4">
        <div class="container">
        <p style="text-align:left">Explore a wide range of businesses available for sale in Melbourne. Whether you're looking for a café, retail store, or professional service, Melbourne has opportunities for everyone.</p>
            <p>Melbourne is a bustling hub for entrepreneurs and businesses, offering a diverse range of opportunities in various sectors. From the heart of the city to the vibrant suburbs, there's no shortage of profitable ventures waiting for the right owner. Take a look at our listings below and find the perfect business to kickstart your entrepreneurial journey in Melbourne.</p>
        </div>
    </div>

    <!-- Business Listings Section -->
    <section class="new_listings">
	<div class="container">
		<h3 class="title_h3 text-left">Listings in Melbourne</h3>
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
		
		$sqlProp.=" order by business_added_date desc limit 0,5";
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

    <?php include PATH . "include/footer.php"; ?>
</body>
