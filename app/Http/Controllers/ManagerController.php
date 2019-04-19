<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role\Role;
use Session;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use GuzzleHttp\Client;
use JsonMapper;
use Redirect;
use Mail;
use App\Role\RoleChecker;
use App\Product;

class ManagerController extends Controller
{
    public function index(){
        // dd(\App\User::find(1)->employers);
        return view('admin_dashboard');
    }

    public function showEmployers(){
        $users = User::all();
        $employers = [];
        // dd(RoleChecker::check($users->get(5), Role::ROLE_EMPLOYER));
        foreach ($users as $user) {
            if ($user->role == null || RoleChecker::check($user, Role::ROLE_EMPLOYER)){
                array_push($employers, $user);
            }
        }
        // $employers = Session::get('currentUser')->employers->all();
        return view('admin.list_employers', compact('employers'));
    }

    public function showFarmers(){
        $listEmployers = Session::get('currentUser')->employers->all();
        $employers = [];
        foreach ($listEmployers as $employer) {
            if($employer->hasRole(Role::ROLE_FARMER)){
                array_push($employers, User::find($employer->id));
            }
        }
        return view('admin.list_employers', compact('employers'));
    }

    public function showTransportationEmployers(){
        $listEmployers = Session::get('currentUser')->employers->all();
        $employers = [];
        foreach ($listEmployers as $employer) {
            if($employer->hasRole(Role::ROLE_TRANSPORTATION_EMPLOYER)){
                array_push($employers, $employer);
            }
        }
        return view('admin.list_employers', compact('employers'));
    }

    public function showStoreEmployers(){
        $listEmployers = Session::get('currentUser')->employers->all();
        $employers = [];
        foreach ($listEmployers as $employer) {
            if($employer->hasRole(Role::ROLE_STORE_EMPLOYER)){
                array_push($employers, $employer);
            }
        }
        return view('admin.list_employers', compact('employers'));
    }

    public function showManagers(){
        $employers = Session::get('currentUser')->employers->all();
        return view('admin.list_employers', compact('employers'));
    }
    public function showFarmerManagers(){
        $listEmployers = Session::get('currentUser')->employers->all();
        $employers = [];
        foreach ($listEmployers as $employer) {
            if($employer->hasRole(Role::ROLE_FARM_MANAGER)){
                array_push($employers, $employer);
            }
        }
        return view('admin.list_employers', compact('employers'));
    }
    public function showTransportationManagers(){
        $listEmployers = Session::get('currentUser')->employers->all();
        $employers = [];
        foreach ($listEmployers as $employer) {
            if($employer->hasRole(Role::ROLE_TRANSPORTATION_MANAGER)){
                array_push($employers, $employer);
            }
        }
        return view('admin.list_employers', compact('employers'));
    }
    public function showStoreManagers(){
        $listEmployers = Session::get('currentUser')->employers->all();
        $employers = [];
        foreach ($listEmployers as $employer) {
            if($employer->hasRole(Role::ROLE_STORE_MANAGER)){
                array_push($employers, $employer);
            }
        }
        return view('admin.list_employers', compact('employers'));
    }

    public function showFarms(){
        $listFarms = Session::get('currentUser')->employers->all();
        return view('admin.list_farms', compact('employers'));
    }

    public function showStores(){
        $listEmployers = Session::get('currentUser')->employers->all();
        $employers = [];
        foreach ($listEmployers as $employer) {
            if($employer->hasRole(Role::ROLE_STORE_MANAGER)){
                array_push($employers, $employer);
            }
        }
        return view('admin.list_stores', compact('employers'));
    }

    public function showProducts(){
        $client = new Client(['base_uri' => 'http://18.236.74.178:3000/api/', 
        'http_errors' => false]);
        $listProductPackage = $client->request('GET', 'kigen.assets.ProductPackage', [
            'headers' => [
                'X-Access-Token' => Session::get('currentUser')->accessToken
            ]
        ]);
        $listProductPackage = json_decode($listProductPackage->getBody(), true);
        $listProducts = [];
        foreach ($listProductPackage as $package){
            array_push($listProducts, Product::find($package['productSerial']));
        }
        return view('admin.list_products', compact('listProductPackage', 'listProducts'));
    }

    public function activeRoleStoreEmployer(Request $request){
        if ($request['type'] == 'Farmer'){
            $parName = 'kigen.participants.Farmer';
            $parNameObj = 'farmer';
        } elseif ($request['type'] == 'Transportation') {
            $parName = 'kigen.participants.TransportationEmployer';
            $parNameObj = 'transportationEmployer';
        } elseif ($request['type'] == 'Store') {
            $parName = 'kigen.participants.StoreEmployer';
            $parNameObj = 'storeEmployer';
        }
        // dd($request['activeUserId']);

        // $client = new Client(['base_uri' => 'http://18.236.74.178:3000/api/', 'http_errors' => false]);
        $adminClient = new Client(['base_uri' => 'http://18.236.74.178:3001/api/', 'http_errors' => false]);
        try {
            $url = sprintf("users/%d", $request['activeUserId']);
            $userResponse = $adminClient->request('GET', $url, [
                'headers' => [
                    'X-Access-Token' => Session::get('currentUser')->accessToken
                ]
            ]);
            $userResponse = json_decode($userResponse->getBody(), true);
            // dd($userResponse['realname']);
            $qryResponse = $adminClient->request('GET', $parName, [
                'headers' => [
                    'X-Access-Token' => Session::get('currentUser')->accessToken
                ]
            ]);
            $qryResponse = json_decode($qryResponse->getBody(), true);
            $id = sizeof($qryResponse) + 1;
            // dd($id);
            $reqParamArray = array();
            $reqParamArray['employerId'] = $parNameObj . $id;

            $response = $adminClient->request('POST', $parName, [
                'json' => $reqParamArray
            ]);

            $reqParamArray = array();
            $reqParamArray['participant'] = $parName . '#' . $parNameObj . $id;
            $reqParamArray['userID'] = $parNameObj . $id;
            $params[] = $reqParamArray;

            $response = $adminClient->request('POST', 'system/identities/issue', [
                'json' => $reqParamArray,
                'sink' => '/home/nhan/Downloads/kigen-file/active'
            ]);

            $data = array('name'=>$userResponse['realname'], 'email'=>$userResponse['email']);
            Mail::send('emails.authentication.role_active', $data, function ($message) use ($data) {
                $message->to($data['email'], 'Hướng dẫn')->subject('Hướng dẫn kích hoạt tài khoản trên hệ thống');
                $message->attach('/home/nhan/Downloads/kigen-file/active');
                $message->from('kigen@gmail.com', 'Kigen System');
            });
            return redirect()->route('all-employers');
        } catch (GuzzleException $e) {
            return redirect()->back()->with('error', 'Issue failed');
        }
    }
}
