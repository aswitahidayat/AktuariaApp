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

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('transaction.order.orderIndex');
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

    public function searchVerify(Request $request)
    {
        if($request->ajax())
        {
            $b['data']= $this->orderList($request, 'pagging', 'varify');
            $b['recordsFiltered']= $this->orderList($request, 'count');
            $b['recordsTotal']= $this->orderList($request, 'count');
            return $b;
        }
    }

    public function store(Request $request)
    {
        $exception = DB::transaction(function() use ($request) {
            if($request->ordhdr_id == ''){
                // var_dump(sizeof($request->detail));
                // exit();
                $orderNum = $this->orderNum();
                $q = Order::create([
                    'ordhdr_ordnum' => $orderNum,
                    'ordhdr_program' => $request->ordhdr_program,
                    'ordhdr_service_hdr' => $request->ordhdr_service_hdr,
                    'ordhdr_service_dtl' => $request->ordhdr_service_dtl,
                    'ordhdr_period_count' => $request->ordhdr_period_count,
                    'ordhdr_period_lastyear' => $request->ordhdr_period_lastyear,

                    'ordhdr_work_age_min' => $request->ordhdr_work_age_min,
                    'ordhdr_pension_age' => $request->ordhdr_pension_age,
                    'ordhdr_sal_increase' => $request->ordhdr_sal_increase,
                    
                    'ordhdr_date' => $request->ordhdr_date,
                    'ordhdr_val_date' => $request->ordhdr_val_date,
                    'ordhdr_amount' => $request->ordhdr_amount,
        
                    'ordhdr_pay_status' => 'N',
                    'ordhdr_by' => Auth::user()->user_id,
                    'ordhdr_created_by' => Auth::user()->user_id,
                    'ordhdr_bizpartid' => $request->ordhdr_bizpartid,

                    'ordhdr_created_date' => date(now()),
                ]);

                $this->setOrderDetail($request->detail, $q->ordhdr_id, $q->ordhdr_ordnum);
                $this->setAssumption($q->ordhdr_id, $q->ordhdr_ordnum, $q->ordhdr_period_count, $q->ordhdr_period_lastyear);
            }else{
                Order::
                    where('ordhdr_id', $request->ordhdr_id)
                    ->update([
                        'ordhdr_amount' => $request->ordhdr_amount,
                        'ordhdr_pay_amt' => $request->ordhdr_amount,
                        'ordhdr_program' => $request->ordhdr_program,
                        'ordhdr_service_hdr' => $request->ordhdr_service_hdr,
                        'ordhdr_service_dtl' => $request->ordhdr_service_dtl,
                        'ordhdr_period_count' => $request->ordhdr_period_count,
                        'ordhdr_period_lastyear' => $request->ordhdr_period_lastyear,
                        'ordhdr_pension_age' => $request->ordhdr_pension_age,
                        'ordhdr_date' => $request->ordhdr_date,
                        'ordhdr_amount' => $request->ordhdr_amount,
                        'ordhdr_work_age_min' => $request->ordhdr_work_age_min,
                        'ordhdr_val_date' => $request->ordhdr_val_date,
                        ]);

                // $this->setOrderDetail($request->detail, $request->ordhdr_id, $q->ordhdr_ordnum);
            }
        });

        return is_null($exception) ? response()->json(['success'=>'Order saved successfully.']) : $exception;

    }

    public function edit($ordhdr_id)
    {
        $data = $this->orderList(new Request,'edit', $ordhdr_id);
        return response()->json($data);
    }

    public function setOrderDetail($detail, $id, $num){
        // $answers = [];
        foreach ($detail as $key =>$value) {
            $cd = OrderDtl::insert([
            // $answers[] = [
                'orddtl_hdrid' => $id,
                'orddtl_ordnum' => $num,
                'orddtl_npk' => !empty($value['NPK'])?$value['NPK']:'',
                'orddtl_name' => !empty($value['Name'])?$value['Name']:'',
                'orddtl_sex' => !empty($value['Gender'])?$value['Gender']:'',
                'orddtl_birthdate' => !empty($value['Birthdate'])?$value['Birthdate']:'',
                'orddtl_ktp_num' => !empty($value['KTP'])?$value['KTP']:'',
                'orddtl_npwp_num' => !empty($value['NPWP'])?$value['NPWP']:'',
                'orddtl_addr' => !empty($value['Address'])?$value['Address']:'',
                'orddtl_hp' => !empty($value['HP'])?$value['HP']:'',
                'orddtl_startdate' => !empty($value['Startdate'])?$value['Startdate']:'',
                'orddtl_curr_sal' => !empty($value['Salery'])?$value['Salery']:0,

                'orddtl_created_by' => 1,
                'orddtl_created_date' => date(now()),
            ]);
            // ];
        }

        // $answers = collect($answers); 

        // $chunks = $answers->chunk(50);

        // foreach ($chunks as $chunk)
        // {
        // // \DB::table('items_details')->insert($chunk->toArray());
        // OrderDtl::insert($chunk->toArray());
        // }

        // OrderDtl::insert($answers);
    }

    public function orderNum():?string 
    {
        $year= date("Y");
        $count = 1;
        $q = Order::where('ordhdr_ordnum', 'LIKE', "%$year%")
        ->orderBy('ordhdr_id', 'desc')->first();
        if(isset($q->ordhdr_ordnum)){
            $var2 = str_replace($year.'ORD',"",$q->ordhdr_ordnum);
            $count = str_pad( $var2+1, 5, "0", STR_PAD_LEFT );
        }

        return $year.'ORD'.$count;
    }

    public function setAssumption($id= 0, $numm=0, $count =0, $year = 0){
        for ($x = $year; $x > ($year - $count); $x--) {
            $ass = Assumption::get();
            foreach ($ass as $key => $value){
                OrderAssumption::create([
                    'ordass_hdrid' => $id,
                    'ordass_ordnum' => $numm,
                    'ordass_periode' => $x,
                    'ordass_sp' => 'S',
                    'ordass_code' => $value['assump_templ_code'],
                    'ordass_value' => 0,
                    'ordass_created_by' => Auth::user()->user_id,
                    'ordass_created_date' => date(now()),
                ]);
            }

        }

    }

    public function comfirmOrder(Request $request)
    {
        $exception = DB::transaction(function() use ($request) {
            Order::
            where('ordhdr_id', $request->id)
            ->update(['ordhdr_pay_status' => 'C',]);
            Helper::upload($request->file, 'order_upload', $request->num.'.jpg');
    
        });
        return is_null($exception) ? response()->json(['success'=>'Order comfirm successfully.']) : $exception;
    }

    public function orderList(Request $request, $reqType ='', $param = ''){
        $query = Order::
            leftJoin('kka_dab.mst_order_program AS prog', 'ordhdr_program', '=', 'prog.ordprg_id')
            ->leftJoin('kka_dab.mst_order_service_hdr AS serv', 'ordhdr_service_hdr', '=', 'serv.ordsrvhdr_id')
            ->leftJoin('kka_dab.mst_order_service_dtl AS sdtl', 'ordhdr_service_dtl', '=', 'sdtl.ordsrvdtl_id');
            
        if($request->name != ''){
            $query->where('ordhdr_ordnum', 'LIKE',"%$request->name%");
        }

        if($param == 'varify'){
            $query->where('ordhdr_pay_status', 'N');
        }

        if($reqType == 'pagging'){
            if($request->start != ''){
                $length = $request->length != '' ? $request->length : 10;
                $query->skip($request->start)->take($length)->get();
            }
            $pag = $query->get();
            foreach ($pag as $key =>$row) {
                $pag[$key]->DT_RowIndex = ($key+ 1 + $request->start)+$request->start;
                $pag[$key]->statusName = 'Active';
                $pag[$key]->action = $this->setActionButton($row, $param);
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

    function setActionButton($row, $param){
        $btn ='';
        
        if($row->ordhdr_pay_status == 'P'){
            $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"   class="edit btn btn-primary btn-sm editOrder">Lembar</a>';
            $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  class="edit btn btn-primary btn-sm editOrder">Buku</a>';
        }

        // $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ordhdr_id.'" data-original-title="Assumption" class="assumption btn btn-primary btn-sm assumptionOrder">Assumption</a>';
        if($row->ordhdr_pay_status == 'N'){
            $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ordhdr_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editOrder">Edit</a>';
            $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ordhdr_id.'" data-original-title="Comfirm" onclick="comfirmOrder('.$row->ordhdr_id.')" class="assumption btn btn-primary btn-sm comfirmOrder">Comfirm</a>';
        }

        if($row->ordhdr_pay_status == 'C'){
            // $btn .= "<a href='javascript:void(0)' onclick='viewOrder(\"$row->ordhdr_id\")'  class='edit btn btn-primary btn-sm'>View</a>";
            $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ordhdr_id.'" data-original-title="Comfirm" onclick="viewComfirm('.$row->ordhdr_id.')" class="assumption btn btn-primary btn-sm comfirmOrder">View</a>';

        }

        if($param == 'varify'){
            $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ordhdr_id.'" data-original-title="Comfirm" onclick="verifrder('.$row->ordhdr_id.')" class="assumption btn btn-primary btn-sm comfirmOrder">Verifikasi</a>';
        }

        return $btn;
    }

    public function getOrderDetail(Request $request){
        $data = OrderDtl::where('orddtl_hdrid', $request->ordhdr_id)
        ->get(array(
            'orddtl_npk as NPK',
            'orddtl_name as Name',
            'orddtl_sex as Gender',
            'orddtl_birthdate as Birthdate',
            'orddtl_ktp_num as KTP',
            'orddtl_npwp_num as NPWP',
            'orddtl_addr as Address',
            'orddtl_hp as HP',
            'orddtl_startdate as Startdate',
            'orddtl_curr_sal as Salery',
        ));
        return response()->json($data);
    }
}
