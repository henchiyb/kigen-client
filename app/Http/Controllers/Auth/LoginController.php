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
class LoginController extends Controller
{
    protected $redirectTo = '/';
    public function login(Request $request){
        $client = new Client(['base_uri' => 'http://localhost:3000/api/', 'http_errors' => false]);
        $reqParamArray = array();
        $reqParamArray['email'] = $request['email'];
        $reqParamArray['password'] = $request['password'];
        $params[] = $reqParamArray;

        $response = $client->request('POST', 'users/login', [
            'json' => $reqParamArray
        ]);
        $response = json_decode($response->getBody(), true);
        if (array_key_exists('error', $response)){
            return Redirect::back()->withErrors($response['error']['message']);
        }

        $url = sprintf('users/%d', $response["userId"]);
        $qryResponse = $client->request('GET', $url, [
            'headers' => [
                'X-Access-Token' => $response['id']
            ]
        ]);
        $qryResponse = json_decode($qryResponse->getBody(), true);
        // dd($qryResponse);
        $cUser = new User();
        $cUser->id = $response["userId"];
        $cUser->name = $qryResponse['username'];
        $cUser->email = $qryResponse['email'];
        $cUser->accessToken = $response['id'];
        Session::put('currentUser', $cUser);
        return redirect()->route('welcome');     
    }

    public function logout(){
        $client = new Client(['base_uri' => 'http://localhost:3000/api/']);
        try {
            $response = $client->request('POST', 'users/logout', [
                'headers' => [
                    'X-Access-Token' => Session::get('currentUser')->accessToken
                ]
            ]);
            Session::forget('currentUser');
            return redirect()->route('welcome');
        } catch (GuzzleException $e) {
            return Redirect::back();
        }
    }

    public function setPermission(Request $request){
        $file = $request->file('upload-file');
        $client = new Client(['base_uri' => 'http://localhost:3000/api/']);
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
            return redirect()->route('profile');
        } catch (GuzzleException $e) {
            return Redirect::back()->withErrors("message", "Kết nối thất bại");
        }
    }

    public function profile(){
        $client = new Client(['base_uri' => 'http://localhost:3000/api/', 'http_errors' => false]);
        // try {
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
            }
            $url = sprintf('users/%d', Session::get('currentUser')->id);
            $qryResponse = $client->request('GET', $url, [
                'headers' => [
                    'X-Access-Token' => Session::get('currentUser')->accessToken
                ]
            ]);
            $qryResponse = json_decode($qryResponse->getBody(), true);
            return view('users.current_profile', compact('isPermissioned', 'qryResponse', 'role'));
        // } catch (GuzzleException $e) {
        //     return Redirect::back()->withErrors("message", "Kết nối thất bại");
        // }
    }

    public function otherProfile(Request $request){
        $user = User::find($request->id);
        // dd($user);
        return view('users.user_profile', compact('user'));
    }
}
