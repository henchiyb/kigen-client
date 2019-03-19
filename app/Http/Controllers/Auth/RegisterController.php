<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\ClientErrorResponseException;
use GuzzleHttp\Client;
use JsonMapper;
Use Redirect;

class RegisterController extends Controller
{
    protected $redirectTo = '/';

    public function register(Request $request){
        $client = new Client(['base_uri' => 'http://localhost:3000/api/', 'http_errors' => false]);
        $reqParamArray = array();
        $reqParamArray['email'] = $request['email'];
        $reqParamArray['username'] = $request['username'];
        $reqParamArray['password'] = $request['password'];
        $reqParamArray['address'] = $request['address'];
        $reqParamArray['birthday'] = $request['birthday'];
        $reqParamArray['phone'] = $request['phone'];
        $reqParamArray['img_link'] = $request['img_link'];

        $params[] = $reqParamArray;
    
        $response = $client->request('POST', 'users', [
            'json' => $reqParamArray
        ]);
        $response = json_decode($response->getBody(), true);
        if (array_key_exists('error', $response)){
            return Redirect::back()->withErrors($response['error']['details']['messages']);
        }
        return redirect()->route('login');     
    }
}
