<style type="text/css">
	.customnav .nav-link.active {
		background: var(--white);
	}
	.customnav .nav-link:not(.active) {
		background: var(--light);
		border-left: 1px solid #eee; 
	}
	.order-checkbox {
    	position: absolute;
    	left: 10px;
	}
</style>
<ul class="nav nav-tabs nav-tabs-bottom bg-white mb-0">
	<li class="nav-item">
		<a href="<?= base_url('orders') ?>" class="nav-link <?= $active_tab == 'new' ? 'active' : '' ?> font-weight-semibold">
			New Orders (<?= $new_order_count ?>)
		</a>
	</li>
	<li class="nav-item">
		<a href="<?= base_url('orders/completed') ?>" class="nav-link <?= $active_tab == 'completed' ? 'active' : '' ?> text-mute font-weight-semibold">
			Completed
		</a>
	</li>
	<li class="nav-item">
		<a href="<?= base_url('orders/cancelled') ?>" class="nav-link text-mute font-weight-semibold <?= $active_tab == 'cancelled' ? 'active' : '' ?>">
			Cancelled
		</a>
	</li>
</ul>