<?php
namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Benefit\Benefit;
use App\Models\Benefit\BenefitDtl;
use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;

class BenefitController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if(Auth::user()->level == 'user') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        return view('datamaster.benefit.benefitIndex');
    }

    public function searchBenefit(Request $request){
        if($request->ajax())
        {
            $url = route('company.index');

            $query = Benefit::query();
            if($request->name != ''){
                $query->where('benhdr_desc', 'LIKE',  "%$request->name%");
            }
            $data = $query->get();
            
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->benhdr_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBenefit">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function searchBenefitDtl(Request $request){
        if($request->ajax())
        {
            $url = route('company.index');

            $query = BenefitDtl::query();
            if($request->bendtl_hdrid != ''){
                $query->where('bendtl_hdrid', '=',  "$request->bendtl_hdrid");
            }
            $data = $query->get();
            
            return response()->json($data);
        }
    }

    public function edit($benhdr_id)
    {
        $data = Benefit::find($benhdr_id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        if($request->benhdr_id == ''){
            return $this->benTransaction($request);
        }else{
            return $this->benEditTransaction($request);
        }
    }

    function benTransaction(Request $request){
        $exception = DB::transaction(function() use ($request) {
            $q = Benefit::create([
                'benhdr_desc' => $request->benhdr_desc,
                'benhdr_start_date' => $request->benhdr_start_date,
                'benhdr_end_date' => $request->benhdr_end_date,
                'benhdr_created_by' => 1,
                'benhdr_created_date' => date(now())
            ]);

            if($request->benhdr_agework > 0){

                $this->benDtl(
                    $request->benhdr_agework, $q->benhdr_id, 
                    $request->bendtl_appreciation, $request->bendtl_split);
            };
        });

        return is_null($exception) ? response()->json(['success'=>'Company Type saved successfully.']) : $exception;

    }

    function benEditTransaction(Request $request){
        $exception = DB::transaction(function() use ($request) {
            Benefit::where('benhdr_id', $request->benhdr_id)
                ->update(['benhdr_desc' => $request->benhdr_desc,
                    'benhdr_updated_date' => date(now())
                ]);
            
            $tempCountDtl = BenefitDtl::where('bendtl_hdrid',$request->benhdr_id)->count();
            
            if($tempCountDtl != ($request->benhdr_agework + 1)){
                BenefitDtl::where('bendtl_hdrid', $request->benhdr_id)->delete();
                $this->benDtl(
                    $request->benhdr_agework, $request->benhdr_id,
                    $request->bendtl_appreciation, $request->bendtl_split
                );
            }

        });

        return is_null($exception) ? response()->json(['success'=>'Company Type edited successfully.']) : $exception;
    }

    function benDtl($number, $id, $bendtl_appreciation, $bendtl_split){
        $cd = [];
        $agework = $number;
        for ($x = 0; $x <= $agework; $x++) {
            $agework_month = $x > 0 ? (12*($x-1))+1 : 0;
            $bendtl_severance = $x<10 ? $x : '9';

            $cd[]= [
                'bendtl_hdrid' => $id,
                'bendtl_agework_year' => $x,
                'bendtl_agework_month' => $agework_month,
                'bendtl_severance' => $bendtl_severance,
                'bendtl_appreciation' => $bendtl_appreciation,
                'bendtl_split' => $bendtl_split,
                'bendtl_created_by' => 1,
                'bendtl_created_date' => date(now()),
            ];
        }

        BenefitDtl::insert($cd);
    }

}