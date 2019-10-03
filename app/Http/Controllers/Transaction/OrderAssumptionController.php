<?php
/**
 * Created by PhpStorm.
 * User: Shandy
 * Date: 4/22/2019
 * Time: 7:30 PM
 */

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AssumptionController;
use App\Models\Order\Order;
use App\Models\Order\OrderDtl;
use App\Models\Order\OrderAssumption;
use App\Models\Order\OrderProgressive;
use App\Models\Assumption;

use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Redirect,Response;

class OrderAssumptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function getAssumption(Request $request){
        $qry = Order::query()
            // ->leftJoin('kka_dab.trn_order_dtl AS dtl', 'ordhdr_id', '=', 'dtl.orddtl_hdrid')
            ->leftJoin('kka_dab.trn_order_assumption AS ass', 'ordhdr_id', '=', 'ass.ordass_hdrid')
            ->leftJoin('kka_dab.mst_assumption_template AS ast', 'ordass_code', '=', 'ast.assump_templ_code')

            ->where('ordhdr_id', $request->ordhdr_id)
            ->orderBy('ass.ordass_id')
            ;
        $array =  $qry->get();
        $count = count($array);
        
        if($count > 1){ 
            $data = (object) [
                'assumtionData' => $array,
                'periodCount' =>  isset($array[0]->ordhdr_period_count) ? $array[0]->ordhdr_period_count : 2,
            ];
            
        } else{
            $data = (object) [
                'assumtionData' => Assumption::get(),
                'periodCount' =>  isset($array[0]->ordhdr_period_count) ? $array[0]->ordhdr_period_count : 2,
            ];
        }
        
        return response()->json($data);
    }

    public function setAssumption(Request $request){
        $exception = DB::transaction(function() use ($request) {
            foreach ($request->dataAssumption as $key =>$ass) {
                OrderAssumption::
                    where('ordass_id', $ass['ordass_id'])
                    ->update(['ordass_value' => $ass['ordass_value']]);
            }
        });
    }
    
    public function getProgressive(Request $request){
        $data = OrderProgressive::query()

                    ->where('ordpro_assid', $request->ordpro_assid)
                    ->get();
        return response()->json($data);
    }

    public function setProgressive(Request $request){
        $exception = DB::transaction(function() use ($request) {
            foreach ($request->dataProgressive as $key =>$prog) {
                OrderAssumption::
                    where('ordass_id', $prog['ordpro_assid'])
                    ->update(['ordass_sp' => 'P']);
                if($prog['ordpro_id'] == ''){
                    $data = new OrderProgressive();
                    $data->ordpro_assid = $prog['ordpro_assid'] ;
                    $data->ordpro_amt_min = $prog['ordpro_amt_min'] ;
                    $data->ordpro_amt_max = $prog['ordpro_amt_max'] ;
                    $data->ordpro_value = $prog['ordpro_value'] ;

                    $data->ordpro_created_by = Auth::id();
                    $data->ordpro_created_date = date(now());
                    $data->save();
                }else{
                    OrderProgressive::
                        where('ordpro_id', $prog['ordpro_id'])
                        ->update(['ordpro_assid' => $prog['ordpro_assid'] ,
                            'ordpro_amt_min' => $prog['ordpro_amt_min'] ,
                            'ordpro_amt_max' => $prog['ordpro_amt_max'] ,
                            'ordpro_value' => $prog['ordpro_value'] ,
                            'ordpro_updated_date' => date(now())]);
                }
            }
        });
        
        return is_null($exception) ? response()->json(['success'=>'Company Type saved successfully.']) : $exception;
    }
}