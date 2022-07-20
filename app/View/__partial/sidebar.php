<?php

use App\Core\View;

?>
<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-center">
                <div class="logo">
                    <a href="index.html"><img src="<?= View::assets('images/logo/logo.jpeg') ?>" alt="Logo" srcset="" /></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item <?= View::$activeItem == 'dashboard' ? 'active' : '' ?>">
                    <a href="<?= View::getBaseUrl() ?>" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Trang Chủ</span>
                    </a>
                </li>
                <li id="CN01" class="d-none sidebar-item  <?= View::$activeItem == 'user' ? 'active' : '' ?>">
                    <a href="<?= View::url('user/index') ?>" class="sidebar-link">
                        <i class="bi bi-people"></i>
                        <span>Người dùng</span>
                    </a>
                </li>
                <li id="CN02" class="d-none sidebar-item  <?= View::$activeItem == 'monhoc' ? 'active' : '' ?>">
                    <a href="<?= View::url('monhoc/index') ?>" class="sidebar-link">
                        <i class="bi bi-book"></i>
                        <span>Môn Học</span>
                    </a>
                </li>
                <li id="CN10" class="d-none sidebar-item  <?= View::$activeItem == 'thi' ? 'active' : '' ?>">
                    <a href="<?= View::url('thi/index') ?>" class="sidebar-link">
                        <i class="bi bi-pen-fill"></i>
                        <span>Thi</span>
                    </a>
                </li>
                <li id="CN09" class="d-none sidebar-item  <?= View::$activeItem == 'xemlichthi' ? 'active' : '' ?>">
                    <a href="<?= View::url('xemlichthi/index') ?>" class="sidebar-link">
                        <i class="bi bi-calendar-week"></i>
                        <span>Xem lịch thi</span>
                    </a>
                </li>
                <li id="CN04" class="d-none sidebar-item  <?= View::$activeItem == 'cauhoi' ? 'active' : '' ?>">
                    <a href="<?= View::url('cauhoi/index') ?>" class="sidebar-link">
                        <i class="bi bi-patch-question"></i>
                        <span>Câu hỏi</span>
                    </a>
                </li>
                <li id="CN03" class="d-none sidebar-item  <?= View::$activeItem == 'dokho' ? 'active' : '' ?>">
                    <a href="<?= View::url('dokho/index') ?>" class="sidebar-link">
                        <i class="bi bi-clipboard-data"></i>
                        <span>Độ khó câu hỏi</span>
                    </a>
                </li>
                <li id="CN05" class="d-none sidebar-item  <?= View::$activeItem == 'kythi' ? 'active' : '' ?>">
                    <a href="<?= View::url('kythi/index') ?>" class="sidebar-link">
                        <i class="bi bi-trophy"></i>
                        <span>Kỳ thi</span>
                    </a>
                </li>
                <li id="CN06" class="d-none sidebar-item  <?= View::$activeItem == 'dethi' ? 'active' : '' ?>">
                    <a href="<?= View::url('dethi/index') ?>" class="sidebar-link">
                        <i class="bi bi-ui-checks"></i>
                        <span>Đề thi</span>
                    </a>
                </li>
                <li id="CN07" class="d-none sidebar-item  <?= View::$activeItem == 'quyen' ? 'active' : '' ?>">
                    <a href="<?= View::url('quyen/index') ?>" class="sidebar-link">
                        <i class="bi bi-gear"></i>
                        <span>Phân Quyền</span>
                    </a>
                </li>
                <li id="CN11" class="d-none sidebar-item  <?= View::$activeItem == 'ketqua' ? 'active' : '' ?>">
                    <a href="<?= View::url('ketqua/index') ?>" class="sidebar-link">
                        <i class="bi bi-clipboard-check"></i>
                        <span>Kết Quả Thi</span>
                    </a>
                </li>
                <li id="CN12" class="d-none sidebar-item  <?= View::$activeItem == 'dinhhuong' ? 'active' : '' ?>">
                    <a href="<?= View::url('dinhhuong/index') ?>" class="sidebar-link">
                        <i class="bi bi-graph-up"></i>
                        <span>Định Hướng Ngành Học</span>
                    </a>
                </li>
                <li id="CN08" class="d-none sidebar-item  <?= View::$activeItem == 'baithi' ? 'active' : '' ?>">
                    <a href="<?= View::url('baithi/index') ?>" class="sidebar-link">
                        <i class="bi bi-calendar"></i>
                        <span>Quản lí bài thi</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x">
            <i data-feather="x"></i>
        </button>
    </div>
</div>