-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 17, 2021 lúc 02:09 PM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web_qlttn`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baithi`
--

CREATE TABLE `baithi` (
  `MaSV` varchar(11) NOT NULL,
  `MaDe` varchar(11) NOT NULL,
  `DSCauTraLoi` text NOT NULL,
  `DanhSachDungSai` varchar(100) NOT NULL,
  `SoCauDung` int(11) NOT NULL,
  `Diem` varchar(10) NOT NULL,
  `TrangThai` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cauhoi`
--

CREATE TABLE `cauhoi` (
  `MaCH` varchar(11) NOT NULL,
  `MaMon` varchar(11) NOT NULL,
  `NoiDung` text NOT NULL,
  `A` text NOT NULL,
  `B` text NOT NULL,
  `C` text NOT NULL,
  `D` text NOT NULL,
  `DapAn` varchar(1) NOT NULL,
  `MaDoKho` int(11) NOT NULL,
  `TrangThai` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietquyen`
--

CREATE TABLE `chitietquyen` (
  `MaQuyen` varchar(11) NOT NULL,
  `MaChucNang` varchar(11) NOT NULL,
  `TrangThai` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chucnang`
--

CREATE TABLE `chucnang` (
  `MaChucNang` varchar(11) NOT NULL,
  `TenDoiTuong` varchar(255) NOT NULL,
  `TacVu` varchar(255) NOT NULL,
  `TrangThai` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dethi`
--

CREATE TABLE `dethi` (
  `MaDe` varchar(11) NOT NULL,
  `MaMon` varchar(11) NOT NULL,
  `MaKyThi` varchar(11) NOT NULL,
  `ThoiGianLamBai` int(11) NOT NULL,
  `NgayThi` date DEFAULT NULL,
  `GioThi` time NOT NULL,
  `SoLuongCauHoi` int(100) NOT NULL,
  `TrangThai` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `de_cauhoi`
--

CREATE TABLE `de_cauhoi` (
  `MaCH` varchar(11) NOT NULL,
  `MaDe` varchar(11) NOT NULL,
  `TrangThai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dokho`
--

CREATE TABLE `dokho` (
  `MaDoKho` int(11) NOT NULL,
  `TenDoKho` varchar(255) NOT NULL,
  `TrangThai` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gv_mh`
--

CREATE TABLE `gv_mh` (
  `MaGV` varchar(11) NOT NULL,
  `MaMon` varchar(11) NOT NULL,
  `TrangThai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kythi`
--

CREATE TABLE `kythi` (
  `MaKyThi` varchar(11) NOT NULL,
  `TenKyThi` text NOT NULL,
  `NgayBatDau` date NOT NULL,
  `NgayKetThuc` date NOT NULL,
  `TrangThai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monhoc`
--

CREATE TABLE `monhoc` (
  `MaMon` varchar(11) NOT NULL,
  `TenMon` varchar(255) NOT NULL,
  `SoTinChi` int(11) NOT NULL,
  `TrangThai` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `monhoc`
--

INSERT INTO `monhoc` (`MaMon`, `TenMon`, `SoTinChi`, `TrangThai`) VALUES
('MH001', 'Triết học Mác - Lênin', 3, 1),
('MH002', 'Kinh tế chính trị Mác - Lênin', 2, 1),
('MH003', 'Chủ nghĩa xã hội khoa học', 2, 1),
('MH004', 'Tư tưởng Hồ Chí Minh', 2, 1),
('MH005', 'Lịch sử Đảng Cộng sản Việt Nam', 2, 1),
('MH006', 'GD quốc phòng - An ninh 1', 2, 1),
('MH007', 'GD quốc phòng - An ninh 2', 2, 1),
('MH008', 'Tiếng Anh I', 2, 1),
('MH009', 'Tiếng Anh II', 2, 1),
('MH010', 'Tiếng Anh III', 3, 1),
('MH011', 'Pháp luật đại cương', 2, 1),
('MH012', 'Phương pháp NCKH trong CNTT', 2, 1),
('MH013', 'Xác suất thống kê A', 3, 1),
('MH014', 'Giải tích', 4, 1),
('MH015', 'Đại số', 4, 1),
('MH016', 'Cơ sở lập trình', 3, 1),
('MH017', 'Kỹ thuật lập trình', 3, 1),
('MH018', 'Kiến trúc máy tính', 3, 1),
('MH019', 'Hệ điều hành', 3, 1),
('MH020', 'Toán rời rạc', 3, 1),
('MH021', 'Lý thuyết đồ thị', 3, 1),
('MH022', 'Mạng máy tính', 4, 1),
('MH023', 'Lập trình Java', 4, 1),
('MH024', 'Phát triển ứng dụng web 1', 3, 1),
('MH025', 'Cấu trúc dữ liệu và giải thuật', 4, 1),
('MH026', 'Cơ sở dữ liệu', 4, 1),
('MH027', 'Lập trình hướng đối tượng', 4, 1),
('MH028', 'Cơ sở trí tuệ nhân tạo', 4, 1),
('MH029', 'Phát triển ứng dụng web 2', 3, 1),
('MH030', 'Công nghệ phần mền', 4, 1),
('MH031', 'Phân tích thiết kế hệ thống thông tin', 4, 1),
('MH032', 'Phân tích thiết kế hướng đối tượng', 4, 1),
('MH033', 'Hệ điều hành mã nguồn mở', 3, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `MaQuyen` varchar(11) NOT NULL,
  `TenQuyen` varchar(255) NOT NULL,
  `TrangThai` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`MaQuyen`, `TenQuyen`, `TrangThai`) VALUES
('Q01', 'Sinh Viên', 1),
('Q02', 'Giảng Viên\r\n', 1),
('Q03', 'Nhân Viên', 1),
('Q04', 'Admin', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `TenDangNhap` varchar(11) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `Hashed_Password` varchar(255) NOT NULL,
  `MaQuyen` varchar(11) NOT NULL,
  `TrangThai` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`TenDangNhap`, `FullName`, `Hashed_Password`, `MaQuyen`, `TrangThai`) VALUES
('3117410207', 'Trần Lê Huy Quyền', '$2y$10$trHnXy7Zbk3VuzaWuSF7ROphlzNhRMuj3KlSWE8YFiqyqrR.67osC', 'Q01', 1),
('3119410332', 'Phan Anh Quân', '$2y$10$PRoUgV9.0bdf4rqXUWiodOXsNXbK9JjvVT1NrFVmcg2IwOVbDil0y', 'Q01', 0),
('3119410400', 'Nguyễn Lê Huy Thắng', '$2y$10$Y/4p8HXRWUfyXWX/pcZWmerVOeMh0B207Y6iA.H2qobj1oXTd/p.q', 'Q01', 1),
('3119410401', 'Phan Thanh Thắng', '$2y$10$PIYpsSqqFbMDFRuzWWscF.T52RUW2IyyCrgKnDVxXpu72dmDy7d2a', 'Q01', 1),
('3119560002', 'Trịnh Trâm Anh', '$2y$10$hNed2EYVlAElRakUlzJR/OByvQeDC.LY9M/g6usSXEtlJtFsWp8EK', 'Q01', 1),
('3119560061', 'Trần Thị Thu Thanh', '$2y$10$3BNA/lTacSLtLtWMxvUh5O0PtmB0aK6W5Ug6PSEcDb277Y.r1/1Qq', 'Q01', 1),
('3119560073', 'Cao Nguyễn Phương Trang', '$2y$10$kd1VN0.0J7IPhkqSezj2GuDoXcXTITixkLrsPKHfbslpvfmEwJV12', 'Q01', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `baithi`
--
ALTER TABLE `baithi`
  ADD PRIMARY KEY (`MaSV`,`MaDe`),
  ADD KEY `baithi_ibfk_1` (`MaDe`);

--
-- Chỉ mục cho bảng `cauhoi`
--
ALTER TABLE `cauhoi`
  ADD PRIMARY KEY (`MaCH`),
  ADD KEY `cauhoi_ibfk_1` (`MaDoKho`),
  ADD KEY `MaMon` (`MaMon`);

--
-- Chỉ mục cho bảng `chitietquyen`
--
ALTER TABLE `chitietquyen`
  ADD PRIMARY KEY (`MaQuyen`,`MaChucNang`),
  ADD KEY `chitietquyen_ibfk_1` (`MaChucNang`);

--
-- Chỉ mục cho bảng `chucnang`
--
ALTER TABLE `chucnang`
  ADD PRIMARY KEY (`MaChucNang`);

--
-- Chỉ mục cho bảng `dethi`
--
ALTER TABLE `dethi`
  ADD PRIMARY KEY (`MaDe`),
  ADD KEY `MaMon` (`MaMon`),
  ADD KEY `MaKyThi` (`MaKyThi`);

--
-- Chỉ mục cho bảng `de_cauhoi`
--
ALTER TABLE `de_cauhoi`
  ADD PRIMARY KEY (`MaCH`,`MaDe`),
  ADD KEY `de_cauhoi_ibfk_1` (`MaDe`);

--
-- Chỉ mục cho bảng `dokho`
--
ALTER TABLE `dokho`
  ADD PRIMARY KEY (`MaDoKho`);

--
-- Chỉ mục cho bảng `gv_mh`
--
ALTER TABLE `gv_mh`
  ADD PRIMARY KEY (`MaGV`,`MaMon`),
  ADD KEY `gv_mh_ibfk_1` (`MaMon`);

--
-- Chỉ mục cho bảng `kythi`
--
ALTER TABLE `kythi`
  ADD PRIMARY KEY (`MaKyThi`);

--
-- Chỉ mục cho bảng `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`MaMon`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`MaQuyen`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`TenDangNhap`),
  ADD KEY `MaQuyen` (`MaQuyen`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `baithi`
--
ALTER TABLE `baithi`
  ADD CONSTRAINT `baithi_ibfk_1` FOREIGN KEY (`MaDe`) REFERENCES `dethi` (`MaDe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `cauhoi`
--
ALTER TABLE `cauhoi`
  ADD CONSTRAINT `cauhoi_ibfk_1` FOREIGN KEY (`MaDoKho`) REFERENCES `dokho` (`MaDoKho`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cauhoi_ibfk_2` FOREIGN KEY (`MaMon`) REFERENCES `monhoc` (`MaMon`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `chitietquyen`
--
ALTER TABLE `chitietquyen`
  ADD CONSTRAINT `chitietquyen_ibfk_1` FOREIGN KEY (`MaChucNang`) REFERENCES `chucnang` (`MaChucNang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chitietquyen_ibfk_2` FOREIGN KEY (`MaQuyen`) REFERENCES `quyen` (`MaQuyen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `dethi`
--
ALTER TABLE `dethi`
  ADD CONSTRAINT `dethi_ibfk_1` FOREIGN KEY (`MaMon`) REFERENCES `monhoc` (`MaMon`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dethi_ibfk_2` FOREIGN KEY (`MaKyThi`) REFERENCES `kythi` (`MaKyThi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `de_cauhoi`
--
ALTER TABLE `de_cauhoi`
  ADD CONSTRAINT `de_cauhoi_ibfk_1` FOREIGN KEY (`MaDe`) REFERENCES `dethi` (`MaDe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `de_cauhoi_ibfk_2` FOREIGN KEY (`MaCH`) REFERENCES `cauhoi` (`MaCH`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `gv_mh`
--
ALTER TABLE `gv_mh`
  ADD CONSTRAINT `gv_mh_ibfk_1` FOREIGN KEY (`MaMon`) REFERENCES `monhoc` (`MaMon`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gv_mh_ibfk_2` FOREIGN KEY (`MaGV`) REFERENCES `user` (`TenDangNhap`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`MaQuyen`) REFERENCES `quyen` (`MaQuyen`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
