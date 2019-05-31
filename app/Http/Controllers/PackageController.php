<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use GuzzleHttp\Client;
use JsonMapper;
use Redirect;
use Session;
use App\Card;
use App\Product;
use DB;
use QrCode;

class PackageController extends Controller
{
    public function create(Request $request){
        $client = new Client(['base_uri' => 'http://54.212.34.46:3000/api/']);
        try {
            $qryResponse = $client->request('GET', 'kigen.assets.ProductPackage', [
                'headers' => [
                    'X-Access-Token' => Session::get('currentUser')->accessToken
                ]
            ]);
            $qryResponse = json_decode($qryResponse->getBody(), true);
            $reqParamArray = array();
            $reqParamArray['$class'] = 'kigen.transactions.CreatePackageTransaction';
            $reqParamArray['productPackId'] = sizeof($qryResponse) + 1;
            $reqParamArray['productSerial'] = $request['name'];
            $reqParamArray['packageHash'] = Crypt::encrypt("{$request['name']}" . "{Session::get('currentUser')->identityNumber}");
            $reqParamArray['createDate'] = $request['harvest'];
            $reqParamArray['productStatus'] = $request['status'];
            $reqParamArray['farmId'] = $request['farmId'];
            $reqParamArray['numberOfProducts'] = $request['numberOf'];
            $reqParamArray['unitPrice'] = $request['unitPrice'];
            $farmer = "kigen.participants.Farmer#" . preg_split('/@/', Card::where('userId', Session::get('currentUser')->id)->first()->name)[0];
            $reqParamArray['farmer'] = $farmer;
            $image = $request->file('upload-file');
            $extension = $image->getClientOriginalExtension();
            Storage::disk('public')->put($image->getFilename().'.'.$extension, File::get($image));
            $reqParamArray['imgLink'] = $image->getFilename().'.'.$extension;
            $params[] = $reqParamArray;
            
            $response = $client->request('POST', 'kigen.transactions.CreatePackageTransaction', [
            'headers' => [
                'X-Access-Token' => Session::get('currentUser')->accessToken
                
            ],
            'json' => $reqParamArray
        ]);
            $response = json_decode($response->getBody(), true);
            return back()->with('success', 'Tạo thành công');
        } catch (GuzzleException $e) {
            return redirect()->back()->with('error', 'Create failed');
        }
    }

    public function transfer(Request $request){
        $client = new Client(['base_uri' => 'http://54.212.34.46:3000/api/']);
        try {
            $reqParamArray = array();
            // $reqParamArray['state'] = $request['state'];
            $reqParamArray['type'] = $request['type'];
            $reqParamArray['transferTime'] = $request['harvest'];
            $reqParamArray['product'] = $request['product'];
            $reqParamArray['newHolder'] = $request['newHolder'];

            $image = $request->file('upload-file');
            $extension = $image->getClientOriginalExtension();
            Storage::disk('public')->put($image->getFilename().'.'.$extension, File::get($image));
            $reqParamArray['imgLink'] = $image->getFilename().'.'.$extension;

            $params[] = $reqParamArray;
    
            $response = $client->request('POST', 'kigen.transactions.TransferTransaction', [
            'headers' => [
                'X-Access-Token' => Session::get('currentUser')->accessToken
                
            ],
            'json' => $reqParamArray
        ]);
            $response = json_decode($response->getBody(), true);
            return back()->with('success1', QrCode::format('png')->size(100)->generate(Request::url()));
        } catch (GuzzleException $e){
            return redirect()->back()->with('error', 'Transfer failed');
        }
    }

    public function dataCreateAjax(Request $request)
    {
        $data = [];
        if ($request->id == 'farm'){
            if($request->has('q')){
                $search = $request->q;
                $data = DB::table("farms")
                        ->select("id","name")
                        ->where('name','LIKE',"%$search%")
                        ->get();
            }
        } else {
            if($request->has('q')){
                $search = $request->q;
                $data = DB::table("products")
                        ->select("id","name")
                        ->where('name','LIKE',"%$search%")
                        ->get();
            }
        }
        
        return response()->json($data);
    }

    public function getHoldingProduct(){
        $client = new Client(['base_uri' => 'http://54.212.34.46:3000/api/']);
        try {
            $role = preg_split('/@/', Session::get('currentUser')->card->name)[0];
            if (str_contains($role, 'transportationEmployer')) {
                $rsName = "resource:kigen.participants.TransportationEmployer#" . $role;
            } elseif (str_contains($role, 'farmer')) {
                $rsName = "resource:kigen.participants.Farmer#" . $role;
            } elseif (str_contains($role, 'storeEmployer')) {
                $rsName = "resource:kigen.participants.StoreEmployer#" . $role;
            } elseif (str_contains($role, 'warehouseEmployer')) {
                $rsName = "resource:kigen.participants.WarehouseEmployer#" . $role;
            } elseif (str_contains($role, 'transportationEmployer')) {
            }
            $query = sprintf('{ "where": {"productHolder": "%s" } }', $rsName);

            $listProductPackage = $client->request('GET', 'kigen.assets.ProductPackage', [
            'headers' => [
                'X-Access-Token' => Session::get('currentUser')->accessToken
            ],
            'query' => [
                'filter' => $query
            ]
        ]);
            $listProductPackage = json_decode($listProductPackage->getBody(), true);
            $listProducts = [];
            foreach ($listProductPackage as $package) {
                array_push($listProducts, Product::find($package['productSerial']));
            }
            return view('products.show-holding', compact('listProductPackage', 'listProducts'));
            //TODO
        } catch (GuzzleException $e) {
            return redirect()->back()->with('error', 'Show failed');
        }
    }
}
