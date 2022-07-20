<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\Cookie;
use App\Core\Controller;
use App\Core\Request;
use App\Model\UserModel;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN01");
        $this->View->render('user/index');
    }

    public function test()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN01");
        $this->View->render('user/test');
    }

    public function getUser()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN01");
        $search = Request::get('search');
        $page = Request::get('page', 1);
        $rowsPerPage = Request::get('rowsPerPage', 20);
        $data = UserModel::getAllPagination($search, $page, $rowsPerPage);
        $this->View->renderJSON($data);
    }

    public function addUser()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN01");
        $email = Request::post('email');
        $password = Request::post('password');
        $fullname = Request::post('fullname');
        $maquyen = Request::post('maquyen');
        $kq = UserModel::create($email, $password, $fullname, $maquyen);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function repairUser(){
        Auth::checkAuthentication();
        Auth::ktraquyen("CN01");
        $email = Request::post('email');
        $fullname = Request::post('fullname');
        $maquyen = Request::post('maquyen');
        $kq= UserModel::update($email,$fullname,$maquyen);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function resetPassword(){
        Auth::checkAuthentication();
        Auth::ktraquyen("CN01");
        $email = Request::post('email');
        $kq = UserModel::resetPassword($email);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }
    public function deleteUser()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN01");
        $email = Request::post('email');
        $kq= UserModel::delete($email);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function deleteUsers(){
        Auth::checkAuthentication();  
        Auth::ktraquyen("CN01");     
        $emails = Request::post('emails');
        $emails = json_decode($emails);
        $kq = UserModel::deletes($emails);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function viewUser()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN01");
        $email = Request::post('email');
        $kq = UserModel::findOneByEmail($email);
        $response = ['thanhcong' => false];
        if($kq == null){
            $response['thanhcong'] = false;
        } else{   
            $response['TenDangNhap'] = $kq->TenDangNhap;
            $response['FullName'] = $kq->FullName;
            $response['MaQuyen'] = $kq->MaQuyen;
            $response['thanhcong'] = true;
        }
        $this->View->renderJSON($response);
        
    }

    public function checkValidEmail()
    {   
        Auth::checkAuthentication();
        $email = Request::post('email');
        $user = UserModel::findOneByEmail($email);

        $response = true;

        if ($user) {
            $response = 'Tên đăng nhập đã đựợc người khác sử dụng';
        }
        $this->View->renderJSON($response);
    }

    public function advancedSearch()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN01");
        $search = Request::get('search');
        $search2 = Request::get('search2');
        $page = Request::get('page', 1);
        $rowsPerPage = Request::get('rowsPerPage', 20);
        $data = UserModel::getAdvancedPagination($search, $search2,$page, $rowsPerPage);
        $this->View->renderJSON($data);
    }

    public function getGiangVien(){
        Auth::checkAuthentication();
        $data = UserModel::getGV();
        $this->View->renderJSON($data);
    }

    public function getID(){
        Auth::checkAuthentication();
        $data = UserModel::getID();
        $this->View->renderJSON($data);
    }

    public function changePassword(){
        Auth::checkAuthentication();
        $id = Cookie::get('user_email');
        $user = UserModel::findOneByEmail($id);
        $oldpassword = Request::post('oldpassword');
        $newpassword = Request::post('newpassword');
        $isValid = password_verify($oldpassword, $user->Hashed_Password);
        if (!$isValid) {
            $response=['thanhcong' => false];
            return $this->View->renderJSON($response);
        }else{
            $kq = UserModel::changePassword($id, $newpassword);
            $response = [
                'thanhcong' => $kq
            ];
            return $this->View->renderJSON($response);
        }
    }
}
