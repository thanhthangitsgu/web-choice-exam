<?php

use App\Core\View;

View::$activeItem = 'dethi';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Web Học Tập</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= View::assets('css/bootstrap.css') ?>" />

    <link rel="stylesheet" href="<?= View::assets('vendors/toastify/toastify.css') ?>" />
    <link rel="stylesheet" href="<?= View::assets('vendors/perfect-scrollbar/perfect-scrollbar.css') ?>" />
    <link rel="stylesheet" href="<?= View::assets('vendors/bootstrap-icons/bootstrap-icons.css') ?>" />
    <link rel="stylesheet" href="<?= View::assets('css/app.css') ?>" />
    <link rel="shortcut icon" href="<?= View::assets('images/favicon.ico') ?>" type="image/x-icon" />
    <link rel="stylesheet" href="<?= View::assets('css/quan.css') ?>" />

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">

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
                    <div class="col-sm-6">
                        <h6>Tìm Kiếm</h6>
                        <div id="search-user-form" name="search-user-form">
                            <div class="form-group position-relative has-icon-right">
                                <input id="serch-user-text" type="text" class="form-control" placeholder="Tìm kiếm" value="">
                                <div class="form-control-icon">
                                    <i class="bi bi-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <label>
                                    <h3>Danh sách đề thi</h3>
                                </label>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">

                                <div class=" loat-start float-lg-end mb-3">
                                    <button id='btn-delete-mon' class="btn btn-danger">
                                        <i class="bi bi-trash-fill"></i> Xóa đề thi
                                    </button>
                                    <button id='open-add-mon-btn' class="btn btn-primary">
                                        <i class="bi bi-plus"></i> Thêm đề thi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 table-danger" id="table1">
                                        <thead>
                                            <tr>
                                                <th>Chọn</th>
                                                <th>Mã Đề Thi</th>
                                                <th>Môn Học</th>
                                                <th>Kỳ Thi</th>
                                                <th>Ngày Thi</th>
                                                <th>Tác Vụ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <nav class="mt-5">
                                        <ul id="pagination" class="pagination justify-content-center">
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                    </section>
                </div>

                <!-- MODAL ADD -->
                <div class="modal fade text-left" id="add-mon-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form autocomplete="off" name="add-mon-form" action="/" method="POST">
                                    <ul class="list-group">
                                        <li class="list-group-item active">Thêm đề thi</li>
                                        <li class="list-group-item">
                                            <div class="form-group">
                                                <label>Mã Đề Thi:</label>
                                                <input type="text" class="form-control" id="made" name="made">
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="cars-mon">Môn Học: </label>
                                            <select class="form-group" name="mamon" id="cars-mon" style="margin-right: 15px;">
                                            </select>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="cars-kt">Kỳ Thi: </label>
                                            <select class="form-group" name="makythi" id="cars-kt" style="margin-right: 15px;">
                                            </select>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group">
                                                <label>Số Lượng Câu:</label>
                                                <input type="text" class="form-control" id="soluong" name="soluong">
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group">
                                                <label>Thời Gian:</label>
                                                <div class="input-group input-group-sm mb-3">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">Ngày Thi: </span>
                                                    <input style="width: 27%;    z-index: 1052;" id="ngaythi" name="ngaythi" type="text" class="form-control" placeholder="dd/mm/yyyy">
                                                    <span style="margin-left:20px;" class="input-group-text" id="inputGroup-sizing-sm">Giờ Thi: </span>
                                                    <input type="text" id="giothi" name="giothi" class="form-control" style="width: 30%;    z-index: 1052;" placeholder="hh:mm">

                                                </div>

                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group">
                                                <div class="input-group input-group-sm mb-3">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">Thời gian làm bài (phút): </span>
                                                    <input type="text" id="tglambai" name="tglambai" class="form-control" style="width: 20%;    z-index: 1052;">
                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Đóng</span>
                                </button>
                                <button type="submit" class="btn btn-primary ml-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Thêm</span>
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--MODAL SUA-->
                <div class="modal fade text-left" id="repair-mon-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form autocomplete="off" name="repair-mon-form" action="/" method="POST">
                                    <ul class="list-group">
                                        <li class="list-group-item active">Sửa Đề Thi</li>
                                        <li class="list-group-item">
                                            <div class="form-group">
                                                <label>Mã Đề Thi:</label>
                                                <input type="text" class="form-control" id="re-madethi" name="made" disabled>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group">
                                                <label for="re-mamon">Môn Học: </label>
                                                <input type="text" class="form-control" name="mamon" id="re-mamon" disabled>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <label for="cars-kt">Kỳ Thi: </label>
                                            <select class="form-group" name="makythi" id="re-cars-kt" style="margin-right: 15px;">
                                            </select>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group">
                                                <label>Số Lượng Câu:</label>
                                                <input type="text" class="form-control" id="re-soluong" name="soluong" disabled>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group">
                                                <label>Thời Gian:</label>
                                                <div class="input-group input-group-sm mb-3">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">Ngày Thi: </span>
                                                    <input style="width: 27%;    z-index: 1052;" id="re-ngaythi" name="ngaythi" type="text" class="form-control" placeholder="dd/mm/yyyy">
                                                    <span style="margin-left:20px;" class="input-group-text" id="inputGroup-sizing-sm">Giờ Thi: </span>
                                                    <input type="text" id="re-giothi" name="giothi" class="form-control" style="width: 30%;    z-index: 1052;" placeholder="hh:mm">

                                                </div>

                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-group">
                                                <div class="input-group input-group-sm mb-3">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">Thời gian làm bài (phút): </span>
                                                    <input type="text" id="re-tglambai" name="tglambai" class="form-control" style="width: 20%;    z-index: 1052;">
                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Đóng</span>
                                </button>
                                <button id="repair-queston" type="submit" class="btn btn-primary ml-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Sửa</span>
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal Thong bao -->
                <div class="modal fade text-left" id="question-user-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel110" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h5 class="modal-title white" id="myModalLabel110">
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body" id="question-model">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Đóng</span>
                                </button>
                                <button type="button" class="btn btn-success ml-1" data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span id="thuchien" class="d-none d-sm-block">Thực hiện</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal View -->
                <div class="modal fade" id="view-mon-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Chi tiết đề thi</h4>
                        </div>
                            <div class="modal-body">
                                <ul class="list-group">
                                    <h6><li class="list-group-item "  style="text-align:center;">
                                        <span class="d-inline-block mb-2 w-100">
                                            <label>KỲ THI: </label>
                                            <label id="view-tenkythi"></label>
                                        </span>
                                        <span class="d-inline-block mb-1 w-100">
                                            <label>Môn Học: </label>
                                            <label id="view-tenmon" ></label>
                                        </span>
                                        <span class="d-inline-block mb-1 w-100">
                                            <label>Mã Đề Thi: </label>
                                            <label id="view-madethi" ></label>
                                        </span>
                                        <span class="d-inline-block mb-1">
                                            <label>Ngày Thi: </label>
                                            <label id="view-ngaythi" ></label>
                                        </span>
                                        <span class="d-inline-block mb-1" style="padding-left: 30px;">
                                            <label>Giờ Thi: </label>
                                            <label id="view-giothi" ></label>
                                        </span><br>
                                        <span class="d-inline-block mb-1">
                                            <label>Thời gian làm bài: </label>
                                            <label id="view-tglambai" ></label>
                                        </span>
                                        <span class="d-inline-block mb-1" style="padding-left: 30px;">
                                            <label>Số Lượng Câu: </label>
                                            <label id="view-soluong" ></label>
                                        </span>
                                    </li></h6>
                                    <li class="list-group-item">    
                                        <div id="view-chi-tiet-cau-hoi"></div>
                                    </li>
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Đóng</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <!--Modal sai pham-->
                <div class="modal fade text-left" id="thongbao-pc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5 class="modal-title" id="myModalLabel1">Thông báo</h5>
                                <p>
                                    Không thể sửa kỳ thi đã diễn ra
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                                    <span class="d-none d-sm-block">OK</span>
                                </button>
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
    <script src="<?= View::assets('js/menu.js') ?>"></script>
    <script src="<?= View::assets('js/api.js') ?>"></script>
    <script>
        let currentPage = 1
        let checkedRows = [];
        let monhocs;
        //on ready
        $(function() {

            $.post(`http://localhost/webhoctapmvc/monhoc/getAllMH`, function(response2) {
                if (response2.thanhcong) {
                    monhocs = response2.data;
                    monhocs.forEach(data => {
                        let opt = '<option value="' + data.MaMon + '">' + data.TenMon + '</option>';
                        $("#cars-mon").append(opt);
                    });
                }

            });

            $.post(`http://localhost/webhoctapmvc/kythi/getAllKT`, function(response2) {
                if (response2.thanhcong) {
                    monhocs = response2.data;
                    monhocs.forEach(data => {
                        let now = new Date();
                        let bd = new Date(data.NgayBatDau);
                        if (now <= bd) {
                            let opt = '<option value="' + data.MaKyThi + '">' + data.TenKyThi + '</option>';
                            $("#cars-kt").append(opt);
                            $("#re-cars-kt").append(opt);
                        }

                    });
                }

            });

            $('#giothi').datetimepicker({
                datepicker: false,
                format: 'H:i'
            });

            $('#re-giothi').datetimepicker({
                datepicker: false,
                format: 'H:i'
            });

            $("#ngaythi").datepicker({
                dateFormat: 'dd/mm/yy'
            });

            $("#re-ngaythi").datepicker({
                dateFormat: 'dd/mm/yy'
            });
            //kietm tra quyen
            layDSDeThiAjax();


            // Đặt sự kiện validate cho modal add mon
            $("form[name='add-mon-form']").validate({
                rules: {
                    made: {
                        required: true,
                        remote: {
                            url: "http://localhost/webhoctapmvc/dethi/checkValidMaDeThi",
                            type: "POST",
                        }
                    },
                    soluong: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    tglambai: {
                        required: true,
                        number: true,
                        min: 1,
                    },
                    ngaythi: {
                        required: true,
                        checkBD: true,
                    },
                    giothi: {
                        required: true,
                        checkGio: true,
                    }
                },
                messages: {
                    made: {
                        required: "Vui lòng nhập mã đề",
                    },
                    soluong: {
                        required: "Vui lòng nhập số lương câu",
                        number: "Số lượng câu phải là số nguyên lớn hơn 0",
                        min: "Số lượng câu phải là số nguyên lớn hơn 0",
                    },
                    tglambai: {
                        required: "Vui lòng nhập thời gian làm bài",
                        number: "thời gian làm bài phải là số nguyên lớn hơn 0",
                        min: "thời gian làm bài phải là số nguyên lớn hơn 0",
                    },
                    ngaythi: {
                        required: "Vui lòng chọn ngày thi | ",
                    },
                    giothi: {
                        required: "Vui lòng chọn giờ thi",
                    }
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    // lấy dữ liệu từ form
                    const data = Object.fromEntries(new FormData(form).entries());
                    let bd = $('#ngaythi').val().split('/');
                    let bdReal = bd[2] + "-" + bd[1] + '-' + bd[0];
                    data['ngaythi'] = bdReal;

                    $.post(`http://localhost/webhoctapmvc/dethi/addDeThi`, data, function(response) {
                        if (response.thanhcong) {

                            currentPage = 1;
                            layDSDeThiAjax();
                            Toastify({
                                text: "Thêm Thành Công",
                                duration: 1000,
                                close: true,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "#4fbe87",
                            }).showToast();
                        } else {
                            Toastify({
                                text: response.text,
                                duration: 1000,
                                close: true,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "#FF6A6A",
                            }).showToast();
                        }

                        // Đóng modal
                        $("#add-mon-modal").modal('toggle');
                    });
                    $('#makythi').val("");
                    $('#tenkythi').val("");
                    $('#ngaybd').val("dd/mm/yyyy");
                    $('#ngaykt').val("dd/mm/yyyy");

                }
            });

        });

        $("#open-add-mon-btn").click(function() {
            $("#add-mon-modal").modal('toggle')
        });


        function changePage(newPage) {
            currentPage = newPage;
            layDSDeThiAjax();
        }

        function changePageSearch(newPage) {
            currentPage = newPage;
            layDSDeThiSearch();
        }

        $("#search-user-form").keyup(debounce(function() {
            currentPage = 1;
            layDSDeThiSearch();
        }, 200));


        function layDSDeThiAjax() {
            $.get(`http://localhost/webhoctapmvc/dethi/getDeThi?rowsPerPage=10&page=${currentPage}`, function(response) {
                const table1 = $('#table1 > tbody');
                table1.empty();
                checkedRows = [];
                $row = 0;
                response.data.forEach(data => {

                    let now = new Date();
                    let bd = new Date(data.NgayThi);
                    let gio = data.GioThi.split(":");
                    bd.setHours(gio[0]);
                    bd.setMinutes(gio[1]);
                    let dis = "";
                    if (now > bd) {
                        dis = "disabled";
                    }
                    let newBD = (bd.getDate()) + '/' + (bd.getMonth() + 1) + '/' + bd.getFullYear();
                    if ($row % 2 == 0) {

                        table1.append(`
                        <tr class="table-light">
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaDe}" ${dis}>
                                </div>
                            </td>
                            <td>${data.MaDe}</td>
                            <td>${data.TenMon}</td>
                            <td>${data.TenKyThi}</td>
                            <td>${newBD}</td>
                            <td>
                                <button onclick="viewRow('${data.MaDe}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaDe}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;" ${dis}>
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaDe}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;" ${dis}>
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    } else {
                        table1.append(`
                        <tr class="table-info">
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaDe}" ${dis}>
                                </div>
                            </td>
                            <td>${data.MaDe}</td>
                            <td>${data.TenMon}</td>
                            <td>${data.TenKyThi}</td>
                            <td>${newBD}</td>
                            <td>
                                <button onclick="viewRow('${data.MaDe}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaDe}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;" ${dis}>
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaDe}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;" ${dis}>
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    }
                    checkedRows.push(data.MaDe);
                    $row += 1;
                });

                const pagination = $('#pagination');
                // Xóa phân trang cũ
                pagination.empty();
                if (response.totalPage > 1) {
                    for (let i = 1; i <= response.totalPage; i++) {
                        if (i == currentPage) {
                            pagination.append(`
                        <li class="page-item active">
                            <button class="page-link" onClick='changePage(${i})'>${i}</button>
                        </li>`)
                        } else {
                            pagination.append(`
                        <li class="page-item">
                            <button class="page-link" onClick='changePage(${i})'>${i}</button>
                        </li>`)
                        }

                    }
                }

            });
        }

        function layDSDeThiSearch() {
            $.get(`http://localhost/webhoctapmvc/dethi/getDeThi?rowsPerPage=10&page=${currentPage}&search=${$('#serch-user-text').val()}`, function(response) {
                const table1 = $('#table1 > tbody');
                table1.empty();
                checkedRows = [];
                $row = 0;
                response.data.forEach(data => {
                    let now = new Date();
                    let bd = new Date(data.NgayThi);
                    let dis = "";
                    if (now > bd) {
                        dis = "disabled";
                    }
                    let newBD = (bd.getDate()) + '/' + (bd.getMonth() + 1) + '/' + bd.getFullYear();
                    if ($row % 2 == 0) {

                        table1.append(`
                        <tr class="table-light">
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaDe}" ${dis}>
                                </div>
                            </td>
                            <td>${data.MaDe}</td>
                            <td>${data.TenMon}</td>
                            <td>${data.TenKyThi}</td>
                            <td>${newBD}</td>
                            <td>
                                <button onclick="viewRow('${data.MaDe}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaDe}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;" ${dis}>
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaDe}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;" ${dis}>
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    } else {
                        table1.append(`
                        <tr class="table-info">
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaDe}" ${dis}>
                                </div>
                            </td>
                            <td>${data.MaDe}</td>
                            <td>${data.TenMon}</td>
                            <td>${data.TenKyThi}</td>
                            <td>${newBD}</td>
                            <td>
                                <button onclick="viewRow('${data.MaDe}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaDe}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;" ${dis}>
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaDe}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;" ${dis}>
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    }
                    checkedRows.push(data.MaDe);
                    $row += 1;
                });

                const pagination = $('#pagination');
                // Xóa phân trang cũ
                pagination.empty();
                if (response.totalPage > 1) {
                    for (let i = 1; i <= response.totalPage; i++) {
                        if (i == currentPage) {
                            pagination.append(`
                        <li class="page-item active">
                            <button class="page-link" onClick='changePageSearch(${i})'>${i}</button>
                        </li>`)
                        } else {
                            pagination.append(`
                        <li class="page-item">
                            <button class="page-link" onClick='changePageSearch(${i})'>${i}</button>
                        </li>`)
                        }

                    }
                }
            });
        }


        function viewRow(params) {
            let data = {
                made: params
            };
            $.post(`http://localhost/webhoctapmvc/dethi/viewDeThi`, data, function(response) {
                if (response.thanhcong) {
                    $("#view-madethi").html(response.MaDe);
                    $("#view-tenmon").html(response.TenMon);
                    $("#view-tenkythi").html(response.TenKyThi.toUpperCase());
                    $("#view-soluong").html(response.SoLuongCau);
                    let bd = new Date(response.NgayThi);
                    let newBD = (bd.getDate()) + '/' + (bd.getMonth() + 1) + '/' + bd.getFullYear();
                    $('#view-ngaythi').html(newBD);
                    $('#view-giothi').html(response.GioThi);
                    $('#view-tglambai').html(response.ThoiGianLamBai + ' phút');
                    
                    $("#view-chi-tiet-cau-hoi").empty();
                    var ajaxCauHoi = $.ajax({
                        type: 'GET',
                        url: 'http://localhost/webhoctapmvc/dethi/getCauHoi',
                        data:{
                            made: $("#view-madethi").html(),
                        }
                    });
                    ajaxCauHoi.done(function(data){

                        for (var i = 1; i <= data['SoLuong']; i++) {
                            var idND = 'view-nd-modal-' + i.toString();
                            var idA = 'view-a-modal-' + i.toString();
                            var idB = 'view-b-modal-' + i.toString();
                            var idC = 'view-c-modal-' + i.toString();
                            var idD = 'view-d-modal-' + i.toString();                    
                            var DapAn = data[i]['DapAn'].toString();

                            $("#view-chi-tiet-cau-hoi").append(createModal(idND, idA, idB, idC, idD));
                            $('#view-nd-modal-'+i.toString()).html('Câu ' + i + ' ('+data[i]['TenDoKho']+'): ' + data[i]['NoiDung']);
                            $('#view-a-modal-'+i.toString()).html('A. ' + data[i]['A']);
                            $('#view-b-modal-'+i.toString()).html('B. ' + data[i]['B']);
                            $('#view-c-modal-'+i.toString()).html('C. ' + data[i]['C']);
                            $('#view-d-modal-'+i.toString()).html('D. ' + data[i]['D']);
                            if(DapAn.charAt(0)=='A')
                                $('#view-a-modal-'+i.toString()).css('color', 'red');
                            else if(DapAn.charAt(0)=='B')
                                $('#view-b-modal-'+i.toString()).css('color', 'red');
                            else if(DapAn.charAt(0)=='C')
                                $('#view-c-modal-'+i.toString()).css('color', 'red');
                            else
                                $('#view-d-modal-'+i.toString()).css('color', 'red');
                        }

                    });
                    function createModal(idND, idA, idB, idC, idD) {
                        return '<div> <span id ="'+ idND +'"></span></div>\
                                <div style="padding-left:50px;">\
                                    <div> <span id ="'+ idA +'"></span></div>\
                                    <div> <span id ="'+ idB +'"></span></div>\
                                    <div> <span id ="'+ idC +'"></span></div>\
                                    <div> <span id ="'+ idD +'"></span></div>\
                                </div>'
                    }
                }
            });
            $("#view-mon-modal").modal('toggle');
        }

        function repairRow(params) {
            let data = {
                made: params
            };

            $.post(`http://localhost/webhoctapmvc/dethi/viewDeThi`, data, function(response) {
                if (response.thanhcong) {
                    if (response.thanhcong) {
                        $("#re-madethi").val(response.MaDe);
                        $("#re-mamon").val(response.TenMon);
                        $("#re-tenkythi").val(response.TenKyThi);
                        $("#re-soluong").val(response.SoLuongCau);
                        let bd = new Date(response.NgayThi);
                        let newBD = (bd.getDate()) + '/' + (bd.getMonth() + 1) + '/' + bd.getFullYear();
                        $('#re-ngaythi').val(newBD);
                        $('#re-giothi').val(response.GioThi);
                        $('#re-tglambai').val(response.ThoiGianLamBai);

                    }

                    $("#repair-mon-modal").modal('toggle');
                }
            });

            //Sua form
            $("form[name='repair-mon-form']").validate({
                rules: {
                    tglambai: {
                        required: true,
                        number: true,
                        min: 1,
                    },
                    ngaythi: {
                        required: true,
                        checkBD: true,
                    },
                    giothi: {
                        required: true,
                        checkGio: true,
                    }
                },
                messages: {
                    tglambai: {
                        required: "Vui lòng nhập thời gian làm bài",
                        number: "thời gian làm bài phải là số nguyên lớn hơn 0",
                        min: "thời gian làm bài phải là số nguyên lớn hơn 0",
                    },
                    ngaythi: {
                        required: "Vui lòng chọn ngày thi | ",
                    },
                    giothi: {
                        required: "Vui lòng chọn giờ thi",
                    }
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    $("#myModalLabel110").text("Quản Lý Đề Thi");
                    $("#question-model").text("Bạn có chắc chắn muốn sửa kỳ thi này không");
                    $("#question-user-modal").modal('toggle');
                    $('#thuchien').off('click');
                    $("#thuchien").click(function() {
                        // lấy dữ liệu từ form

                        const data = Object.fromEntries(new FormData(form).entries());
                        let bd = $('#re-ngaythi').val().split('/');
                        let bdReal = bd[2] + "-" + bd[1] + '-' + bd[0];
                        data['ngaythi'] = bdReal;
                        data['made'] = $('#re-madethi').val();
                        console.log(data);
                        $.post(`http://localhost/webhoctapmvc/dethi/repairDeThi`, data, function(response) {
                            if (response.thanhcong) {
                                currentPage = 1;
                                layDSDeThiAjax();
                                Toastify({
                                    text: "Sửa Thành Công",
                                    duration: 1000,
                                    close: true,
                                    gravity: "top",
                                    position: "center",
                                    backgroundColor: "#4fbe87",
                                }).showToast();
                            } else {
                                Toastify({
                                    text: "Sửa Thất Bại",
                                    duration: 1000,
                                    close: true,
                                    gravity: "top",
                                    position: "center",
                                    backgroundColor: "#FF6A6A",
                                }).showToast();
                            }

                            // Đóng modal
                            $("#repair-mon-modal").modal('toggle')
                        });
                    });
                }
            })
        }

        function deleteRow(params) {
            let data = {
                made: params
            };
            $("#myModalLabel110").text("Quản Lý Đề Thi");
            $("#question-model").text("Bạn có chắc chắn muốn xóa đề thi này không");
            $("#question-user-modal").modal('toggle');
            $('#thuchien').off('click');
            $("#thuchien").click(function() {
                $.post(`http://localhost/webhoctapmvc/dethi/deleteDeThi`, data, function(response) {
                    if (response.thanhcong) {
                        Toastify({
                            text: "Xóa Thành Công",
                            duration: 1000,
                            close: true,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#4fbe87",
                        }).showToast();
                        currentPage = 1;
                        layDSDeThiAjax();
                    } else {
                        Toastify({
                            text: "Xóa Thất Bại",
                            duration: 1000,
                            close: true,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#FF6A6A",
                        }).showToast();
                    }
                });
            });

        }
        $("#btn-delete-mon").click(function() {
            $("#myModalLabel110").text("Quản Lý Đề Thi");
            $("#question-model").text("Bạn có chắc chắn muốn xóa những đề thi này không");
            $("#question-user-modal").modal('toggle');
            $('#thuchien').off('click');
            $("#thuchien").click(function() {
                let datas = []
                checkedRows.forEach(checkedRow => {
                    if ($('#' + checkedRow).prop("checked")) {
                        datas.push(checkedRow);
                    }
                });
                let data = {
                    mades: JSON.stringify(datas)
                };
                $.post(`http://localhost/webhoctapmvc/dethi/deleteDeThis`, data, function(response) {
                    if (response.thanhcong) {
                        Toastify({
                            text: "Xóa Thành Công",
                            duration: 1000,
                            close: true,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#4fbe87",
                        }).showToast();
                        currentPage = 1;
                        layDSDeThiAjax();
                    } else {
                        Toastify({
                            text: "Xóa Thất Bại",
                            duration: 1000,
                            close: true,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#FF6A6A",
                        }).showToast();
                    }
                });
            });
        });

        jQuery.validator.addMethod("checkBD", function(value, element) {
            let now = new Date();
            let nowReal = (now.getMonth() + 1) + "/" + now.getDate() + '/' + now.getFullYear();
            let isNow = new Date(nowReal);
            let bd = value.split('/');
            let realBd = bd[1] + '/' + bd[0] + '/' + bd[2];
            let isDate = new Date(realBd);
            let kq = true;
            if (isDate < isNow) {
                kq = false;
            }
            return this.optional(element) || kq
        }, "Ngày thi phải lớn hơn hiện tại ");

        jQuery.validator.addMethod("checkGio", function(value, element) {
            let gio = value.split(':');
            let bd = $('#ngaythi').val().split('/');
            let bdReal = bd[1] + "/" + bd[0] + '/' + bd[2];
            let isBd = new Date(bdReal);
            isBd.setHours(gio[0]);
            isBd.setMinutes(gio[1]);

            let now = new Date();
            let kq = true;
            if (isBd < now) {
                kq = false;
            }
            return this.optional(element) || kq
        }, "Giờ thi phải lớn hơn giờ hiện tại ");
    </script>
</body>

</html>