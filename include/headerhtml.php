<?php $frontPageName=basename($_SERVER['PHP_SELF']);  ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title><?php echo $SEO_TITLE; ?></title>
     <meta name="description" content="<?php echo $SEO_DESCRIPTION?>">
 	 <meta name="keywords" content="<?php echo $SEO_KEYWORDS?>">
    <meta property="og:site_name" content="<?php echo URL?>">
    <meta property="og:url" content="<?php echo $ogURL?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $SEO_TITLE; ?>">
    <meta property="og:description" content="<?php echo $ogDescription; ?>">
	<meta name='og:image' content='<?php echo $ogImage; ?>'>
    <?php echo $linkCal; ?>
   
    <link rel="stylesheet" type="text/css" href="<?php echo URL?>css/style.css">
  </head>