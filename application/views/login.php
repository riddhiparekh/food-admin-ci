<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= 'Login | '.WEBSITE_TITLE ?></title>
	<?php $this->load->view('partials/headlinks'); ?>
	<?php $this->load->view('partials/scripts'); ?>
</head>
<body class="navbar-top">
	<!-- Page content -->
	<div class="page-content">
		<!-- Main content -->
		<div class="content-wrapper">
			<div class="content d-flex justify-content-center align-items-center">
				<!-- Login form -->
				<form class="login-form" action="" method="post">
					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center mb-3">
								<img src="<?= ASSET_URL ?>images/logo/ajax-loader.gif" class="rounded-round">
								<h5 class="mb-0">Login to your account</h5>
								<span class="d-block text-muted">Enter your credentials below</span>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="text" class="form-control" name="username" placeholder="Username">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" class="form-control" name="password" placeholder="Password">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
							</div>
						</div>
					</div>
				</form>
				<!-- /login form -->

			</div>
			<?php $this->load->view('partials/footer'); ?>
		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->
<script type="text/javascript">
	<?php if (isset($errMsg)) { ?>
	$(function() {
		alertNotification('<?= $errMsg ?>','error');
    });
<?php	} ?>
	
</script>
</body>
</html>