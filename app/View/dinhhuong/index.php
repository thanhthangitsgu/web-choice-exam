<?php

use App\Core\View;

View::$activeItem = 'dinhhuong';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= View::assets('css/bootstrap.css') ?>" />

    <link rel="stylesheet" href="<?= View::assets('vendors/toastify/toastify.css') ?>" />
    <link rel="stylesheet" href="<?= View::assets('vendors/perfect-scrollbar/perfect-scrollbar.css') ?>" />
    <link rel="stylesheet" href="<?= View::assets('vendors/bootstrap-icons/bootstrap-icons.css') ?>" />
    <link rel="stylesheet" href="<?= View::assets('css/app.css') ?>" />
    <link rel="shortcut icon" href="<?= View::assets('images/favicon.ico') ?>" type="image/x-icon')" />
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
                <div class="page-heading">
                    <div style="margin-bottom: 5%;" class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Định Hướng Ngành Học</h3>

                            </div>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Biểu Đồ: Cho biết tỉ lệ phù hợp với ngành học</h4>
                                </div>
                                <div class="card-body">
                                    <div id="chart-profile-visit"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 ">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Biểu Đồ: Cho biết tỉ lệ phù hợp của các ngành với bản thân</h4>
                                </div>
                                <div class="card-body">
                                    <div id="chart-visitors-profile"></div>
                                </div>
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
        <script src="<?= View::assets('js/menu.js') ?>"></script>
        <script src="<?= View::assets('vendors/apexcharts/apexcharts.js') ?>"></script>
        <script src="<?= View::assets('js/api.js') ?>"></script>
        <script>
            var diem = JSON.parse(localStorage.getItem("danhSachDiem"));
            ktpm = diem[0].ktpm;
            httt = diem[1].httt;
            mmt = diem[2].mmt;
            cnt = diem[3].cnt;
            var optionsProfileVisit = {
                annotations: {
                    position: "back",
                },
                dataLabels: {
                    enabled: 100,
                },
                chart: {
                    type: "bar",
                    height: 350,
                },
                fill: {
                    opacity: 1,
                },
                plotOptions: {},
                series: [{
                    name: "Thích Hợp",
                    data: [ktpm, httt, mmt],
                }, ],
                colors: '#55acee',
                xaxis: {
                    categories: [
                        "Kỹ Thuật Phần Mềm",
                        "Hệ Thống Thông Tin",
                        "Mạng Máy Tính",
                    ],
                },
            };
            let optionsVisitorsProfile = {
                series: [
                    Math.round((ktpm / cnt) * 10000) / 10000,
                    Math.round((httt / cnt) * 10000) / 10000,
                    Math.round((mmt / cnt) * 10000) / 10000,
                ],
                labels: ["Kỹ Thuật Phần Mềm",
                    "Hệ Thống Thông Tin",
                    "Mạng Máy Tính",
                ],
                colors: ["#4fbe87", "#eaca4a", "#f3616d"],
                chart: {
                    type: "donut",
                    width: "100%",
                    height: "400px",
                },
                legend: {
                    position: "bottom",
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: "10%",
                        },
                    },
                },
            };
            var chartProfileVisit = new ApexCharts(
                document.querySelector("#chart-profile-visit"),
                optionsProfileVisit
            );
            var chartVisitorsProfile = new ApexCharts(
                document.getElementById("chart-visitors-profile"),
                optionsVisitorsProfile
            );

            $("#chart-profile-visit").empty();
            chartProfileVisit.render();

            $("#chart-visitors-profile").empty();
            chartVisitorsProfile.render();
        </script>
</body>

</html>