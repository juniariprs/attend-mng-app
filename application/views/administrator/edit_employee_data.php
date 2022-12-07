<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">

        <form action="" method="post">
            <div class="form-group row">
                <div class="col-sm-2">Photo Profile</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="<?= base_url('assets/img/profile/') . $employee->img ?>" width="192px" height="192px" class="img-thumbnail" readonly>
                        </div>    
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="firstName" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?= $employee->firstName ?>">
                    <?= form_error('firstName', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?= $employee->lastName ?>">
                    <?= form_error('lastName', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="lastName" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" name="username" value="<?= $employee->username ?>" readonly>
                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="<?= $employee->email ?>" readonly>
                </div>
            </div> 
            <div class="form-group row">
                <label for="division" class="col-sm-2 col-form-label">Division</label>
                <div class="col-sm-10"> 
                <select name="div_id" id="div_id" class="form-control">
                    <option value="" disabled selected>---Select Division---</option>
                    <?php foreach($division as $d): ?>
                        <option value="<?= $d->div_id?>"<?php if ($d->div_id == $employee->div_id) : ?> selected <?php endif; ?>><?= $d->div_name?>
                    <?php endforeach; ?>
                </select>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Save Change</button>
                </div>
            </div>

            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->