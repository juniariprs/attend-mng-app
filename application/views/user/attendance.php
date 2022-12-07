<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    The presence data is successfully <?= $this->session->flashdata('flash'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (is_weekend()) : ?>
        <div class="card">
        <div class="card-body">
            Today is weekend. No need to record your presence.
        </div>
        </div>
    <?php else : ?>
    <div class="row">
        <div class="col-sm-4">
            <div class="card text-center" style="max-width: 540px;">
                <div class="card-body">
                    <h5 class="card-title">Get In Presence</h5>
                    <p class="card-text">Click the button below to record your get in presence ...</p>
                    <button class="btn btn-primary btn-fill" id="presentbutton" <?= ($presence < 1) ? '' : 'disabled style="cursor:not-allowed"'; ($presence == 1) ? 'disabled style="cursor:not-allowed"' : ''?> onclick="location.href='<?= base_url('user/presence') ?>';this.disabled = 'disabled';">Get In Present</button>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card text-center" style="max-width: 540px;">
                <div class="card-body">
                    <h5 class="card-title">Presence</h5>
                    <p class="card-text"><i class="fa fa-3x fa-<?= ($presence < 2) ? "warning text-warning" : "check-circle text-success" ?>"></i></p>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card text-center" style="max-width: 540px;">
                <div class="card-body">
                    <h5 class="card-title">Get Out Presence</h5>
                    <p class="card-text">Click the button below to record your get out presence ...</p>
                    <button class="btn btn-primary btn-fill" id="presentbutton" <?= ($presence !== 1 || $presence == 2) ? 'disabled style="cursor:not-allowed"' : '' ?> onclick="location.href='<?= base_url('user/presence') ?>';this.disabled = 'disabled';">Get Out Present</button>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->