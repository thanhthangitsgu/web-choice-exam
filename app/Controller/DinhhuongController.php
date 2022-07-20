<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\Controller;

class DinhHuongController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN12");
        $this->View->render('dinhhuong/index');
    }

}