<?php

namespace App\Model;

use App\Core\DatabaseFactory;
use PDO;

class KyThiModel
{

    public static function findOneByMaKyThi($mamon)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT * FROM kythi WHERE MaKyThi = :mamon LIMIT 1");
        $query->execute([':mamon' => $mamon]);

        if ($row = $query->fetch()) {
            return $row;
        }
        return null;
    }

    public static function create($mamon, $tenmon,$bd,$kt)
    {
        $database = DatabaseFactory::getFactory()->getConnection();


        $sql = "INSERT INTO kythi (MaKyThi, TenKyThi, NgayBatDau,NgayKetThuc,TrangThai)
                VALUES (:mamon,:tenmon,:bd,:kt, 1)";
        $query = $database->prepare($sql);
        $query->bindValue(':mamon', $mamon, PDO::PARAM_STR);
        $query->bindValue(':tenmon', $tenmon, PDO::PARAM_STR);
        $query->bindValue(':bd', $bd, PDO::PARAM_STR);
        $query->bindValue(':kt', $kt, PDO::PARAM_STR);
        $query->execute();
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }

        return false;
    }


    public static function update($mamon, $tenmon,$bd,$kt)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        // $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE kythi SET TenKyThi =:tenmon, NgayBatDau = :bd, NgayKetThuc = :kt WHERE MaKyThi = :mamon";
        $query = $database->prepare($sql);
        $query->execute([':mamon' => $mamon,':tenmon' => $tenmon,':bd' => $bd,':kt' => $kt]);
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }
        return false;
    }

    public static function delete($mamon)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "UPDATE `kythi` SET TrangThai = 0  WHERE MaKyThi = :mamon";
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

        $sql = "UPDATE `kythi` SET TrangThai = 0  WHERE  MaKyThi IN " . $raw;
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
        $raw = 'SELECT * FROM kythi';
        if ($search) {
            $search = '%' . $search . '%';
            $raw .= ' WHERE (MaKyThi LIKE :search OR TenKyThi LIKE :search OR NgayBatDau LIKE :search OR NgayKetThuc LIKE :search) AND TrangThai = 1';
        } else {
            $raw .= ' WHERE TrangThai = 1';
        }
        $raw .= ' ORDER BY MaKyThi ASC LIMIT :limit OFFSET :offset'; //DESC giảm ASC tăng

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
        $count = 'SELECT COUNT(MaKyThi) FROM kythi';
        if ($search) {
            $search = '%' . $search . '%';
            $count .= ' WHERE (MaKyThi LIKE :search OR TenKyThi LIKE :search OR NgayBatDau LIKE :search OR NgayKetThuc LIKE :search ) AND TrangThai = 1';
        } else {
            $count .= ' WHERE TrangThai = 1';
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

    public static function getAllKT(){
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->query("SELECT * FROM kythi WHERE TrangThai = 1");
        $data = $query->fetchAll();
        $check = true;
        if(!$query){
            $check = false;
        }
        $response = [
            'thanhcong' => $check,
            'data' =>$data,
        ];
        return $response;
    }
    public static function getAllKyThi()
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare('SELECT * FROM kythi WHERE 1');
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute();
        $i=0;
        $arrData=null;
        while ($data = $query->fetch()) {
            $arrData[$i++] = $data; 
        }
        $arrData['SoLuong']=$i;
        return $arrData;
    }

    public static function getAllKyThiTK()
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare('SELECT * FROM kythi WHERE 1');
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute();
        $i=0;
        $arrData=null;
        while ($data = $query->fetch()) {
            $arrData[$i++] = $data; 
        }
        $arrData['SoLuong']=$i;
        return $arrData;
    }

    
}
