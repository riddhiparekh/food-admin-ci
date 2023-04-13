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
<?php
$this->load->view('orders/partials/order-nav', [
	'new_order_count' => $orders->count() + $pending_order_count + $assigned_order_count + $shipped_order_count,
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
			<li class="nav-item bg-light border border-dark-alpha">
				<a class="nav-link" href="javascript:;" onclick="outForDelivery()">Out for delivery</a>
			</li>
			<li class="nav-item bg-light border border-left-0 border-dark-alpha">
				<a class="nav-link" href="javascript:;" onclick="rejectOrders()">Reject</a>
			</li>
		</ul>
	</nav>
	<?php
	$this->load->view('orders/partials/new-order-nav', [
		'pending_order_count' => $pending_order_count,
		'assigned_order_count' => $assigned_order_count,
		'ready_to_pick_count' => $orders->count(),
		'shipped_count' => $shipped_order_count,
		'active_tab' => 'pickup'
	]);
	?>
	<form method="post" id="orderAction" action="<?= base_url('orders') ?>">
		<input type="hidden" name="order_status" value="shipped">
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
	function outForDelivery() {
		swal({
            title: 'Are you sure?',
            text: 'You are setting order(s) out for delivery!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, proceed!',
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