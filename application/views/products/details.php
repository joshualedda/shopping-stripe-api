<section>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-4 mb-3">
				<div class="text-decoration-none text-dark">
					<div class="card">
						<form action="<?= base_url('addtocart')  ?>" method="POST">
							<div class="card-body">
								<h5 class="card-title"><?= $product['name'] ?></h5>
								<p class="card-text"><?= $product['description'] ?></p>
								<p class="card-text"><?= $product['price'] ?></p>
								<div class="col-md-4 d-flex justify-content-end">

									<input type="number" class="form-control" placeholder="Quantity" name="quantity" value="1">
								</div>
								<input type="hidden" name="user_id" value="<?= $user_data['id'] ?? '' ?>">
								<input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
								<div class="d-flex justify-content-end">

									<input type="submit" class="btn btn-success btn-sm" value="Add to Cart" />
									<?= form_error('password', '<span class="error text-sm text-danger">', '</span>'); ?>
								</div>

							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
