<?php include "../private/settings.php"; include PATH."include/headerhtml.php"; ?>
<body>
    <?php include PATH."include/header.php"; ?>
    <div class="container mt-5 news-detail">
        <div class="row">
            <!-- Left Panel: News Details -->
            <div class="col-lg-8">
                <div class="news-detail-content">
                <div class="breadcrumbs mt-0 mb-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo URL; ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo URL; ?>news">News</a></li>
                <li class="breadcrumb-item active" aria-current="page">News Detail</li>
            </ol>
        </nav>
    </div>
</div>

                    <img src="<?php echo URL ?>images/image-2590.jpg" alt="" class="img-fluid">
                    <h1 class="news-title mt-4">Headline of the News Article</h1>
                    <p class="news-meta">Published on: <span>December 15, 2024</span> | By: <span>Author Name</span></p>
                    
                    <p>
                        Suspendisse potenti. Nam fermentum nulla non lacus hendrerit, sit amet interdum ipsum scelerisque. 
                        Integer congue, eros a efficitur iaculis, nisi libero fringilla risus, non malesuada odio turpis 
                        ut sapien. Nullam vulputate varius leo vel tempor.
                    </p>
                    
                    <p>
                        Suspendisse potenti. Nam fermentum nulla non lacus hendrerit, sit amet interdum ipsum scelerisque. 
                        Integer congue, eros a efficitur iaculis, nisi libero fringilla risus, non malesuada odio turpis 
                        ut sapien. Nullam vulputate varius leo vel tempor.
                    </p>
                    
                    <div style="height:100px"></div>
                    
                </div>
            </div>

            <!-- Right Panel: Recent News -->
            <div class="col-lg-4">
                <div class="recent-news">
    <h4 class="section-title mb-3">Recent News</h4>
    <div class="news-list">
        <div class="news-item d-flex mb-4">
            <div class="news-image">
                <img src="<?php echo URL; ?>images/Businessman-11.jpg" alt="" class="img-fluid">
            </div>
            <div class="news-content ms-3">
                <h6 class="news-title">
                    <a href="<?php echo URL; ?>news-detail-page.php">Exciting News Headline Goes Here</a>
                </h6>
                <p class="news-desc">This is a short description of the news to give the reader a quick idea...</p>
            </div>
        </div>
        <div class="news-item d-flex mb-4">
            <div class="news-image">
                <img src="<?php echo URL; ?>images/Businessman-11.jpg" alt="" class="img-fluid">
            </div>
            <div class="news-content ms-3">
                <h6 class="news-title">
                    <a href="<?php echo URL; ?>news-detail-page.php">Another Recent News Headline</a>
                </h6>
                <p class="news-desc">A concise summary to engage readers and encourage them to read more...</p>
            </div>
        </div>
        <!-- Repeat more news items here -->
    </div>
</div>

            </div>
        </div>
    </div>
    <?php include PATH."include/footer.php"; ?>
</body>
