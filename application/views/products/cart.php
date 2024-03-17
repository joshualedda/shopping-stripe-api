<div class="container mt-5">
	<div class="row justify-content-center">

		<div class="col-md-8">

			<div class="card">

				<div class="card-header d-flex justify-content-between align-items-center">
					<h5 class="mb-0">Cart List</h5>
				</div>


				<div class="card-body">
					<div class="table-responsive">
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
											<a href="<?= base_url('checkOut/' . $cartItem['product_id']); ?>" class="btn btn-sm btn-success">
												Check Out
											</a>
										</td>
									</tr>
								<?php endforeach; ?>


								<?php else : ?>
									<tr>
										<td>Login first view the items</td>
									</tr>
								<?php endif; ?>

							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
