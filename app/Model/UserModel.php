<?php

namespace App\Model;

use App\Core\Cookie;
use App\Core\DatabaseFactory;
use PDO;

class UserModel
{

    public static function findOneByEmail($email)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT * FROM user WHERE TenDangNhap = :email LIMIT 1");
        $query->execute([':email' => $email]);

        if ($row = $query->fetch()) {
            return $row;
        }
        return null;
    }

    public static function create($email, $password, $fullname, $maquyen)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        // Mã hóa password bằng thuật toán bcrypt
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO user (TenDangNhap,FullName, Hashed_Password, MaQuyen)
                VALUES (:email,:fullname, :hashed_password, :maquyen)";
        $query = $database->prepare($sql);
        $query->execute([':email' => $email, ':fullname' => $fullname, ':hashed_password' => $hashed_password, ':maquyen' => $maquyen]);
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }

        return false;
    }

    public static function resetPassword($email){
        $database = DatabaseFactory::getFactory()->getConnection();
        $password = "11111111";
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE user SET Hashed_Password = :hashed_password WHERE TenDangNhap = :email";
        $query = $database->prepare($sql);
        $query->execute([':email' => $email, ':hashed_password' => $hashed_password]);
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }
        return false;
    }

    public static function update($email,  $fullname, $maquyen)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        // $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE user SET FullName =:fullname, MaQuyen = :maquyen WHERE TenDangNhap = :email";
        $query = $database->prepare($sql);
        $query->execute([':email' => $email, ':fullname' => $fullname, ':maquyen' => $maquyen]);
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }
        return false;
    }

    public static function delete($email)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "UPDATE `user` SET TrangThai = 0  WHERE TenDangNhap = :email";
        $query = $database->prepare($sql);
        $query->execute([':email' => $email]);
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }
        return false;
    }

    public static function deletes($emails)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $raw = "(";
        foreach ($emails as &$email) {
            $raw .= "'" . $email . "',";
        }
        $raw = substr($raw, 0, -1);
        $raw .= ")";

        $sql = "UPDATE `user` SET TrangThai = 0  WHERE  TenDangNhap IN " . $raw;
        $count  = $database->exec($sql);
        if (!$count) {
            return false;
        }
        return true;
    }

    public static function getGV(){
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = 'SELECT * FROM `user` WHERE MaQuyen = "Q02"';
        $query = $database->query($sql);
        $data = $query->fetchAll();
        foreach ($data as $user) {
            unset($user->Hashed_Password);
        }
        if ($data != null) {
            return $data;
        }
        return null;

    }

    public static function getAllPagination($search = null, $page = 1, $rowsPerPage = 20)
    {
        // tính limit và offset dựa trên số trang và số lương dòng trên mỗi trang
        $limit = $rowsPerPage;
        $offset = $rowsPerPage * ($page - 1);

        $database = DatabaseFactory::getFactory()->getConnection();

        // query chỉ lấy user thuộc page yêu cầu
        $raw = 'SELECT * FROM user';
        if ($search) {
            $search = '%' . $search . '%';
            $raw .= ' WHERE (FullName LIKE :search OR TenDangNhap LIKE :search OR MaQuyen LIKE :search OR YeuCau LIKE :search) AND TrangThai = 1';
        } else {
            $raw .= ' WHERE TrangThai = 1';
        }
        $raw .= ' ORDER BY TenDangNhap ASC LIMIT :limit OFFSET :offset'; //DESC giảm ASC tăng

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
        $count = 'SELECT COUNT(TenDangNhap) FROM user';
        if ($search) {
            $search = '%' . $search . '%';
            $count .= ' WHERE (FullName LIKE :search OR TenDangNhap LIKE :search OR MaQuyen LIKE :search OR YeuCau LIKE :search) AND TrangThai = 1';
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

    public static function getAdvancedPagination($search, $search2, $page = 1, $rowsPerPage = 20)
    {
        $limit = $rowsPerPage;
        $offset = $rowsPerPage * ($page - 1);

        $database = DatabaseFactory::getFactory()->getConnection();
        $raw = 'SELECT * FROM user';

        if ($search2 == '1') {
            $raw .= ' WHERE (FullName LIKE :search OR TenDangNhap LIKE :search ) AND (YeuCau = 1)
         AND TrangThai = 1';
        } else {
            $raw .= ' WHERE (FullName LIKE :search OR TenDangNhap LIKE :search ) AND (MaQuyen LIKE :search2 OR YeuCau LIKE :search2)
         AND TrangThai = 1';
        }

        $search = '%' . $search . '%';
        $search2 = '%' . $search2 . '%';

        $raw .= ' ORDER BY TenDangNhap ASC LIMIT :limit OFFSET :offset';
        $query = $database->prepare($raw);

        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);
        $query->bindValue(':search', $search, PDO::PARAM_STR);
        $query->bindValue(':search2', $search2, PDO::PARAM_STR);
        $query->execute();
        $data = $query->fetchAll();
        // Xóa password trước khi trả về

        foreach ($data as $user) {
            unset($user->Hashed_Password);
        }

        $count = 'SELECT COUNT(TenDangNhap) FROM user';
        if ($search2 == 1) {
            $count .= ' WHERE (FullName LIKE :search OR TenDangNhap LIKE :search ) AND (YeuCau = :search2)
            AND TrangThai = 1';
        } else {
            $count .= ' WHERE (FullName LIKE :search OR TenDangNhap LIKE :search ) AND (MaQuyen LIKE :search2 OR YeuCau LIKE :search2)
            AND TrangThai = 1';
        }

        $countQuery = $database->prepare($count);
        $countQuery->bindValue(':search', $search, PDO::PARAM_STR);
        $countQuery->bindValue(':search2', $search2, PDO::PARAM_STR);
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

    public static function getID(){
        $id = Cookie::get('user_email');
        $quyen = Cookie::get('user_quyen');
        $response = [
            'id' => $id,
            'quyen' => $quyen,
        ];
        return $response;
    }

    public static function changePassword($id, $pass){
        $database = DatabaseFactory::getFactory()->getConnection();
        $hashed_password = password_hash($pass, PASSWORD_BCRYPT);
        $sql = "UPDATE user SET Hashed_Password = :hashed_password WHERE TenDangNhap = :id";
        $query = $database->prepare($sql);
        $query->execute([':id' => $id, ':hashed_password' => $hashed_password]);
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }
        return false;
    }

    public static function getSinhVien(){
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT TenDangNhap, FullName from user WHERE TrangThai = 1 and MaQuyen= 'Q01'";
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
