<?php

namespace App\Model;

use App\Core\DatabaseFactory;
use PDO;

class DoKhoModel
{

    public static function findOneByMaDoKho($mamon)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT * FROM dokho WHERE MaDoKho = :mamon LIMIT 1");
        $query->execute([':mamon' => $mamon]);

        if ($row = $query->fetch()) {
            return $row;
        }
        return null;
    }

    public static function create($mamon, $tenmon)
    {
        $database = DatabaseFactory::getFactory()->getConnection();


        $sql = "INSERT INTO dokho (MaDoKho, TenDoKho, TrangThai)
                VALUES (:mamon,:tenmon, 1)";
        $query = $database->prepare($sql);
        $query->bindValue(':mamon', $mamon, PDO::PARAM_INT);
        $query->bindValue(':tenmon', $tenmon, PDO::PARAM_STR);

        $query->execute();
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }

        return false;
    }


    public static function update($mamon, $tenmon)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        // $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE dokho SET TenDoKho =:tenmon WHERE MaDoKho = :mamon";
        $query = $database->prepare($sql);
        $query->execute([':mamon' => $mamon,':tenmon' => $tenmon]);
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }
        return false;
    }

    public static function delete($mamon)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "UPDATE `dokho` SET TrangThai = 0  WHERE MaDoKho = :mamon";
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

        $sql = "UPDATE `dokho` SET TrangThai = 0  WHERE  MaDoKho IN " . $raw;
        $count  = $database->exec($sql);
        if (!$count) {
            return false;
        }
        return true;
    }

    public static function getAll(){
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = 'SELECT * FROM dokho WHERE TrangThai = 1';
        $query  = $database->query($sql);
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

    public static function getAllPagination($search = null, $page = 1, $rowsPerPage = 20)
    {
        // tính limit và offset dựa trên số trang và số lương dòng trên mỗi trang
        $limit = $rowsPerPage;
        $offset = $rowsPerPage * ($page - 1);

        $database = DatabaseFactory::getFactory()->getConnection();

        // query chỉ lấy user thuộc page yêu cầu
        $raw = 'SELECT * FROM dokho';
        if ($search) {
            $search = '%' . $search . '%';
            $raw .= ' WHERE (MaDoKho LIKE :search OR TenDoKho LIKE :search) AND TrangThai = 1';
        } else {
            $raw .= ' WHERE TrangThai = 1';
        }
        $raw .= ' ORDER BY MaDoKho ASC LIMIT :limit OFFSET :offset'; //DESC giảm ASC tăng

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
        $count = 'SELECT COUNT(MaDoKho) FROM dokho';
        if ($search) {
            $search = '%' . $search . '%';
            $count .= ' WHERE (MaDoKho LIKE :search OR TenDoKho LIKE :search ) AND TrangThai = 1';
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
}
