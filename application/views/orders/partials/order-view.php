<div class="card card-body mb-1 rounded-0">
	<?php
	if($order->order_status != 'rejected' && $order->order_status != 'delivered') {
	?>
		<div class="order-checkbox">
			<input type="checkbox" name="orders[]" value="<?= $order->id ?>">
		</div>
	<?php
	}
	$order_item_length = count($order->items);
	foreach ($order->items as $iter => $item) {
		$images = $item->product->images;
		?>
		<div class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row pl-4 mt-0">
			<div class="mr-lg-3 mb-3 mb-lg-0">

				<a href="<?= base_url('public/images/product/'.$images[0]) ?>" data-popup="lightbox">
					<img src="<?= base_url('public/images/product/'.$images[0]) ?>" width="96" alt="">
				</a>
			</div>
			<div class="media-body">
				<div class="row">
					<div class="col-md-7">
						<h6 class="media-title font-weight-semibold">
							<a href="#"><?= $item->product->name ?></a>
						</h6>

						<ul class="list-inline mb-3 mb-lg-2">
							<li class="list-inline-item">
								<span class="text-muted">Qty: <?= $item->qty ?></span>
							</li>
							<li class="list-inline-item">
								<span class="text-muted">Selling price: ₹<?= $item->price ?></span>
							</li>
							<?php
							if($order->delivery_boy) { ?>
								<li class="list-inline-item">
									<span class="text-muted">Delivery By: <?= $order->delivery_boy->profile->name ?></span>
								</li>
							<?php }
							?>
						</ul>
					</div>
					<?php if(!$iter) { ?>
						<div class="col-md-5">
							<b><?= $order->address->name ?></b>
							<p>
								<?= $order->address->address1 ?>
								<br />
								<?= $order->address->address2 ?>
								<br />
								<span class="mr-2"><b>City:</b>&nbsp;<?= $order->address->city ?></span>
								<span><b>State:</b>&nbsp;<?= $order->address->state ?></span>
								<br />
								<span><b>Pincode:</b>&nbsp;<?= $order->address->pincode ?></span>
							</p>
						</div>
					<?php } ?>
				</div>

			</div>
		</div>
		<?php
		if($order_item_length - 1 > $iter ) {
			echo '<hr />';
		}
	}
	?>
</div>