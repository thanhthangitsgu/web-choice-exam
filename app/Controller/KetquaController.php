<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\Cookie;
use App\Core\Controller;
use App\Core\Request;
use App\Model\KetQuaModel;

class KetQuaController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN11");
        $this->View->render('ketqua/index');
    }

    public function getKetQua(){ 
        
        Auth::checkAuthentication();
        Auth::ktraquyen("CN11");
        $maSV = Request::get('masv');
        $data = KetQuaModel::getKetQua($maSV);
        $this->View->renderJSON($data);
    }

}