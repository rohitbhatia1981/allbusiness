<nav class="navbar navbar-expand-lg navbar-light bg-light top_navi">
  <div class="container">
    <a class="navbar-brand" href="<?php echo URL?>"><img alt="All Business" width="200px" src="<?php echo URL?>images/allbusiness_Logo.svg"></a>
    <div class="sign_in_right">
    	<a class="sign_in " style="display: none;" href="#">Sign In</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="<?php echo URL?>buy-business">Buy a business</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo URL?>for-brokers">Sell a business</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="forBrokersDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        For brokers
      </a>
      <ul class="dropdown-menu" aria-labelledby="forBrokersDropdown">
        <li><a class="dropdown-item" href="<?php echo URL?>for-brokers">Advertise with us</a></li>
        <li><a class="dropdown-item" href="<?php echo URL?>for-brokers#reg_broker_form">Apply for a Broker Account</a></li>
        <!--<li><a class="dropdown-item" href="<?php echo URL?>cms/find-a-broker">Find a broker</a></li>-->
      </ul>
    </li>
    
    <?php 
$sqlCities = "SELECT * FROM tbl_cities WHERE city_status=1 AND city_popular=1";
$resCities = $database->get_results($sqlCities);
?>

<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="popularCitiesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    Locations
  </a>
  <ul class="dropdown-menu" aria-labelledby="popularCitiesDropdown">
    <?php if (count($resCities) > 0): ?>
      <?php foreach ($resCities as $rowCities): ?>
        <?php 
          $cityName = htCategoryName($rowCities['city_name']);
          $cityState = strtolower($rowCities['city_state']);
        ?>
        <li>
          <a class="dropdown-item" href="<?php echo URL ?>business-for-sale/<?php echo $cityState; ?>/<?php echo $cityName; ?>">
            <?php echo $rowCities['city_name']; ?>
          </a>
        </li>
      <?php endforeach; ?>
    <?php endif; ?>
  </ul>
</li>

    
    
    
    <!--<li class="nav-item"><a class="nav-link" href="<?php echo URL?>private-sellers">Private sellers</a></li>-->
    <li class="nav-item"><a class="nav-link" href="<?php echo URL?>news">News</a></li>
  </ul>

  <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
   <?php if ($_SESSION['sess_member_id']=="") { $sellBusinessLink=URL."private-sellers";?> <li class="nav-item ms-auto login"><a class="nav-link" href="<?php echo URL?>login">Log in</a></li>
    <li class="nav-item"><a class="nav-link" href="<?php echo URL?>buyer-signup">Sign up</a></li>
    <?php } else {
	$sellBusinessLink=URL."cms/member/index.php?c=b-business&task=add";	
		 ?>
    <li class="nav-item"><a class="nav-link" href="<?php echo URL?>cms/member/">My Account</a></li>
    <?php } ?>
    <li class="nav-item button"><a class="nav-link" href="<?php echo $sellBusinessLink?>">Sell a Business</a></li>
  </ul>
</div>

  </div>
</nav>