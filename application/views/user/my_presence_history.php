<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><? $title; ?></h1>

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Your presence data has been <?= $this->session->flashdata('flash'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">My Presence History</h1>

        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">My Presence History</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($presence as $i => $p) : ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= $p->description ?></td>
                                    <td><?= $p->date ?></td>
                                    <td><?= $p->time ?></td>
                                    <td>
                                        <?php
                                        if (($p->hour_id == 1 && ($p->time >= $p->start && $p->time <= $p->finished))
                                            || ($p->hour_id == 2 && ($p->time >= $p->start && $p->time <= $p->finished))
                                        ) {
                                            echo '<span class="badge badge-primary">' . 'on time' . '&nbsp&nbsp&nbsp&nbsp&nbsp' . '</span>';
                                        } else if ($p->hour_id == 1 && $p->time > $p->finished) {
                                            echo '<span class="badge badge-danger">' . 'out of time' . '</span>';
                                        } else if ($p->hour_id == 2 && $p->time < $p->start) {
                                            echo '<span class="badge badge-warning">' . 'permission' . '</span>';
                                        } else if ($p->hour_id == 2 && $p->time > $p->finished) { 
                                            echo '<span class="badge badge-success">' . 'over time' . '&nbsp' . '</span>';
                                        }
                                        ?>
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
    <!-- /.container-fluid --> 
        
</div>
<!-- End of Main Content -->