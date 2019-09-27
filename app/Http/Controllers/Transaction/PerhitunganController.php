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
use Helper;

class PerhitunganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        return view('transaction.perhitungan.perhitunganIndex');
    }

    public function search(Request $request)
    {
        if($request->ajax())
        {
            $b['data']= $this->orderList($request, 'pagging');
            $b['recordsFiltered']= $this->orderList($request, 'count');
            $b['recordsTotal']= $this->orderList($request, 'count');
            return $b;
        }
    }

    // TODO status payment + button
    public function orderList(Request $request, $reqType ='', $param = ''){
        $query = Order::
            leftJoin('kka_dab.mst_order_program AS prog', 'ordhdr_program', '=', 'prog.ordprg_id')
            ->leftJoin('kka_dab.mst_order_service_hdr AS serv', 'ordhdr_service_hdr', '=', 'serv.ordsrvhdr_id')
            ->leftJoin('kka_dab.mst_order_service_dtl AS sdtl', 'ordhdr_service_dtl', '=', 'sdtl.ordsrvdtl_id');


        if($reqType == 'pagging'){
            if($request->start != ''){
                $length = $request->length != '' ? $request->length : 10;
                $query->skip($request->start)->take($length)->get();
            }
            $pag = $query->get();
            foreach ($pag as $key =>$row) {
                $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ordhdr_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editOrder">Edit</a>';
                $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ordhdr_id.'" data-original-title="Assumption" class="assumption btn btn-primary btn-sm assumptionOrder">Assumption</a>';
    
                $pag[$key]->DT_RowIndex = ($key+ 1)+$request->start;
                $pag[$key]->statusName = 'Active';
                $pag[$key]->action = $btn;
            }
            return $pag;
        } else if ($reqType == 'get'){
            return $query->get();
        } else if ($reqType == 'count'){
            return $query->count();
        } else if ($reqType == 'edit'){
            return $query->where('ordhdr_id', $param)->first();
        }
        
    }
}