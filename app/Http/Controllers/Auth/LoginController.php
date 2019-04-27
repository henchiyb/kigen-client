<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Farm;
use App\FarmImage;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use JsonMapper;
use Redirect;
use App\User;
use Session;
use App\Role\Role;
use DB;

class LoginController extends Controller
{
    protected $redirectTo = '/';
    public function login(Request $request){
        $client = new Client(['base_uri' => 'http://54.212.34.46:3000/api/']);
        try {
            $reqParamArray = array();
            $reqParamArray['email'] = $request['email'];
            $reqParamArray['password'] = $request['password'];
            $params[] = $reqParamArray;

            $response = $client->request('POST', 'users/login', [
                'json' => $reqParamArray
            ]);
            $response = json_decode($response->getBody(), true);
            
            $cUser = USer::find($response['userId']);
            // dd(DB::getQueryLog());
            $cUser->accessToken = $response['id'];
            Session::put('currentUser', $cUser);
            return redirect()->route('welcome');
        } catch (GuzzleException $e) {
            dd($e);
            return Redirect::back()->with('error', 'Login failed');
        }
    }

    public function logout(){
        $client = new Client(['base_uri' => 'http://54.212.34.46:3000/api/']);
        try {
            $response = $client->request('POST', 'users/logout', [
                'headers' => [
                    'X-Access-Token' => Session::get('currentUser')->accessToken
                ]
            ]);
            Session::forget('currentUser');
            return redirect()->route('welcome');
        } catch (GuzzleException $e) {
            return Redirect::back()->with('error', 'Logout failed');
        }
    }

    public function setPermission(Request $request){
        $file = $request->file('upload-file');
        $client = new Client(['base_uri' => 'http://54.212.34.46:3000/api/']);
        try {
            $response = $client->request('POST', 'wallet/import', [
                'headers' => [
                    'X-Access-Token' => Session::get('currentUser')->accessToken
                    
                ],
                'multipart' => [
                    [
                        'name'     => 'card',
                        'contents' => fopen($file->getPathname(), 'r')
                    ]
                ]
            ]);
            $response = json_decode($response->getBody(), true);
            
            return redirect()->route('profile');
        } catch (GuzzleException $e) {
            return Redirect::back()->with("error", "Kết nối thất bại");
        }
    }

    public function profile(){
        $client = new Client(['base_uri' => 'http://54.212.34.46:3000/api/']);
        try {
            $qryResponse = $client->request('GET', 'wallet', [
                'headers' => [
                    'X-Access-Token' => Session::get('currentUser')->accessToken
                ]
            ]);
            $qryResponse = json_decode($qryResponse->getBody(), true);
            $isPermissioned = true;
            if (empty($qryResponse) || !empty($qryResponse['error'])){
                $isPermissioned = false;
                $role = 'Guest';
            } else {
                $role = preg_split('/@/', $qryResponse[0]['name'])[0];
                $user = User::where('id', Session::get('currentUser')->id)->first();
                // $this.updateRole($user, $role);
                if ($user->role == Role::ROLE_GUEST){
                    if (str_contains($role, 'farmManager')){
                        User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_FARM_MANAGER));
                        Session::get('currentUser')->role = Role::ROLE_FARM_MANAGER;
                    }
                    else if (str_contains($role, 'transportationManager')){
                        User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_TRANSPORTATION_MANAGER));
                        Session::get('currentUser')->role = Role::ROLE_TRANSPORTATION_MANAGER;
                    }
                    else if (str_contains($role, 'storeManager')){
                        User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_STORE_MANAGER));
                        Session::get('currentUser')->role = Role::ROLE_STORE_MANAGER;
                    }
                    else if (str_contains($role, 'warehouseManager')){
                        User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_WAREHOUSE_MANAGER));
                        Session::get('currentUser')->role = Role::ROLE_WAREHOUSE_MANAGER;
                    }
                    else if (str_contains($role, 'farmer')){
                        User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_FARMER));
                        Session::get('currentUser')->role = Role::ROLE_FARMER;
                    }
                    else if (str_contains($role, 'transportationEmployer')){
                        User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_TRANSPORTATION_EMPLOYER));
                        Session::get('currentUser')->role = Role::ROLE_TRANSPORTATION_EMPLOYER;
                    }
                    else if (str_contains($role, 'warehouseEmployer')){
                        User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_WAREHOUSE_EMPLOYER));
                        Session::get('currentUser')->role = Role::ROLE_WAREHOUSE_EMPLOYER;
                    }
                    else if (str_contains($role, 'storeEmployer')){
                        User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_STORE_EMPLOYER));
                        Session::get('currentUser')->role = Role::ROLE_STORE_EMPLOYER;
                    }
                    else if (str_contains($role, 'manager')){
                        User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_MAIN_MANAGER));
                        Session::get('currentUser')->role = Role::ROLE_MAIN_MANAGER;
                    }
                }
            }
            $url = sprintf('users/%d', Session::get('currentUser')->id);
            $qryResponse = $client->request('GET', $url, [
                'headers' => [
                    'X-Access-Token' => Session::get('currentUser')->accessToken
                ]
            ]);
            $qryResponse = json_decode($qryResponse->getBody(), true);
            // $qryResponse = User::find(Session::get('currentUser')->id)->first();
            return view('users.current_profile', compact('isPermissioned', 'qryResponse', 'role'));
        } catch (GuzzleException $e) {
            return Redirect::back()->with("error", "Kết nối thất bại");
        }
    }

    public function otherProfile(Request $request){
        $client = new Client(['base_uri' => 'http://54.212.34.46:3000/api/']);
        try {
            $url = sprintf('users/%d', $request->id);
            $qryResponse = $client->request('GET', $url, [
                'headers' => [
                    'X-Access-Token' => Session::get('currentUser')->accessToken
                ]
            ]);
            $qryResponse = json_decode($qryResponse->getBody(), true);
            $user = new User($qryResponse);
            if (isset($user->card)) {
                $role = preg_split('/@/', $user->card->name)[0];
            } else {
                $role = 'Khách';
            }
            return view('users.user_profile', compact('user', 'role'));
        } catch (GuzzleException $e) {
            dd($e);
            return Redirect::back()->with("error", "Kết nối thất bại");
        }
    }
}
