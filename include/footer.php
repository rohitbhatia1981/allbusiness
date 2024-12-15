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
			<div class="col-sm-2">
				<h5>Businesses for Sale by States</h5>	
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
			<div class="col-sm-2">
				<h5>Browse by Businesses by category</h5>	
				<ul class="site_map">
					<li><a href="#">Accommodation Tourism </a></li>
					<li><a href="#">Automotive Businesses for sale</a></li>
					<li><a href="#">Beauty/Health</a></li>
					<li><a href="#">Education/Training</a></li>
					<li><a href="#">Food/Hospitality </a></li>
					<li><a href="#">Franchise</a></li>
					<li><a href="#">Home/Garden </a></li>
					<li><a href="#">Import/Export/Wholesale</a></li>
					<li><a href="#">Industrial/Manufacturing</a></li>
					<li><a href="#">Leisure/Entertainment</a></li>
					<li><a href="#">Professional</a></li>
					<li><a href="#">Retail</a></li>
					<li><a href="#">Rural</a></li>
					<li><a href="#">Services</a></li>
					<li><a href="#">Transport/Distribution</a></li>
				</ul>
			</div>
		</div>
		<div class="copy_right">
			<p>&copy; <?php echo date("Y") ?> Allbusinesses.com.au.  All rights reserved. </p>
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
