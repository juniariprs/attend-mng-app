<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><? $title; ?></h1>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

        <?php if ($this->session->flashdata('flash')) : ?>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        The employee data is successfully <?= $this->session->flashdata('flash'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Employee Data</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width=30px>No</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Division</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employee as $i => $e) : ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-4 pr-1">
                                                <img src="<?= base_url('assets/img/profile/' . $e->img) ?>" class="img-thumbnail rounded-circle">
                                            </div>
                                    <td><?= $e->firstName . " " . $e->lastName ?></td>
                                    <td><?= $e->username ?></td>
                                    <td><?= $e->div_name ?></td>
                                    <td><?= $e->email ?></td>
                                    <td>
                                        <a href="<?= base_url('administrator/update_employee_data/' . $e->username) ?>">
                                            <i class="fa fa-edit bg-success p-2 text-white rounded">
                                            </i>
                                        </a> |
                                        <a href="<?= base_url('administrator/delete_employee_data/' . $e->username) ?>" onlick="return confirm('Are you sure?');"><i class="fa fa-trash bg-danger p-2 text-white rounded">
                                            </i>
                                        </a>
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