<?php
$this->load->view('orders/partials/order-nav', [
	'orders' => $orders,
	'assigned_order_count' => $new_order_count,
	'active_tab' => 'completed'
]);
?>
<div class="content">
	<?php
	foreach ($orders as $order) {
		$this->load->view('orders/partials/order-view', [
			'order' => $order
		]);
	}
	?>
</div>