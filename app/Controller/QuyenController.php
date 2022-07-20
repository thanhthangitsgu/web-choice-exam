<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Request;
use App\Model\QuyenModel;

class QuyenController extends Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN07");
        $this->View->render('quyen/index');
    }

    public function getQuyen()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN07");
        $search = Request::get('search');
        $page = Request::get('page', 1);
        $rowsPerPage = Request::get('rowsPerPage', 20);
        $data = QuyenModel::getAllPagination($search, $page, $rowsPerPage);
        $this->View->renderJSON($data);
    }

    public function getChucNang(){
        Auth::checkAuthentication();
        Auth::ktraquyen("CN07");
        $data = QuyenModel::getChucNang();
        $this->View->renderJSON($data);

    }

    public function getQuyens(){
        Auth::checkAuthentication();
        $data = QuyenModel::getAll();
        $this->View->renderJSON($data);
    }

    public function getIsQuyen(){
        Auth::checkAuthentication();
        $maquyen = Request::post('maquyen');
        $data = QuyenModel::getQuyen($maquyen);
        $this->View->renderJSON($data);
    }
    
    public function getChiTietQuyen(){
        Auth::checkAuthentication();
        $data  = QuyenModel::getChiTietQuyen();
        $this->View->renderJSON($data);
    }

    public function viewQuyen(){
        Auth::checkAuthentication();
        Auth::ktraquyen("CN07");
        $mamon = Request::post('maquyen');
        $kq = QuyenModel::findOneByMaQuyen($mamon);
        $kq2 = QuyenModel::findChiTietQuyen($mamon);
        $response = ['thanhcong' => false];
        if($kq == null || $kq2 == null){
            $response['thanhcong'] = false;
        } else{   
            $response['MaQuyen'] = $kq->MaQuyen;
            $response['TenQuyen'] = $kq->TenQuyen;
            $response['chitiet'] = $kq2;
            $response['thanhcong'] = true;
        }
        $this->View->renderJSON($response);
    }

    public function deleteQuyen(){
        Auth::checkAuthentication();
        Auth::ktraquyen("CN07");
        $mamon = Request::post('maquyen');
        $kq= QuyenModel::delete($mamon);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function deleteQuyens(){
        Auth::checkAuthentication();       
        Auth::ktraquyen("CN07");
        $mamons = Request::post('maquyens');
        $mamons = json_decode($mamons);
        $kq = QuyenModel::deletes($mamons);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    
    public function checkValidMaQuyen()
    {
        $mamon = Request::post('maquyen');
        $user = QuyenModel::findOneByMaQuyen($mamon);

        $response = true;

        if ($user) {
            $response = 'Mã quyền này đã đựợc sử dụng';
        }
        $this->View->renderJSON($response);
    }

    public function repairQuyen(){
        
        Auth::checkAuthentication();
        Auth::ktraquyen("CN07");
        $maquyen= Request::post('maquyen');
        $tenquyen = Request::post('tenquyen');
        $chitiets = Request::post('chitiets');
        $chitiets = json_decode($chitiets);
        $kq = QuyenModel::update($maquyen, $tenquyen,$chitiets);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function addQuyen(){
        Auth::checkAuthentication();
        Auth::ktraquyen("CN07");
        $maquyen= Request::post('maquyen');
        $tenquyen = Request::post('tenquyen');
        $chitiets = Request::post('chitiets');
        $chitiets = json_decode($chitiets);
        $kq = QuyenModel::create($maquyen,$tenquyen,$chitiets);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }
}