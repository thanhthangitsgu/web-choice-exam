<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Request;
use App\Model\DoKhoModel;

class DoKhoController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN03");
        $this->View->render('dokho/index');
    }

    public function getDoKho()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN03");
        $search = Request::get('search');
        $page = Request::get('page', 1);
        $rowsPerPage = Request::get('rowsPerPage', 20);
        $data = DoKhoModel::getAllPagination($search, $page, $rowsPerPage);
        $this->View->renderJSON($data);
    }

    public function addDoKho()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN03");
        $mamon = Request::post('madokho');
        $tenmon = Request::post('tendokho');
        $kq = DoKhoModel::create($mamon, $tenmon);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function repairDoKho(){
        Auth::checkAuthentication();
        Auth::ktraquyen("CN03");
        $mamon = Request::post('madokho');
        $tenmon = Request::post('tendokho');
        $kq = DoKhoModel::update($mamon, $tenmon);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function deleteDoKho()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN03");
        $mamon = Request::post('madokho');
        $kq= DoKhoModel::delete($mamon);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function deleteDoKhos(){
        Auth::checkAuthentication();       
        Auth::ktraquyen("CN03");
        $mamons = Request::post('madokhos');
        $mamons = json_decode($mamons);
        $kq = DoKhoModel::deletes($mamons);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function viewDoKho()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN03");
        $mamon = Request::post('madokho');
        $kq = DoKhoModel::findOneByMaDoKho($mamon);
        $response = ['thanhcong' => false];
        if($kq == null){
            $response['thanhcong'] = false;
        } else{   
            $response['MaDoKho'] = $kq->MaDoKho;
            $response['TenDoKho'] = $kq->TenDoKho;
            $response['thanhcong'] = true;
        }
        $this->View->renderJSON($response);
        
    }

    public function checkValidMaDoKho()
    {
        Auth::checkAuthentication();
        $mamon = Request::post('madokho');
        $user = DoKhoModel::findOneByMaDoKho($mamon);

        $response = true;

        if ($user) {
            $response = 'Mã độ khó này đã đựợc sử dụng';
        }
        $this->View->renderJSON($response);
    }

    public function getAllDoKho(){
        Auth::checkAuthentication();
        $response = DoKhoModel::getAll();
        $this->View->renderJSON($response);
    }
}
