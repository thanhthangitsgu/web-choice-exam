<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Request;
use App\Model\KyThiModel;

class KyThiController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN05");
        $this->View->render('kythi/index');
    }

    public function getKyThi()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN05");
        $search = Request::get('search');
        $page = Request::get('page', 1);
        $rowsPerPage = Request::get('rowsPerPage', 20);
        $data = KyThiModel::getAllPagination($search, $page, $rowsPerPage);
        $this->View->renderJSON($data);
    }

    public function addKyThi()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN05");
        $mamon = Request::post('makythi');
        $tenmon = Request::post('tenkythi');
        $bd = Request::post('ngaybd');
        $kt = Request::post('ngaykt');
        $kq = KyThiModel::create($mamon, $tenmon,$bd,$kt);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }


    public function deleteKyThi()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN05");
        $mamon = Request::post('makythi');
        $kq= KyThiModel::delete($mamon);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function deleteKyThis(){
        Auth::checkAuthentication();       
        Auth::ktraquyen("CN05");
        $mamons = Request::post('makythis');
        $mamons = json_decode($mamons);
        $kq = KyThiModel::deletes($mamons);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function viewKyThi()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN05");
        $mamon = Request::post('makythi');
        $kq = KyThiModel::findOneByMaKyThi($mamon);
        $response = ['thanhcong' => false];
        if($kq == null){
            $response['thanhcong'] = false;
        } else{   
            $response['MaKyThi'] = $kq->MaKyThi;
            $response['TenKyThi'] = $kq->TenKyThi;
            $response['NgayBatDau'] = $kq->NgayBatDau;
            $response['NgayKetThuc'] = $kq->NgayKetThuc;
            $response['thanhcong'] = true;
        }
        $this->View->renderJSON($response);
        
    }

    public function repairKyThi(){
        Auth::checkAuthentication();
        Auth::ktraquyen("CN05");
        $mamon = Request::post('makythi');
        $tenmon = Request::post('tenkythi');
        $bd = Request::post('ngaybd');
        $kt = Request::post('ngaykt');
        $kq = KyThiModel::update($mamon, $tenmon,$bd,$kt);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function checkValidMaKyThi()
    {
        $mamon = Request::post('makythi');
        $user = KyThiModel::findOneByMaKyThi($mamon);

        $response = true;

        if ($user) {
            $response = 'Mã kỳ thi này đã đựợc sử dụng';
        }
        $this->View->renderJSON($response);
    }

    public function getALLKT(){
        Auth::checkAuthentication();
        $data = KyThiModel::getAllKT();
        $this->View->renderJSON($data);
    }

    public function getAllKyThi(){
        $data = KyThiModel::getAllKyThi();
        $this->View->renderJSON($data);
    }


}
