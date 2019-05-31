<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AjaxController extends Controller {
   public function scanQrCode(Request $request) {
      $response = $request->input('datacontent');
      $msg = json_decode($response, true);
      return response()->json(array('msg'=> $msg));
   }
}