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
                    $btn = $btn." <a href='". route('company.index')."/detail/$row->coytypehdr_id' data-toggle='tooltip'  data-original-title='Detail' class='btn btn-warning btn-sm detailCompanyType'>Detail</a>";
                    $btn = $btn." <a href='javascript:void(0)' data-toggle='tooltip'  data-id='$row->coytypehdr_id' data-original-title='Delete' class='btn btn-danger btn-sm deleteCompanyType'>Delete</a>";
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

    public function store(Request $request)
    {
        if($request->coytypehdr_id == ''){
            $data = new Company();
            $data->coytypehdr_name = $request->coytypehdr_name;
            $data->coytypehdr_desc = $request->coytypehdr_desc;
            $data->coytypehdr_status = $request->coytypehdr_status;
            $data->coytypehdr_created_by = 1;
            $data->coytypehdr_created_date = date(now());
            $data->save();
        }else{
            Company::where('coytypehdr_id', $request->coytypehdr_id)
                ->update(['coytypehdr_name' => $request->coytypehdr_name,
                    'coytypehdr_desc' => $request->coytypehdr_desc,
                     'coytypehdr_status' => $request->coytypehdr_status,
                     'coytypehdr_updated_date' => date(now())]);
        }
        return response()->json(['success'=>'Company Type saved successfully.']);
    }

    public function destroy($coytypehdr_id)
    {
        Company::find($coytypehdr_id)->delete();
        return response()->json(['success'=>'Company Type deleted successfully.']);
    }
}
