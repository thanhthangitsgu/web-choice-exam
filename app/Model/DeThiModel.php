<?php

namespace App\Model;

use App\Core\DatabaseFactory;
use PDO;

class DeThiModel
{

    public static function findOneByMaDeThi($mamon)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT de.MaDe,de.MaMon,mh.TenMon,de.MaKyThi,kt.TenKyThi,de.ThoiGianLamBai,de.NgayThi,
                                            de.GioThi,de.SoLuongCauHoi FROM `dethi` de, monhoc mh, kythi kt WHERE de.MaDe = :mamon 
                                            AND de.TrangThai = 1 AND de.MaMon = mh.MaMon AND de.MaKyThi = kt.MaKyThi LIMIT 1");
        $query->execute([':mamon' => $mamon]);

        if ($row = $query->fetch()) {
            return $row;
        }
        return null;
    }

    public static function create($made, $mamon,$makythi,$tg,$ngaythi,$giothi,$slcau)
    {
        $database = DatabaseFactory::getFactory()->getConnection();


        $sql = "INSERT INTO `dethi`(`MaDe`, `MaMon`, `MaKyThi`, `ThoiGianLamBai`, `NgayThi`, `GioThi`, `SoLuongCauHoi`, `TrangThai`)
                VALUES (:made,:mamon,:makythi,:tg,:ngaythi,:giothi,:slcau, 1)";
        $query = $database->prepare($sql);
        $query->bindValue(':made', $made, PDO::PARAM_STR);
        $query->bindValue(':mamon', $mamon, PDO::PARAM_STR);
        $query->bindValue(':makythi', $makythi, PDO::PARAM_STR);
        $query->bindValue(':tg', $tg, PDO::PARAM_INT);
        $query->bindValue(':ngaythi', $ngaythi, PDO::PARAM_STR);
        $query->bindValue(':giothi', $giothi, PDO::PARAM_STR);
        $query->bindValue(':slcau', $slcau, PDO::PARAM_INT);

        $query->execute();
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }

        return false;
    }


    public static function update($made,$makythi,$tg,$ngaythi,$giothi)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE dethi SET MaKyThi =:makythi, ThoiGianLamBai = :tg, NgayThi = :ngaythi, GioThi = :giothi WHERE MaDe = :made";
        $query = $database->prepare($sql);
        $query->bindValue(':made', $made, PDO::PARAM_STR);
        $query->bindValue(':makythi', $makythi, PDO::PARAM_STR);
        $query->bindValue(':tg', $tg, PDO::PARAM_INT);
        $query->bindValue(':ngaythi', $ngaythi, PDO::PARAM_STR);
        $query->bindValue(':giothi', $giothi, PDO::PARAM_STR);
        $query->execute();
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }
        return false;
    }

    public static function delete($mamon)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "UPDATE `dethi` SET TrangThai = 0  WHERE MaDe = :mamon";
        $query = $database->prepare($sql);
        $query->execute([':mamon' => $mamon]);       
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }
        return false;
    }

    public static function deletes($mamons)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $raw = "(";
        foreach ($mamons as &$mamon) {
            $raw .= "'" . $mamon . "',";
        }
        $raw = substr($raw, 0, -1);
        $raw .= ")";

        $sql = "UPDATE `dethi` SET TrangThai = 0  WHERE  MaDe IN " . $raw;
        $count  = $database->exec($sql);
        if (!$count) {
            return false;
        }
        return true;
    }

    public static function getAllPagination($search = null, $page = 1, $rowsPerPage = 20)
    {
        // tính limit và offset dựa trên số trang và số lương dòng trên mỗi trang
        $limit = $rowsPerPage;
        $offset = $rowsPerPage * ($page - 1);

        $database = DatabaseFactory::getFactory()->getConnection();

        // query chỉ lấy user thuộc page yêu cầu
        $raw = 'SELECT de.MaDe,de.MaMon,mh.TenMon,de.MaKyThi,kt.TenKyThi,de.ThoiGianLamBai,de.NgayThi,de.GioThi,de.SoLuongCauHoi
                FROM `dethi` de, monhoc mh, kythi kt  ';
        if ($search) {
            $search = '%' . $search . '%';
            $raw .= ' WHERE (de.MaDe LIKE :search OR mh.TenMon LIKE :search OR kt.TenKyThi LIKE :search OR de.NgayThi LIKE :search) 
                    AND (de.TrangThai = 1 AND de.MaMon = mh.MaMon AND de.MaKyThi = kt.MaKyThi)';
        } else {
            $raw .= ' WHERE de.TrangThai = 1 AND de.MaMon = mh.MaMon AND de.MaKyThi = kt.MaKyThi';
        }
        $raw .= ' ORDER BY MaDe ASC LIMIT :limit OFFSET :offset'; //DESC giảm ASC tăng

        $query = $database->prepare($raw);

        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($search) {
            $query->bindValue(':search', $search, PDO::PARAM_STR);
        }

        $query->execute();
        $data = $query->fetchAll();
        // Xóa password trước khi trả về
        foreach ($data as $user) {
            unset($user->Hashed_Password);
        }

        // đếm số lượng tất cả user để tính số trang
        $count = 'SELECT COUNT(de.MaDe) FROM `dethi` de, monhoc mh, kythi kt ';
        if ($search) {
            $search = '%' . $search . '%';
            $count .= ' WHERE (de.MaDe LIKE :search OR mh.TenMon LIKE :search OR kt.TenKyThi LIKE :search OR de.NgayThi LIKE :search ) 
            AND (de.TrangThai = 1 AND de.MaMon = mh.MaMon AND de.MaKyThi = kt.MaKyThi)';
        } else {
            $count .= ' WHERE de.TrangThai = 1 AND de.MaMon = mh.MaMon AND de.MaKyThi = kt.MaKyThi';
        }

        $countQuery = $database->prepare($count);
        if ($search) {
            $countQuery->bindValue(':search', $search, PDO::PARAM_STR);
        }
        $countQuery->execute();
        $totalRows = $countQuery->fetch(PDO::FETCH_COLUMN);

        $response = [
            'page' => $page,
            'rowsPerPage' => $rowsPerPage,
            'totalPage' => ceil(intval($totalRows) / $rowsPerPage),
            'data' => $data,
        ];
        return $response;
    }

    public static function deleteVinhVien($made){
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = 'DELETE FROM `dethi` WHERE MaDe = "'.$made.'"';
        $database->exec($sql);
    }
    public static function getOneByMaDe($maDe)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT * FROM dethi WHERE MaDe = :maDe LIMIT 1");

        $query->setFetchMode(PDO::FETCH_ASSOC);

        $query->execute(array('made' => $maDe));

        if ($row = $query->fetch()) {
            return $row;
        }
        return null;
    }

    public static function getOneByMaMon($maMon)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT * FROM dethi WHERE MaMon = :mamon LIMIT 1");

        $query->setFetchMode(PDO::FETCH_ASSOC);
        
        $query->execute(array('mamon' => $maMon));

        while($row = $query->fetch()) {
            return $row;
        }
        return null;
    }



    public static function getCauHoiDe($maDe, $orderQ)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare('SELECT MaCH FROM de_cauhoi WHERE MaDe =:made LIMIT ' . $orderQ . ',1');

        $query->setFetchMode(PDO::FETCH_ASSOC);

        $query->execute(array('made' => $maDe));

        while ($data = $query->fetch()) {
            return $data;
        }
    }

    public static function getDeThiContent($maDe)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare('SELECT MaCH FROM de_cauhoi WHERE MaDe =:made');

        $query->setFetchMode(PDO::FETCH_ASSOC);

        $query->execute(array('made' => $maDe));

        $arrData = array();

        $i = 1;

        while ($data = $query->fetch()) {

            $arrData[$i++] = CauHoiModel::findOneByMaCH($data['MaCH']);
        }
        return $arrData;
    }

    public static function getAllDeThi(){
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare('SELECT * from dethi, monhoc,kythi where dethi.TrangThai = 1 and dethi.MaMon = monhoc.MaMon and dethi.MaKyThi = kythi.MaKyThi and kythi.TrangThai=1');
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute();
        $arrData = array();
        $i=0;
        while($data = $query->fetch()){
            $arrData[$i] = $data;
            $i++;
        }
        $arrData['SoLuong'] = $i;
        return $arrData;
    }

    public static function getCauHoi($made){
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT cauhoi.MaCH, NoiDung, A, B, C, D, DapAn, TenDoKho FROM cauhoi, de_cauhoi, dokho WHERE cauhoi.MaDoKho = dokho.MaDoKho AND cauhoi.MaCH =de_cauhoi.MaCH AND de_cauhoi.MaDe = :made");
        
        $query->setFetchMode(PDO::FETCH_ASSOC);

        $query->execute(array('made' => $made));

        $arrData = null;
        $i=0;

        while($row = $query->fetch()) {
            $i++;
            $arrData[$row['MaCH']] = $row;
            $arrData[$i]=$row;
        }

        $arrData['SoLuong'] = $i;
        return $arrData;
    }
}
