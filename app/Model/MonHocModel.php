<?php

namespace App\Model;

use App\Core\DatabaseFactory;
use App\Core\Cookie;
use PDO;

class MonHocModel
{

    public static function findOneByMaMon($mamon)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT * FROM monhoc WHERE MaMon = :mamon LIMIT 1");
        $query->execute([':mamon' => $mamon]);

        if ($row = $query->fetch()) {
            return $row;
        }
        return null;
    }

    public static function create($mamon, $tenmon, $tinchi)
    {
        $database = DatabaseFactory::getFactory()->getConnection();


        $sql = "INSERT INTO monhoc (MaMon, TenMon, SoTinChi,TrangThai)
                VALUES (:mamon,:tenmon, :tinchi,1)";
        $query = $database->prepare($sql);
        $query->execute([':mamon' => $mamon, ':tenmon' => $tenmon, ':tinchi' => $tinchi]);
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }

        return false;
    }

    public static function getMHGV(){
        $database = DatabaseFactory::getFactory()->getConnection();

        $magv = Cookie::get('user_email');     
        $sql = 'SELECT monhoc.MaMon,monhoc.TenMon,monhoc.SoTinChi FROM (`monhoc`,`gv_mh`) WHERE 
        (monhoc.MaMon = gv_mh.MaMon) AND (gv_mh.MaGV = "'.$magv.'")';
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


    public static function update($mamon, $tenmon, $tinchi)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        // $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE monhoc SET TenMon =:tenmon, SoTinChi = :tinchi WHERE MaMon = :mamon";
        $query = $database->prepare($sql);
        $query->execute([':mamon' => $mamon, ':tinchi' => $tinchi, ':tenmon' => $tenmon]);
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }
        return false;
    }

    public static function delete($mamon)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "UPDATE `monhoc` SET TrangThai = 0  WHERE MaMon = :mamon";
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

        $sql = "UPDATE `monhoc` SET TrangThai = 0  WHERE  MaMon IN " . $raw;
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
        $raw = 'SELECT * FROM monhoc';
        if ($search) {
            $search = '%' . $search . '%';
            $raw .= ' WHERE (MaMon LIKE :search OR TenMon LIKE :search OR SoTinChi LIKE :search) AND TrangThai = 1';
        } else {
            $raw .= ' WHERE TrangThai = 1';
        }
        $raw .= ' ORDER BY MaMon ASC LIMIT :limit OFFSET :offset'; //DESC giảm ASC tăng

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
        $count = 'SELECT COUNT(MaMon) FROM monhoc';
        if ($search) {
            $search = '%' . $search . '%';
            $count .= ' WHERE (MaMon LIKE :search OR TenMon LIKE :search OR SoTinChi LIKE :search) AND TrangThai = 1';
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
    public static function getAllGVM($search,$search2, $page=1, $rowsPerPage=20){
        $limit = $rowsPerPage;
        $offset = $rowsPerPage * ($page - 1);

        $database = DatabaseFactory::getFactory()->getConnection();

        // query chỉ lấy user thuộc page yêu cầu
        $raw = 'SELECT * FROM gv_mh';
        $search = '%' . $search . '%';
        
        if($search2 == ""){
            $raw .= ' WHERE (MaMon LIKE :search OR MaGV LIKE :search) AND TrangThai = 1';
        } else if($search2 == "gv"){
            $raw .= ' WHERE (MaGV LIKE :search) AND TrangThai = 1';
        } else {
            $raw .= ' WHERE (MaMon LIKE :search) AND TrangThai = 1';
        }

        $raw .= ' ORDER BY MaMon ASC LIMIT :limit OFFSET :offset'; //DESC giảm ASC tăng

        $query = $database->prepare($raw);

        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($search) {
            $query->bindValue(':search', $search, PDO::PARAM_STR);
        }

        $query->execute();
        $data = $query->fetchAll();

        // đếm số lượng tất cả user để tính số trang
        $count = 'SELECT COUNT(MaMon AND MaGV) FROM gv_mh';
        if($search2 == ""){
            $count .= ' WHERE (MaMon LIKE :search OR MaGV LIKE :search) AND TrangThai = 1';
        } else if($search2 == "gv"){
            $count .= ' WHERE (MaGV LIKE :search) AND TrangThai = 1';
        } else {
            $count .= ' WHERE (MaMon LIKE :search) AND TrangThai = 1';
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


    public static function addGVM($magv,$mamon){
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql ='INSERT INTO `gv_mh`(`MaGV`, `MaMon`, `TrangThai`) VALUES (:magv, :mamon, 1)';
        $query = $database->prepare($sql);
        $query->execute([':mamon' => $mamon, ':magv' => $magv]);
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }
        return false;
    }

    public static function deleteGVM($magv,$mamon){
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = 'DELETE FROM `gv_mh` WHERE MaGV = :magv AND MaMon = :mamon';
        $query = $database->prepare($sql);
        $query->execute([':mamon' => $mamon, ':magv' => $magv]);
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }
        return false;
    }

    public static function getAllMH(){
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->query("SELECT * FROM monhoc WHERE TrangThai = 1");
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
}
