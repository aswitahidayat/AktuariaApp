<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use App\Models\Order\OrderDtl;
use App\Models\Order\OrderAssumption;
use App\Models\Assumption;

use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Redirect,Response;

class PerhitunganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        return view('transaction.order.orderIndex');
    }
}