<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;

use JsonMapper;
use Redirect;
use Session;
use App\Card;
use App\User;

class HistoryController extends Controller
{
    private $listTransaction = [];
    public function getHistory(Request $request){
        $client = new Client(['base_uri' => 'http://54.212.34.46:3000/api/']);
        try {
            $reqParamArray = array();
            $reqParamArray['productPackId'] = $request->id;
            $params[] = $reqParamArray;
            $response = $client->request('POST', 'kigen.transactions.GetHistoryTransaction', [
                    'headers' => [
                        'X-Access-Token' => Session::get('currentUser')->accessToken
                        
                    ],
                    'json' => $reqParamArray
                ]);
            $response = json_decode($response->getBody(), true);
            $url = sprintf('system/historian/%s', $response['transactionId']);
            $qryResponse = $client->request('GET', $url, [
                    'headers' => [
                        'X-Access-Token' => Session::get('currentUser')->accessToken
                    ],
                    'query' => [
                        'filter' => '{ "include":"resolve"}'
                    ]
                ]);
            $qryResponse = json_decode($qryResponse->getBody(), true);
            $results = $qryResponse['eventsEmitted'][0]['results'];
            $asyncRequestsUrl = [];
            $listProduct = [];
            for ($i = 0; $i < sizeof($results); $i++) {
                if ($i % 2 != 0) {
                    $txId = $results[$i];
                    $url = sprintf('system/historian/%s', $txId);
                    array_push($asyncRequestsUrl, $url);
                    // $qryResponse = $client->request('GET', $url, [
                    //     'headers' => [
                    //         'X-Access-Token' => Session::get('currentUser')->accessToken
                    //     ]
                    // ]);
                    // $qryResponse = json_decode($qryResponse->getBody(), true);
                    // array_push($listTransaction, $qryResponse);
                } else {
                    $result = json_decode($results[$i], true);
                    array_push($listProduct, $result);
                }
            }
            $requests = function ($asyncRequestsUrl) {            
                foreach ($asyncRequestsUrl as $asyncUrl) {
                    yield new \GuzzleHttp\Psr7\Request('GET', "{$asyncUrl}", [
                        'X-Access-Token' => Session::get('currentUser')->accessToken
                    ]);
                }
            };
            $pool = new Pool($client, $requests($asyncRequestsUrl), [
                'concurrency' => 10,
                'fulfilled' => function ($response, $index) {
                    $response = json_decode($response->getBody(), true);
                    array_push($this->listTransaction, $response);
                },
                'rejected' => function ($reason, $index) {
                },
            ]);
            
            $promise = $pool->promise(); // Initiate the transfers and create a promise
            
            $promise->wait(); // Force the pool of requests to complete.
            $listTransaction = $this->listTransaction;
            $this->listTransaction = [];
            $str = preg_split('/#/', $listProduct[0]['farmer'])[1] . "@kigen";
            return view('histories.show', compact('listTransaction', 'listProduct'));
        } catch (GuzzleException $e) {
            return redirect()->back()->with('error', 'Get history failed');
        }
    }
}
