<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-2">
				<a href="#" class="mb-3 d-inline-block"><img src="<?php echo URL?>images/footer-logo.png"></a>
				<p>Search businesses for sale in Australia. No. 1 website for Business dales in Australia. </p>
				<div class="Contact_info">
				<h5>Contact us</h5>
				<p><a href="mailto:info@allbusinesses.com.au">info@allbusinesses.com.au</a></p> 
				<p><a href="tel:1300 999 888">1300 999 888</a></p>
				</div>

				<h5>Follow us</h5>
				<ul class="follow_links">
					<li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
					<li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
					<li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
				</ul>
			</div>
			<div class="col-sm-2 ps-lg-5 ps-2">
				<h5>Company</h5>	
				<ul class="site_map">
					<li><a href="#">About us</a></li>
					<li><a href="#">Contact us</a></li>
					<li><a href="#">News</a></li>
					<li><a href="#">Help & Support</a></li>
					<li><a href="#">For Brokers</a></li>
					<li><a href="#">Advertise</a></li>
					<li><a href="#">Private Sellers</a></li>
					<li><a href="#">Sell a Business</a></li>
					<li><a href="#">Login</a></li>
				</ul>
			</div>
			<div class="col-sm-2">
				<h5>Browse by Capital Cities </h5>	
				<ul class="site_map">
                
                 <?php 
			$sqlCities="select * from tbl_cities where city_status=1";
			$resCities=$database->get_results($sqlCities);
			
			if (count($resCities)>0)
			{
			for ($j=0;$j<count($resCities);$j++)
			{
				$rowCities=$resCities[$j];
				
				$cityNameLink=htCategoryName($rowCities['city_name']);
				$cityPostcode=$rowCities['city_postcode'];
				$cityState=strtolower($rowCities['city_state']);
				
		
		 ?>
					<li><a href="<?php echo URL?>business-for-sale/<?php echo $cityState; ?>/<?php echo $cityNameLink; ?>">Business for Sale <?php echo $rowCities['city_name']; ?></a></li>
					
			<?php }
			}
		?>		
				</ul>
			</div>
			<div class="col-sm-2">
				<h5>Businesses for Sale by States</h5>	
				<ul class="site_map">
					<li><a href="<?php echo URL?>business-for-sale/nsw">Business for sale in NSW</a></li> 
					<li><a href="<?php echo URL?>business-for-sale/vic">Business for sale in VIC</a></li>
					<li><a href="<?php echo URL?>business-for-sale/qld">Business for sale in QLD</a></li>
					<li><a href="<?php echo URL?>business-for-sale/sa">Business for sale in SA</a></li>
					<li><a href="<?php echo URL?>business-for-sale/wa">Business for sale in WA</a></li>
					<li><a href="<?php echo URL?>business-for-sale/act">Business for sale in ACT</a></li>
					<li><a href="<?php echo URL?>business-for-sale/nt">Business for sale in NT</a></li>
					<li><a href="<?php echo URL?>business-for-sale/tas">Business for sale in TAS</a></li>
				</ul>
			</div>
			<div class="col-sm-2">
				<h5>Browse by Businesses by category</h5>	
				<ul class="site_map">
                
                      <?php 
			$sqlCategory="select * from tbl_business_category where bc_parent_id=0 and bc_status=1";
			$resCategory=$database->get_results($sqlCategory);
			
			if (count($resCategory)>0)
			{
			for ($j=0;$j<count($resCategory);$j++)
			{
				$rowCategory=$resCategory[$j];				
				$categoryNameLink=htCategoryName($rowCategory['bc_name'])."-for-sale";
				
				
		
		 ?>
                
					<li><a href="<?php echo URL?><?php echo $categoryNameLink; ?>"><?php echo $rowCategory['bc_name']; ?></a></li>
                    
           <?php }
			}
		?>
					
				</ul>
			</div>
		</div>
		<div class="copy_right">
			<p>&copy; <?php echo date("Y") ?> Allbusiness.com.au.  All rights reserved. </p>
			<ul>
				<li><a href="#">Privacy</a></li>
				<li><a href="#">Terms of Use</a></li>
				<li><a href="#">Sitemap</a></li>
			</ul>

		</div>
	</div>
</footer>
	<script src="<?php echo URL?>js/jquery.min.js"></script>
  	<script src="<?php echo URL?>js/popper.min.js"></script>
    <script src="<?php echo URL?>js/bootstrap.bundle.min.js"></script>
    
    <?php if ($frontPageName=="index.php") { ?>
    <script src="<?php echo URL?>js/owl.carousel.js"></script>
    <script type="text/javascript">
    	$('.owl-carousel').owlCarousel({
		    loop:true,
		    margin:10,
		    nav:false,
		    responsive:{
		        0:{
		            items:2
		        },
		        600:{
		            items:3
		        },
		        1000:{
		            items:8
		        }
		    }
		})
    </script>
    




    
    <?php } ?>
  </body>
</html>
<script>
$(document).ready(function () {
    // Function to open the inquiry modal
  function openInquiryModal(listingId, businessTitle) {
    // Set the listing ID in the hidden field
    $('#listingId').val(listingId);

    // Optionally, set the business title in the modal (if needed)
    $('#modalBusinessTitle').text(businessTitle);

    // Send an AJAX request to fetch data
    $.ajax({
        url: '<?php echo URL ?>ajax/inquiry-form.php', // PHP script to fetch data
        type: 'GET',
        data: { listing_id: listingId }, // Pass the listing ID to the server
        success: function(response) {
			
			
            // Update the modal content with the fetched data
            $('#modalContent').html(response);

            // Show the modal
            $('#inquiryModal').fadeIn();
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: " + status + error);
            $('#modalContent').html('<p>Error loading data. Please try again.</p>');
            $('#inquiryModal').fadeIn();
        }
    });
}

    // Function to close the inquiry modal
    function closeInquiryModal() {
        $('#inquiryModal').fadeOut(); // Hide the modal with a fade-out effect
    }

    // Attach open modal function to the button
    $('.enquire_btn').on('click', function() {
    var listingId = $(this).data('listing-id');
    var businessTitle = $(this).data('business-title');
    openInquiryModal(listingId, businessTitle); // Call the function with parameters
});

    // Close modal on close button click
    $('.modal .close').on('click', function () {
        closeInquiryModal();
    });

    // Optional: Close modal when clicking outside the modal
    $(window).on('click', function (event) {
        if ($(event.target).is('#inquiryModal')) {
            closeInquiryModal();
        }
    });
});
</script>

<?php if ($frontPageName=="index.php" || $frontPageName=="buy-business.php" || $frontPageName=="city.php" || $frontPageName=="bdetail.php") { ?>



<script>

  function fnGetRegion(regionId='')
  {
	
	 stateId=$("#state_cont").val();
	 var regionId;
	 
	 <?php if ($_GET['region']!="") { ?>
	 regionId=<?php echo $_GET['region']; ?>;
	 <?php } ?> 
	 
	 
	  $.post("<?php echo URL?>ajax/get-regions.php", { state_id: stateId, region_id: regionId }, function(data) {
        $("#region_cont").html(data); // Populate the dropdown with response data
    });
	 
  }
  


	$("#txtLocation").keyup(function () {
    const inputVal = $(this).val().trim(); // Get the trimmed input value

    if (inputVal) {
        // If the input has text, make the AJAX call
        $.ajax({
            type: "POST",
            url: "<?php echo URL?>ajax/load-location.php",
            data: { keyword: inputVal },
            beforeSend: function () {
                // Optional: Add loading indicator styles here
            },
            success: function (data) {
                $("#suggesstion-box").show().html(data); // Show and update the suggestion box
            },
        });
    } else {
        // If input is empty, hide the suggestion box
        $("#suggesstion-box").hide();
    }
});


const dropdown = document.getElementById('dropdown');
const dropdownOptions = document.getElementById('dropdownOptions');
const options = document.querySelectorAll('.option');
const hiddenInput = document.getElementById('selectedCategories'); // Reference to hidden input
let selectedValues = [];

// Initialize with pre-selected categories
function initializeSelectedCategories(preSelectedCategories) {
    if (preSelectedCategories) {
        selectedValues = preSelectedCategories.split(','); // Split the comma-separated string into an array
        selectedValues.forEach(value => {
            const option = [...options].find(opt => opt.getAttribute('data-value') === value);
            if (option) {
                option.classList.add('selected'); // Highlight the selected option
            }
        });
        updateDropdownLabel();
        updateHiddenInput();
    }
}

// Toggle dropdown visibility
dropdown.addEventListener('click', () => {
    dropdownOptions.style.display = dropdownOptions.style.display === 'none' || !dropdownOptions.style.display ? 'block' : 'none';
});

// Handle option selection
options.forEach(option => {
    option.addEventListener('click', () => {
        const value = option.getAttribute('data-value');
        if (selectedValues.includes(value)) {
            selectedValues = selectedValues.filter(val => val !== value);
            option.classList.remove('selected');
        } else {
            selectedValues.push(value);
            option.classList.add('selected');
        }
        updateDropdownLabel();
        updateHiddenInput(); // Update the hidden input field
    });
});

// Hide dropdown on outside click
document.addEventListener('click', (e) => {
    if (!e.target.closest('.multi-select')) {
        dropdownOptions.style.display = 'none';
    }
});

// Update dropdown label
function updateDropdownLabel() {
    const count = selectedValues.length;
    if (count === 0) {
        dropdown.textContent = 'Select Categories';
    } else if (count === 1) {
        dropdown.textContent = '1 category selected';
    } else {
        dropdown.textContent = `${count} categories selected`;
    }
}

// Update hidden input field value
function updateHiddenInput() {
    hiddenInput.value = selectedValues.join(','); // Join selected values with commas
}

// Example usage: Replace with actual server-side values
const preSelectedCategories = hiddenInput.value; // This should be set by the server as a comma-separated string
initializeSelectedCategories(preSelectedCategories);


	
function selectLocation(val,lid) {

$("#txtLocation").val(val);
$("#hdLocationId").val(lid);
$("#suggesstion-box").hide();

 // Reset state and region dropdowns
    $("#state_cont").val("").change();  // Reset state dropdown
    $("#region_cont").val("").change(); // Reset region dropdown

}

function selectRegion(val, stateID, regionID) {
    $("#txtLocation").val(val);
    $("#suggesstion-box").hide();

    // Set the selected value of the state dropdown
    $("#state_cont").val(stateID).change();

    // Delay calling fnGetRegion by 1 second (1000ms)
    setTimeout(function() {
        fnGetRegion(regionID);
    }, 500);
}



</script>

 <?php if ($_GET['state']!="") { ?>
  <script>fnGetRegion()</script>
  <?php } ?>

<?php } ?>
