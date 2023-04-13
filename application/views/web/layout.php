<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="author" content="KeyDesign" />
		<meta name="description" content="AppSperia - App Landing Page" />
		<meta name="keywords" content="AppSperia , Landing page, Template, App, Mobile, Android, iOS" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>101 Tadka</title>
		<link rel="icon" href="images/favicon.ico">
		
		<?php $this->load->view('web/partials/headlinks'); ?>
		<?php $this->load->view('web/partials/scripts'); ?>
		
	</head>

<body>

    <div id="preloader"><img src="images/logo.png" alt=""></div>

    <a id="main-nav" href="#sidr"><span class="flaticon-menu9"></span></a>

    <?php $this->load->view('web/partials/sidebar'); ?>

    <div class="wrap">
        <div id="logo">
            <a href="#"><img src="images/logo.png" alt=""> </a>
        </div>
    </div>
	
    <?php $this->load->view(''.$page,$pageData); ?>
    <?php $this->load->view('web/partials/footer'); ?>
	
</body>

</html>
