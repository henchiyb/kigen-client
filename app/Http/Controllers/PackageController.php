<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use JsonMapper;
use Redirect;
use Session;

class PackageController extends Controller
{
    public function create(Request $request){
        $client = new Client(['base_uri' => 'http://localhost:3000/api/', 'http_errors' => false]);
        $reqParamArray = array();
        $reqParamArray['productPackId'] = 5;
        $reqParamArray['productSerial'] = $request['serial'];
        // $reqParamArray['address'] = $request['address'];
        $reqParamArray['createDate'] = $request['harvest'];
        $reqParamArray['productStatus'] = $request['status'];
        $reqParamArray['unitPrice'] = $request['unitPrice'];
        $reqParamArray['farmer'] = "kigen.participants.Farmer#farmer1";
        $params[] = $reqParamArray;
    
        $response = $client->request('POST', 'kigen.transactions.CreatePackageTransaction', [
            'json' => $reqParamArray
        ]);
        $response = json_decode($response->getBody(), true);
        // dd($response);
        if (array_key_exists('error', $response)){
            return Redirect::back()->withErrors($response['error']['details']['messages']);
        }
        return redirect()->route('welcome')->withMessages('msg', 'Tạo thành công');  
    }

    public function transfer(Request $request){
        $client = new Client(['base_uri' => 'http://localhost:3000/api/', 'http_errors' => false]);
        $reqParamArray = array();
        $reqParamArray['state'] = $request['state'];
        $reqParamArray['type'] = $request['type'];
        $reqParamArray['transferTime'] = $request['harvest'];
        $reqParamArray['product'] = $request['product'];
        $reqParamArray['newHolder'] = $request['newHolder'];
        $params[] = $reqParamArray;
    
        $response = $client->request('POST', 'kigen.transactions.TransferTransaction', [
            'json' => $reqParamArray
        ]);
        $response = json_decode($response->getBody(), true);
        dd($response);
        if (array_key_exists('error', $response)){
            return Redirect::back()->withErrors($response['error']['details']['messages']);
        }
        return redirect()->route('welcome')->withMessages('msg', 'Chuyển thành công');  
    }
}
