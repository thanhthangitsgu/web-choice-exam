<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Request;
use App\Model\MonHocModel;

class MonHocController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN02");
        $this->View->render('monhoc/index');
    }

    public function getMonHoc()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN02");
        $search = Request::get('search');
        $page = Request::get('page', 1);
        $rowsPerPage = Request::get('rowsPerPage', 20);
        $data = MonHocModel::getAllPagination($search, $page, $rowsPerPage);
        $this->View->renderJSON($data);
    }

    public function addMon()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN02");
        $mamon = Request::post('mamon');
        $tenmon = Request::post('tenmon');
        $tinchi = Request::post('tinchi');
        $kq = MonHocModel::create($mamon, $tenmon, $tinchi);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function repairMon(){
        Auth::ktraquyen("CN02");
        $mamon = Request::post('mamon');
        $tenmon = Request::post('tenmon');
        $tinchi = Request::post('tinchi');
        $kq= MonHocModel::update($mamon,$tenmon,$tinchi);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function deleteMon()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN02");
        $mamon = Request::post('mamon');
        $kq= MonHocModel::delete($mamon);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function deleteMons(){
        Auth::checkAuthentication();       
        Auth::ktraquyen("CN02");
        $mamons = Request::post('mamons');
        $mamons = json_decode($mamons);
        $kq = MonHocModel::deletes($mamons);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function viewMon()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN02");
        $mamon = Request::post('mamon');
        $kq = MonHocModel::findOneByMaMon($mamon);
        $response = ['thanhcong' => false];
        if($kq == null){
            $response['thanhcong'] = false;
        } else{   
            $response['MaMon'] = $kq->MaMon;
            $response['TenMon'] = $kq->TenMon;
            $response['SoTinChi'] = $kq->SoTinChi;
            $response['thanhcong'] = true;
        }
        $this->View->renderJSON($response);
        
    }

    public function checkValidMaMon()
    {
        $mamon = Request::post('mamon');
        $user = MonHocModel::findOneByMaMon($mamon);

        $response = true;

        if ($user) {
            $response = 'Mã môn này đã đựợc sử dụng';
        }
        $this->View->renderJSON($response);
    }

    public function getGVMon(){
        Auth::checkAuthentication();
        Auth::ktraquyen("CN02");
        $search = Request::get('search');
        $search2 = Request::get('search2');
        $page = Request::get('page', 1);
        $rowsPerPage = Request::get('rowsPerPage', 20);
        $data = MonHocModel::getAllGVM($search,$search2, $page, $rowsPerPage);
        $this->View->renderJSON($data);
    }

    public function addGVM(){
        Auth::checkAuthentication();
        Auth::ktraquyen("CN02");
        $mamon = Request::post('mamon');
        $magv = Request::post('magv');
        $kq = MonHocModel::addGVM($magv,$mamon);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function deleteGVM(){
        Auth::checkAuthentication();
        Auth::ktraquyen("CN02");
        $mamon = Request::post('mamon');
        $magv = Request::post('magv');
        $kq = MonHocModel::deleteGVM($magv,$mamon);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function getMHGV(){
        Auth::checkAuthentication();
        $data = MonHocModel::getMHGV();
        $this->View->renderJSON($data);
    }

    public function getAllMH(){
        Auth::checkAuthentication();
        $data = MonHocModel::getAllMH();
        $data['SoLuong'] = count($data['data']);
        $this->View->renderJSON($data);
    }}
