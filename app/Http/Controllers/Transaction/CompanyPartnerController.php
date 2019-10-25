<?php
namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\AdminController;
use App\User;

use App\Models\Register\CompanyPartner;
use App\Models\Register\Partner;
use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;

class CompanyPartnerController extends AdminController
{
    public function index()
    {
        return view('transaction.companyPartner.companyPartnerIndex');
    }

    public function searchApi(Request $request){
        $data = Partner::get();
        return response()->json($data);
    }

    public function search(Request $request)
    {
        $data = CompanyPartner::paging($request);
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->bizpart_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPartner">Edit</a>';
                    return $btn;
                })
                ->addColumn('statusName', function($row){
                    $btn = $row->bizpart_status == 1 ? "Active" : "Inactive" ;
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function edit($id)
    {
        $data = CompanyPartner::find($id);
        return response()->json($data);
    }

    public function store(Request $request){
        if($request->bizpart_id == ''){
            $response = CompanyPartner::simpan($request);
        }else{
            $response = CompanyPartner::edit($request);            
        }
        return $response;
    }

}