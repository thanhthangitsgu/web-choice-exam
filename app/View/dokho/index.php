<?php

use App\Core\View;

View::$activeItem = 'dokho';

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
                                    <h3>Danh sách độ khó</h3>
                                </label>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">

                                <div class=" loat-start float-lg-end mb-3">
                                    <button id='btn-delete-mon' class="btn btn-danger">
                                        <i class="bi bi-trash-fill"></i> Xóa độ khó
                                    </button>
                                    <button id='open-add-mon-btn' class="btn btn-primary">
                                        <i class="bi bi-plus"></i> Thêm độ khó
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
                                                <th>Mã Độ Khó</th>
                                                <th>Tên Độ Khó</th>
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
                                <h4 class="modal-title">Thêm Độ Khó</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form name="add-mon-form" action="/" method="POST">
                                <div class="modal-body">
                                    <label for="madokho">Mã Độ Khó: </label>
                                    <div class="form-group">
                                        <input type="text" id="madokho" name="madokho" placeholder="Mã độ khó" class="form-control">
                                    </div>
                                    <label for="tendokho">Tên Môn Học: </label>
                                    <div class="form-group">
                                        <input type="text" id="tendokho" name="tendokho" placeholder="Tên độ khó" class="form-control">
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
                                <h4 class="modal-title">Sửa Độ Khó</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form name="repair-mon-form" action="/" method="POST">
                                <div class="modal-body">
                                    <label>Mã Độ Khó: </label>
                                    <div class="form-group">
                                        <input type="text" id="re-madokho" name="madokho" class="form-control" disabled>
                                    </div>
                                    <label for="re-tendokho">Tên Độ Khó: </label>
                                    <div class="form-group">
                                        <input type="text" id="re-tendokho" name="tendokho" placeholder="Tên độ khó" class="form-control">
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
                                            <label>Mã Độ Khó:</label>
                                            <input type="text" class="form-control" id="view-madokho" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Tên Độ Khó:</label>
                                            <input type="text" class="form-control" id="view-tendokho" disabled>
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

            //kietm tra quyen
            layDSDoKhoAjax();


            // Đặt sự kiện validate cho modal add mon
            $("form[name='add-mon-form']").validate({
                rules: {
                    madokho: {
                        required: true,
                        number: true,
                        min: 1,
                        remote: {
                            url: "http://localhost/webhoctapmvc/dokho/checkValidMaDoKho",
                            type: "POST",
                        }
                    },
                    tendokho: {
                        required: true,
                        validateTenMon: true,
                    },
                },
                messages: {
                    madokho: {
                        required: "Vui lòng nhập mã độ khó",
                        number: "Mã độ khó phải là số lớn hơn 0",
                        min:"Mã độ khó phải là số lớn hơn 0",
                    },
                    tendokho: {
                        required: "Vui lòng nhập tên độ khó",
                        validateTenMon: "Tên độ khó chứa các kí tự a-z, 0-9, [space], _, - (từ 2 kí tự trở lên)!"
                    },
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    // lấy dữ liệu từ form
                    const data = Object.fromEntries(new FormData(form).entries());
                    $.post(`http://localhost/webhoctapmvc/dokho/addDoKho`, data, function(response) {
                        if (response.thanhcong) {
                            currentPage = 1;
                            layDSDoKhoAjax();
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
            layDSDoKhoAjax();
        }

        function changePageSearch(newPage) {
            currentPage = newPage;
            layDSDoKhoSearch();
        }

        $("#search-user-form").keyup(debounce(function() {
            currentPage = 1;
            layDSDoKhoSearch();
        },200));


        function layDSDoKhoAjax() {
            $.get(`http://localhost/webhoctapmvc/dokho/getDoKho?rowsPerPage=10&page=${currentPage}`, function(response) {
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
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaDoKho}">
                                </div>
                            </td>
                            <td>${data.MaDoKho}</td>
                            <td>${data.TenDoKho}</td>
                            <td>
                                <button onclick="viewRow('${data.MaDoKho}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaDoKho}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaDoKho}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    } else {
                        table1.append(`
                        <tr class="table-info">
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaDoKho}">
                                </div>
                            </td>
                            <td>${data.MaDoKho}</td>
                            <td>${data.TenDoKho}</td>
                            <td>
                                <button onclick="viewRow('${data.MaDoKho}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaDoKho}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaDoKho}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    }
                    checkedRows.push(data.MaDoKho);
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

        function layDSDoKhoSearch() {
            $.get(`http://localhost/webhoctapmvc/dokho/getDoKho?rowsPerPage=10&page=${currentPage}&search=${$('#serch-user-text').val()}`, function(response) {
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
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaDoKho}">
                                </div>
                            </td>
                            <td>${data.MaDoKho}</td>
                            <td>${data.TenDoKho}</td>
                            <td>
                                <button onclick="viewRow('${data.MaDoKho}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaDoKho}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaDoKho}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    } else {
                        table1.append(`
                        <tr class="table-info">
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaDoKho}">
                                </div>
                            </td>
                            <td>${data.MaDoKho}</td>
                            <td>${data.TenDoKho}</td>
                            <td>
                                <button onclick="viewRow('${data.MaDoKho}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaDoKho}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaDoKho}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    }
                    checkedRows.push(data.MaDoKho);
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
                madokho: params
            };
            $.post(`http://localhost/webhoctapmvc/dokho/viewDoKho`, data, function(response) {
                if (response.thanhcong) {
                    $("#view-madokho").val(response.MaDoKho);
                    $("#view-tendokho").val(response.TenDoKho);
                }
            });
            $("#view-mon-modal").modal('toggle');
        }

        function repairRow(params) {
            let data = {
                madokho: params
            };

            $.post(`http://localhost/webhoctapmvc/dokho/viewDoKho`, data, function(response) {
                if (response.thanhcong) {
                    $('#re-madokho').val(response.MaDoKho);
                    $('#re-tendokho').val(response.TenDoKho);
                }
            });
            $("#repair-mon-modal").modal('toggle');
            //Sua form
            $("form[name='repair-mon-form']").validate({
                rules: {
                    tendokho: {
                        required: true,
                        validateTenMon: true,
                    },
                },
                messages: {
                    tendokho: {
                        required: "Vui lòng nhập tên độ khó",
                    },
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    $("#myModalLabel110").text("Quản Lý Độ Khó");
                    $("#question-model").text("Bạn có chắc chắn muốn sửa độ khó này không");
                    $("#question-user-modal").modal('toggle');
                    $('#thuchien').off('click');
                    $("#thuchien").click(function() {
                        // lấy dữ liệu từ form

                        const data = Object.fromEntries(new FormData(form).entries());
                        data['madokho'] = $('#re-madokho').val();
                        $.post(`http://localhost/webhoctapmvc/dokho/repairDoKho`, data, function(response) {
                            if (response.thanhcong) {
                                currentPage = 1;
                                layDSDoKhoAjax();
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
                madokho: params
            };
            $("#myModalLabel110").text("Quản Lý Độ Khó");
            $("#question-model").text("Bạn có chắc chắn muốn xóa độ khó này không");
            $("#question-user-modal").modal('toggle');
            $('#thuchien').off('click');
            $("#thuchien").click(function() {
                $.post(`http://localhost/webhoctapmvc/dokho/deleteDoKho`, data, function(response) {
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
                        layDSDoKhoAjax();
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
            $("#myModalLabel110").text("Quản Lý Độ Khó");
            $("#question-model").text("Bạn có chắc chắn muốn xóa những độ khó này không");
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
                    madokhos: JSON.stringify(datas)
                };
                $.post(`http://localhost/webhoctapmvc/dokho/deleteDoKhos`, data, function(response) {
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
                        layDSDoKhoAjax();
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