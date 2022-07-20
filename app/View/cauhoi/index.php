<?php

use App\Core\View;

View::$activeItem = 'cauhoi';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Web Học Tập</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap"
        rel="stylesheet" />
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
                                <input id="serch-user-text" type="text" class="form-control" placeholder="Tìm kiếm"
                                    value="">
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
                                    <h3>Danh sách câu hỏi</h3>
                                </label>
                                <label>
                                    <h5 style="margin-left: 50px; margin-right: 10px;"> Lọc Theo:</h5>
                                </label>
                                <select class="btn btn btn-primary" name="search-cbb" id="cars-search">
                                    <option value="" selected>Tất Cả</option>
                                    <option value="ch">Mã câu hỏi</option>
                                    <option value="mh">Môn học</option>
                                    <option value="nd">Nội dung</option>
                                    <option value="dk">Độ khó</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">

                                <div class=" loat-start float-lg-end mb-3">
                                    <button id='btn-delete-user' class="btn btn-danger">
                                        <i class="bi bi-trash-fill"></i> Xóa câu hỏi
                                    </button>
                                    <button id='open-add-user-btn' class="btn btn-primary">
                                        <i class="bi bi-plus"></i> Thêm câu hỏi
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
                                                <th>Mã Câu Hỏi</th>
                                                <th>Môn Học</th>
                                                <th style="width:40%;">Nội Dung</th>
                                                <th>Độ Khó</th>
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
                <div class="modal fade text-left" id="add-user-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Thêm Câu Hỏi</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form name="add-user-form" action="/" method="POST">
                                    <div class="modal-body">
                                        <label for="macauhoi">Mã Câu Hỏi: </label>
                                        <div class="form-group">
                                            <input type="text" id="macauhoi" name="macauhoi" placeholder="Mã câu hỏi"
                                                class="form-control">
                                        </div>
                                        <label for="cars-mon">Môn Học: </label>
                                        <select class="form-group" name="mamon" id="cars-mon"
                                            style="margin-right: 15px;">
                                        </select><br>
                                        <label for="cars-da">Đáp án đúng: </label>
                                        <select class="form-group" name="da_dung" id="cars-da"
                                            style="margin-right: 15px;">
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                        </select>
                                        <label for="cars-dokho">Độ khó: </label>
                                        <select class="form-group" name="dokho" id="cars-dokho">

                                        </select>
                                        <br>
                                        <label for="ndcauhoi">Nội dung: </label>
                                        <div class="form-group">
                                            <textarea id="ndcauhoi" name="ndcauhoi" placeholder="Nội dung"
                                                class="form-control"></textarea>
                                        </div>
                                        <label for="da_a">Đáp án A: </label>
                                        <div class="form-group">
                                            <textarea type="password" id="da_a" name="da_a" placeholder="Đáp án A"
                                                class="form-control"></textarea>
                                        </div>
                                        <label for="da_b">Đáp án B: </label>
                                        <div class="form-group">
                                            <textarea type="password" id="da_b" name="da_b" placeholder="Đáp án B"
                                                class="form-control"></textarea>
                                        </div>
                                        <label for="da_c">Đáp án C: </label>
                                        <div class="form-group">
                                            <textarea type="password" id="da_c" name="da_c" placeholder="Đáp án C"
                                                class="form-control"></textarea>
                                        </div>
                                        <label for="da_d">Đáp án D: </label>
                                        <div class="form-group">
                                            <textarea type="password" id="da_d" name="da_d" placeholder="Đáp án D"
                                                class="form-control"></textarea>
                                        </div>


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
                <div class="modal fade text-left" id="repair-user-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Sửa Câu Hỏi</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form name="repair-user-form" action="/" method="POST">
                                    <div class="modal-body">
                                        <label>Mã Câu Hỏi: </label>
                                        <div class="form-group">
                                            <input type="text" id="re-macauhoi" name="macauhoi" class="form-control"
                                                disabled>
                                        </div>
                                        <label for="re-cars-mon">Môn Học: </label>
                                        <select class="form-group" name="mamon" id="re-cars-mon"
                                            style="margin-right: 15px;">
                                        </select><br>
                                        <label for="re-cars-da">Đáp án đúng: </label>
                                        <select class="form-group" name="da_dung" id="re-cars-da"
                                            style="margin-right: 15px;">
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                        </select>
                                        <label for="re-cars-dokho">Độ khó: </label>
                                        <select class="form-group" name="dokho" id="re-cars-dokho">

                                        </select><br>
                                        <label for="re-ndcauhoi">Nội dung: </label>
                                        <div class="form-group">
                                            <textarea id="re-ndcauhoi" name="ndcauhoi" placeholder="Nội dung"
                                                class="form-control"></textarea>
                                        </div>
                                        <label for="re-da-a">Đáp án A: </label>
                                        <div class="form-group">
                                            <textarea type="password" id="re-da-a" name="da_a" placeholder="Đáp án D"
                                                class="form-control"></textarea>
                                        </div>
                                        <label for="re-da-b">Đáp án B: </label>
                                        <div class="form-group">
                                            <textarea type="password" id="re-da-b" name="da_b" placeholder="Đáp án B"
                                                class="form-control"></textarea>
                                        </div>
                                        <label for="re-da-c">Đáp án C: </label>
                                        <div class="form-group">
                                            <textarea type="password" id="re-da-c" name="da_c" placeholder="Đáp án C"
                                                class="form-control"></textarea>
                                        </div>
                                        <label for="re-da-d">Đáp án D: </label>
                                        <div class="form-group">
                                            <textarea type="password" id="re-da-d" name="da_d" placeholder="Đáp án D"
                                                class="form-control"></textarea>
                                        </div>


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
                <div class="modal fade text-left" id="question-user-modal" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel110" aria-hidden="true">
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
                <div class="modal fade" id="view-user-modal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                        role="document">
                        <div class="modal-content">

                            <div class="modal-body">
                                <ul class="list-group">
                                    <li class="list-group-item active">Thông Tin Chi Tiết</li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Mã câu hỏi:</label>
                                            <input type="text" class="form-control" id="view-macauhoi" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Tên Môn: </label>
                                            <input type="text" class="form-control" id="view-tenmon" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Đáp án đúng: </label>
                                            <input id="view-da-dung" disabled
                                                style="width: 50px; background-color: #e9ecef;text-align: center;margin-right: 15px;">
                                            <label style="margin-right: 5px;">Độ khó: </label>
                                            <input id="view-dokho" disabled
                                                style="width: 100px; background-color: #e9ecef;text-align: center;">
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Nội dung: </label>
                                            <div class="form-group">
                                                <textarea id="view-ndcauhoi" class="form-control" disabled></textarea>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Đáp án A: </label>
                                            <div class="form-group">
                                                <textarea id="view-da-a" class="form-control" disabled></textarea>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Đáp án B: </label>
                                            <div class="form-group">
                                                <textarea id="view-da-b" class="form-control" disabled></textarea>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Đáp án C: </label>
                                            <div class="form-group">
                                                <textarea id="view-da-c" class="form-control" disabled></textarea>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Đáp án D: </label>
                                            <div class="form-group">
                                                <textarea id="view-da-d" class="form-control" disabled></textarea>
                                            </div>
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
    let dokhos;
    let monhocs;

    // on ready
    $(function() {

        $.post(`http://localhost/webhoctapmvc/dokho/getAllDoKho`, function(response) {
            if (response.thanhcong) {
                dokhos = response.data;
                dokhos.forEach(data => {
                    let opt = '<option value="' + data.MaDoKho + '">' + data.TenDoKho +
                        '</option>';
                    $("#cars-dokho").append(opt);
                    $("#re-cars-dokho").append(opt);
                });
                $.post(`http://localhost/webhoctapmvc/monhoc/getMHGV`, function(response2) {
                    if (response2.thanhcong) {
                        monhocs = response2.data;
                        monhocs.forEach(data => {
                            let opt = '<option value="' + data.MaMon + '">' + data
                                .TenMon + '</option>';
                            $("#cars-mon").append(opt);
                            $("#re-cars-mon").append(opt);
                        });
                    }

                });

            }
        });

        //kietm tra quyen

        // Đặt sự kiện validate cho modal add user
        $("form[name='add-user-form']").validate({
            rules: {
                macauhoi: {
                    required: true,
                    remote: {
                        url: "http://localhost/webhoctapmvc/cauhoi/checkValidCauHoi",
                        type: "POST",
                    }
                },
                ndcauhoi: {
                    required: true,
                },
                da_a: {
                    required: true,
                },
                da_b: {
                    required: true,
                },
                da_c: {
                    required: true,
                },
                da_d: {
                    required: true,
                },
            },
            messages: {
                macauhoi: {
                    required: "Vui lòng nhập mã câu hỏi",
                },
                ndcauhoi: {
                    required: "Vui lòng nhập nội dung câu hỏi",
                },
                da_a: {
                    required: "Vui lòng nhập đáp án A",
                },
                da_b: {
                    required: "Vui lòng nhập đáp án B",
                },
                da_c: {
                    required: "Vui lòng nhập đáp án C",
                },
                da_d: {
                    required: "Vui lòng nhập đáp án D",
                },
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                // lấy dữ liệu từ form
                const data = Object.fromEntries(new FormData(form).entries());
                console.log(data);
                $.post(`http://localhost/webhoctapmvc/cauhoi/addCauHoi`, data, function(response) {
                    if (response.thanhcong) {
                        currentPage = 1;
                        layDSCauHoiAjax();
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
                    $("#add-user-modal").modal('toggle')
                });
                $('#macauhoi').val("");
                $('#ndcauhoi').val("");
                $('#da_a').val("");
                $('#da_b').val("");
                $('#da_c').val("");
                $('#da_d').val("");
            }
        })
        layDSCauHoiAjax();
    });

    $("#open-add-user-btn").click(function() {
        $("#add-user-modal").modal('toggle')
    });


    function changePage(newPage) {
        currentPage = newPage;
        layDSCauHoiAjax();
    }

    $('#cars-search').change(function() {
        currentPage = 1;
        layDSCauHoiAjax();
    });

    $("#search-user-form").keyup(debounce(function() {
        currentPage = 1;
        layDSCauHoiAjax();
    }, 200));

    function layDSCauHoiAjax() {
        let search = $('#cars-search option').filter(':selected').val();
        console.log('/' + search + "/");
        $.get(`http://localhost/webhoctapmvc/cauhoi/getCauHoi?rowsPerPage=10&page=${currentPage}&search=${$("#serch-user-text").val()}&search2=${search}`,
            function(response) {
                const table1 = $('#table1 > tbody');
                table1.empty();
                checkedRows = [];
                $row = 0;
                response.data.forEach(data => {
                    let tenDoKho = "";
                    dokhos.forEach(quyen => {
                        if (quyen.MaDoKho == data.MaDoKho) {
                            tenDoKho = quyen.TenDoKho;
                            return true;
                        }
                    });

                    if ($row % 2 == 0) {

                        table1.append(`
                        <tr class="table-light">
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaCH}">
                                </div>
                            </td>
                            <td>${data.MaCH}</td>
                            <td>${data.TenMon}</td>
                            <td >${data.NoiDung}</td>
                            <td>${tenDoKho}</td>
                            <td>
                                <button onclick="viewRow('${data.MaCH}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaCH}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaCH}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    } else {
                        table1.append(`
                        <tr class="table-info">
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.MaCH}">
                                </div>
                            </td>
                            <td>${data.MaCH}</td>
                            <td>${data.TenMon}</td>
                            <td>${data.NoiDung}</td>
                            <td>${tenDoKho}</td>
                            <td>
                                <button onclick="viewRow('${data.MaCH}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button onclick="repairRow('${data.MaCH}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-tools"></i>
                                </button>
                                <button onclick="deleteRow('${data.MaCH}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>`);
                    }
                    checkedRows.push(data.MaCH);
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


    function viewRow(params) {
        let data = {
            macauhoi: params
        };
        $.post(`http://localhost/webhoctapmvc/cauhoi/viewCauHoi`, data, function(response) {
            if (response.thanhcong) {
                $("#view-macauhoi").val(response.MaCH);
                let tenMon = "";
                monhocs.forEach(mon => {
                    if (mon.MaMon == response.MaMon) {
                        tenMon = mon.TenMon;
                        return true;
                    }
                });
                let tenDoKho = "";
                dokhos.forEach(quyen => {
                    if (quyen.MaDoKho == response.MaDoKho) {
                        tenDoKho = quyen.TenDoKho;
                        return true;
                    }
                });
                $("#view-tenmon").val(tenMon);
                $("#view-da-dung").val(response.DapAn);
                $("#view-dokho").val(tenDoKho);
                $("#view-ndcauhoi").val(response.NoiDung);
                $("#view-da-a").val(response.A);
                $("#view-da-b").val(response.B);
                $("#view-da-c").val(response.C);
                $("#view-da-d").val(response.D);
            }
        });
        $("#view-user-modal").modal('toggle');
    }

    function repairRow(params) {
        let data = {
            macauhoi: params
        };

        $.post(`http://localhost/webhoctapmvc/cauhoi/viewCauHoi`, data, function(response) {
            if (response.thanhcong) {
                $('#re-macauhoi').val(response.MaCH);
                $("#re-cars-mon").val(response.MaMon).prop('selected', true);
                $("#re-cars-da").val(response.DapAn).prop('selected', true);
                $("#re-cars-dokho").val(response.MaDoKho).prop('selected', true);
                $("#re-ndcauhoi").val(response.NoiDung);
                $("#re-da-a").val(response.A);
                $("#re-da-b").val(response.B);
                $("#re-da-c").val(response.C);
                $("#re-da-d").val(response.D);
            }
        });
        $("#repair-user-modal").modal('toggle');
        //Sua form
        $("form[name='repair-user-form']").validate({
            rules: {
                ndcauhoi: {
                    required: true,
                },
                da_a: {
                    required: true,
                },
                da_b: {
                    required: true,
                },
                da_c: {
                    required: true,
                },
                da_d: {
                    required: true,
                },
            },
            messages: {

                ndcauhoi: {
                    required: "Vui lòng nhập nội dung câu hỏi",
                },
                da_a: {
                    required: "Vui lòng nhập đáp án A",
                },
                da_b: {
                    required: "Vui lòng nhập đáp án B",
                },
                da_c: {
                    required: "Vui lòng nhập đáp án C",
                },
                da_d: {
                    required: "Vui lòng nhập đáp án D",
                },
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                $("#myModalLabel110").text("Quản Lý Tài Khoản");
                $("#question-model").text("Bạn có chắc chắn muốn sửa tài khoản này không");
                $("#question-user-modal").modal('toggle');
                $('#thuchien').off('click')
                $("#thuchien").click(function() {
                    // lấy dữ liệu từ form

                    const data = Object.fromEntries(new FormData(form).entries());
                    data['macauhoi'] = $('#re-macauhoi').val();
                    $.post(`http://localhost/webhoctapmvc/cauhoi/repairCauHoi`, data, function(
                        response) {
                        if (response.thanhcong) {
                            currentPage = 1;
                            layDSCauHoiAjax();
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
                        $("#repair-user-modal").modal('toggle')
                    });
                });
            }
        });
    }

    function deleteRow(params) {
        let data = {
            macauhoi: params
        };
        $("#myModalLabel110").text("Quản Lý Câu Hỏi");
        $("#question-model").text("Bạn có chắc chắn muốn xóa câu hỏi này không");
        $("#question-user-modal").modal('toggle');
        $('#thuchien').off('click');
        $("#thuchien").click(function() {
            $.post(`http://localhost/webhoctapmvc/cauhoi/deleteCauHoi`, data, function(response) {
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
                    layDSCauHoiAjax();
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
    $("#btn-delete-user").click(function() {
        $("#myModalLabel110").text("Quản Lý Tài Khoản");
        $("#question-model").text("Bạn có chắc chắn muốn xóa những tài khoản này không");
        $("#question-user-modal").modal('toggle');
        $('#thuchien').off('click')
        $("#thuchien").click(function() {
            let datas = []
            checkedRows.forEach(checkedRow => {
                if ($('#' + checkedRow).prop("checked")) {
                    datas.push(checkedRow);
                }
            });
            let data = {
                macauhois: JSON.stringify(datas)
            };
            $.post(`http://localhost/webhoctapmvc/cauhoi/deleteCauHois`, data, function(response) {
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
                    layDSCauHoiAjax();
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