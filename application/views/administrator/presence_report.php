<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><? $title; ?></h1>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Presence Report</h1>

        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Presence Report</h6>
            </div> 
            <div class="card-body"> 
            
  <div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12"> 
               <form action="" method="get">
                <div class="row">
                    <div class="col-xs-12 col-sm-8">
                        <table class="table border-0">
                            <tr>
                                <th class="border-0 py-0">Name</th>
                                <th class="border-0 py-0">:</th>
                                <th class="border-0 py-0">
                                    <select name="username" id="username" class="form-control">
                                    <option value="" disabled selected>--- Select name ---</option> 
                                    <?php foreach($employee as $e): ?>
                                    <option value="<?= $e->username ?>"<?= ($e->username == $this->input->get('username')) ? 'selected' : '' ?>><?= $e->firstName . ' ' . $e->lastName ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </th>
                            </tr>
                        </table>
                    </div>
                    <div class="col-xs-12 col-sm-4 ml-auto text-right">
                        <div class="dropdown d-inline"> 
                            <a href="<?= ($e->username == $this->input->get('username')) ? 'selected' : '' ?><?= base_url('administrator/export_excel_presentrep/' . $this->input->get('username') . "?month=$month&year=$year") ?>" class="btn btn-success btn-export-excel" type="button" target="_blank">
                                <i class="fa fa-file-excel"></i>
                                Export Excel Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
        
            <div class="row">
                <div class="col-3">
                    <select name="month" id="month" class="form-control">
                        <option value="" disabled selected>--- Select month ---</option>
                        <?php foreach($all_months as $i => $m): ?>
                            <option value="<?= $i ?>" <?= ($i == $month) ? 'selected' : '' ?>><?= $m ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-3">
                    <select name="year" id="year" class="form-control">
                        <option value="" disabled selected>--- Select year ---</option>
                        <?php for($i = date('Y'); $i >= (date('Y') - 5); $i--): ?>
                            <option value="<?= $i ?>" <?= ($i == $year) ? 'selected' : '' ?>><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-xs-3">
                    <button type="submit" class="btn btn-primary btn-fill btn-block">
                        <i class="fa fa-maximize"></i> 
                        View Report
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

            <div class="card-body">
                <div class="row">
                    <div class="table">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Day, Date</th> 
                                    <th>Get In</th>
                                    <th>Status Get In</th> 
                                    <th>Get Out</th>
                                    <th>Status Get Out</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if($presentrep): ?>
                                <?php foreach($day as $i => $d): ?> 
                                    <?php
                                    $presenceperday = array_search($d['date'], array_column($presentrep, 'date')) !== false ? $presentrep[array_search($d['date'], array_column($presentrep, 'date'))] : '';
                                    ?>
                                    <tr <?= (in_array($d['day'], ['Saturday', 'Sunday'])) ? 'class="bg-dark text-white"' : '' ?> <?= ($presenceperday == '') ? 'class="bg-muted text-black"' : '' ?>>
                                    <td><?= ($i+1) ?></td>
                                    <td><?= $d['day'] . ', ' . $d['date'] ?></td>
                                    <td><?= is_weekend($d['date']) ? '-' : check_hour(@$presenceperday['get_in_h'], 1) ?></td> 
                                    <td><?= is_weekend($d['date']) ? 'weekend' : check_status(@$presenceperday['get_in_h'], 1) ?></td>
                                    <td><?= is_weekend($d['date']) ? '-' : check_hour(@$presenceperday['get_out_h'], 2) ?></td> 
                                    <td><?= is_weekend($d['date']) ? 'weekend' : check_status(@$presenceperday['get_out_h'], 2)?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td class="bg-light" colspan="6">There's no presence data available.</td>
                            </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
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