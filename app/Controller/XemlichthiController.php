<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Request;
use App\Model\UserModel;

class XemlichthiController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN09");
        $this->View->render('xemlichthi/index');
    }

}