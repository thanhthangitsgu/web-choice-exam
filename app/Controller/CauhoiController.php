<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Request;
use App\Model\CauHoiModel;
use App\Model\DeModel;
use App\Model\DeThiModel;

class CauHoiController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN04");
        $this->View->render('cauhoi/index');
    }

    public function getCauHoi()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN04");
        $search = Request::get('search');
        $search2 = Request::get('search2');
        $page = Request::get('page', 1);
        $rowsPerPage = Request::get('rowsPerPage', 20);
        $data = CauHoiModel::getAllPagination($search, $search2, $page, $rowsPerPage);
        $this->View->renderJSON($data);
    }

    public function addCauHoi()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN04");
        $email = Request::post('macauhoi');
        $password = Request::post('mamon');
        $fullname = Request::post('ndcauhoi');
        $maquyen = Request::post('da_a');
        $dab = Request::post('da_b');
        $dac = Request::post('da_c');
        $dad = Request::post('da_d');
        $dadung = Request::post('da_dung');
        $dokho = Request::post('dokho');

        $kq = CauHoiModel::create($email, $password, $fullname, $maquyen, $dab, $dac, $dad, $dadung, $dokho);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function repairCauHoi()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN04");
        $email = Request::post('macauhoi');
        $password = Request::post('mamon');
        $fullname = Request::post('ndcauhoi');
        $maquyen = Request::post('da_a');
        $dab = Request::post('da_b');
        $dac = Request::post('da_c');
        $dad = Request::post('da_d');
        $dadung = Request::post('da_dung');
        $dokho = Request::post('dokho');
        $kq = CauHoiModel::update($email, $password, $fullname, $maquyen, $dab, $dac, $dad, $dadung, $dokho);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function deleteCauHoi()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN04");
        $email = Request::post('macauhoi');
        $kq = CauHoiModel::delete($email);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function deleteCauHois()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN04");
        $emails = Request::post('macauhois');
        $emails = json_decode($emails);
        $kq = CauHoiModel::deletes($emails);
        $response = [
            'thanhcong' => $kq
        ];
        $this->View->renderJSON($response);
    }

    public function viewCauHoi()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN04");
        $email = Request::post('macauhoi');
        $kq = CauHoiModel::findOneByMaCauHoi($email);
        $response = ['thanhcong' => false];
        if ($kq == null) {
            $response['thanhcong'] = false;
        } else {
            $response['MaCH'] = $kq->MaCH;
            $response['MaMon'] = $kq->MaMon;
            $response['NoiDung'] = $kq->NoiDung;
            $response['A'] = $kq->A;
            $response['B'] = $kq->B;
            $response['C'] = $kq->C;
            $response['D'] = $kq->D;
            $response['DapAn'] = $kq->DapAn;
            $response['MaDoKho'] = $kq->MaDoKho;
            $response['thanhcong'] = true;
        }
        $this->View->renderJSON($response);
    }

    public function checkValidCauHoi()
    {
        Auth::checkAuthentication();
        $email = Request::post('macauhoi');
        $user = CauHoiModel::findOneByMaCauHoi($email);

        $response = true;

        if ($user) {
            $response = 'Mã câu hỏi đã được sử dụng';
        }
        $this->View->renderJSON($response);
    }

    public function getCauHoiOfDe(){
        //Auth::checkAuthentication();
        $maDe = Request::get('made');
        $orderQ = Request::get('orderQ');
        $data = CauHoiModel::findOneByMaCH(DeThiModel::getCauHoiDe($maDe,$orderQ)['MaCH']);
        $this->View->renderJSON($data);
    }
    

}
