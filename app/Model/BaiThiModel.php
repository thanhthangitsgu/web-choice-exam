<?php

namespace App\Model;

use App\Core\DatabaseFactory;
use PDO;

class BaiThiModel
{

    public static function findOneByMaCH($maCH)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare('SELECT * FROM cauhoi WHERE MaCH =:name');

        $query->setFetchMode(PDO::FETCH_ASSOC);

        $query->execute(array('name' => $maCH));


        while ($data = $query->fetch()) {
            return $data;
        }
    }

    public static function addBaiThi($maSV, $maDe, $makythi, $listTraLoi, $listDungSai, $soCauDung, $diem)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "INSERT INTO baithi (MaSV, MaDe, MaKyThi, DSCauTraLoi,DanhSachDungSai,SoCauDung,Diem,TrangThai)
                VALUES (:masv,:made, :makythi, :dscautraloi, :danhsachdungsai, :socaudung, :diem,1)";
        $query = $database->prepare($sql);
        $query->execute([':masv' => $maSV, ':made' => $maDe, ':makythi' => $makythi, ':dscautraloi' => $listTraLoi, ":danhsachdungsai" => $listDungSai, ":socaudung" => $soCauDung, ":diem" => $diem]);
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }
        return false;
    }

    public static function getBaiThi($maSV, $maDe)
    {

        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT * FROM baithi WHERE MaSV = :masv AND MaDe = :made LIMIT 1");

        $query->execute(array(':masv' => $maSV, ':made' => $maDe));

        $query->setFetchMode(PDO::FETCH_ASSOC);

        if ($data = $query->fetch()) {
            return $data;
        }
        return null;
    }

    //Lấy toàn bộ bài thi kể cả trạng thái = 1
    public static function getAllBaiThi()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT * FROM baithi WHERE 1");

        $query->execute();

        $query->setFetchMode(PDO::FETCH_ASSOC);

        $arrData = null;

        $i = 0;

        while ($data = $query->fetch()) {
            $arrData[$i++] = $data;
        }
        $arrData['SoLuong'] = $i;
        return $arrData;
    }

    //Lấy bài thi để hiển thị:
    public static function getAdvanBaiThi($search)
    {

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = 'SELECT baithi.MaSV, user.FullName, baithi.MaDe, 
        dethi.MaMon, kythi.MaKyThi, baithi.Diem, monhoc.TenMon, kythi.TenKyThi 
        from baithi,user,dethi,kythi,monhoc where baithi.MaSV = user.TenDangNhap and baithi.MaDe = dethi.MaDe and dethi.MaKyThi = kythi.MaKyThi and dethi.MaMon = monhoc.MaMon';

        if ($search != null) {
            $search .= '%' . $search . '%';
            $sql .= ' and baithi.MaSV LIKE :search';
            $query = $database->prepare($sql);
            $query->execute(array(':search' => "'" . $search . "'"));
        } else {
            $query = $database->prepare($sql);
            $query->execute(array());
        }
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $arrData = null;
        $i = 0;
        while ($data = $query->fetch()) {
            $i++;
            $arrData[$i] = $data;
            $arrData[$data['MaSV']] = $data['FullName'];
        }
        $arrData['SoLuong'] = $i;
        return $arrData;
    }

    //Kiểm tra xem bài thi đã tồn tại chưa:
    public static function checkIsset($maSV, $maDe)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT COUNT(*) as 'SoLuong' from baithi where MaSV ='" . $maSV . "' and MaDe='" . $maDe . "'";
        $query = $database->prepare($sql);
        $query->execute();
        $i = $query->fetch(PDO::FETCH_ASSOC);
        return $i['SoLuong'];
    }

    //Lấy bài thi của sinh viên
    public static function getBaiThiSinhVien($maSV)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT baithi.MaSV, user.FullName ,monhoc.MaMon, monhoc.TenMon, baithi.Diem from user, baithi, monhoc,dethi WHERE user.TenDangNhap=baithi.MaSV and baithi.MaDe = dethi.MaDe and dethi.MaMon = monhoc.MaMon and baithi.MaSV='" . $maSV . "'";
        $query = $database->prepare($sql);
        $query->execute();
        $data=null;
        $arrData = null;
        $i=0;
        while($data=$query->fetch(PDO::FETCH_ASSOC)){
            $arrData[$i++] =$data;
        }
        $arrData['SoLuong'] = $i;
        return $arrData;
    }

    //Get bài thi theo mã môn: 
    public static function getBaiThiByMaMon($maMon,$makythi){
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT baithi.MaSV, user.FullName, baithi.MaDe, baithi.Diem from baithi,user,dethi where baithi.MaSV = user.TenDangNhap  and baithi.MaDe = dethi.MaDe and dethi.MaMon ='".$maMon."' and baithi.MaKyThi = '".$makythi."'";
        $query = $database->prepare($sql);
        $query->execute();
        $data=null;
        $arrData = null;
        $i=0;
        while($data=$query->fetch(PDO::FETCH_ASSOC)){
            $arrData[$i++] =$data;
        }
        $arrData['SoLuong'] = $i;
        return $arrData;
    }
}
