<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assumption;
use Auth;
use DataTables;
use DB;

class AssumptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getAssumptionTemplate(){
        
        $data = Assumption::get();
        return response()->json($data);
    }
}