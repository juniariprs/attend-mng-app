<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">

            <form action=" " method="post">
                <div class="form-group row">
                    <label for="div_id" class="col-sm-2 col-form-label">Division ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="div_id" name="div_id" placeholder="Division ID">
                        <?= form_error('div_id', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Division Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="div_name" placeholder="Division Name">
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Add Data</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->