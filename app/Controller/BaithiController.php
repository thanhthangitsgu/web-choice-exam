<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Cookie;
use App\Core\Request;
use App\Model\DeThiModel;
use App\Model\BaiThiModel;
use App\Model\CauHoiModel;
use App\Model\KyThiModel;
use App\Model\UserModel;
use LengthException;

// url baithi/danhsachbaithi
class BaiThiController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //Auth::checkNotAuthentication();
        $this->View->render('baithi/index');
    }

    public function addBaiThi()
    {
        $maSV = Request::get('maSV');
        $maDe = Request::get('maDe');
        $result = Request::get('resultSV');
        $data = DeThiModel::getDeThiContent($maDe);
        $makythi = Request::get('makythi');
        $listDungSai = "";
        $caudung = 0;
        for ($i = 1; $i <= count($data); $i++) {
            $cauhoi = CauHoiModel::findOneByMaCH((string)$data[$i]['MaCH']);
            if ($result[$i] == $cauhoi['DapAn']) {
                $caudung++;
                $listDungSai .= "1";
            } else {
                $listDungSai .= "0";
            }
        }
        if (count($data) != 0)
            $diem = ((float)$caudung) * 10 / ((float)count($data));
        else $diem = 0;
        $listTraLoi = "";
        for ($i = 1; $i <= count($data); $i++) {
            $listTraLoi .= $result[$i];
        }
        $kt = BaiThiModel::addBaiThi($maSV, $maDe, $makythi, $listTraLoi, $listDungSai, $caudung, (string) round($diem, 2));
        $baithi = BaiThiModel::getBaiThi($maSV, $maDe);
        $response = ['thanhcong' => $kt];
        $this->View->renderJSON($baithi);
    }

    public function getAllBaiThi()
    {
        $data = BaiThiModel::getAllBaiThi();
        $this->View->renderJSON($data);
    }

    public function getAdvanBaiThi()
    {
        $data = BaiThiModel::getAdvanBaiThi("");
        $this->View->renderJSON($data);
    }

    public function thongkeKetQua()
    {
        $kythi = Request::get('makythi');
        $data = BaiThiModel::getAdvanBaiThi("");
        $arrData = array();
        $diem = null;
        $soluong = null;
        for ($i = 1; $i <= $data['SoLuong']; $i++) {
            $diem[$data[$i]['MaSV']] = 0;
            $soluong[$data[$i]['MaSV']] = 0;
        }
        for ($i = 1; $i <= $data['SoLuong']; $i++) {
            if ($data[$i]['MaKyThi'] == $kythi) {
                $arrData[$data[$i]['MaSV']] = $data[$data[$i]['MaSV']];
                $diem[$data[$i]['MaSV']] += $data[$i]['Diem'];
                $soluong[$data[$i]['MaSV']]++;
            }
        }
        $i = 0;
        foreach ($arrData as $key => $value) {
            $i++;
            $arrData[$i]['MaSV'] = $key;
            $arrData[$i]['FullName'] = $value;
            if ($soluong[$key] > 0) $arrData[$i]['Diem'] = (float)($diem[$key]) / (float)($soluong[$key]);
            else $arrData[$i]['Diem'] = 0;
            if ($arrData[$i]['Diem'] >= 8.5) $arrData[$i]['XepLoai'] = "Giỏi";
            else if ($arrData[$i]['Diem'] < 8.5 and $arrData[$i]['Diem'] >= 7) $arrData[$i]['XepLoai'] = "Khá";
            else if ($arrData[$i]['Diem'] < 7 and $arrData[$i]['Diem'] >= 5.5) $arrData[$i]['XepLoai'] = "Trung bình";
            else if ($arrData[$i]['Diem'] < 5.5 and $arrData[$i]['Diem'] >= 4) $arrData[$i]['XepLoai'] = "Yếu";
            else $arrData[$i]['XepLoai'] = "Kém";
        }

        $arrData['SoLuong'] = $i;
        $arrData['TenKyThi'] = $data[1]['TenKyThi'];
        $this->View->renderJSON($arrData);
    }

    public function checkIsset()
    {
        $maSV = Request::get('masv');
        $maDe = Request::get('made');
        $response = BaiThiModel::checkIsset($maSV, $maDe);
        $this->View->renderJSON($response);
    }

    //Hàm xử lí thống kê kỳ thi: 
    public function thongkeKyThi()
    {
        $kythi = KyThiModel::getAllKyThiTK();
        $data = BaiThiModel::getAdvanBaiThi("");
        $xeploai = $kythi;
        for ($k = 0; $k < count($kythi) - 1; $k++) {
            $xeploai[$k]['Giỏi'] = 0;
            $xeploai[$k]['Khá'] = 0;
            $xeploai[$k]['Trung bình'] = 0;
            $xeploai[$k]['Yếu'] = 0;
            $xeploai[$k]['Kém'] = 0;
            $arrData = array();
            $diem = null;
            $soluong = null;
            for ($i = 1; $i <= $data['SoLuong']; $i++) {
                $diem[$data[$i]['MaSV']] = 0;
                $soluong[$data[$i]['MaSV']] = 0;
            }
            for ($i = 1; $i <= $data['SoLuong']; $i++) {
                if ($data[$i]['MaKyThi'] == $kythi[$k]['MaKyThi']) {
                    $arrData[$data[$i]['MaSV']] = $data[$data[$i]['MaSV']];
                    $diem[$data[$i]['MaSV']] += $data[$i]['Diem'];
                    $soluong[$data[$i]['MaSV']]++;
                }
            }
            $i = 0;
            foreach ($arrData as $key => $value) {
                $i++;
                $arrData[$i]['MaSV'] = $key;
                $arrData[$i]['FullName'] = $value;
                if ($soluong[$key] > 0) $arrData[$i]['Diem'] = (float)($diem[$key]) / (float)($soluong[$key]);
                else $arrData[$i]['Diem'] = 0;
                if ($arrData[$i]['Diem'] >= 8.5) $arrData[$i]['XepLoai'] = "Giỏi";
                else if ($arrData[$i]['Diem'] < 8.5 and $arrData[$i]['Diem'] >= 7) $arrData[$i]['XepLoai'] = "Khá";
                else if ($arrData[$i]['Diem'] < 7 and $arrData[$i]['Diem'] >= 5.5) $arrData[$i]['XepLoai'] = "Trung bình";
                else if ($arrData[$i]['Diem'] < 5.5 and $arrData[$i]['Diem'] >= 4) $arrData[$i]['XepLoai'] = "Yếu";
                else $arrData[$i]['XepLoai'] = "Kém";
            }

            for ($j = 1; $j <= $i; $j++) {
                $xeploai[$k][$arrData[$j]['XepLoai']]++;
            }
        }
        $this->View->renderJSON($xeploai);
    }

    public function getKQMon()
    {
        $maSV = Request::get('masv');
        $data = BaiThiModel::getBaiThiSinhVien($maSV);
        for ($i = 0; $i < $data['SoLuong']; $i++) {
            if ($data[$i]['Diem'] >= 8.5) $data[$i]['XepLoai'] = "Giỏi";
            else if ($data[$i]['Diem'] < 8.5 and $data[$i]['Diem'] >= 7) $data[$i]['XepLoai'] = "Khá";
            else if ($data[$i]['Diem'] < 7 and $data[$i]['Diem'] >= 5.5) $data[$i]['XepLoai'] = "Trung bình";
            else if ($data[$i]['Diem'] < 5.5 and $data[$i]['Diem'] >= 4) $data[$i]['XepLoai'] = "Yếu";
            else $data[$i]['XepLoai'] = "Kém";
        }
        $this->View->renderJSON($data);
    }

    public function getListSinhVien()
    {
        $data = UserModel::getSinhVien();
        $this->View->renderJSON($data);
    }

    public function getBaiThiByMaMon()
    {
        $mamon = Request::get('mamon');
        $makythi = Request::get('makythi');
        $data = BaiThiModel::getBaiThiByMaMon($mamon, $makythi);
        for ($i = 0; $i < $data['SoLuong']; $i++) {
            if ($data[$i]['Diem'] >= 8.5) $data[$i]['XepLoai'] = "Giỏi";
            else if ($data[$i]['Diem'] < 8.5 and $data[$i]['Diem'] >= 7) $data[$i]['XepLoai'] = "Khá";
            else if ($data[$i]['Diem'] < 7 and $data[$i]['Diem'] >= 5.5) $data[$i]['XepLoai'] = "Trung bình";
            else if ($data[$i]['Diem'] < 5.5 and $data[$i]['Diem'] >= 4) $data[$i]['XepLoai'] = "Yếu";
            else $data[$i]['XepLoai'] = "Kém";
        }
        $this->View->renderJSON($data);
    }
}
