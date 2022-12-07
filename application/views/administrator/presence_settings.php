<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-10"> 

        <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    The presence hour is successfully <?= $this->session->flashdata('flash'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        <?php endif; ?>


            <!-- Collapsable Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Presence Settings</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        Presence Hour Setting
                        <div class="table-responsive">
                            <table class="table table-stripped">
                                <thead>

                                    <th>No</th>
                                    <th>Description</th>
                                    <th>Start</th>
                                    <th>Finished</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($hour as $i => $h) : ?>
                                        <tr id="<?= 'hour-' . $h->hour_id ?>">
                                            <td><?= ($i + 1) ?></td>
                                            <td><?= $h->description ?></td>
                                            <td class="hour-start"><?= $h->start ?></td>
                                            <td class="hour-finished"><?= $h->finished ?></td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-edit-hour" data-toggle="modal" data-target="#edit-hour" data-id="<?= $h->hour_id ?>" data-hour="<?= base64_encode(json_encode($h)) ?>"><i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal-wrapper">
    <div class="modal fade" id="edit-hour" tabindex="-1" role="dialog" aria-labelledby="edit-hour-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-edit-hour" method="post" action="<?= base_url('administrator/update_presence_hour') ?>" method="post" onsubmit="return true">
                    <input type="hidden" name="hour_id" id="edit-id" value="<?= $this->uri->segment(3) ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit-hour-label">Edit Presence Hour <span id="edit-description"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="start">Start Hour</label>
                            <input type="time" name="start" id="edit-start" class="form-control" placeholder="Start Hour">
                            <?= form_error('start', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="finished">Finished Hour</label>
                            <input type="time" name="finished" id="edit-finished" class="form-control" placeholder="Finished Hour">
                            <?= form_error('finished', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>