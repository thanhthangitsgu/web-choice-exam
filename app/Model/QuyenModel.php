<?php

namespace App\Model;

use App\Core\DatabaseFactory;
use App\Core\Cookie;
use PDO;

class QuyenModel{
    
    public static function getAllPagination($search = null, $page = 1, $rowsPerPage = 20)
    {
        // tính limit và offset dựa trên số trang và số lương dòng trên mỗi trang
        $limit = $rowsPerPage;
        $offset = $rowsPerPage * ($page - 1);

        $database = DatabaseFactory::getFactory()->getConnection();

        // query chỉ lấy quyen thuộc page yêu cầu
        $raw = 'SELECT * FROM quyen';
        if ($search) {
            $search = '%' . $search . '%';
            $raw .= ' WHERE (TenQuyen LIKE :search OR MaQuyen LIKE :search ) AND TrangThai = 1';
        } else {
            $raw .= ' WHERE TrangThai = 1';
        }

        $raw .= ' ORDER BY MaQuyen ASC LIMIT :limit OFFSET :offset';
        $query = $database->prepare($raw);

        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($search) {
            $query->bindValue(':search', $search, PDO::PARAM_STR);
        }

        $query->execute();
        $data = $query->fetchAll();

        // đếm số lượng tất cả quyen để tính số trang
        $count ='SELECT COUNT(MaQuyen) FROM quyen';
        if ($search) {
            $search = '%' . $search . '%';
            $count .= ' WHERE (TenQuyen LIKE :search OR MaQuyen LIKE :search) AND TrangThai = 1';
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

    public static function getAll(){
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = 'SELECT * FROM quyen WHERE TrangThai = 1';
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

    public static function getQuyen($maquyen){
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = 'SELECT * FROM quyen WHERE MaQuyen = "'.$maquyen.'" AND TrangThai = 1 LIMIT 1';
        $query  = $database->query($sql);
        if ($row = $query->fetch()) {
            return $row;
        }
        return null;
    }

    public static function getChiTietQuyen(){
        $database = DatabaseFactory::getFactory()->getConnection();
        $maquyen = Cookie::get('user_quyen');

        $sql = 'SELECT * FROM chitietquyen WHERE MaQuyen = "'.$maquyen.'" AND TrangThai = 1 ';
        $query = $database->query($sql);
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

    public static function ktraQuyen($macn){
        $database = DatabaseFactory::getFactory()->getConnection();
        $maquyen = Cookie::get('user_quyen');
        $sql = 'SELECT * FROM chitietquyen WHERE MaQuyen = "'.$maquyen.'" AND MaChucNang = "'.$macn.'"';
        $query = $database->query($sql);
        $data = $query->fetch();
        if($data->TrangThai == 0){
            return false;
        }
        return true;
    }

    public static function getChucNang(){
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = 'SELECT * FROM `chucnang` WHERE TrangThai = 1';
        $query = $database->query($sql);
        $row = $query->fetchAll();
        $check = true;
        if(!$query){
            $check = false;
        }
        $response = [
            'thanhcong' => $check,
            'data' =>$row,
        ];
        return $response;
    }

    public static function findOneByMaQuyen($maquyen){
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT * FROM quyen WHERE MaQuyen = :mamon LIMIT 1");
        $query->execute([':mamon' => $maquyen]);


        if ($row = $query->fetch()) {
            return $row;
        }
        return null;

    }

    public static function update($maquyen, $tenquyen,$chitiets)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE quyen SET TenQuyen =:tenquyen WHERE MaQuyen = :maquyen";
        $query = $database->prepare($sql);
        $query->execute([':maquyen' => $maquyen,':tenquyen' => $tenquyen]);

        $count2 = 0;
        foreach ($chitiets as &$chitiet) {
            $sql2 = "UPDATE chitietquyen SET TrangThai =:trangthai WHERE MaQuyen = :maquyen AND MaChucNang = :machucnang";
            $query2 = $database->prepare($sql2);
            $query2->execute([':maquyen' => $chitiet->MaQuyen,':machucnang' => $chitiet->MaChucNang,':trangthai' => $chitiet->TrangThai]);
            $count2 += $query2->rowCount();
        }

        $count = $query->rowCount() + $count2;
        if ($count > 0) {
            return true;
        }
        return false;
    }

    public static function create($maquyen, $tenquyen,$chitiets)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO quyen (MaQuyen, TenQuyen) VALUES (:maquyen,:tenquyen) ";
        $query = $database->prepare($sql);
        $query->execute([':maquyen' => $maquyen,':tenquyen' => $tenquyen]);

        $count2 = 0;
        foreach ($chitiets as &$chitiet) {
            $sql2 = "INSERT INTO chitietquyen (MaQuyen, MaChucNang, TrangThai) VALUES (:maquyen,:machucnang,:trangthai)";
            $query2 = $database->prepare($sql2);
            $query2->execute([':maquyen' => $chitiet->MaQuyen,':machucnang' => $chitiet->MaChucNang,':trangthai' => $chitiet->TrangThai]);
            $count2 += $query2->rowCount();
        }

        $count = $query->rowCount() + $count2;
        if ($count > 0) {
            return true;
        }
        return false;
    }

    public static function findChiTietQuyen($maquyen){
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT * FROM chitietquyen WHERE MaQuyen = :mamon ORDER BY MaChucNang ASC");
        $query->execute([':mamon' => $maquyen]);

        if ($row = $query->fetchAll()) {
            return $row;
        }
        return null;
    }

    public static function delete($maquyen){
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "UPDATE `quyen` SET TrangThai = 0  WHERE MaQuyen = :mamon";
        $query = $database->prepare($sql);
        $query->execute([':mamon' => $maquyen]);       
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }
        return false;
    }

    public static function deletes($maquyens){
        $database = DatabaseFactory::getFactory()->getConnection();
        $raw = "(";
        foreach ($maquyens as &$email) {
            $raw .= "'" . $email . "',";
        }
        $raw = substr($raw, 0, -1);
        $raw .= ")";

        $sql = "UPDATE `quyen` SET TrangThai = 0  WHERE  MaQuyen IN " . $raw;
        $count  = $database->exec($sql);
        if (!$count) {
            return false;
        }
        return true;
    }
}