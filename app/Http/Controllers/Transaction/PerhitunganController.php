<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use App\Models\Order\OrderDtl;
use App\Models\Order\OrderAssumption;
use App\Models\Assumption;
// use App\Jobs\Hitung;

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

    public function orderList(Request $request, $reqType ='', $param = ''){
        $query = Order::
            leftJoin('kka_dab.mst_order_program AS prog', 'ordhdr_program', '=', 'prog.ordprg_id')
            ->leftJoin('kka_dab.mst_order_service_hdr AS serv', 'ordhdr_service_hdr', '=', 'serv.ordsrvhdr_id')
            ->leftJoin('kka_dab.mst_order_service_dtl AS sdtl', 'ordhdr_service_dtl', '=', 'sdtl.ordsrvdtl_id')
            
            ->select('*',
                DB::raw("(select count(*) from kka_dab.trn_order_assumption AS b
                    where b.ordass_hdrid = ordhdr_id and b.ordass_code = 'TMO'
                    and b.ordass_value <> 0) as ass_status")
            );

        if($request->name != ''){
            $query->where('ordhdr_ordnum', 'LIKE',"%$request->name%");
        }

        if($reqType == 'pagging'){
            $query->orderBy('ordhdr_id');
            if($request->start != ''){
                $length = $request->length != '' ? $request->length : 10;
                $query->skip($request->start)->take($length)->get();
            }
            $pag = $query->get();
            foreach ($pag as $key =>$row) {
                $btn = '';
                if($row->ordhdr_pay_status == 'N'){
                    $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ordhdr_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editOrder">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ordhdr_id.'" data-original-title="Assumption" class="assumption btn btn-primary btn-sm assumptionOrder">Assumption</a>';
                    if($row->ass_status > 0){
                        $btn .= " <a href='javascript:void(0)'  onclick='hitungOrder(\"$row->ordhdr_id\", \"$row->ordhdr_ordnum\")' class='assumption btn btn-primary btn-sm'>Hitung</a>";    
                    }
                } 
                if ($row->ordhdr_pay_status == 'C'){
                    $btn .= "<a href='javascript:void(0)' onclick='viewOrder(\"$row->ordhdr_id\")' class='edit btn btn-primary btn-sm'>View</a> ";
                    $btn .= "<a href='halaman?hitung=$row->ordhdr_ordnum' target='_blank' class='edit btn btn-primary btn-sm'>Halaman</a> ";
                    $btn .= ' <span data-toggle="tooltip" data-id="'.$row->ordhdr_id.'" data-original-title="Assumption" class="assumption btn btn-primary btn-sm assumptionView">Assumption</span>';
                }
                if ($row->ordhdr_pay_status == 'P'){
                    $btn .= "<a href='javascript:void(0)' onclick='viewOrder(\"$row->ordhdr_id\")' class='edit btn btn-primary btn-sm'>View</a> ";
                    $btn .= "<a href='halaman?hitung=$row->ordhdr_ordnum' target='_blank' class='edit btn btn-primary btn-sm'>Halaman</a> ";
                    $btn .= ' <span data-toggle="tooltip" data-id="'.$row->ordhdr_id.'" data-original-title="Assumption" class="assumption btn btn-primary btn-sm assumptionView">Assumption</span>';
                }

                if ($row->ordhdr_pay_status == 'W'){
                    $btn .= "Loading";
                }
                $pag[$key]->DT_RowIndex = ($key+ 1)+$request->start;
                $pag[$key]->statusName = 'Active';
                $pag[$key]->action = $btn;
                $pag[$key]->paymentStatusName = Order::getStatus($row->ordhdr_pay_status);
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

    // TODO Background Process
    function hitungOrder(Request $request){
        $user_id = Auth::user()->user_id;
        $allUsersCount=DB::select(" select * from kka_dab.order_calc($request->orderid, '$request->ordernum', $user_id)");
        
        Order::
        where('ordhdr_id', $request->orderid)
        ->update(['ordhdr_pay_status' => 'C',]);
        
        
        // Hitung::dispatch($request->all());
       
        return response()->json(['success'=>'Order saved successfully.']);
    }

    function getKaryawan(Request $request)
    {
        $query = Order::
        leftJoin('kka_dab.trn_order_dtl AS dtl', 'ordhdr_id', '=', 'dtl.orddtl_hdrid');
        $query->where('orddtl_hdrid', "$request->ordhdr_id");
        $data = $query->get();
        return response()->json($data);
        
    }

    function getTahun(Request $request)
    {
        $query = DB::table('kka_dab.trn_order_assumption')
        ->select('ordass_periode')
        ->where('ordass_hdrid', "$request->ordhdr_id")->groupBy('ordass_periode');
        $data = $query->get();
        return response()->json($data);
        
    }

    function cariHasil(Request $request){
        $query = DB::table('kka_dab.trn_order_calc_hdr')
        
        ->leftJoin('kka_dab.trn_order_dtl AS dtl', 'ordchdr_orddtlid', '=', 'dtl.orddtl_id');
        if($request->ordchdr_orddtlid != ''){
            $query->where('ordchdr_orddtlid', "$request->ordchdr_orddtlid");
        }

        if($request->ordchdr_periode != ''){
            $query->where('ordchdr_periode', "$request->ordchdr_periode");
        }

        $query->where('orddtl_hdrid', "$request->orddtl_hdrid");
        $data = $query->get();
        return response()->json($data);   
    }

    function cariHasilDtl(Request $request){
        $query = DB::table('kka_dab.trn_order_calc_dtl')
            ->where('ordcdtl_ordchdrid', "$request->ordcdtl_ordchdrid");
        $data = $query->get();
        return response()->json($data);   
    }

}