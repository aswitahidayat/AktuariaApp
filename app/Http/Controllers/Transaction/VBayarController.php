<?php
namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;

use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;

class VBayarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('transaction.vbayar.vbayarIndex', compact('datas'));
    }

    public function search(Request $request)
    {
        if($request->ajax())
        {
            $b['data']= $this->vbList($request, 'pagging');
            $b['recordsFiltered']= $this->vbList($request, 'count');
            $b['recordsTotal']= $this->vbList($request, 'count');
            return $b;
        }
    }

    public function edit($ordhdr_id)
    {
        $data = $this->orderList(new Request,'edit', $ordhdr_id);
        return response()->json($data);
    }

    public function vbList(Request $request, $reqType ='', $param = ''){
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
                $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ordhdr_id.'" data-original-title="Comfirm" onclick="verifrder('.$row->ordhdr_id.')" class="assumption btn btn-primary btn-sm comfirmOrder">Verifikasi</a>';
    
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

    public function verificationOrder(Request $request)
    {
        $exception = DB::transaction(function() use ($request) {
            Order::
                where('ordhdr_id', $request->id)
                ->update(['ordhdr_pay_status' => 'P',]);
    
        });
        return is_null($exception) ? response()->json(['success'=>'Order Verification successfully.']) : $exception;
    }
}
