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
		
		$headingTop="Businesses for sale in ".$cityName;
		$headingBottom="Buy a Business in ".$cityName;
		
	} else if ($_GET['landing']=="city")
	{
		 $sqlData="select city_name,city_page_desc,city_state from tbl_cities where city_postcode='".$database->filter($_GET['lid'])."'";
		$resData=$database->get_results($sqlData);
		$rowData=$resData[0];
		$cityName=$rowData['city_name'];
		$pageDesc=$rowData['city_page_desc'];
		$stateName=$rowData['city_state'];
		
		
		
		
		
		if ($_GET['category']!="")
		{
		$_GET['selectedCategories']=$_GET['category'];
		
		
		$sqlData="select * from tbl_business_category where bc_id='".$database->filter($_GET['category'])."'";
		$resData=$database->get_results($sqlData);
		$rowData=$resData[0];
		$catName=$rowData['bc_name'];
		
		$headingTop=$catName." Businesses for sale in ".$cityName;
		$headingBottom="Buy a ".$catName." Business  in ".$cityName;
		
		$SEO_TITLE="Buy a ".$catName." Businesses for sale in ".$cityName;	
		
		
		}
		else
		{
		$headingTop="Businesses for sale in ".$cityName;
		$headingBottom="Buy a Business in ".$cityName;
		
		$SEO_TITLE="Buy a Business in ".$cityName;	
		
		}
		
		
		
		
	}
	
	else if ($_GET['landing']=="category")
	{
		$sqlData="select * from tbl_business_category where bc_id='".$database->filter($_GET['category'])."'";
		$resData=$database->get_results($sqlData);
		$rowData=$resData[0];
		$catName=$rowData['bc_name'];
		$pageDesc=$rowData['bc_page_description'];
		$headingTop=$catName." Businesses for sale in Australia";
		$headingBottom="Buy a ".$catName." Business in Australia";
		
		if ($rowData['bc_seo_title']!="")
		$SEO_TITLE=$rowData['bc_seo_title'];
		else
		$SEO_TITLE="Buy a ".$catName." Business in Australia";
		
		$SEO_KEYWORDS="";
		$SEO_DESCRIPTION="";
		
		$_GET['selectedCategories']=$_GET['category'];
		
	}
}
else
{
$headingTop="Businesses for sale in Australia";
$pageDesc="<p>Starting a business from scratch is tough. Buying an established business for sale in Australia can be the answer. By buying an existing business, you can skip the startup hassle and start making profits right away. Magicbricks helps you find the right business for sale in Melbourne and across Victoria, with plans to expand into other states soon. Our platform simplifies the search process, allowing you to find businesses by industry, location, and price range.</p>
		<p>With Magicbricks, investing in an Australian business for sale means investing in certainty and a proven formula. Whether you're interested in small businesses or franchises, we can help you find the right opportunity. Buying a business gives you access to systems, clients, inventory, and leases. It's a smart move for any entrepreneur.</p>
		<p>Melbourne, as Victoria's capital, is a hub for businesses of all sizes. With its pro-business government and favourable taxation, it's a hub for small and start-up companies. Whether you're looking for large corporations or smaller retail operations, Melbourne has options for you.
Find your perfect business for sale today with Magicbricks.</p>";
}

include PATH."include/headerhtml.php"; 



 ?>
 <style>
 /* Base style for the anchor tag buttons */
/* Base style for the anchor tag buttons */
a.btn-custom {
    display: block; /* Make the button full width */
    padding: 10px 10px; /* Padding for better spacing */
    margin-bottom: 10px; /* Margin between buttons */
    font-size: 13px; /* Font size */
    font-weight: 500; /* Medium font weight */
    color: #333 !important; /* Dark text color */
   
    border: 1px solid #ccc; /* Slightly darker border */
    border-radius: 8px; /* Slightly rounded corners */
    text-align: left; /* Left-aligned text */
    text-decoration: none; /* Remove underline */
    box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
    transition: all 0.3s ease; /* Smooth transition for hover effects */
}

a.btn-custom:hover {
    background-color: #e0e0e0; /* Slightly darker background on hover */
    border-color: #ccc; /* Darker border on hover */
}


/* Hover effect */
a.btn-custom:hover {
    background-color: #ADB6DF; /* Light gray background on hover */
    color: #000; /* Darker text color on hover */
    border-color: #ccc; /* Slightly darker border on hover */
}

/* Active/focus effect */
a.btn-custom:active,
a.btn-custom:focus {
    background-color: #e0e0e0; /* Slightly darker background on click/focus */
    border-color: #bbb; /* Darker border on click/focus */
}
</style>
  <body>

  	<?php include PATH."include/header.php"; ?>
    
   	<div class="busiess_tag"><div class="container">Business for Sale</div></div>   
<div class="listing_screen" >

<section class="top_banner">

	<div class="container">
		<h1 class="title_h3 text-left mb-4"><?php echo $headingTop; ?></h1>
		
        <?php include PATH."include/search-form.php"; ?>
        
	</div>
   
   
</section> 

<?php
		$sqlProp="select * from tbl_business,tbl_members where business_owner_id=member_id and business_active_status='1' and business_archive=0 and member_status=1 ";
		
		if ($_GET['s']=='sold')
		$sqlProp.="and business_status='sold'";
		else
		$sqlProp.="and business_status='current'";
		
		if ($_GET['location']!="")
		{
		$search=$_GET['location'];
		$sqlProp .= "AND business_suburb LIKE '%$search%' ";
		}
		
		if ($_GET['lid']!="")
		{
		$postcode=$_GET['lid'];
		$sqlProp .= "AND business_postcode='".$database->filter($postcode)."'";
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
		$sqlProp .= "AND (find_in_set (".$database->filter($_GET['category']).",business_category) || find_in_set (".$database->filter($_GET['category']).",business_subcat)) ";
		}
		
		if ($_GET['state']!="")
		{
		$sqlProp .= "AND business_state='".$database->filter($_GET['state'])."' ";
		}
		
		if ($_GET['region']!="")
		{
		$sqlProp .= "AND business_region='".$database->filter($_GET['region'])."' ";
		}
		
		if (!empty($_GET['selectedCategories']) && $_GET['landing']!="category") {
			// Get the categories from the query string
			$selectedCategories = explode(',', $_GET['selectedCategories']); // Convert to an array
			$categoryConditions = array();
		
			foreach ($selectedCategories as $category) {
				$category = intval($category); // Ensure it's an integer to prevent SQL injection
				$categoryConditions[] = "FIND_IN_SET($category, business_subcat)";
			}
			
			foreach ($selectedCategories as $category) {
				$category = intval($category); // Ensure it's an integer to prevent SQL injection
				$categoryConditions[] = "FIND_IN_SET($category, business_category)";
			}
		
			if (!empty($categoryConditions)) {
				// Join conditions with OR for matching any of the selected categories
				$sqlProp .= " AND (" . implode(" OR ", $categoryConditions) . ")";
			}
	}

		
		 $sqlProp.=" order by business_plan_id desc, business_added_date desc";
		$getProp=$database->get_results($sqlProp);
		$totalPropMax=count($getProp);
		$pagingObject->setMaxRecords(12);
		$sqlProp = $pagingObject->setQuery($sqlProp);
		$getProp=$database->get_results($sqlProp);
		$totalProp=count($getProp);
?>


<section class="new_listings" >
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


<div class="buy_business">
	<div class="left">
    
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
    
    <?php include PATH."cms/listing-design.php"; ?>
		 

<?php }
}?>
	 
	 
		
	</div>
	<div class="right">
		<img class="adds_" src="<?php echo URL?>images/right_side_bar.png">
	</div>
</div>



		<!--<div class="new_listings_row">
        
        
       
        
			
			
			
 
            
			
			
			
		</div>-->
	</div>

	<nav aria-label="Page navigation example">
 
  
  		 <?php

				print "<div style='text-align:center'>";

				$pagingObject->displayLinks_adlisting(); 

				print "</div>";

			?>
  
</nav>
</section>
 
 <?php if ($_GET['landing']=="city") { ?>
 	<div class="container">
    <div class="row" id="business-list">
        <?php
        $cityNameLink = htCategoryName($cityName);
        $stateNameLink = htCategoryName($stateName);

        $sqlbCat = "SELECT * FROM tbl_business_category WHERE bc_status = 1 ORDER BY bc_name";
        $resbCat = $database->get_results($sqlbCat);
        $totalItems = count($resbCat);
        $itemsPerRow = 3;
        $itemsPerLoad = 15; // 5 rows at a time (5 x 3 = 15 items)

        echo '<div class="row business-rows">'; // Start first visible row
        for ($k = 0; $k < $totalItems; $k++) {
            if ($k % $itemsPerRow == 0 && $k != 0) {
                echo '</div><div class="row business-rows '; 
                echo ($k < $itemsPerLoad) ? '' : 'd-none'; // Hide rows beyond first 15 items
                echo '">';
            }

            $rowbCat = $resbCat[$k];
            $cName = htCategoryName($rowbCat['bc_name']);

            echo '<div class="col-md-4">';
            echo '<a class="btn-custom d-block" href="' . URL . $cName . '/' . $stateNameLink . '/' . $cityNameLink . '/' . $postcode . '/' . $rowbCat['bc_id'] . '">' . $rowbCat['bc_name'] . ' business for sale in ' . $cityName . '</a>';
            echo '</div>';
        }
        echo '</div>'; // Close last row
        ?>
    </div>

    <?php if ($totalItems > $itemsPerLoad) : ?>
        <div class="text-center mt-3">
            <button class="btn btn-primary" id="loadMore">Read More</button>
        </div>
    <?php endif; ?>
</div>

<?php } ?>


<section class="about_section">
	<div class="container">
	
		<h2 class="title_h3"><?php echo $headingBottom?></h2>
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
    
   <script>
$(document).ready(function () {
    $("#loadMore").on("click", function () {
        let hiddenRows = $(".business-rows.d-none").slice(0, 5); // Show 5 rows (15 items) at a time

        hiddenRows.removeClass("d-none");

        // If no more hidden rows, remove the button
        if ($(".business-rows.d-none").length === 0) {
            $("#loadMore").remove();
        }
    });
});


</script>
