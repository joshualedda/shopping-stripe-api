<div class="container mt-5">
	<div class="row justify-content-center">

		<div class="col-md-8">

			<div class="card">

				<div class="card-header d-flex justify-content-between align-items-center">
					<h5 class="mb-0">Cart List</h5>
				</div>


				<div class="card-body">

					<div class="table-responsive">
						<div class="card-title fw-bold">
							Total Price:
							<?php
							$totalPrice = 0;
							foreach ($carts as $cartItem) {
								$totalPrice += ($cartItem['total_quantity'] * $cartItem['price']);
							}
							echo '$' . number_format($totalPrice, 2);
							?>
						</div>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Product Name</th>
									<th>Quantity</th>
									<th>Price</th>
									<th>Manage</th>
								</tr>
							</thead>
							<tbody>
								<?php if ($is_logged_in) : ?>
									<?php foreach ($carts as $cartItem) : ?>
										<tr>
											<td><?= $cartItem['name']; ?></td>
											<td><?= $cartItem['total_quantity']; ?></td>
											<td><?= $cartItem['price']; ?></td>
											<td>
												<a href="<?= base_url('removeCartItem/' . $cartItem['product_id']); ?>" class="btn btn-sm btn-danger">
													Remove
												</a>

											</td>
										</tr>
									<?php endforeach; ?>


							</tbody>


						</table>



						<div class="card">
							<div class="card-header">
								Biling Info
							</div>
							<form action="<?= base_url('main/stripeSuccess'); ?>" method="POST">
							<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

								<div class="card-body">


									<?php foreach ($carts as $cartItem) : ?>
										<input type="hidden" name="product[]" value="<?= $cartItem['name']; ?>">
										<input type="hidden" name="quantity[]" value="<?= $cartItem['total_quantity']; ?>">
										<input type="hidden" name="product_id[]" value="<?= $cartItem['product_id']; ?>">
									<?php endforeach; ?>

									<div class="mb-3">
										<label for="name" class="form-label">Name</label>
										<input type="text" id="first_name" name="name" class="form-control" />
										<?= form_error('name', '<span class="error text-sm text-danger">', '</span>'); ?>
									</div>


									<div class="mb-3">
										<label for="address" class="form-label">Address</label>
										<input type="text" id="address" name="address" class="form-control" />
										<?= form_error('address', '<span class="error text-sm text-danger">', '</span>'); ?>
									</div>

									<div class="mb-3">
										<label for="card_number" class="form-label">Card Number</label>
										<input type="text" id="card_number" name="card_number" class="form-control" />
										<?= form_error('card_number', '<span class="error text-sm text-danger">', '</span>'); ?>
									</div>

									<div class="d-flex justify-content-end my-3">
										<input type="submit" name="submit" class="btn btn-sm btn-success" value="Proceed to Checkout" />
									</div>


								<?php else : ?>
									<tr>
										<td>Login first view the items</td>
									</tr>
								<?php endif; ?>

							</form>


						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
</div>
