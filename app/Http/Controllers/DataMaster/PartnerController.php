<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;

class PartnerController extends Controller
{
    public function search(Request $request){
        $data = Partner::getPartner($request);
        return response()->json($data);
    }
}