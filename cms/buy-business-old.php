<?php include "../private/settings.php";

if ($_GET['landing']!="")
{
	if ($_GET['landing']=="state")
	{
		$sqlData="select state_full_name,state_page_desc from tbl_states where state_name='".$database->filter($_GET['state'])."'";
		$resData=$database->get_results($sqlData);
		$rowData=$resData[0];
		$cityName=$rowData['state_full_name'];
		$pageDesc=$rowData['state_page_desc'];
		
	}
}
else
{
$cityName="Australia";
$pageDesc="<p>Starting a business from scratch is tough. Buying an established business for sale in Australia can be the answer. By buying an existing business, you can skip the startup hassle and start making profits right away. Magicbricks helps you find the right business for sale in Melbourne and across Victoria, with plans to expand into other states soon. Our platform simplifies the search process, allowing you to find businesses by industry, location, and price range.</p>
		<p>With Magicbricks, investing in an Australian business for sale means investing in certainty and a proven formula. Whether you're interested in small businesses or franchises, we can help you find the right opportunity. Buying a business gives you access to systems, clients, inventory, and leases. It's a smart move for any entrepreneur.</p>
		<p>Melbourne, as Victoria's capital, is a hub for businesses of all sizes. With its pro-business government and favourable taxation, it's a hub for small and start-up companies. Whether you're looking for large corporations or smaller retail operations, Melbourne has options for you.
Find your perfect business for sale today with Magicbricks.</p>";
}

include PATH."include/headerhtml.php"; 



 ?>
  <body>

  	<?php include PATH."include/header.php"; ?>
    
      
<div class="listing_screen">
	<div class="busiess_tag"><div class="container">Business for Sale</div></div>
<section class="top_banner">

	<div class="container">
		<h3 class="title_h3 text-left mb-4">Businesses for sale in <?php echo $cityName; ?></h3>
		
        <?php include PATH."include/search-form.php"; ?>
        
	</div>
   
   
</section> 

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
		
		 $sqlProp.=" order by business_added_date desc";
		$getProp=$database->get_results($sqlProp);
		$totalPropMax=count($getProp);
		$pagingObject->setMaxRecords(12);
		$sqlProp = $pagingObject->setQuery($sqlProp);
		$getProp=$database->get_results($sqlProp);
		$totalProp=count($getProp);
?>


<section class="new_listings">
	<div class="container">
		<div class="filter_box">
			<span><?php echo $totalPropMax?> Businesses for Sale</span>

			<div class="right">
				Sort by: <select class="form-select"><option>Featured</option></select>
			</div>
			<button style="display: none;" class="filter_button">Filters <i class="fa-light fa-sliders-simple"></i></button>
		</div>
		<div class="filter_box only_for_mobile" style="display: none;">
			<?php echo $totalPropMax?> Businesses for Sale
		</div>
		<div class="new_listings_row">
        
        
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

	<nav aria-label="Page navigation example">
  <!--<ul class="pagination justify-content-center">
  
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>-->
  
  		 <?php

				print "<div style='text-align:center'>";

				$pagingObject->displayLinks_adlisting(); 

				print "</div>";

			?>
  
</nav>
</section>
 

<section class="about_section">
	<div class="container">
		<!-- <h6>About Allbusinesses.com.au</h6> -->
		<h3 class="title_h3">Buy a Business in <?php echo $cityName; ?></h3>
		<?php echo $pageDesc; ?>
	</div>
</section>

</div>

<?php include PATH."include/footer.php"; ?>
    
<script type="text/javascript">
    	$(".filter_button").click(function(){
  $(".top_from").toggleClass("main");
   $("body").scrollTop(0);
});  
    </script>