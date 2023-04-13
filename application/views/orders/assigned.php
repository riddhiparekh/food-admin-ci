<?php
$this->load->view('orders/partials/order-nav', [
	'new_order_count' => $orders->count() + $pending_order_count + $pickup_order_count + $shipped_order_count,
	'active_tab' => 'new'
]);
?>
<div class="content">
	<nav class="navbar navbar-expand-sm mb-3 p-0">
		<ul class="navbar-nav">
			<li class="nav-item bg-light mr-2 border border-dark-alpha">
				<div class="nav-link pl-2">
					<div class="form-check">
						<label class="form-check-label">
							<input type="checkbox" class="selectAllBox"> All
						</label>
					</div>
				</div>
			</li>
			<li class="nav-item bg-light border border-right-0 border-dark-alpha">
				<a class="nav-link" href="javascript:;" onclick="readyToPick()">Ready for Pickup</a>
			</li>
			<li class="nav-item bg-light border border-dark-alpha">
				<div class="dropdown">
					<a class="nav-link dropdown-toggle" href="javascript:;" data-toggle="dropdown">
						Re-assign to
					</a>
					<div class="dropdown-menu">
						<?php
						foreach ($users as $user) { ?>
							<a class="dropdown-item" href="javascript:;" onclick="assignOrdersTo(<?= $user->id ?>, `<?= $user->profile->name ?>`)"><?= $user->profile->name ?></a>
						<?php }
						?>
					</div>
				</div>
			</li>
			<li class="nav-item bg-light border border-left-0 border-dark-alpha">
				<a class="nav-link" href="javascript:;" onclick="rejectOrders()">Reject</a>
			</li>
		</ul>
	</nav>
	<?php
	$this->load->view('orders/partials/new-order-nav', [
		'pending_order_count' => $pending_order_count,
		'assigned_order_count' => $orders->count(),
		'ready_to_pick_count' => $pickup_order_count,
		'shipped_count' => $shipped_order_count,
		'active_tab' => 'assigned'
	]);
	?>
	<form method="post" id="orderAction" action="<?= base_url('orders') ?>">
		<input type="hidden" name="order_status" value="pickup">
		<input type="hidden" name="assignee" value="">
		<?php
		foreach ($orders as $order) {
			$this->load->view('orders/partials/order-view', [
				'order' => $order
			]);
		}
		?>
	</form>
</div>
<script type="text/javascript">
	$(function() {
		$('input[type=checkbox]').uniform({
			wrapperClass: 'border-slate-300 text-slate-700'
		});
		$('.order-checkbox input[type=checkbox]').change(function() {
			$('.selectAllBox').prop({
				'checked': !$('.order-checkbox input[type=checkbox]:not(:checked)').length
			});
			$.uniform.update();
		});
		$('.selectAllBox').change(function() {
			$('.order-checkbox input[type=checkbox]').prop({'checked' : $(this).is(':checked')});
			$.uniform.update();
		});
	});
	function assignOrdersTo(userId, name) {
		swal({
            title: 'Are you sure?',
            text: 'You are assigning orders to'+name+'!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, assign!',
            allowOutsideClick: false,
            showLoaderOnConfirm: true,
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light',
        }).then((result) => {
        	if (result.value) {
        		$('input[name=assignee]').val(userId);
        		$('input[name=order_status]').val('reassign');
        		$('#orderAction').submit();
        	}
        });
	}
	function rejectOrders() {
		swal({
            title: 'Are you sure?',
            text: 'You are rejecting order(s)!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, reject!',
            allowOutsideClick: false,
            showLoaderOnConfirm: true,
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light',
        }).then((result) => {
        	if (result.value) {
        		$('input[name=order_status]').val('reject');
        		$('#orderAction').submit();
        	}
        });
	}
	function readyToPick() {
		swal({
            title: 'Are you sure?',
            text: 'You are preparing order(s) for pickup!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, reject!',
            allowOutsideClick: false,
            showLoaderOnConfirm: true,
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light',
        }).then((result) => {
        	if (result.value) {
        		$('#orderAction').submit();
        	}
        });
	}
</script>