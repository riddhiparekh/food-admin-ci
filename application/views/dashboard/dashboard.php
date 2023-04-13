<div class="page-header page-header-light">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="<?= base_url('') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
				<span class="breadcrumb-item active">Dashboard</span>
			</div>

			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
<div class="content">
	<div class="row">

		<div class="col-sm-6 col-xl-3">
			<a href="<?= base_url('orders') ?>">
				<div class="card card-body bg-success-400 has-bg-image">
					<div class="media">
						<div class="mr-3 align-self-center">
							<i class="icon-cart icon-3x opacity-75"></i>
						</div>

						<div class="media-body text-right">
							<h3 class="mb-0"><?= Order::NewOrders()->count() ?></h3>
							<span class="text-uppercase font-size-xs">New Orders</span>
						</div>
					</div>
				</div>
			</a>
		</div>

		<div class="col-sm-6 col-xl-3">
			<div class="card card-body bg-indigo-400 has-bg-image">
				<div class="media">
					<div class="mr-3 align-self-center">
						<i class="icon-coins icon-3x opacity-75"></i>
					</div>

					<div class="media-body text-right">
						<h3 class="mb-0"><?= Order::CompletedOrders()->count() ?></h3>
						<span class="text-uppercase font-size-xs">Completed Orders</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-xl-3">
			<div class="card card-body bg-teal-700 has-bg-image">
				<div class="media">
					<div class="mr-3 align-self-center">
						<i class="icon-piggy-bank icon-3x opacity-75"></i>
					</div>

					<div class="media-body text-right">
						<h3 class="mb-0">₹<?= (double)Order::NewOrders()->sum('grand_total') ?></h3>
						<span class="text-uppercase font-size-xs">Pending Amount</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-xl-3">
			<div class="card card-body bg-warning-600 has-bg-image">
				<div class="media">
					<div class="mr-3 align-self-center">
						<i class="icon-cash3 icon-3x opacity-75"></i>
					</div>

					<div class="media-body text-right">
						<h3 class="mb-0">₹<?= (double)Order::CompletedOrders()->sum('grand_total') ?></h3>
						<span class="text-uppercase font-size-xs">Total Earning</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-sm-6 col-xl-3">
			<div class="card card-body bg-blue-400 has-bg-image">
				<div class="media">
					<div class="media-body">
						<h3 class="mb-0"><?= User::customer()->count() ?></h3>
						<span class="text-uppercase font-size-xs">Total Users</span>
					</div>

					<div class="ml-3 align-self-center">
						<i class="icon-users4 icon-3x opacity-75"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-xl-3">
			<div class="card card-body bg-brown-800 has-bg-image">
				<div class="media">
					<div class="media-body">
						<h3 class="mb-0"><?= User::deliveryBoy()->count() ?></h3>
						<span class="text-uppercase font-size-xs">Total Delivery boy</span>
					</div>

					<div class="ml-3 align-self-center">
						<i class="icon-users4 icon-3x opacity-75"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-xl-3">
			<div class="card card-body bg-danger-400 has-bg-image">
				<div class="media">
					<div class="media-body">
						<h3 class="mb-0"><?= Product::count() ?></h3>
						<span class="text-uppercase font-size-xs">Total Products</span>
					</div>

					<div class="ml-3 align-self-center">
						<i class="icon-cup2 icon-3x opacity-75"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>