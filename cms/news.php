<?php include "../private/settings.php";
include PATH."include/headerhtml.php";
?>
<body>
    <?php include PATH."include/header.php"; ?>

    <div class="news_gallery text-center">
        <div class="container">
            <h3 class="title_h3">Latest News</h3>
            <div class="row">
                <!-- News Item Start -->
                <div class="col-md-4">
                    <div class="news_item">
                       <a href="<?php echo URL?>detail-business-news"> <img class="img-fluid" src="<?php echo URL?>images/Businessman-11.jpg" alt=""></a>
                        <h4>News Title 1</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt.</p>
                        <a href="<?php echo URL?>detail-business-news" class="btn btn-primary">Read More</a>
                    </div>
                </div>
                <!-- News Item End -->

                <!-- News Item Start -->
                <div class="col-md-4">
                    <div class="news_item">
                        <a href="<?php echo URL?>detail-business-news"><img class="news-image" src="<?php echo URL?>images/image-2590.jpg" alt=""></a>
                        <h4>News Title 2</h4>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.</p>
                        <a href="<?php echo URL?>detail-business-news" class="btn btn-primary">Read More</a>
                    </div>
                </div>
                <!-- News Item End -->

                <!-- News Item Start -->
                <div class="col-md-4">
                    <div class="news_item">
                        <a href="<?php echo URL?>detail-business-news"><img class="news-image" src="<?php echo URL?>images/Businessman-11.jpg" alt=""></a>
                        <h4>News Title 3</h4>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        <a href="<?php echo URL?>detail-business-news" class="btn btn-primary">Read More</a>
                    </div>
                </div>
                <!-- News Item End -->
            </div>
        </div>
    </div>

    <?php include PATH."include/footer.php"; ?>