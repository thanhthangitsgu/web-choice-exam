<?php

namespace App\Model;

use App\Core\DatabaseFactory;
use App\Core\Cookie;
use PDO;

class CauHoiModel
{

    public static function findOneByMaCauHoi($email)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT * FROM cauhoi WHERE MaCH = :email LIMIT 1");
        $query->execute([':email' => $email]);

        if ($row = $query->fetch()) {
            return $row;
        }
        return null;
    }

    public static function create($email, $password, $fullname, $maquyen, $dab, $dac, $dad, $dadung, $dokho)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        // Mã hóa password bằng thuật toán bcrypt

        $sql = 'INSERT INTO `cauhoi`(`MaCH`, `MaMon`, `NoiDung`, `A`, `B`, `C`, `D`, `DapAn`, `MaDoKho`)
                VALUES ("'.$email.'","'.$password.'","'.$fullname.'","'.$maquyen.'","'.$dab.'","'.$dac.'","'.$dad.'","'.$dadung.'",'.$dokho.")";
        $query = $database->query($sql);

        
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }

        return false;
    }


    public static function update($email, $password, $fullname, $maquyen,  $dab, $dac, $dad, $dadung, $dokho)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        // $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = 'UPDATE `cauhoi` SET `MaMon`="'.$password.'",`NoiDung`="'.$fullname.'",
                `A`="'.$maquyen.'",`B`="'.$dab.'",`C`="'.$dac.'",`D`="'.$dad.'",`DapAn`="'.$dadung.'",
                `MaDoKho`='.$dokho.' WHERE `MaCH`="'.$email.'"';
        
        $query = $database->query($sql);
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }
        return false;
    }

    public static function delete($email)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "UPDATE `cauhoi` SET TrangThai = 0  WHERE MaCH = :email";
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

        $sql = "UPDATE `cauhoi` SET TrangThai = 0  WHERE  MaCH IN " . $raw;
        $count  = $database->exec($sql);
        if (!$count) {
            return false;
        }
        return true;
    }

    public static function getAllPagination($search, $search2, $page = 1, $rowsPerPage = 20)
    {
        // tính limit và offset dựa trên số trang và số lương dòng trên mỗi trang
        $limit = $rowsPerPage;
        $offset = $rowsPerPage * ($page - 1);

        $database = DatabaseFactory::getFactory()->getConnection();

        $search = '%' . $search . '%';
        // query chỉ lấy user thuộc page yêu cầu
        $magv = '"'.Cookie::get('user_email').'"';
        if ($search2 == "") {
            $sql = 'SELECT cauhoi.MaCH,cauhoi.MaMon,cauhoi.NoiDung, cauhoi.A, cauhoi.B, cauhoi.C, cauhoi.D, 
                cauhoi.DapAn, cauhoi.MaDoKho,monhoc.TenMon
                FROM `cauhoi`,monhoc WHERE (cauhoi.MaCH LIKE :search OR monhoc.TenMon LIKE :search OR cauhoi.NoiDung LIKE :search OR cauhoi.MaDoKho LIKE :search) 
                    AND cauhoi.TrangThai = 1 AND monhoc.MaMon = cauhoi.MaMon AND cauhoi.MaMon IN 
                        ( SELECT mh.MaMon FROM (`monhoc` mh,`gv_mh`) 
                        WHERE mh.MaMon = gv_mh.MaMon AND (gv_mh.MaGV = ' . $magv . '))';
        } else if ($search2 == "ch") {
            $sql = 'SELECT cauhoi.MaCH,cauhoi.MaMon,cauhoi.NoiDung, cauhoi.A, cauhoi.B, cauhoi.C, cauhoi.D, 
                cauhoi.DapAn, cauhoi.MaDoKho,monhoc.TenMon
                FROM `cauhoi`,monhoc WHERE (cauhoi.MaCH LIKE :search) 
                    AND cauhoi.TrangThai = 1 AND monhoc.MaMon = cauhoi.MaMon AND cauhoi.MaMon IN 
                        ( SELECT mh.MaMon FROM (`monhoc` mh,`gv_mh`) 
                        WHERE mh.MaMon = gv_mh.MaMon AND (gv_mh.MaGV = ' . $magv . '))';
        } else if ($search2 == "mh") {
            $sql = 'SELECT cauhoi.MaCH,cauhoi.MaMon,cauhoi.NoiDung, cauhoi.A, cauhoi.B, cauhoi.C, cauhoi.D, 
                cauhoi.DapAn, cauhoi.MaDoKho,monhoc.TenMon
                FROM `cauhoi`,monhoc WHERE (monhoc.TenMon LIKE :search) 
                    AND cauhoi.TrangThai = 1 AND monhoc.MaMon = cauhoi.MaMon AND cauhoi.MaMon IN 
                        ( SELECT mh.MaMon FROM (`monhoc` mh,`gv_mh`) 
                        WHERE mh.MaMon = gv_mh.MaMon AND (gv_mh.MaGV = ' . $magv . '))';
        } else if ($search2 == "nd") {
            $sql = 'SELECT cauhoi.MaCH,cauhoi.MaMon,cauhoi.NoiDung, cauhoi.A, cauhoi.B, cauhoi.C, cauhoi.D, 
                cauhoi.DapAn, cauhoi.MaDoKho,monhoc.TenMon
                FROM `cauhoi`,monhoc WHERE (cauhoi.NoiDung LIKE :search) 
                    AND cauhoi.TrangThai = 1 AND monhoc.MaMon = cauhoi.MaMon AND cauhoi.MaMon IN 
                        ( SELECT mh.MaMon FROM (`monhoc` mh,`gv_mh`) 
                        WHERE mh.MaMon = gv_mh.MaMon AND (gv_mh.MaGV = ' . $magv . '))';
        }
        if ($search2 == "dk") {
            $sql = 'SELECT cauhoi.MaCH,cauhoi.MaMon,cauhoi.NoiDung, cauhoi.A, cauhoi.B, cauhoi.C, cauhoi.D, 
                cauhoi.DapAn, cauhoi.MaDoKho,monhoc.TenMon
                FROM `cauhoi`,monhoc WHERE (cauhoi.MaDoKho LIKE :search) 
                    AND cauhoi.TrangThai = 1 AND monhoc.MaMon = cauhoi.MaMon AND cauhoi.MaMon IN 
                        ( SELECT mh.MaMon FROM (`monhoc` mh,`gv_mh`) 
                        WHERE mh.MaMon = gv_mh.MaMon AND (gv_mh.MaGV = ' . $magv . '))';
        }


        $sql .= ' ORDER BY MaCH ASC LIMIT :limit OFFSET :offset'; //DESC giảm ASC tăng

        $query = $database->prepare($sql);

        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);
        $query->bindValue(':search', $search, PDO::PARAM_STR);

        $query->execute();
        $data = $query->fetchAll();

        // đếm số lượng tất cả user để tính số trang
        $count = "";
        if ($search2 == "") {
            $count = 'SELECT COUNT(MaCH) FROM `cauhoi`,monhoc WHERE (cauhoi.MaCH LIKE :search OR monhoc.TenMon LIKE :search OR cauhoi.NoiDung LIKE :search OR cauhoi.MaDoKho LIKE :search) 
                    AND cauhoi.TrangThai = 1 AND monhoc.MaMon = cauhoi.MaMon AND cauhoi.MaMon IN 
                        ( SELECT mh.MaMon FROM (`monhoc` mh,`gv_mh`) 
                        WHERE mh.MaMon = gv_mh.MaMon AND (gv_mh.MaGV = ' . $magv . '))';
        } else if ($search2 == "ch") {
            $count = 'SELECT COUNT(MaCH) FROM `cauhoi`,monhoc WHERE (cauhoi.MaCH LIKE :search) 
                    AND cauhoi.TrangThai = 1 AND monhoc.MaMon = cauhoi.MaMon AND cauhoi.MaMon IN 
                        ( SELECT mh.MaMon FROM (`monhoc` mh,`gv_mh`) 
                        WHERE mh.MaMon = gv_mh.MaMon AND (gv_mh.MaGV = ' . $magv . '))';
        } else if ($search2 == "mh") {
            $count = 'SELECT COUNT(MaCH) FROM `cauhoi`,monhoc WHERE (monhoc.TenMon LIKE :search) 
                    AND cauhoi.TrangThai = 1 AND monhoc.MaMon = cauhoi.MaMon AND cauhoi.MaMon IN 
                        ( SELECT mh.MaMon FROM (`monhoc` mh,`gv_mh`) 
                        WHERE mh.MaMon = gv_mh.MaMon AND (gv_mh.MaGV = ' . $magv . '))';
        } else if ($search2 == "nd") {
            $count = 'SELECT COUNT(MaCH) FROM `cauhoi`,monhoc WHERE (cauhoi.NoiDung LIKE :search) 
                    AND cauhoi.TrangThai = 1 AND monhoc.MaMon = cauhoi.MaMon AND cauhoi.MaMon IN 
                        ( SELECT mh.MaMon FROM (`monhoc` mh,`gv_mh`) 
                        WHERE mh.MaMon = gv_mh.MaMon AND (gv_mh.MaGV = ' . $magv . '))';
        }
        if ($search2 == "dk") {
            $count = 'SELECT COUNT(MaCH) FROM `cauhoi`,monhoc WHERE (cauhoi.MaDoKho LIKE :search) 
                    AND cauhoi.TrangThai = 1 AND monhoc.MaMon = cauhoi.MaMon AND cauhoi.MaMon IN 
                        ( SELECT mh.MaMon FROM (`monhoc` mh,`gv_mh`) 
                        WHERE mh.MaMon = gv_mh.MaMon AND (gv_mh.MaGV = ' . $magv . '))';
        }

        $countQuery = $database->prepare($count);
        $countQuery->bindValue(':search', $search, PDO::PARAM_STR);

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

    public static function taoDeCauHoi($made,$mamon,$socau){
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = 'SELECT MaCH FROM `cauhoi` WHERE MaMon = "'.$mamon.'"';
        $query = $database->query($sql);
        $row = $query->fetchAll();
        $socau = (int)$socau;
        if (count($row) < $socau){  
            return 3;
        }

        $data = array();
        $i = 0;
        foreach($row as $r){
            array_push($data,$r->MaCH);
        }
        $check = false;
        while ($i < $socau){
            $it = rand(0,count($data));       
            $insert = 'INSERT INTO de_cauhoi (MaCH, MaDe, TrangThai) VALUES ("'.$data[$it].'","'.$made.'",1)';
            $squery = $database->query($insert);
            $count = $squery->rowCount();
            if( $count == 1){
                $check = true;
            } else {
                $check = false;
            }
            array_splice($data, $it, 1);
            $i++;
        }     
        return $check;
    }
    public static function findOneByMaCH($maCH){
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare('SELECT * FROM cauhoi WHERE MaCH =:name');

        $query->setFetchMode(PDO::FETCH_ASSOC);

        $query->execute(array('name'=>$maCH));

        if($data = $query->fetch()){
            return $data;
        }
    }
    

}
