<?php

use App\Core\View;

View::$activeItem = 'xemlichthi';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Xem lịch thi</title>

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
                <div class="page-heading">
                    <section class="section">
                        <div class="row" id="card-calendar-exam">
                        </div>
                    </section>
                </div>
                <?php View::partial('footer')  ?>
            </div>

            <!-- FOOTER -->

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
    <script src="<?= View::assets('js/api.js') ?>"></script>
    <script>
        $(document).ready(function() {

            //Lấy đề thi
            var ajaxDeThi = $.ajax({
                type: 'GET',
                url: 'http://localhost/webhoctapmvc/dethi/getAllDeThi'
            });

            //Thực hiện sau khi lấy được đề thi
            ajaxDeThi.done(function(data) {

                //Lấy danh sách môn học của sinh viên
                var listMaMon = localStorage.getItem('danhSachMaMon');
                var arrMaMon = listMaMon.split(",");
                arrMaMon[0] = arrMaMon[0].substring(2, arrMaMon[0].length - 1);
                arrMaMon[arrMaMon.length - 1] = arrMaMon[arrMaMon.length - 1].substring(1, arrMaMon[arrMaMon.length - 1].length - 2);
                for (var i = 1; i < arrMaMon.length - 1; i++) {
                    arrMaMon[i] = arrMaMon[i].substring(1, arrMaMon[i].length - 1);
                }

                //Hàm kiểm tra thời gian: 
                function compareTime(datetime, hour) {
                    var today = new Date();
                    var date = today.getFullYear() + "-" + (((today.getMonth() + 1) < 10) ? "0" : "") + (today.getMonth() + 1) + "-" + ((today.getDate() < 10) ? "0" : "") + today.getDate();
                    var time = ((today.getHours() < 10) ? "0" : "") + today.getHours() + ":" + ((today.getMinutes() < 10) ? "0" : "") + today.getMinutes() + ":" + ((today.getSeconds() < 10) ? "0" : "") + today.getSeconds();
                    var arrhour = hour.split(":");
                    arrhour[1] = (parseInt(arrhour[1]) + 15 < 10 ? "0" : "") + (parseInt(arrhour[1]) + 15).toString();
                    if (parseInt(arrhour[1]) > 60) {
                        arrhour[0] = (parseInt(arrhour[0]) + 1 < 10 ? "0" : "") + (parseInt(arrhour[0]) + 1).toString();
                        arrhour[1] = (parseInt(arrhour[1] - 60)).toString();
                    }
                    var limitTime = arrhour[0] + ":" + arrhour[1] + ":" + arrhour[2];
                    if (date < datetime) {
                        return -1;
                    } else if (date > datetime) {
                        return 1;
                    } else {
                        if (time < hour) return -1;
                        else if (time > limitTime) return 1;
                        else return 0;
                    }
                };

                for (var i = 0; i < arrMaMon.length; i++) {
                    for (var j = 0; j < parseInt(data['SoLuong']); j++) {
                        if (arrMaMon[i] == data[j]['MaMon']) {

                            var btnFomart = "";

                            if (compareTime(data[j]['NgayThi'], data[j]['GioThi']) == 0) {
                                $.ajax({
                                    type: 'GET',
                                    url: 'http://localhost/webhoctapmvc/baithi/checkIsset',
                                    data: {
                                        made: data[j]['MaDe'],
                                        masv: $('#mail').html(),
                                    }
                                }).done(function(subdata) {
                                    if (subdata != 0) {
                                        btnFomart = '<button class="btn btn-secondary flag2">Đã hoàn thành</button></div></div></div></div>';
                                    } else {
                                        btnFomart = '<a href="http://localhost/webhoctapmvc/thi/index" class="btn btn-warning flag0 ">Vào thi</a></div></div></div></div>';
                                    }
                                    let temp = data[j - 1]['NgayThi'].split('-');
                                    let ngayThi = temp[2] + '/' + temp[1] + '/' + temp[0];
                                    $('#card-calendar-exam').append('<div class="col-12 col-md-4" id="card-calendar-exam" ><div class="card"><div class="card-header"><h4>' + data[j - 1]['TenMon'] + '</h4></div><div class="card-body">\
                                    <div class="alert alert-success"><i class="bi bi-stopwatch"></i><span> Thời gian làm bài: ' + data[j - 1]['ThoiGianLamBai'] + ' phút</span></div><div class="alert alert-info"><i class="bi bi-receipt"></i><span> Số lượng câu hỏi: ' + data[j - 1]['SoLuongCauHoi'] + ' câu</span></div>\
                                    <div class="alert alert-danger"><i class="bi bi-award"></i><span> Giờ Thi: ' + data[j - 1]['GioThi'] + ' Ngày: ' + ngayThi + '</span></div>\
                                    <div class="pagination justify-content-center">' + btnFomart);
                                });
                            } else if (compareTime(data[j]['NgayThi'], data[j]['GioThi']) == -1) {
                                let temp = data[j]['NgayThi'].split('-');
                                let ngayThi = temp[2] + '/' + temp[1] + '/' + temp[0];
                                btnFomart = '<button class="btn btn-primary flag-1" >Vào thi</button></div></div></div></div>';
                                $('#card-calendar-exam').append('<div class="col-12 col-md-4" id="card-calendar-exam"><div class="card"><div class="card-header"><h4>' + data[j]['TenMon'] + '</h4></div><div class="card-body">\
                            <div class="alert alert-success"><i class="bi bi-stopwatch"></i><span> Thời gian làm bài: ' + data[j]['ThoiGianLamBai'] + ' phút</span></div><div class="alert alert-info"><i class="bi bi-receipt"></i><span> Số lượng câu hỏi: ' + data[j]['SoLuongCauHoi'] + ' câu</span></div>\
                            <div class="alert alert-danger"><i class="bi bi-award"></i><span> Giờ Thi: ' + data[j]['GioThi'] + ' Ngày: ' + ngayThi + '</span></div>\
                            <div class="pagination justify-content-center">' + btnFomart);
                            } else {
                                let temp = data[j]['NgayThi'].split('-');
                                let ngayThi = temp[2] + '/' + temp[1] + '/' + temp[0];
                                btnFomart = '<button class="btn btn-secondary flag2">Đã hoàn thành</button></div></div></div></div>';
                                $('#card-calendar-exam').append('<div class="col-12 col-md-4" id="card-calendar-exam"><div class="card"><div class="card-header"><h4>' + data[j]['TenMon'] + '</h4></div><div class="card-body">\
                            <div class="alert alert-success"><i class="bi bi-stopwatch"></i><span> Thời gian làm bài: ' + data[j]['ThoiGianLamBai'] + ' phút</span></div><div class="alert alert-info"><i class="bi bi-receipt"></i><span> Số lượng câu hỏi: ' + data[j]['SoLuongCauHoi'] + ' câu</span></div>\
                            <div class="alert alert-danger"><i class="bi bi-award"></i><span> Giờ Thi: ' + data[j]['GioThi'] + ' Ngày: ' + ngayThi + '</span></div>\
                            <div class="pagination justify-content-center">' + btnFomart);
                            }
                        }
                    }
                }

                //Gán các sự kiện:  
                $('.flag-1').click(function() {
                    Toastify({
                        text: "Chưa đến giờ thi",
                        duration: 1500,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#4fbe87",
                    }).showToast();
                })

                $('.flag2').click(function() {
                    Toastify({
                        text: "Thời gian thi đã kết thúc",
                        duration: 1000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#FF6600",
                    }).showToast();
                })
            });
        });
    </script>
</body>

</html>