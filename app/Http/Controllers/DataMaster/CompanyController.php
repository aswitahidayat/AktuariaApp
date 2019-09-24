<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyDetail;
use App\Models\CompanyDetailSub;
use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;

class CompanyController extends Controller
{
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

        return view('datamaster.company.companyindex');
    }

    public function search(Request $request){
        if($request->ajax())
        {
            $url = route('company.index');

            $query = Company::query();
            if($request->name != ''){
                $query->where('coytypehdr_name', 'LIKE',  "%$request->name%");
            }
            $data = $query->get();
            
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->coytypehdr_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCompanyType">Edit</a>';
                    // $btn = $btn." <a href='". route('company.index')."/detail/$row->coytypehdr_id' data-toggle='tooltip'  data-original-title='Detail' class='btn btn-warning btn-sm detailCompanyType'>Detail</a>";
                    // $btn = $btn." <a href='javascript:void(0)' data-toggle='tooltip'  data-id='$row->coytypehdr_id' data-original-title='Delete' class='btn btn-danger btn-sm deleteCompanyType'>Delete</a>";
                    return $btn;
                })
                ->addColumn('statusName', function($row){
                    $btn = $row->coytypehdr_status == 1 ? "Active" : "Inactive" ;
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function edit($coytypehdr_id)
    {
        $data = Company::find($coytypehdr_id);
        return response()->json($data);
    }

    public function getCompanyDtl(Request $request)
    {
        $data = Company::query()
            ->leftJoin('kka_dab.mst_coytype_dtl', 'coytypehdr_id', '=', 'kka_dab.mst_coytype_dtl.coytypedtl_hdrid')
            ->leftJoin('kka_dab.mst_coytype_dtlsub', 'kka_dab.mst_coytype_dtl.coytypedtl_id', '=', 'kka_dab.mst_coytype_dtlsub.coytypedtlsub_dtlid')
            ->where('coytypehdr_id', $request->coytypehdr_id)
            ->get();
            
        return response()->json($data);
    }

    public function store(Request $request)
    {
        if($request->coytypehdr_id == ''){
            $response = $this->companyTransaction($request);
            return is_null($response) ? response()->json(['success'=>'Company Type saved successfully.']) : $response;
        }else{
            try{
                Company::where('coytypehdr_id', $request->coytypehdr_id)
                    ->update(['coytypehdr_name' => $request->coytypehdr_name,
                        'coytypehdr_desc' => $request->coytypehdr_desc,
                        'coytypehdr_status' => $request->coytypehdr_status,
                        'coytypehdr_updated_date' => date(now())]);

                return response()->json(['success'=>'Company Type edited successfully.']);
            } catch(\Illuminate\Database\QueryException $ex){
                return response()->json($ex->getMessage(), 500);
            }
        }
    }

    public function destroy($coytypehdr_id)
    {
        try{
            $a =Company::find($coytypehdr_id)->delete();
            if($a == true){
                return response()->json(['success'=>'Company Type deleted successfully.']);
            } else {
                return response()->json('deleted fail.', 500);
            }
        } catch(\Illuminate\Database\QueryException $ex){
            return response()->json($ex->getMessage(), 500);
        }
    }

    function companyTransaction(Request $request){
        $exception = DB::transaction(function() use ($request) {
            $dataDtl = [];
            $dataDtlSub = [];

            $q = Company::create([
                'coytypehdr_name' => $request->header['coytypehdr_name'],
                'coytypehdr_desc' => $request->header['coytypehdr_desc'],
                'coytypehdr_status' => 1,
                'coytypehdr_created_by' => 1,
                'coytypehdr_created_date' => date(now())
            ]);
            
            if(!empty($request->detail)){
                foreach ($request->detail as $key =>$value) {
                    $cd = CompanyDetail::create([
                        'coytypedtl_hdrid' => $q->coytypehdr_id,
                        'coytypedtl_assumpt_sp' => $value['coytypedtl_assumpt_sp'],
                        'coytypedtl_assumpt_code' => $value['coytypedtl_assumpt_code'],
                        'coytypedtl_assumpt_value' => $value['value'],
                        'coytypedtl_status' => 1,
                        'coytypedtl_created_by' => 1,
                        'coytypedtl_created_date' => date(now()),
                    ]);
    
                    if($value['coytypedtl_assumpt_sp'] == 'P'){
                        CompanyDetailSub::insert([
                            'coytypedtlsub_dtlid' => $cd->coytypedtl_id,
                            'coytypedtlsub_amt_min' => $value['min'],
                            'coytypedtlsub_amt_max' => $value['max'],
                            'coytypedtlsub_value' => $value['value'],
                            'coytypedtlsub_created_by' => 1,
                            'coytypedtlsub_created_date' => date(now())
                        ]);
                    }
        
                }
            }
        });

        return is_null($exception) ? response()->json(['success'=>'Company Type saved successfully.']) : $exception;

    }
}
