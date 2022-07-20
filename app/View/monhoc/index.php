<?php

use App\Core\View;

View::$activeItem = 'monhoc';

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
                                    <h3>Danh sách môn học</h3>
                                </label>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">

                                <div class=" loat-start float-lg-end mb-3">

                                    <button id="btn-phancong" class="btn btn btn-success">
                                        <i class="bi bi-card-checklist"></i> Phân Công
                                    </button>
                                    <button id='btn-delete-mon' class="btn btn-danger">
                                        <i class="bi bi-trash-fill"></i> Xóa môn học
                                    </button>
                                    <button id='open-add-mon-btn' class="btn btn-primary">
                                        <i class="bi bi-plus"></i> Thêm môn học
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
                                                <th>Mã Môn</th>
                                                <th>Tên Môn</th>
                                                <th>Số Tín Chỉ</th>
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
                                <h4 class="modal-title">Thêm Môn Học</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form name="add-mon-form" action="/" method="POST">
                                <div class="modal-body">
                                    <label for="mamon">Mã Môn Học: </label>
                                    <div class="form-group">
                                        <input type="text" id="mamon" name="mamon" placeholder="Mã môn" class="form-control">
                                    </div>
                                    <label for="tenmon">Tên Môn Học: </label>
                                    <div class="form-group">
                                        <input type="text" id="tenmon" name="tenmon" placeholder="Tên môn" class="form-control">
                                    </div>
                                    <label for="tinchi">Số Tín Chỉ: </label>
                                    <div class="form-group">
                                        <input type="text" id="tinchi" name="tinchi" placeholder="Số tín chỉ" class="form-control">
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
                                <h4 class="modal-title">Sửa Môn Học</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form name="repair-mon-form" action="/" method="POST">
                                <div class="modal-body">
                                    <label>Mã Môn Học: </label>
                                    <div class="form-group">
                                        <input type="text" id="re-mamon" name="mamon" class="form-control" disabled>
                                    </div>
                                    <label for="re-tenmon">Tên Môn Học: </label>
                                    <div class="form-group">
                                        <input type="text" id="re-tenmon" name="tenmon" placeholder="Tên môn" class="form-control">
                                    </div>
                                    <label for="re-tinchi">Số Tín Chỉ: </label>
                                    <div class="form-group">
                                        <input type="text" id="re-tinchi" name="tinchi" placeholder="Số tín chỉ" class="form-control">
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
                <div style="z-index: 1051;" class="modal fade text-left" id="question-user-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel110" aria-hidden="true">
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
                                            <label>Mã Môn Học:</label>
                                            <input type="text" class="form-control" id="view-mamon" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Tên Môn Học:</label>
                                            <input type="text" class="form-control" id="view-tenmon" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Số Tín Chỉ:</label>
                                            <input type="text" class="form-control" id="view-tinchi" disabled>
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

                <!-- MODAL Phân Công -->
                <div class="modal fade text-left" id="phancong-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">

                            <div class="modal-header bg-primary">
                                <div class="col-sm-6">
                                    <h6 style="color: White;">Tìm Kiếm</h6>
                                    <div id="search-pc-form" name="search-pc-form">
                                        <div class="form-group position-relative has-icon-right">
                                            <input id="serch-pc-text" type="text" class="form-control" placeholder="Tìm kiếm" value="">
                                            <div class="form-control-icon">
                                                <i class="bi bi-search"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="page-title">
                                    <div class="row">
                                        <div class="col-12 col-md-6 order-md-1 order-last">
                                            <label>
                                                <h5>Bảng Phân Công</h5>
                                            </label>
                                            <label>
                                                <h6 style="margin-left: 50px; margin-right: 10px;"> Lọc Theo:</h6>
                                            </label>
                                            <select class="btn btn btn-primary" name="pc-cbb" id="cars-pc">
                                                <option value="">Tất Cả</option>
                                                <option value="gv">Giảng Viên</option>
                                                <option value="mon">Môn Học</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6 order-md-2 order-first">
                                            <div class=" loat-start float-lg-end mb-3">
                                                <select class="btn btn btn-success" name="gv-cbb" id="cars-gv">
                                                    <option value="">Chọn giảng viên</option>
                                                </select>
                                                <select class="btn btn btn-success" name="mon-cbb" id="cars-mon">
                                                    <option value="">Chọn môn</option>
                                                </select>

                                                <button id='add-pc-btn' class="btn btn-primary">
                                                    <i class="bi bi-plus"></i> Thêm
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <section class="section">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table-danger" id="table2">
                                                    <thead>
                                                        <tr>
                                                            <th>Mã Giảng Viên</th>
                                                            <th>Mã Môn</th>
                                                            <th>Gỡ </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                                <nav class="mt-5">
                                                    <ul id="pagination2" class="pagination justify-content-center">
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                </section>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Đóng</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal thông báo pc -->
                <div class="modal fade text-left" id="thongbao-pc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5 class="modal-title" id="myModalLabel1">Thông báo</h5>
                                <p>
                                    Vui lòng chọn giảng viên và môn
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
    <script src="<?= View::assets('js/menu.js') ?>"></script>
    <script src="<?= View::assets('js/api.js') ?>"></script>
    <script>
        let currentPage = 1
        let checkedRows = [];
        // on ready
        $(function() {
            $.post(`http://localhost/webhoctapmvc/monhoc/getMonHoc`, function(response) {
                monhocs = response.data;
                monhocs.forEach(data => {
                    let opt = '<option value="' + data.MaMon + '">' + data.MaMon + '</option>';
                    $("#cars-mon").append(opt);
                });
            });
            $.post(`http://localhost/webhoctapmvc/user/getGiangVien`, function(response) {
                response.forEach(data => {
                    let opt = '<option value="' + data.TenDangNhap + '">' + data.TenDangNhap + '</option>';
                    $("#cars-gv").append(opt);
                });
            });
            //kietm tra quyen
            layDSMonAjax();


            // Đặt sự kiện validate cho modal add mon
            $("form[name='add-mon-form']").validate({
                rules: {
                    mamon: {
                        required: true,
                        validateUsername: true,
                        remote: {
                            url: "http://localhost/webhoctapmvc/monhoc/checkValidMaMon",
                            type: "POST",
                        }
                    },
                    tenmon: {
                        required: true,
                        validateTenMon: true,
                    },
                    tinchi: {
                        required: true,
                        number: true,
                        min: 1
                    }
                },
                messages: {
                    mamon: {
                        required: "Vui lòng nhập mã môn",
                        validateUsername: "Mã môn chứa các kí tự a-z, 0-9, _, - (từ 3 đến 11 kí tự)!"
                    },
                    tenmon: {
                        required: "Vui lòng nhập tên môn",
                    },
                    tinchi: {
                        required: "Vui lòng nhập số tín chỉ",
                        number: "Số tín chỉ phải là số nguyên lớn hơn 0",
                        min: "Số tín chỉ phải là số nguyên lớn hơn 0",
                    },
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    // lấy dữ liệu từ form
                    const data = Object.fromEntries(new FormData(form).entries());
                    $.post(`http://localhost/webhoctapmvc/monhoc/addMon`, data, function(response) {
                        if (response.thanhcong) {
                            currentPage = 1;
                            layDSMonAjax();
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
                    $('#mamon').val("");
                    $('#tenmon').val("");
                    $('#tinchi').val("");
                }
            })

        });

        $("#open-add-mon-btn").click(function() {
            $('#mamon').val("");
            $('#tenmon').val("");
            $('#tinchi').val("");
            $("#add-mon-modal").modal('toggle')
        });

        $("#btn-phancong").click(function() {
            $("#phancong-modal").modal('toggle');
            currentPage = 1;
            layDSGVMonAjax();
        });

        function changePage(newPage) {
            currentPage = newPage;
            layDSMonAjax();
        }

        function changePageSearch(newPage) {
            currentPage = newPage;
            layDSMonSearch();
        }

        $("#search-user-form").keyup(debounce(function() {
            currentPage = 1;
            layDSMonSearch();
        },200));

        $("#search-pc-form").keyup(debounce(function() {
            currentPage = 1;
            layDSGVMonAjax();
        },200));

        $("#cars-pc").change(function() {
            currentPage = 1;
            layDSGVMonAjax();
        });

        $("#add-pc-btn").click(function() {
            let magv = $('#cars-gv option').filter(':selected').val();
            let mamon = $('#cars-mon option').filter(':selected').val();

            if (magv == "" || mamon == "") {
                $("#thongbao-pc").modal('toggle');
            } else {
                let data = {
                    mamon: mamon,
                    magv: magv,
                };
                $.post(`http://localhost/webhoctapmvc/monhoc/addGVM`, data, function(response) {
                    if (response.thanhcong) {
                        currentPage = 1;
                        layDSGVMonAjax();
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
                });
            }
        });


        function layDSMonAjax() {
            $.get(`http://localhost/webhoctapmvc/monhoc/getMonHoc?rowsPerPage=10&page=${currentPage}`, function(response) {
                // Không được gán biến response này ra ngoài function,
                // vì function này bất đồng bộ, khi nào gọi api xong thì response mới có dữ liệu
                // gán ra ngoài thì code ở ngoài chạy trc khi gọi api xong.
                //data là danh sách usser
                //page là trang hiện tại
                // rowsPerpage là số dòng trên 1 trang
                // totalPage là tổng số trang
                const table1 = $('#table1 > tbody');
                table1.empty();
                checkedRows = [];
                $row = 0;
                response.data.forEach(data => {
                    if ($row % 2 == 0) {

                        table1.append(`
                        <tr class="table-light">
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaMon}">
                                </div>
                            </td>
                            <td>${data.MaMon}</td>
                            <td>${data.TenMon}</td>
                            <td>${data.SoTinChi}</td>
                            <td>
                                <button onclick="viewRow('${data.MaMon}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaMon}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaMon}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    } else {
                        table1.append(`
                        <tr class="table-info">
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaMon}">
                                </div>
                            </td>
                            <td>${data.MaMon}</td>
                            <td>${data.TenMon}</td>
                            <td>${data.SoTinChi}</td>
                            <td>
                                <button onclick="viewRow('${data.MaMon}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaMon}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaMon}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    }
                    checkedRows.push(data.MaMon);
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

        function layDSMonSearch() {
            $.get(`http://localhost/webhoctapmvc/monhoc/getMonHoc?rowsPerPage=10&page=${currentPage}&search=${$('#serch-user-text').val()}`, function(response) {
                // Không được gán biến response này ra ngoài function,
                // vì function này bất đồng bộ, khi nào gọi api xong thì response mới có dữ liệu
                // gán ra ngoài thì code ở ngoài chạy trc khi gọi api xong.
                //data là danh sách usser
                //page là trang hiện tại
                // rowsPerpage là số dòng trên 1 trang
                // totalPage là tổng số trang
                const table1 = $('#table1 > tbody');
                table1.empty();
                checkedRows = [];
                $row = 0;
                response.data.forEach(data => {
                    if ($row % 2 == 0) {

                        table1.append(`
                        <tr class="table-light">
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaMon}">
                                </div>
                            </td>
                            <td>${data.MaMon}</td>
                            <td>${data.TenMon}</td>
                            <td>${data.SoTinChi}</td>
                            <td>
                                <button onclick="viewRow('${data.MaMon}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaMon}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaMon}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    } else {
                        table1.append(`
                        <tr class="table-info">
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaMon}">
                                </div>
                            </td>
                            <td>${data.MaMon}</td>
                            <td>${data.TenMon}</td>
                            <td>${data.SoTinChi}</td>
                            <td>
                                <button onclick="viewRow('${data.MaMon}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaMon}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaMon}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    }
                    checkedRows.push(data.MaMon);
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

        function changePageGVM(newPage) {
            currentPage = newPage;
            layDSGVMonAjax()
        }

        function layDSGVMonAjax() {
            let search = $('#cars-pc option').filter(':selected').val();
            $.get(`http://localhost/webhoctapmvc/monhoc/getGVMon?rowsPerPage=5&page=${currentPage}&search=${$("#serch-pc-text").val()}&search2=${search}`, function(response) {

                const table2 = $('#table2 > tbody');
                table2.empty();
                checkedRows = [];
                $row = 0;
                response.data.forEach(data => {
                    if ($row % 2 == 0) {

                        table2.append(`
                        <tr class="table-light">
                            <td>${data.MaGV}</td>
                            <td>${data.MaMon}</td>
                            <td>
                                <button onclick="deleteGVM('${data.MaGV}','${data.MaMon}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    } else {
                        table2.append(`
                        <tr class="table-info">
                            <td>${data.MaGV}</td>
                            <td>${data.MaMon}</td>
                            <td>
                                <button onclick="deleteGVM('${data.MaGV}','${data.MaMon}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    }
                    $row += 1;
                });

                const pagination = $('#pagination2');
                // Xóa phân trang cũ
                pagination.empty();
                if (response.totalPage > 1) {
                    for (let i = 1; i <= response.totalPage; i++) {
                        if (i == currentPage) {
                            pagination.append(`
                        <li class="page-item active">
                            <button class="page-link" onClick='changePageGVM(${i})'>${i}</button>
                        </li>`)
                        } else {
                            pagination.append(`
                        <li class="page-item">
                            <button class="page-link" onClick='changePageGVM(${i})'>${i}</button>
                        </li>`)
                        }

                    }
                }

            });
        }

        function deleteGVM(magv, mamon) {
            let data = {
                mamon: mamon,
                magv: magv,
            };
            $("#myModalLabel110").text("Phân Công");
            $("#question-model").text("Bạn có chắc chắn muốn xóa phân công này không");
            $("#question-user-modal").modal('toggle');
            $('#thuchien').off('click');
            $("#thuchien").click(function() {
                $.post(`http://localhost/webhoctapmvc/monhoc/deleteGVM`, data, function(response) {
                    if (response.thanhcong) {
                        currentPage = 1;
                        layDSGVMonAjax();
                        Toastify({
                            text: "Xóa Thành Công",
                            duration: 1000,
                            close: true,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#4fbe87",
                        }).showToast();
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

        function viewRow(params) {
            let data = {
                mamon: params
            };
            $.post(`http://localhost/webhoctapmvc/monhoc/viewMon`, data, function(response) {
                if (response.thanhcong) {
                    $("#view-mamon").val(response.MaMon);
                    $("#view-tenmon").val(response.TenMon);

                    $("#view-tinchi").val(response.SoTinChi);
                }
            });
            $("#view-mon-modal").modal('toggle');
        }

        function repairRow(params) {
            let data = {
                mamon: params
            };

            $.post(`http://localhost/webhoctapmvc/monhoc/viewMon`, data, function(response) {
                if (response.thanhcong) {
                    $('#re-mamon').val(response.MaMon);
                    $('#re-tenmon').val(response.TenMon);
                    $('#re-tinchi').val(response.SoTinChi);
                }
            });
            $("#repair-mon-modal").modal('toggle');
            //Sua form
            $("form[name='repair-mon-form']").validate({
                rules: {
                    tenmon: {
                        required: true,
                        validateTenMon: true,
                    },
                    tinchi: {
                        required: true,
                        number: true,
                        min: 1
                    }
                },
                messages: {
                    tenmon: {
                        required: "Vui lòng nhập tên môn",
                    },
                    tinchi: {
                        required: "Vui lòng nhập số tín chỉ",
                        number: "Số tín chỉ phải là số nguyên lớn hơn 0",
                        min: "Số tín chỉ phải là số nguyên lớn hơn 0",
                    }
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    $("#myModalLabel110").text("Quản Lý Môn Học");
                    $("#question-model").text("Bạn có chắc chắn muốn sửa môn học này không");
                    $("#question-user-modal").modal('toggle');
                    $('#thuchien').off('click');
                    $("#thuchien").click(function() {
                        // lấy dữ liệu từ form

                        const data = Object.fromEntries(new FormData(form).entries());
                        data['mamon'] = $('#re-mamon').val();
                        $.post(`http://localhost/webhoctapmvc/monhoc/repairMon`, data, function(response) {
                            if (response.thanhcong) {
                                currentPage = 1;
                                layDSMonAjax();
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
                mamon: params
            };
            $("#myModalLabel110").text("Quản Lý Môn Học");
            $("#question-model").text("Bạn có chắc chắn muốn xóa môn học này không");
            $("#question-user-modal").modal('toggle');
            $('#thuchien').off('click');
            $("#thuchien").click(function() {
                $.post(`http://localhost/webhoctapmvc/monhoc/deleteMon`, data, function(response) {
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
                        layDSMonAjax();
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
            $("#myModalLabel110").text("Quản Lý Môn Học");
            $("#question-model").text("Bạn có chắc chắn muốn xóa những môn học này không");
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
                    mamons: JSON.stringify(datas)
                };
                $.post(`http://localhost/webhoctapmvc/monhoc/deleteMons`, data, function(response) {
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
                        layDSMonAjax();
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
    </script>
</body>

</html>