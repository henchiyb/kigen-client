<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use JsonMapper;
use Redirect;
use Session;

class HistoryController extends Controller
{
    public function getHistory(Request $request){
        $client = new Client(['base_uri' => 'http://localhost:3000/api/', 
            'http_errors' => false]);
            $listPackageHistory = [];
            $productUrl = sprintf("kigen.assets.ProductPackage/%d", $request->id);
            $productResponse = $client->request('GET', $productUrl, [
                'headers' => [
                    'X-Access-Token' => Session::get('currentUser')->accessToken
                ]
            ]);
            $farmer = $client->request('GET', 'users', [
                'headers' => [
                    'X-Access-Token' => Session::get('currentUser')->accessToken
                ],
                'filter' => []
            ]);
            $qryResponse = $client->request('GET', 'system/historian', [
                'headers' => [
                    'X-Access-Token' => Session::get('currentUser')->accessToken
                ]
            ]);
            $productResponse = json_decode($productResponse->getBody(), true);
            $qryResponse = json_decode($qryResponse->getBody(), true);
            if (!empty($productResponse['error'])){
                return view('welcome')->withErrors("message", "Sản phẩm không tồn tại");
            //     return redirect()->back()->withErrors("Sản phẩm không tồn tại");
            }
            foreach ($qryResponse as $history){
                if(!empty($history["eventsEmitted"])){
                    if ($history["eventsEmitted"][0]["productPackId"] 
                        == $request->id){
                        array_unshift($listPackageHistory, $history);
                    }
                }
            }
            // dd($qryResponse);
            return view('histories.show', compact('listPackageHistory', 'productResponse'));
    }
}
