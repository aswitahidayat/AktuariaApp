<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\OrderProgram;
use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;

class ProgramController extends Controller
{
    public function index(Request $request)
    {

        if($request->ajax())
        {
            $data = OrderProgram::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ordprg_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editOrderProgram">Edit</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ordprg_id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteOrderProgram">Delete</a>';
                    return $btn;
                })
                ->addColumn('statusName', function($row){
                    $btn = $row->ordprg_status == 1 ? "Active" : "Inactive" ;
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('datamaster.program.index', compact('datas'));
    }

    public function search(Request $request){
        if($request->ajax())
        {
            $query = OrderProgram::query();

            if($request->name != ''){
                $query->where('ordprg_name', 'LIKE', "%$request->name%");
            }

            $data =  $query->orderBy('ordprg_id')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ordprg_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editOrderProgram">Edit</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ordprg_id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteOrderProgram">Delete</a>';
                    return $btn;
                })
                ->addColumn('statusName', function($row){
                    $btn = $row->ordprg_status == 1 ? "Active" : "Inactive" ;
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }   
    }

    public function edit($ordprg_id)
    {
        $program = OrderProgram::find($ordprg_id);
        return response()->json($program);
    }

    public function store(Request $request)
    {
        if($request->ordprg_id == ''){
            $data = new OrderProgram();
            $data->ordprg_name = $request->ordprg_name;
            $data->ordprg_status = $request->ordprg_status;
            $data->ordprg_created_by = 1;
            $data->ordprg_created_date = date(now());
            $data->save();
        }else{
            DB::table('kka_dab.mst_order_program')
                ->where('ordprg_id', $request->ordprg_id)
                ->update(['ordprg_name' => $request->ordprg_name,
                    'ordprg_status' => $request->ordprg_status]);
        }
        return response()->json(['success'=>'Program saved successfully.']);
    }

    public function destroy($ordprg_id)
    {
        OrderProgram::find($ordprg_id)->delete();
        return response()->json(['success'=>'Program deleted successfully.']);
    }
    
}
