<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Request;
use App\Model\CauHoiModel;
use App\Model\DeThiModel;

class DeThiController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN06");
        $this->View->render('dethi/index');
    }

    public function getDeThi()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN06");
        $search = Request::get('search');
        $page = Request::get('page', 1);
        $rowsPerPage = Request::get('rowsPerPage', 20);
        $data = DeThiModel::getAllPagination($search, $page, $rowsPerPage);
        $this->View->renderJSON($data);
    }

    public function addDeThi()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN06");
        $made = Request::post('made');
        $mamon = Request::post('mamon');
        $makythi = Request::post('makythi');
        $tg = Request::post('tglambai');
        $ngaythi = Request::post('ngaythi');
        $giothi = Request::post('giothi');
        $slcau = Request::post('soluong');

        $kq = DeThiModel::create($made, $mamon, $makythi, $tg, $ngaythi, $giothi, $slcau);
        $response = [
            'thanhcong' => false,
            'text' => 'thêm thất bại'
        ];
        if ($kq) {
            $ktra = CauHoiModel::taoDeCauHoi($made, $mamon, $slcau);
            if ($ktra === 3) {
                $response = [
                    'thanhcong' => false,
                    'text' => 'Số lượng câu hỏi không đủ'
                ];
                DeThiModel::deleteVinhvien($made);
            } else if ($ktra == true) {
                $response = [
                    'thanhcong' => true,
                    'text' => 'Thêm thành công'
                ];
            }
        }
        $this->View->renderJSON($response);
    }


    public function deleteDeThi()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN06");
        $mamon = Request::post('made');
        $kq = DeThiModel::delete($mamon);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function deleteDeThis()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN06");
        $mamons = Request::post('mades');
        $mamons = json_decode($mamons);
        $kq = DeThiModel::deletes($mamons);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function viewDeThi()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN06");
        $mamon = Request::post('made');
        $kq = DeThiModel::findOneByMaDeThi($mamon);
        $response = ['thanhcong' => false];
        if ($kq == null) {
            $response['thanhcong'] = false;
        } else {
            $response['MaDe'] = $kq->MaDe;
            $response['MaMon'] = $kq->MaMon;
            $response['MaKyThi'] = $kq->MaKyThi;
            $response['TenKyThi'] = $kq->TenKyThi;
            $response['TenMon'] = $kq->TenMon;
            $response['NgayThi'] = $kq->NgayThi;
            $response['GioThi'] = $kq->GioThi;
            $response['ThoiGianLamBai'] = $kq->ThoiGianLamBai;
            $response['SoLuongCau'] = $kq->SoLuongCauHoi;
            $response['thanhcong'] = true;
        }
        $this->View->renderJSON($response);
    }

    public function repairDeThi()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN06");
        $made = Request::post('made');
        $makythi = Request::post('makythi');
        $tg = Request::post('tglambai');
        $ngaythi = Request::post('ngaythi');
        $giothi = Request::post('giothi');

        $kq = DeThiModel::update($made, $makythi, $tg, $ngaythi, $giothi);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function checkValidMaDeThi()
    {
        $mamon = Request::post('made');
        $user = DeThiModel::findOneByMaDeThi($mamon);

        $response = true;

        if ($user) {
            $response = 'Mã đề thi này đã đựợc sử dụng';
        }
        $this->View->renderJSON($response);
    }

    public function getDebyMaMon()
    {
        $maMon = Request::get('mamon');
        $data = DeThiModel::getOneByMaMon($maMon);
        $this->View->renderJSON($data);
    }

    public function getCauHoiDe()
    {
        $maDe = Request::get('made');
        $data = DeThiModel::getDeThiContent($maDe);
        $this->View->renderJSON(count($data));
    }

    public function getAllDeThi()
    {
        $data = DeThiModel::getAllDeThi();
        $arr=null;
        $date = getdate();
        $k=0;
        $time = $date['year']."-".'0'.$date['mon']."-".($date['mday']<0?"0":"").$date['mday'];
        for($i=0;$i<$data['SoLuong'];$i++){
            if(strcmp($time,$data[$i]['NgayBatDau'])<=0&&(strcmp($time,$data[$i]['NgayKetThuc']>=0))){
                $arr[$k++] = $data[$i];
            }
        }
        $arr['SoLuong'] = $k;
        $this->View->renderJSON(($arr));
    }

    public function getCauHoi(){ 
        
        Auth::checkAuthentication();
        $made = Request::get('made');
        $data = DeThiModel::getCauHoi($made);
        $this->View->renderJSON($data);
    }
}
