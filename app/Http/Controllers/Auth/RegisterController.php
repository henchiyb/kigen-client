<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use GuzzleHttp\Client;
use JsonMapper;
Use Redirect;

class RegisterController extends Controller
{
    protected $redirectTo = '/';

    public function register(Request $request){
        $client = new Client(['base_uri' => 'http://18.236.74.178:3000/api/', 'http_errors' => false]);
        // try { 18.236.74.178:3000
            $reqParamArray = array();
            $reqParamArray['email'] = $request['email'];
            $reqParamArray['username'] = $request['username'];
            $reqParamArray['realname'] = $request['realname'];
            $reqParamArray['password'] = $request['password'];
            $reqParamArray['address'] = $request['address'];
            $reqParamArray['birthday'] = $request['birthday'];
            $reqParamArray['phone'] = $request['phone'];
            $image = $request->file('upload-file');
            $extension = $image->getClientOriginalExtension();
            Storage::disk('public')->put($image->getFilename().'.'.$extension, File::get($image));
            $reqParamArray['img_link'] = $image->getFilename().'.'.$extension;

            $params[] = $reqParamArray;
        
            $response = $client->request('POST', 'users', [
                'json' => $reqParamArray
            ]);
            $response = json_decode($response->getBody(), true);
            dd($response);

            if (array_key_exists('error', $response)) {
                return Redirect::back()->withErrors($response['error']['details']['messages']);
            }
            return view('form_login');
        // } catch (GuzzleException $e){
        //     dd($e);
        //     return redirect()->back()->with('error', 'Register failed');    
        // }
    }
}
