<!-- Main sidebar -->
<?php
$auth_admin_data = Auth::get();
?>
<div class="sidebar sidebar-dark sidebar-main sidebar-fixed sidebar-expand-md">
	<div class="sidebar-mobile-toggler text-center">
		<a href="#" class="sidebar-mobile-main-toggle">
			<i class="icon-arrow-left8"></i>
		</a>
		Navigation
		<a href="#" class="sidebar-mobile-expand">
			<i class="icon-screen-full"></i>
			<i class="icon-screen-normal"></i>
		</a>
	</div>
	<div class="sidebar-content">
		<div class="sidebar-user">
			<div class="card-body">
				<div class="media">
					<div class="mr-3">
						<a href="#"><img src="<?= ADMIN_ASSET_URL ?>/images/placeholder.png" width="38" height="38" class="rounded-circle" alt=""></a>
					</div>

					<div class="media-body">
						<div class="media-title font-weight-semibold"><?= explode('@', $auth_admin_data['email'])[0] ?></div>
					</div>
				</div>
			</div>
		</div>
		<div class="card card-sidebar-mobile">
			<ul class="nav nav-sidebar" data-nav-type="accordion">
				<!-- Main -->
				<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
				<li class="nav-item">
					<a href="<?= base_url('') ?>" class="nav-link">
						<i class="icon-home4"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('category') ?>" class="nav-link">
						<i class="icon-tree6"></i>
						<span>Category</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('product') ?>" class="nav-link">
						<i class="icon-cube4"></i>
						<span>Product</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('coupon') ?>" class="nav-link">
						<i class="icon-price-tag3"></i>
						<span>Coupons</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('delivery-boy') ?>" class="nav-link">
						<i class="icon-truck"></i>
						<span>Delivery Boy</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('orders') ?>" class="nav-link">
						<i class="icon-cart2"></i>
						<span>Orders</span>
					</a>
				</li>
                <?php
                    if (0) {
                ?> 
                    <li class="nav-item nav-item-submenu">
                        <a href="javascript:void(0)" class="nav-link">
                            <i class="icon-meter2"></i>
                            <span>Content Pages</span>
                        </a>
                        <ul class="nav nav-group-sub">
                            <li class="nav-item">
                                <a href="<?= base_url('content/dmca') ?>" class="nav-link">
                                    <span>DMCA</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php
                    }
                ?>
				<li class="nav-item nav-item-submenu">
					<a href="#" class="nav-link"><i class="icon-earth"></i> <span>Website</span></a>

					<ul class="nav nav-group-sub" data-submenu-title="Layouts">
						<li class="nav-item"><a href="<?= base_url('website/about') ?>" class="nav-link">About</a></li>
						<li class="nav-item"><a href="<?= base_url('website/features') ?>" class="nav-link">Features</a></li>
						<li class="nav-item"><a href="<?= base_url('website/benifits') ?>" class="nav-link">Benifits</a></li>
						<li class="nav-item"><a href="<?= base_url('website/feedbacks') ?>" class="nav-link">Feedbacks</a></li>
						<li class="nav-item"><a href="<?= base_url('website/screenshots') ?>" class="nav-link">Screenshots</a></li>
						<li class="nav-item"><a href="<?= base_url('website/downloads') ?>" class="nav-link">Downloads</a></li>
						<li class="nav-item"><a href="<?= base_url('website/contact') ?>" class="nav-link">Contact</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>