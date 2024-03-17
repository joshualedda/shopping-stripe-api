<main>

	<div class="container mx-auto d-flex justify-content-center mt-5">

		<div class="card col-md-4 ">

			<div class="card-body ">
				<h5 class="card-title">Login Here</h5>
				<form action="<?= base_url('users/loginProcess'); ?>" method="POST">
					<div class="mb-3">
						<label for="contact_email" class="form-label">Email</label>
						<input type="email" class="form-control" id="contact_email" name="email" >
						<?= form_error('contact_email', '<span class="error text-sm text-danger">', '</span>'); ?>

					</div>
					<div class="mb-3">
						<label for="password" class="form-label">Password</label>
						<input type="password" class="form-control" id="password" name="password" >
						<?= form_error('password', '<span class="error text-sm text-danger">', '</span>'); ?>

					</div>
					<div class="d-grid mb-2 ">
						<button type="submit" class="btn btn-success" name="submit">Login</button>
					</div>
					<a href="<?= base_url('register');?>" class="text-dark text-decoration-none">Don't have an account? <span class="text-decoration-underline">Register here</span></a>

				</form>


			</div>
		</div>
	</div>

</main>
