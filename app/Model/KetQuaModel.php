<?php

namespace App\Model;

use App\Core\DatabaseFactory;
use PDO;

class KetQuaModel
{

    public static function findOneByMaDe($made){
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare('SELECT * FROM baithi WHERE MaDe = :made');

        $query->setFetchMode(PDO::FETCH_ASSOC);

        $query->execute([':made' => $made]);

        if($data = $query->fetch()){
            return $data;
        }
    }

    public static function getKetQua($maSV){
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT monhoc.MaMon, monhoc.TenMon,baithi.SoCauDung, baithi.Diem, dethi.SoLuongCauHoi, baithi.DSCauTraLoi, baithi.DanhSachDungSai, kythi.TenKyThi FROM baithi, monhoc, dethi, kythi WHERE baithi.MaSV= :masv AND baithi.MaDe = dethi.MaDe AND dethi.MaKyThi=kythi.MaKyThi AND dethi.MaMon = monhoc.MaMon");
        
        $query->setFetchMode(PDO::FETCH_ASSOC);

        $query->execute(array('masv' => $maSV));

        $arrData = null;
        $i=0;

        while($row = $query->fetch()) {
            $i++;
            $arrData[$row['MaMon']] = $row;
            $arrData[$i]=$row;
        }

        $arrData['SoLuong'] = $i;
        return $arrData;
    }
    
}