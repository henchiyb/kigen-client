<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Farm;

class FarmController extends Controller
{
    public function show(Request $request){
        $farm = Farm::find($request->id);
        return view('farms.show', compact('farm'));
    }
}
