<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="jumbotron bg-gradient-info text-white">
            <h4 class="my-0">Welcome to</h4>
            <h2 class="display-4 my-0">Employee Attendance Management Application</h2>
            <hr class="my-4">
            <p class="lead">Web-based Employee Attendance Management App</p>
        </div>

                        <!-- Present Card -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Present</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $present; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Annual) Card Example -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Not Present</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= @$present ? $not_present : 0; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar-minus fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->