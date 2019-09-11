<?php
/**
 * Created by PhpStorm.
 * User: Shandy
 * Date: 4/22/2019
 * Time: 7:30 PM
 */

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyDetail;

use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;

class CompanyDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

    }

    public function detail($id) 
    {
        if(Auth::user()->level == 'user') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        $company = Company::where('coytypehdr_id', $id)->count();
        if($company > 0){
            return view('datamaster.company.detailindex',  ['id' => $id]);
        } else {
            return redirect()->to('/company');
        }
    }
    
    public function getdetail(Request $request){
        $query = CompanyDetail::query();
        if($request->name != ''){
            $query->where('coytypehdr_name', 'LIKE',  "%$request->name%");
        }
        $data = $query->where('coytypedtl_hdrid', $request->company)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->coytypedtl_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCompanyTypeDetail">Edit</a>';
                $btn = $btn." <a href='javascript:void(0)' data-toggle='tooltip'  data-id='$row->coytypedtl_id' data-original-title='Delete' class='btn btn-danger btn-sm deleteCompanyTypeDetail'>Delete</a>";
                return $btn;
            })
            ->addColumn('statusName', function($row){
                $btn = $row->coytypedtl_status == 1 ? "Active" : "Inactive" ;
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        
    }

    public function edit($coytypedtl_id)
    {
        $data = CompanyDetail::find($coytypedtl_id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        if($request->coytypedtl_id == ''){
            $data = new CompanyDetail();
            $data->coytypedtl_hdrid = $request->coytypedtl_hdrid;
            $data->coytypedtl_assumpt_value = $request->coytypedtl_assumpt_value;
            $data->coytypedtl_status = $request->coytypedtl_status;
            $data->coytypedtl_created_by = 1;
            $data->coytypedtl_created_date = date(now());
            $data->save();
        }else{
            CompanyDetail::
                where('coytypedtl_id', $request->coytypedtl_id )->where('coytypedtl_hdrid', $request->coytypedtl_hdrid) 
                ->update([
                    'coytypedtl_assumpt_value' => $request->coytypedtl_assumpt_value,
                     'coytypedtl_status' => $request->coytypedtl_status,
                     'coytypedtl_updated_date' => date(now())]);
        }
        return response()->json(['success'=>'Company Type saved successfully.']);
    }

    public function destroy($coytypedtl_id)
    {
        CompanyDetail::find($coytypedtl_id)->delete();
        return response()->json(['success'=>'Company Type deleted successfully.']);
    }
}
