<?php

use App\Core\View;
use App\Core\Cookie;

View::$activeItem = 'ketqua';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kết quả thi</title>

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
                        <div class="row" id="cover-card-kq"></div>
                    </section>
                </div>
                <!-- FOOTER -->
                <?php View::partial('footer')  ?>
            </div>
        </div>
        <!--MODAL-->
        <div class="modal fade text-left" id="chi-tiet-kq-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Chi tiết kết quả</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body" id="cover-modal-kq"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Đóng</span>
                        </button>
                    </div>
                </div>
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
    
    <script>
    $(document).ready(function(){


        var ajaxKetQua = $.ajax({
            type: 'GET',
            url: 'http://localhost/webhoctapmvc/ketqua/getKetQua',
            data:{
                masv: $('#mail').html(),
            }
        });

        /**
         *  Thực hiện sau khi ajax được kết quả từ dtb, mấy cái liên quan đến dữ liệu bài thi đều nằm trong này nha:
         *  data là mảng 2 chiều có key là số 1,2,3... hoặc tên môn (TenMon) và tên cột trong dtb: TenMon, MaMon, SoCauDung,Diem
         *  
         */
        ajaxKetQua.done(function(data){
            //In bảng kết quả
            for (var i = 1; i <= data['SoLuong']; i++) {
                var idCartKQ = 'card-kq-' + i.toString();
                var idMon = 'mon-' + i.toString();
                var idSoCauDung = 'so-cau-dung-' + i.toString();
                var idDiem = 'diem-' + i.toString();
                var idChiTiet = 'chi-tiet-' + i.toString();
                $("#cover-card-kq").append(createHtml(idCartKQ,idMon,idSoCauDung,idDiem,idChiTiet));
                $('#mon-'+i.toString()).html(data[i]['TenMon']);
                $('#so-cau-dung-'+i.toString()).html(data[i]['SoCauDung']+ "/" +data[i]['SoLuongCauHoi']);
                $('#diem-'+i.toString()).html(data[i]['Diem']);
                $('#chi-tiet-'+i.toString()).click(function() {
                    $("#chi-tiet-kq-modal").modal('toggle');
                });
               
            }

            for (var i = 1; i <= data['SoLuong']; i++) {
                eventClick(i);           
            }

            function eventClick(i){
                document.getElementById('chi-tiet-'+i.toString()).addEventListener("click", function() {
                    var idKT = 'ky-thi-modal-' + i.toString();
                    var idMon = 'mon-modal-' + i.toString();
                    var idSoCauDung = 'so-cau-dung-modal-' + i.toString();
                    var idDiem = 'diem-modal-' + i.toString();
                    var idCau = 'cau-modal-' + i.toString();
                    var DSDungSai = data[i]['DanhSachDungSai'].toString();
                    var DSCauTraLoi = data[i]['DSCauTraLoi'].toString();
                    $("#cover-modal-kq").html(createModal(idKT, idMon, idSoCauDung, idDiem, idCau));
                    $('#mon-modal-'+i.toString()).html(data[i]['TenMon']);
                    $('#so-cau-dung-modal-'+i.toString()).html(data[i]['SoCauDung']+ "/" +data[i]['SoLuongCauHoi']);
                    $('#diem-modal-'+i.toString()).html(data[i]['Diem']);
                    $('#ky-thi-modal-'+i.toString()).html(data[i]['TenKyThi']);
                    for (var j = 1; j <= data[i]['SoLuongCauHoi']; j++) {
                        if(DSDungSai.charAt(j-1)=='0' && DSCauTraLoi.charAt(j-1)!='#')
                            $('#cau-modal-'+i.toString()).append('<div class="btn btn-sm btn-info disabled" style="width:90px" >Câu '+j+'</div>\
                            <div class="btn btn-sm btn-danger disabled">'+DSCauTraLoi.charAt(j-1)+'</div>');
                        else if(DSDungSai.charAt(j-1)=='1') $('#cau-modal-'+i.toString()).append('<div class="btn btn-sm btn-info disabled" style="width:90px" >Câu '+j+'</div>\
                        <div class="btn btn-sm btn-success disabled">'+DSCauTraLoi.charAt(j-1)+'</div>');
                        else $('#cau-modal-'+i.toString()).append('<div class="btn btn-sm btn-info disabled" style="width:90px" >Câu '+j+'</div>\
                        <div class="btn btn-sm btn-secondary disabled"style="width:28px" >'+DSCauTraLoi.charAt(j-1)+'</div>');
                    }

                });
            }

        });

        function createHtml(idCartKQ, idMon, idSoCauDung, idDiem, idChiTiet) {
            return '<div class="col-xl-4 col-md-6 col-sm-12">\
                <div class="card">\
                    <div class="card-quest" id="' + idCartKQ + '">\
                        <div class="card-header">\
                            <h4 id="' + idMon+ '"></h4>\
                        </div>\
                        <div class="card-body">\
                            <div class="alert alert-light-success">\
                                <i class="bi bi-check2-square"></i><span> Số câu đúng:</span>\
                                <span id ="'+ idSoCauDung +'"></span>\
                            </div>\
                            <div class="alert alert-light-danger">\
                                <i class="bi bi-file-earmark-check"></i><span> Điểm:</span>\
                                <span id ="'+ idDiem +'">\
                            </div>\
                            <div class="pagination justify-content-center">\
                                <button class="btn btn-info" id="'+ idChiTiet +'">Xem chi tiết</button>\
                            </div>\
                        </div>\
                    </div>\
                </div>\
            </div>'
        }

        function createModal(idKT, idMon, idSoCauDung, idDiem, idCau) {
            return '<div class="pagination justify-content-center"><h5 id="'+ idKT +'"></h5></div>\
                    <div class="pagination justify-content-center"><h6>Môn: </h6><h6 id="'+ idMon +'"></h6></div>\
                    <div><i class="bi bi-check2-square"></i><span> Số câu đúng:</span>\
                        <span id ="'+ idSoCauDung +'"></span>\
                    </div>\
                    <div><i class="bi bi-file-earmark-check"></i><span> Điểm:</span>\
                        <span id ="'+ idDiem +'">\
                    </div>\
                    <div><div class="btn btn-success disabled icon"></div> Chọn đúng \
                        <div class="btn btn-danger disabled icon"></div> Chọn sai\
                        <div class="btn btn-secondary disabled icon"></div> Bỏ trống\
                    </div><br>\
                    <div class="buttons" style="padding-left:20px" id="'+idCau+'">\
                    </div>'
        }
        
        
    })
    </script>
</body>

</html>