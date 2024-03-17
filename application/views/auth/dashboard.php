<main>
    <div class="container mx-auto d-flex justify-content-center mt-5">
        <div class="card col-md-4">
            <div class="card-body">
                <h5 class="card-title">Profile Information</h5>
                <form>
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" value="<?= $user_data['first_name'] ?? '' ?>">

                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" value="<?= $user_data['last_name'] ?? '' ?>">

                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contact Number</label>
                        <input type="text" class="form-control" name="contact" value="<?= $user_data['contact'] ?? '' ?>">

                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $user_data['email'] ?? '' ?>">

                    </div>


                    <a href="<?= base_url('logout'); ?>" class="text-dark text-decoration-none"> <span class="text-decoration-underline">Logout</span></a>
                </form>
            </div>
        </div>
    </div>
</main>
