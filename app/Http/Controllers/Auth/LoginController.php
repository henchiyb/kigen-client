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

class LoginController extends Controller
{
    protected $redirectTo = '/';
    public function login(Request $request){
        $client = new Client(['base_uri' => 'http://18.236.74.178:3000/api/']);
        try {
            $reqParamArray = array();
            $reqParamArray['email'] = $request['email'];
            $reqParamArray['password'] = $request['password'];
            $params[] = $reqParamArray;

            $response = $client->request('POST', 'users/login', [
                'json' => $reqParamArray
            ]);
            $response = json_decode($response->getBody(), true);
            // if (array_key_exists('error', $response)){
            //     return Redirect::back()->withErrors($response['error']['message']);
            // }

            $url = sprintf('users/%d', $response["userId"]);
            $qryResponse = $client->request('GET', $url, [
                'headers' => [
                    'X-Access-Token' => $response['id']
                ]
            ]);
            $qryResponse = json_decode($qryResponse->getBody(), true);
            $cUser = User::find($response["userId"]);
            $cUser->accessToken = $response['id'];
            Session::put('currentUser', $cUser);
            if ($cUser->role == null && $cUser->card != null){
                $role = preg_split('/@/', $cUser->card->name)[0];
                if (str_contains($role, 'farmManager')){
                    User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_FARM_MANAGER));
                }
                else if (str_contains($role, 'transportationManager')){
                    User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_TRANSPORTATION_MANAGER));
                }
                else if (str_contains($role, 'storeManager')){
                    User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_STORE_MANAGER));
                }
                else if (str_contains($role, 'farmer')){
                    User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_FARMER));
                }
                else if (str_contains($role, 'transportationEmployer')){
                    User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_TRANSPORTATION_EMPLOYER));
                }
                else if (str_contains($role, 'storeEmployer')){
                    User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_STORE_EMPLOYER));
                }
            }
            return redirect()->route('welcome');
        } catch (GuzzleException $e) {
            return Redirect::back()->with('error', 'Login failed');
        }
    }

    public function logout(){
        $client = new Client(['base_uri' => 'http://18.236.74.178:3000/api/']);
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
        $client = new Client(['base_uri' => 'http://18.236.74.178:3000/api/']);
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
        $client = new Client(['base_uri' => 'http://18.236.74.178:3000/api/']);
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
                $role = 'Chưa có';
            } else {
                $role = preg_split('/@/', $qryResponse[0]['name'])[0];
                $user = User::where('id', Session::get('currentUser')->id)->first();
                // $this.updateRole($user, $role);
                if ($user->role == null){
                    if (str_contains($role, 'farmManager')){
                        User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_FARM_MANAGER));
                    }
                    else if (str_contains($role, 'transportationManager')){
                        User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_TRANSPORTATION_MANAGER));
                    }
                    else if (str_contains($role, 'storeManager')){
                        User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_STORE_MANAGER));
                    }
                    else if (str_contains($role, 'farmer')){
                        User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_FARMER));
                    }
                    else if (str_contains($role, 'transportationEmployer')){
                        User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_TRANSPORTATION_EMPLOYER));
                    }
                    else if (str_contains($role, 'storeEmployer')){
                        User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_STORE_EMPLOYER));
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
            return view('users.current_profile', compact('isPermissioned', 'qryResponse', 'role'));
        } catch (GuzzleException $e) {
            return Redirect::back()->with("error", "Kết nối thất bại");
        }
    }

    public function otherProfile(Request $request){
        $user = User::find($request->id);
        if (isset($user->card)){
            $role = preg_split('/@/', $user->card->name)[0];
        } else {
            $role = 'Khách';
        }
        // dd($user);
        return view('users.user_profile', compact('user', 'role'));
    }

    private function updateRole($user, $role){
        if ($user->role == null){
            if (str_contains($role, 'farmManager')){
                User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_FARM_MANAGER));
            }
            else if (str_contains($role, 'transportationManager')){
                User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_TRANSPORTATION_MANAGER));
            }
            else if (str_contains($role, 'storeManager')){
                User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_STORE_MANAGER));
            }
            else if (str_contains($role, 'farmer')){
                User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_FARMER));
            }
            else if (str_contains($role, 'transportationEmployer')){
                User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_TRANSPORTATION_EMPLOYER));
            }
            else if (str_contains($role, 'storeEmployer')){
                User::where('id', Session::get('currentUser')->id)->update(array('role' => Role::ROLE_STORE_EMPLOYER));
            }
        }
    
    }
}
