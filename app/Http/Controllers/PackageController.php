<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use GuzzleHttp\Client;
use JsonMapper;
use Redirect;
use Session;
use App\Card;

class PackageController extends Controller
{
    public function create(Request $request){
        $client = new Client(['base_uri' => 'http://localhost:3000/api/', 'http_errors' => false]);
        $qryResponse = $client->request('GET', 'kigen.assets.ProductPackage', [
            'headers' => [
                'X-Access-Token' => Session::get('currentUser')->accessToken
            ]
        ]);
        $qryResponse = json_decode($qryResponse->getBody(), true);
        $reqParamArray = array();
        $reqParamArray['productPackId'] = sizeof($qryResponse) + 1;
        $reqParamArray['productSerial'] = $request['serial'];
        // $reqParamArray['address'] = $request['address'];
        $reqParamArray['createDate'] = $request['harvest'];
        $reqParamArray['productStatus'] = $request['status'];
        $reqParamArray['unitPrice'] = $request['unitPrice'];
        $farmer = "kigen.participants.Farmer#" . preg_split('/@/', Card::where('userId', Session::get('currentUser')->id)->first()->name)[0];
        $reqParamArray['farmer'] = $farmer;
        $image = $request->file('upload-file');
        $extension = $image->getClientOriginalExtension();
        Storage::disk('public')->put($image->getFilename().'.'.$extension,  File::get($image));
        $reqParamArray['imgLink'] = $image->getFilename().'.'.$extension;
        $params[] = $reqParamArray;
        
        $response = $client->request('POST', 'kigen.transactions.CreatePackageTransaction', [
            'headers' => [
                'X-Access-Token' => Session::get('currentUser')->accessToken
                
            ],
            'json' => $reqParamArray
        ]);
        $response = json_decode($response->getBody(), true);
        if (array_key_exists('error', $response)){
            return Redirect::back()->withErrors($response['error']['details']['messages']);
        }
        return back()->with('success', 'Tạo thành công');
    }

    public function transfer(Request $request){
        $client = new Client(['base_uri' => 'http://localhost:3000/api/', 'http_errors' => false]);
        $reqParamArray = array();
        // $reqParamArray['state'] = $request['state'];
        $reqParamArray['type'] = $request['type'];
        $reqParamArray['transferTime'] = $request['harvest'];
        $reqParamArray['product'] = $request['product'];
        $reqParamArray['newHolder'] = $request['newHolder'];

        $image = $request->file('upload-file');
        $extension = $image->getClientOriginalExtension();
        Storage::disk('public')->put($image->getFilename().'.'.$extension,  File::get($image));
        $reqParamArray['imgLink'] = $image->getFilename().'.'.$extension;

        $params[] = $reqParamArray;
    
        $response = $client->request('POST', 'kigen.transactions.TransferTransaction', [
            'headers' => [
                'X-Access-Token' => Session::get('currentUser')->accessToken
                
            ],
            'json' => $reqParamArray
        ]);
        $response = json_decode($response->getBody(), true);
        // dd($response);
        if (array_key_exists('error', $response)){
            // dd($response);
            return Redirect::back()->withErrors($response['error']['details']['messages']);
        }
        return back()->with('success', 'Chuyển thành công');  
    }
}
