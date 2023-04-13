<ul class="nav nav-tabs nav-tabs-top customnav mb-0 border-bottom-0">
	<li class="nav-item">
		<a href="<?= base_url('orders') ?>" class="nav-link px-5 font-weight-semibold <?= $active_tab == 'pending' ? 'active' : '' ?>">
			Pending <?= $pending_order_count ? "({$pending_order_count})" : '' ?>
		</a>
	</li>
	<li class="nav-item">
		<a href="<?= base_url('orders/assigned') ?>" class="px-5 nav-link font-weight-semibold <?= $active_tab == 'assigned' ? 'active' : '' ?>">
			Assigned <?= $assigned_order_count ? "({$assigned_order_count})" : '' ?>
		</a>
	</li>
	<li class="nav-item">
		<a href="<?= base_url('orders/ready-to-pick') ?>" class="px-5 nav-link font-weight-semibold <?= $active_tab == 'pickup' ? 'active' : '' ?>">
			Ready to pick <?= $ready_to_pick_count ? "({$ready_to_pick_count})" : '' ?>
		</a>
	</li>
	<li class="nav-item">
		<a href="<?= base_url('orders/in-transit') ?>" class="px-5 nav-link font-weight-semibold <?= $active_tab == 'shipped' ? 'active' : '' ?>">
			In Transit <?= $shipped_count ? "({$shipped_count})" : '' ?>
		</a>
	</li>
</ul>