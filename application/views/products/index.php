<section>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<?php foreach ($products as $row) : ?>
				<div class="col-md-4 mb-3">
					<div class="card text-decoration-none text-dark">
						<form action="<?= base_url('addtocart')  ?>" method="POST">
						<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

							<div class="card-body">
								<h5 class="card-title"><?php echo $row['name']; ?></h5>
								<p class="card-text"><?php echo $row['description']; ?></p>
								<p class="card-text">$<?php echo $row['price']; ?></p>
								<div class="col-md-4 d-flex justify-content-end">

									<input type="number" class="form-control" placeholder="Quantity" name="quantity" value="1">
								</div>

								<div class="d-flex justify-content-end my-2">

									<input type="hidden" name="user_id" value="<?= $user_data['id'] ?? '' ?>">
									<input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
									<a href="<?php echo base_url('product/details/' . $row['id']); ?>" class="btn btn-sm btn-success">View</a>
									<input type="submit" class="btn btn-success btn-sm mx-2" value="Add to Cart" />

								</div>
							</div>
						</form>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

</section>
