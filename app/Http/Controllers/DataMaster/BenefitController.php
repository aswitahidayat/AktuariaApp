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

            $length = $request->length != '' ? $request->length : 10;
            $data = $query->skip($request->start)->take($length)->get();
                        
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
        if($request->ajax()) {
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
        $data = Benefit::detail($benhdr_id);
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
            $q = Benefit::createData($request);
            
            if(sizeof($request->detail) > 0){
                $this->benDtl($request->detail, $q->benhdr_id);
            }
        });

        return is_null($exception) ? response()->json(['success'=>'Company Type saved successfully.']) : $exception;

    }

    function benEditTransaction(Request $request){
        $exception = DB::transaction(function() use ($request) {
            Benefit::editData($request);
            if(sizeof($request->detail) > 0){
                $this->benDtl($request->detail, $request->benhdr_id);
            }

        });

        return is_null($exception) ? response()->json(['success'=>'Company Type edited successfully.']) : $exception;
    }

    function benDtl($detail, $benhdr_id){
        $cd = [];
        foreach ($detail as $key =>$value) {
            if($value['bendtl_id'] == ''){
                BenefitDtl::create([
                    'bendtl_hdrid' => $benhdr_id,
                    'bendtl_agework_year' => $value['bendtl_agework_year'],
                    'bendtl_severance' => $value['bendtl_severance'],
                    'bendtl_appreciation' => $value['bendtl_appreciation'],
                    'bendtl_split' => $value['bendtl_split'],
                    'bendtl_created_by' => 1,
                    'bendtl_created_date' => date(now()),
                ]);
            } else {
                BenefitDtl::
                where('bendtl_id', $value['bendtl_id'] )
                ->update([
                    'bendtl_agework_year' => $value['bendtl_agework_year'],
                    'bendtl_severance' => $value['bendtl_severance'],
                    'bendtl_appreciation' => $value['bendtl_appreciation'],
                    'bendtl_split' => $value['bendtl_split'],
                ]);
            }
        }

    }

}