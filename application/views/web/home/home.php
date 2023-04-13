<div id="fullpage">
	<div class="wrap">
		<div class="section-image"> 
			<img src="http://placehold.it/232x407" alt="Home">
			<img src="http://placehold.it/232x407" alt="Features">
			<img src="http://placehold.it/232x407" alt="About">
			<img src="http://placehold.it/232x407" alt="Clients">
			<img src="http://placehold.it/232x407" alt="Screenshots">
			<img src="http://placehold.it/232x407" alt="Download">
			<img src="http://placehold.it/232x407" alt="Contact">
		</div>
		<div id="hand"></div>
	</div>
	
	<div class="section " id="section0">
		<div class="wrap">
			<div class="box">
				<h1>About <strong><?= WEBSITE_TITLE ?></strong></h1>
				<p>A better way to present your app using fully featured appsperia template.
				<br> Now available on the App Store and Play Store!</p> 
				<a href="#Download" class="simple-button">
					<span class="icon flaticon-download7"></span>Download App
				</a>
			</div>
		</div>
	</div>
	
	<?php $this->load->view('web/home/features') ?>
	<?php $this->load->view('web/home/about') ?>
	<?php $this->load->view('web/home/clients') ?>
	<?php $this->load->view('web/home/screenshots') ?>
	<?php $this->load->view('web/home/download') ?>
	<?php $this->load->view('web/home/contact') ?>

</div>