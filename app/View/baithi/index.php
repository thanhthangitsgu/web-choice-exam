<?php

use App\Core\View;

View::$activeItem = 'baithi';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quản lí bài thi</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= View::assets('css/bootstrap.css') ?>" />
    <link rel="stylesheet" href="<?= View::assets('vendors/toastify/toastify.css') ?>" />
    <link rel="stylesheet" href="<?= View::assets('vendors/perfect-scrollbar/perfect-scrollbar.css') ?>" />
    <link rel="stylesheet" href="<?= View::assets('vendors/bootstrap-icons/bootstrap-icons.css') ?>" />
    <link rel="stylesheet" href="<?= View::assets('css/app.css') ?>" />

    <link rel="shortcut icon" href="<?= View::assets('images/favicon.ico') ?>" type="image/x-icon" />
    <link rel="stylesheet" href="<?= View::assets('css/quan.css') ?>" />
</head>

<body>
    <div id="app">
        <!-- SIDEBAR -->
        <?php View::partial('sidebar')  ?>
        <div id="main" class="layout-navbar">
            <!-- HEADER -->
            <?php View::partial('header')  ?>
            <?php View::partial('changepass')  ?>
            <div id="main-content">
                <div class="page-heading" id="test">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <label>
                                    <h3>Quản lí kết quả</h3>
                                </label>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <div class=" loat-start float-lg-end mb-3">
                                    <button id='view-exam' class="btn btn-primary">
                                        <i class="bi bi-plus"></i> Xem bài thi
                                    </button>
                                    <button id='view-cal' class="btn btn-primary">
                                        <i class="bi bi-bar-chart-line"></i> Xem thống kê
                                    </button>
                                    <button id="btn-export" class="btn btn btn-success">
                                        <i class="bi bi-card-checklist"></i> Xuất file
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="boxnoidung">
                            <div>
                                <select name="select-exam" id="select-exam" class="select"> </select>
                            </div>
                        </div>
                        <div id="boxsinhvien">
                            <div>
                                <select name="select-sinhvien" id="select-stu" class="select"> </select>
                            </div>
                        </div>
                        <div id="boxmon">
                            <div>
                                <select name="select-mon" id="select-mon"  class="select"> </select>
                            </div>
                        </div>
                    </div>
                    <section class="section" id="card-task">
                        <div class="card">
                            <div class="card-body" id="card-body">
                                <div class="table-responsive" id="tbl">
                                    <div class="table-uni" id="table-baithi">
                                        <?php include 'baithi.php' ?>
                                    </div>
                                    <div class="table-uni" id="table-thongke">
                                        <?php include 'thongke.php' ?>
                                    </div>
                                    <nav class="mt-5">
                                        <ul id="pagination" class="pagination justify-content-center">
                                        </ul>
                                    </nav>
                                    <div class="loat-start float-lg-end mb-3" style="float:right">
                                        <button id='view-chart' class="btn btn-warning btn-view" style="float:right;margin-right:20px">
                                            <i class="bi bi-graph-up"></i> Xem biểu đồ </button>
                                        <button id='view-mon' class="btn btn-warning btn-view" style="float:right;margin-right:20px">
                                            <i class="bi bi-graph-up"></i> Xem môn </button>
                                    </div>
                                </div>
                            </div>
                    </section>
                    <div style="display:inline-flex">
                        <div class="chart" id="chart-pie" style="width:400px; display:inline-flex;float:left">
                        </div>
                        <div class="chart" id="chart-line" style="width:450px; display:inline;margin-left:30px">
                        </div>
                    </div>
                </div>
                <!-- FOOTER -->
                <?php View::partial('footer')  ?>
            </div>
        </div>
    </div>
    <script src="<?= View::assets('vendors/toastify/toastify.js') ?>"></script>
    <script src="<?= View::assets('vendors/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
    <script src="<?= View::assets('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= View::assets('vendors/jquery/jquery.min.js') ?>"></script>
    <script src="<?= View::assets('vendors/jquery/jquery.validate.js') ?>"></script>
    <script src="<?= View::assets('js/main.js') ?>"></script>
    <script src="<?= View::assets('js/changepass.js') ?>"></script>
    <script src="<?= View::assets('vendors/Highcharts-9.1.0/code/highcharts.js') ?>"></script>
    <script src="<?= View::assets('js/api.js') ?>"></script>
    <script src="<?= View::assets('js/menu.js') ?>"></script>
    <script src="<?= View::assets('js/api.js') ?>"></script>
    <script src="<?= View::assets('vendors\jquery.table2excel.min_bdjf5z\jquery.table2excel.min.js') ?>"> </script>
    <script src="<?= View::assets('js/baithi.js') ?>"></script>
</body>

</html>