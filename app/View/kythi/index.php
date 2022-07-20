<?php

use App\Core\View;

View::$activeItem = 'kythi';

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
                                    <h3>Danh sách kỳ thi</h3>
                                </label>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">

                                <div class=" loat-start float-lg-end mb-3">
                                    <button id='btn-delete-mon' class="btn btn-danger">
                                        <i class="bi bi-trash-fill"></i> Xóa kỳ thi
                                    </button>
                                    <button id='open-add-mon-btn' class="btn btn-primary">
                                        <i class="bi bi-plus"></i> Thêm kỳ thi
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
                                                <th>Mã Kỳ Thi</th>
                                                <th>Tên Kỳ Thi</th>
                                                <th>Ngày Bắt Đầu</th>
                                                <th>Ngày Kết Thúc</th>
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
                            <div class="modal-header">
                                <h4 class="modal-title">Thêm Kỳ Thi</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form name="add-mon-form" action="/" method="POST">
                                <div class="modal-body">
                                    <label for="makythi">Mã Kỳ Thi: </label>
                                    <div class="form-group">
                                        <input type="text" id="makythi" name="makythi" placeholder="Mã kỳ thi" class="form-control">
                                    </div>
                                    <label for="tenkythi">Tên Kỳ Thi: </label>
                                    <div class="form-group">
                                        <input type="text" id="tenkythi" name="tenkythi" placeholder="Tên kỳ thi" class="form-control">
                                    </div>
                                    <label>Thời gian: </label>
                                    <div class="form-group">
                                        <div class="input-group input-group-sm mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Bắt đầu: </span>
                                            <input style="width: 27%;    z-index: 1052;" id="ngaybd" name="ngaybd" placeholder="dd/mm/yyyy" type="text" class="form-control">
                                            <span style="margin-left:20px;" class="input-group-text" id="inputGroup-sizing-sm">Kết thúc: </span>
                                            <input type="text" id="ngaykt" name="ngaykt" placeholder="dd/mm/yyyy" class="form-control" style="width: 30%;    z-index: 1052;">
                                        </div>
                                        <!-- <input type="text"  class="form-control" "> -->

                                    </div>
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
                            <div class="modal-header">
                                <h4 class="modal-title">Sửa Kỳ Thi</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form name="repair-mon-form" action="/" method="POST">
                                <div class="modal-body">
                                    <label for="makythi">Mã Kỳ Thi: </label>
                                    <div class="form-group">
                                        <input type="text" id="re-makythi" name="makythi" placeholder="Mã kỳ thi" class="form-control" disabled>
                                    </div>
                                    <label for="tenkythi">Tên Kỳ Thi: </label>
                                    <div class="form-group">
                                        <input type="text" id="re-tenkythi" name="tenkythi" placeholder="Tên kỳ thi" class="form-control">
                                    </div>
                                    <label>Thời gian: </label>
                                    <div class="form-group">
                                        <div class="input-group input-group-sm mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Bắt đầu: </span>
                                            <input style="width: 27%;    z-index: 1052;" id="re-ngaybd" name="ngaybd" placeholder="dd/mm/yyyy" type="text" class="form-control">
                                            <span style="margin-left:20px;" class="input-group-text" id="inputGroup-sizing-sm">Kết thúc: </span>
                                            <input type="text" id="re-ngaykt" name="ngaykt" placeholder="dd/mm/yyyy" class="form-control" style="width: 30%;    z-index: 1052;">
                                        </div>
                                        <!-- <input type="text"  class="form-control" "> -->

                                    </div>
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
                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">

                            <div class="modal-body">
                                <ul class="list-group">
                                    <li class="list-group-item active">Thông Tin Chi Tiết</li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Mã Kỳ Thi:</label>
                                            <input type="text" class="form-control" id="view-makythi" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Tên Kỳ Thi:</label>
                                            <input type="text" class="form-control" id="view-tenkythi" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <label>Thời Gian:</label>
                                        <div class="input-group input-group-sm mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Bắt đầu: </span>
                                            <input style="width: 27%;    z-index: 1052;" id="view-ngaybd" name="ngaybd" placeholder="dd/mm/yyyy" type="text" class="form-control" disabled>
                                            <span style="margin-left:20px;" class="input-group-text" id="inputGroup-sizing-sm">Kết thúc: </span>
                                            <input type="text" id="view-ngaykt" name="ngaykt" placeholder="dd/mm/yyyy" class="form-control" style="width: 30%;    z-index: 1052;" disabled>
                                        </div>
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
    <script src="<?= View::assets('js/menu.js') ?>"></script>
    <script src="<?= View::assets('js/api.js') ?>"></script>
    <script>
        let currentPage = 1
        let checkedRows = [];
        // on ready
        $(function() {

            $("#ngaybd").datepicker({
                dateFormat: 'dd/mm/yy'
            });
            $("#ngaykt").datepicker({
                dateFormat: 'dd/mm/yy'
            });
            $("#re-ngaybd").datepicker({
                dateFormat: 'dd/mm/yy'
            });
            $("#re-ngaykt").datepicker({
                dateFormat: 'dd/mm/yy'
            });
            //kietm tra quyen
            layDSKyThiAjax();


            // Đặt sự kiện validate cho modal add mon
            $("form[name='add-mon-form']").validate({
                rules: {
                    makythi: {
                        required: true,
                        remote: {
                            url: "http://localhost/webhoctapmvc/kythi/checkValidMaKyThi",
                            type: "POST",
                        }
                    },
                    tenkythi: {
                        required: true,
                        validateTenMon: true,
                    },
                    ngaybd: {
                        required: true,
                        checkBD: true,
                    },
                    ngaykt: {
                        required: true,
                        checkKT: true,
                    }
                },
                messages: {
                    makythi: {
                        required: "Vui lòng nhập mã kỳ thi",
                    },
                    tenkythi: {
                        required: "Vui lòng nhập tên kì thi",
                        validateTenMon: "Tên kỳ thi chứa các kí tự a-z, 0-9, [space], _, - (từ 2 kí tự trở lên)!"
                    },
                    ngaybd: {
                        required: "Vui lòng chọn ngày bắt đầu! ",
                    },
                    ngaykt: {
                        required: "Vui lòng chọn ngày kết thúc! ",
                    }
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    // lấy dữ liệu từ form
                    const data = Object.fromEntries(new FormData(form).entries());
                    let bd = $('#ngaybd').val().split('/');
                    let bdReal = bd[2] + "-" + bd[1] + '-' + bd[0];
                    data['ngaybd'] = bdReal;
                    let kt = $('#ngaykt').val().split('/');
                    let ktReal = kt[2] + "-" + kt[1] + '-' + kt[0];
                    data['ngaykt'] = ktReal;
                    $.post(`http://localhost/webhoctapmvc/kythi/addKyThi`, data, function(response) {
                        if (response.thanhcong) {
                            currentPage = 1;
                            layDSKyThiAjax();
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
                                text: "Thêm Thất Bại",
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
            layDSKyThiAjax();
        }

        function changePageSearch(newPage) {
            currentPage = newPage;
            layDSKyThiSearch();
        }

        $("#search-user-form").keyup(debounce(function() {
            currentPage = 1;
            layDSKyThiSearch();
        },200));


        function layDSKyThiAjax() {
            $.get(`http://localhost/webhoctapmvc/kythi/getKyThi?rowsPerPage=10&page=${currentPage}`, function(response) {
                const table1 = $('#table1 > tbody');
                table1.empty();
                checkedRows = [];
                $row = 0;
                response.data.forEach(data => {
                    let now = new Date();
                    let bd = new Date(data.NgayBatDau);
                    let dis = "";
                    if(now>bd){
                        dis = "disabled";
                    }
                    let newBD = (bd.getDate()) + '/' + (bd.getMonth() + 1) + '/' + bd.getFullYear();
                    let kt = new Date(data.NgayKetThuc);
                    let newKT = (kt.getDate()) + '/' + (kt.getMonth() + 1) + '/' + kt.getFullYear();
                    if ($row % 2 == 0) {
                        table1.append(`
                        <tr class="table-light">
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaKyThi}"  ${dis}>
                                </div>
                            </td>
                            <td>${data.MaKyThi}</td>
                            <td>${data.TenKyThi}</td>
                            <td>${newBD}</td>
                            <td>${newKT}</td>
                            <td>
                                <button onclick="viewRow('${data.MaKyThi}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaKyThi}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;"  ${dis}>
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaKyThi}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;"  ${dis}>
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    } else {
                        table1.append(`
                        <tr class="table-info">
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaKyThi}"  ${dis}>
                                </div>
                            </td>
                            <td>${data.MaKyThi}</td>
                            <td>${data.TenKyThi}</td>
                            <td>${newBD}</td>
                            <td>${newKT}</td>
                            <td>
                                <button onclick="viewRow('${data.MaKyThi}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaKyThi}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;"  ${dis}>
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaKyThi}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;"  ${dis}>
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    }
                    checkedRows.push(data.MaKyThi);
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

        function layDSKyThiSearch() {
            $.get(`http://localhost/webhoctapmvc/kythi/getKyThi?rowsPerPage=10&page=${currentPage}&search=${$('#serch-user-text').val()}`, function(response) {
                const table1 = $('#table1 > tbody');
                table1.empty();
                checkedRows = [];
                $row = 0;
                response.data.forEach(data => {
                    let now = new Date();
                    let bd = new Date(data.NgayBatDau);
                    let dis = "";
                    if(now>bd){
                        dis = "disabled";
                    }
                    let newBD = (bd.getDate()) + '/' + (bd.getMonth() + 1) + '/' + bd.getFullYear();
                    let kt = new Date(data.NgayKetThuc);
                    let newKT = (kt.getDate()) + '/' + (kt.getMonth() + 1) + '/' + kt.getFullYear();
                    if ($row % 2 == 0) {

                        table1.append(`
                        <tr class="table-light">
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaKyThi}" ${dis}>
                                </div>
                            </td>
                            <td>${data.MaKyThi}</td>
                            <td>${data.TenKyThi}</td>
                            <td>${newBD}</td>
                            <td>${newKT}</td>
                            <td>
                                <button onclick="viewRow('${data.MaKyThi}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaKyThi}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;" ${dis}>
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaKyThi}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;" ${dis}>
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    } else {
                        table1.append(`
                        <tr class="table-info">
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaKyThi}" ${dis}>
                                </div>
                            </td>
                            <td>${data.MaKyThi}</td>
                            <td>${data.TenKyThi}</td>
                            <td>${newBD}</td>
                            <td>${newKT}</td>
                            <td>
                                <button onclick="viewRow('${data.MaKyThi}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaKyThi}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;" ${dis}>
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaKyThi}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;" ${dis}>
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    }
                    checkedRows.push(data.MaKyThi);
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
                makythi: params
            };
            $.post(`http://localhost/webhoctapmvc/kythi/viewKyThi`, data, function(response) {
                if (response.thanhcong) {
                    $("#view-makythi").val(response.MaKyThi);
                    $("#view-tenkythi").val(response.TenKyThi);
                    let bd = new Date(response.NgayBatDau);
                    let newBD = (bd.getDate()) + '/' + (bd.getMonth() + 1) + '/' + bd.getFullYear();
                    let kt = new Date(response.NgayKetThuc);
                    let newKT = (kt.getDate()) + '/' + (bd.getMonth() + 1) + '/' + bd.getFullYear();
                    $('#view-ngaybd').val(newBD);
                    $('#view-ngaykt').val(newKT);
                }
            });
            $("#view-mon-modal").modal('toggle');
        }

        function repairRow(params) {
            let data = {
                makythi: params
            };

            $.post(`http://localhost/webhoctapmvc/kythi/viewKyThi`, data, function(response) {
                if (response.thanhcong) {
                    $("#re-makythi").val(response.MaKyThi);
                    $("#re-tenkythi").val(response.TenKyThi);
                    let bd = new Date(response.NgayBatDau);
                    let newBD = (bd.getDate()) + '/' + (bd.getMonth() + 1) + '/' + bd.getFullYear();
                    let kt = new Date(response.NgayKetThuc);
                    let newKT = (kt.getDate()) + '/' + (bd.getMonth() + 1) + '/' + bd.getFullYear();
                    $('#re-ngaybd').val(newBD);
                    $('#re-ngaykt').val(newKT);

                    let now = new Date();
                    let nowReal = (now.getMonth() + 1) + "/" + now.getDate() + '/' + now.getFullYear();
                    let isNow = new Date(nowReal);

                    let ngaykt = $('#re-ngaybd').val().split('/');
                    let ktReal = ngaykt[1] + "/" + ngaykt[0] + '/' + ngaykt[2];
                    let checkDate = new Date(ktReal);
                    console.log(isNow);
                    console.log(checkDate);
                    if (checkDate <= isNow) {
                        $('#thongbao-pc').modal('toggle');
                    } else {
                        $("#repair-mon-modal").modal('toggle');
                    }
                }
            });

            //Sua form
            $("form[name='repair-mon-form']").validate({
                rules: {
                    tenkythi: {
                        required: true,
                        validateTenMon: true,
                    },
                    ngaybd: {
                        required: true,
                        checkBD: true,
                    },
                    ngaykt: {
                        required: true,
                        checkKT: true,
                    }
                },
                messages: {
                    tenkythi: {
                        required: "Vui lòng nhập tên kỳ thi",
                        validateTenMon: "Tên kỳ thi chứa các kí tự a-z, 0-9, [space], _, - (từ 2 kí tự trở lên)!"
                    },
                    ngaybd: {
                        required: "Vui lòng chọn ngày bắt đầu! ",
                    },
                    ngaykt: {
                        required: "Vui lòng chọn ngày kết thúc! ",
                    }
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    $("#myModalLabel110").text("Quản Lý Độ Khó");
                    $("#question-model").text("Bạn có chắc chắn muốn sửa kỳ thi này không");
                    $("#question-user-modal").modal('toggle');
                    $('#thuchien').off('click');
                    $("#thuchien").click(function() {
                        // lấy dữ liệu từ form

                        const data = Object.fromEntries(new FormData(form).entries());
                        let bd = $('#re-ngaybd').val().split('/');
                        let bdReal = bd[2] + "-" + bd[1] + '-' + bd[0];
                        data['ngaybd'] = bdReal;
                        let kt = $('#re-ngaykt').val().split('/');
                        let ktReal = kt[2] + "-" + kt[1] + '-' + kt[0];
                        data['ngaykt'] = ktReal;
                        data['makythi'] = $('#re-makythi').val();
                        $.post(`http://localhost/webhoctapmvc/kythi/repairKyThi`, data, function(response) {
                            if (response.thanhcong) {
                                currentPage = 1;
                                layDSKyThiAjax();
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
                makythi: params
            };
            $("#myModalLabel110").text("Quản Lý Kỳ Thi");
            $("#question-model").text("Bạn có chắc chắn muốn xóa kì thi này không");
            $("#question-user-modal").modal('toggle');
            $('#thuchien').off('click');
            $("#thuchien").click(function() {
                $.post(`http://localhost/webhoctapmvc/kythi/deleteKyThi`, data, function(response) {
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
                        layDSKyThiAjax();
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
            $("#myModalLabel110").text("Quản Lý Kỳ Thi");
            $("#question-model").text("Bạn có chắc chắn muốn xóa những kỳ thi này không");
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
                    makythis: JSON.stringify(datas)
                };
                $.post(`http://localhost/webhoctapmvc/kythi/deleteKyThis`, data, function(response) {
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
                        layDSKyThiAjax();
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
        }, "Ngày bắt đầu phải lớn hơn hiện tại ");

        jQuery.validator.addMethod("checkKT", function(value, element) {
            let bd = $('#ngaybd').val().split('/');
            let bdReal = bd[1] + "/" + bd[0] + '/' + bd[2];
            let isBd = new Date(bdReal);
            let kt = value.split('/');
            let ktReal = kt[1] + '/' + kt[0] + '/' + kt[2];
            let isKT = new Date(ktReal);
            let kq = true;
            if (isKT < isBd) {
                kq = false;
            }
            return this.optional(element) || kq
        }, "Ngày kết thúc phải lớn hơn ngày bắt đầu  ");
    </script>
</body>

</html>