<?php

use App\Core\View;

View::$activeItem = 'quyen';

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
                                    <h3>Phân quyền</h3>
                                </label>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">

                                <div class=" loat-start float-lg-end mb-3">
                                    <button id='btn-delete-mon' class="btn btn-danger">
                                        <i class="bi bi-trash-fill"></i> Xóa quyền
                                    </button>
                                    <button id='open-add-mon-btn' class="btn btn-primary">
                                        <i class="bi bi-plus"></i> Thêm quyền
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
                                                <th>Mã Quền</th>
                                                <th>Tên Quyền</th>
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
                                <h4 class="modal-title">Thêm Quyền</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form name="add-mon-form" action="/" method="POST">
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Mã Quyền:</label>
                                            <input type="text" class="form-control" id="maquyen" name="maquyen">
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Tên Quyền:</label>
                                            <input type="text" class="form-control" id="tenquyen" name="tenquyen">
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <label>Chi Tiết:</label>
                                        <ul id="chucnang-list" class="list-unstyled mb-0">

                                        </ul>
                                    </li>
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
                                <h4 class="modal-title">Sửa Quyền</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form name="repair-mon-form" action="/" method="POST">
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Mã Quyền:</label>
                                            <input type="text" class="form-control" id="re-maquyen" name="maquyen" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Tên Quyền:</label>
                                            <input type="text" class="form-control" id="re-tenquyen" name="tenquyen">
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <label>Chi Tiết:</label>
                                        <ul id="re-chucnang-list" class="list-unstyled mb-0">

                                        </ul>
                                    </li>
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
                                            <label>Mã Quyền:</label>
                                            <input type="text" class="form-control" id="view-maquyen" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Tên Quyền:</label>
                                            <input type="text" class="form-control" id="view-tenquyen" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <label>Chi Tiết:</label>
                                        <ul id="view-chucnang-list" class="list-unstyled mb-0">

                                        </ul>
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
        let chucnangs;
        // on ready
        $(function() {

            //kietm tra quyen
            $.post(`http://localhost/webhoctapmvc/quyen/getChucNang`, function(response) {
                chucnangs = response.data;
                chucnangs.forEach(data => {
                    let viewopt = '<li class="d-inline-block me-0 mb-1 w-50">\
                                    <div class="form-check">\
                                        <div class="custom-control custom-checkbox">\
                                            <input type="checkbox" class="form-check-input form-check-success" name="' + data.MaChucNang + '" id="view-' + data.MaChucNang + '" disabled>\
                                            <label class="form-check-label" for="customColorCheck3">' + data.TenDoiTuong + '</label>\
                                        </div>\
                                    </div>\
                                </li>';
                    let opt = '<li class="d-inline-block me-0 mb-1 w-50">\
                                    <div class="form-check">\
                                        <div class="custom-control custom-checkbox">\
                                            <input type="checkbox" class="form-check-input form-check-success"  name="' + data.MaChucNang + '" id="add-' + data.MaChucNang + '" >\
                                            <label class="form-check-label" for="customColorCheck3">' + data.TenDoiTuong + '</label>\
                                        </div>\
                                    </div>\
                                </li>';
                    let reopt = '<li class="d-inline-block me-0 mb-1 w-50">\
                                <div class="form-check">\
                                    <div class="custom-control custom-checkbox">\
                                        <input type="checkbox" class="form-check-input form-check-success" name="' + data.MaChucNang + '" id="re-' + data.MaChucNang + '" >\
                                        <label class="form-check-label" for="customColorCheck3">' + data.TenDoiTuong + '</label>\
                                    </div>\
                                </div>\
                            </li>';
                    $("#view-chucnang-list").append(viewopt);
                    $("#chucnang-list").append(opt);
                    $("#re-chucnang-list").append(reopt);

                });
            });
            layDSQuyenAjax();


            // Đặt sự kiện validate cho modal add mon
            $("form[name='add-mon-form']").validate({
                rules: {
                    maquyen: {
                        required: true,
                        remote: {
                            url: "http://localhost/webhoctapmvc/quyen/checkValidMaQuyen",
                            type: "POST",
                        }
                    },
                    tenquyen: {
                        required: true,
                        validateTenMon: true,
                    },
                },
                messages: {
                    maquyen: {
                        required: "Vui lòng nhập mã quyền",
                    },
                    tenquyen: {
                        required: "Vui lòng nhập tên quyền",
                        validateTenMon: "Tên quyền chứa các kí tự a-z, 0-9, [space], _, - (từ 2 kí tự trở lên)!"
                    },
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    // lấy dữ liệu từ form
                    const tam = Object.fromEntries(new FormData(form).entries());
                        chucnangs.forEach(cn => {
                            if ($('#add-' + cn.MaChucNang).prop("checked")) {
                                tam[cn.MaChucNang] = 1;
                            } else {
                                tam[cn.MaChucNang] = 0;
                            }
                        });
                        let chitiet = [];
                        Object.keys(tam).forEach(key => {
                            if(key == 'maquyen' || key == 'tenquyen'){
                                return;
                            }

                            let temp = {
                                MaQuyen: tam['maquyen'],
                                MaChucNang: key,
                                TrangThai: tam[key]
                            }
                            chitiet.push(temp)
                        })
                        let data = {
                            maquyen :tam['maquyen'],
                            tenquyen :tam['tenquyen'],
                            chitiets : JSON.stringify(chitiet)
                        }
                        console.log(data);
                    $.post(`http://localhost/webhoctapmvc/quyen/addQuyen`, data, function(response) {
                        if (response.thanhcong) {
                            currentPage = 1;
                            layDSQuyenAjax();
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
                    $('#maquyen').val("");
                    $('#tenquyen').val("");
                    chucnangs.forEach(cn => {
                            $('#add-' + cn.MaChucNang).prop("checked",false);
                    });
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
            layDSQuyenAjax();
        }

        function changePageSearch(newPage) {
            currentPage = newPage;
            layDSQuyenSearch();
        }

        $("#search-user-form").keyup(debounce(function() {
            currentPage = 1;
            layDSQuyenSearch();
        },200));


        function layDSQuyenAjax() {
            $.get(`http://localhost/webhoctapmvc/quyen/getQuyen?rowsPerPage=10&page=${currentPage}`, function(response) {
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
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaQuyen}">
                                </div>
                            </td>
                            <td>${data.MaQuyen}</td>
                            <td>${data.TenQuyen}</td>
                            <td>
                                <button onclick="viewRow('${data.MaQuyen}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaQuyen}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaQuyen}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    } else {
                        table1.append(`
                        <tr class="table-info">
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaQuyen}">
                                </div>
                            </td>
                            <td>${data.MaQuyen}</td>
                            <td>${data.TenQuyen}</td>
                            <td>
                                <button onclick="viewRow('${data.MaQuyen}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaQuyen}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaQuyen}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    }
                    checkedRows.push(data.MaQuyen);
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

        function layDSQuyenSearch() {
            $.get(`http://localhost/webhoctapmvc/quyen/getQuyen?rowsPerPage=10&page=${currentPage}&search=${$('#serch-user-text').val()}`, function(response) {
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
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaQuyen}">
                                </div>
                            </td>
                            <td>${data.MaQuyen}</td>
                            <td>${data.TenQuyen}</td>
                            <td>
                                <button onclick="viewRow('${data.MaQuyen}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaQuyen}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaQuyen}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    } else {
                        table1.append(`
                        <tr class="table-info">
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaQuyen}">
                                </div>
                            </td>
                            <td>${data.MaQuyen}</td>
                            <td>${data.TenQuyen}</td>
                            <td>
                                <button onclick="viewRow('${data.MaQuyen}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaQuyen}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaQuyen}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    }
                    checkedRows.push(data.MaQuyen);
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


        function viewRow(params) {
            let data = {
                maquyen: params
            };
            $.post(`http://localhost/webhoctapmvc/quyen/viewQuyen`, data, function(response) {
                if (response.thanhcong) {
                    $("#view-maquyen").val(response.MaQuyen);
                    $("#view-tenquyen").val(response.TenQuyen);
                    response.chitiet.forEach(function(cn) {
                        if (cn.TrangThai == 1) {
                            $('#view-' + cn.MaChucNang).prop('checked', true);
                        }
                    });
                }
            });
            $("#view-mon-modal").modal('toggle');
        }

        function repairRow(params) {
            let data = {
                maquyen: params
            };

            $.post(`http://localhost/webhoctapmvc/quyen/viewQuyen`, data, function(response) {
                if (response.thanhcong) {
                    $("#re-maquyen").val(response.MaQuyen);
                    $("#re-tenquyen").val(response.TenQuyen);
                    response.chitiet.forEach(function(cn) {
                        if (cn.TrangThai == 1) {
                            $('#re-' + cn.MaChucNang).prop('checked', true);
                        } else {
                            $('#re-' + cn.MaChucNang).prop('checked', false);
                        }
                    });
                }
            });
            $("#repair-mon-modal").modal('toggle');
            //Sua form
            $("form[name='repair-mon-form']").validate({
                rules: {
                    tenquyen: {
                        required: true,
                        validateTenMon: true,
                    },
                },
                messages: {
                    tenquyen: {
                        required: "Vui lòng nhập tên độ khó",
                        validateTenMon: "Tên quyền chứa các kí tự a-z, 0-9, [space], _, - (từ 2 kí tự trở lên)!",
                    },
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    $("#myModalLabel110").text("Phân Quyền");
                    $("#question-model").text("Bạn có chắc chắn muốn sửa quyền này không");
                    $("#question-user-modal").modal('toggle');
                    $('#thuchien').off('click');
                    $("#thuchien").click(function() {
                        // lấy dữ liệu từ form

                        const tam = Object.fromEntries(new FormData(form).entries());
                        tam['maquyen'] = $('#re-maquyen').val();
                        
                        chucnangs.forEach(cn => {
                            if ($('#re-' + cn.MaChucNang).prop("checked")) {
                                tam[cn.MaChucNang] = 1;
                            } else {
                                tam[cn.MaChucNang] = 0;
                            }
                        });
                        let chitiet = [];
                        Object.keys(tam).forEach(key => {
                            if(key == 'maquyen' || key == 'tenquyen'){
                                return;
                            }

                            let temp = {
                                MaQuyen: tam['maquyen'],
                                MaChucNang: key,
                                TrangThai: tam[key]
                            }
                            chitiet.push(temp)
                        })
                        let data = {
                            maquyen :tam['maquyen'],
                            tenquyen :tam['tenquyen'],
                            chitiets : JSON.stringify(chitiet)
                        }
                        $.post(`http://localhost/webhoctapmvc/quyen/repairQuyen`, data, function(response) {
                            if (response.thanhcong) {
                                currentPage = 1;
                                layDSQuyenAjax();
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
                maquyen: params
            };
            $("#myModalLabel110").text("Phân Quyền");
            $("#question-model").text("Bạn có chắc chắn muốn xóa quyền này không");
            $("#question-user-modal").modal('toggle');
            $('#thuchien').off('click');
            $("#thuchien").click(function() {
                $.post(`http://localhost/webhoctapmvc/quyen/deleteQuyen`, data, function(response) {
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
                        layDSQuyenAjax();
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
            $("#myModalLabel110").text("Phân Quyền");
            $("#question-model").text("Bạn có chắc chắn muốn xóa những quyền này không");
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
                    maquyens: JSON.stringify(datas)
                };
                $.post(`http://localhost/webhoctapmvc/quyen/deleteQuyens`, data, function(response) {
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
                        layDSQuyenAjax();
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