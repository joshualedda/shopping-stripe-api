<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container">
		<div class="navbar-brand">Shopping</div>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>



		<div class="collapse navbar-collapse" id="navbarText">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="<?= base_url('products') ?>">Products</a>
				</li>
			</ul>

			<span class="navbar-text">
				<?php if ($is_logged_in) : ?>
					<div class="d-flex align-items-center">

						<div class=" position-relative mx-4">
							<a href="<?= base_url('carts') ?>" class="me-1 text-decoration-none">
								Cart<i class="bi bi-cart mx-2"></i>
							</a>

							<span class="position-absolute top-0 start-10 translate-middle badge rounded-pill bg-success">
    <?php echo $cart_count; ?>
</span>

						</div>


						<div class="dropdown">
							<a class="dropdown-toggle text-decoration-none" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
								<?= $user_data['first_name'] ?? '' ?> <?= $user_data['last_name'] ?? '' ?>
							</a>

							<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
								<li><a class="dropdown-item" href="#">Profile</a></li>
								<li><a class="dropdown-item" href="<?= base_url('logout') ?>">Log Out</a></li>
							</ul>
						</div>



					</div>
				<?php else : ?>
					<a href="<?= base_url('login') ?>" class="me-3 text-decoration-none">
						Login
					</a>

					<a href="<?= base_url('register') ?>" class="text-decoration-none">
						Register
					</a>
				<?php endif; ?>
			</span>
		</div>




	</div>
</nav>
