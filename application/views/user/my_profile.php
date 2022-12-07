<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Your profile has been <?= $this->session->flashdata('flash'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $user['img']; ?>" class="img-fluid rounded-start">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['firstName'] . " " . $user['lastName']; ?></h5>
                    <p class="card-text"><?= $user['email'] ?></p>
                    <p class="card-text"><?= $user['username'] ?></p>
                    <p class="card-text"><small class="text-muted">Member since <?= date('F d Y', $user['date_created']); ?></small></p>
                </div>
            </div>
        </div>
    </div>

    <a class="btn btn-primary" href="<?= base_url('user/edit_profile'); ?>" role="button">Edit Profile</a>

    <a class="btn btn-primary" href="<?= base_url('user/change_password'); ?>" role="button">Change Password</a>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->