
<main>
        <div class="container mx-auto d-flex justify-content-center mt-5">
            <div class="card col-md-4">
               
                <div class="card-body">
                    <h5 class="card-title">Register Here</h5>
                    <form action="<?=base_url('users/registerprocess') ?>" method="POST">
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first_name">
							<?= form_error('first_name', '<span class="error text-sm text-danger">', '</span>'); ?>

                        </div>

                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name">
							<?= form_error('last_name', '<span class="error text-sm text-danger">', '</span>'); ?>

                        </div>

                    
                        
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email">
							<?= form_error('email', '<span class="error text-sm text-danger">', '</span>'); ?>

                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
					<?= form_error('password', '<span class="error text-sm text-danger">', '</span>'); ?>

                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation">
							<?= form_error('password_confirmation', '<span class="error text-sm text-danger">', '</span>'); ?>

                        </div>


						<div class="d-grid mb-2 ">
                            <input type="submit" class="btn btn-success" name="submit" value="Register" />
                        </div>

                        <a href="<?= base_url('users');?>" class="text-dark text-decoration-none">Already have an account? <span class="text-decoration-underline">Login here</span></a>
                    </form>
                </div>
            </div>
        </div>

</main>
