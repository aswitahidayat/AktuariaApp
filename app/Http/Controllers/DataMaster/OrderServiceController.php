<?php
/**
 * Created by PhpStorm.
 * User: Shandy
 * Date: 4/22/2019
 * Time: 7:30 PM
 */

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\OrderService;
use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;

class OrderServiceController extends Controller
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

        // $datas = UserType::paginate(10);

        if($request->ajax())
        {
            $query = OrderService;

            if($request->name != ''){
                $query->where('kka_dab.mst_province.prov_id', $request->name);
            }
            $data = $query->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ordsrvhdr_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editOrderService">Edit</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ordsrvhdr_id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteOrderService">Delete</a>';
                    return $btn;
                })
                ->addColumn('statusName', function($row){
                    $btn = $row->ordsrvhdr_status == 1 ? "Active" : "Inactive" ;
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('datamaster.service.index', compact('datas'));
    }

    public function search(Request $request)
    {
        $query = DB::table('kka_dab.mst_order_service_hdr');

        if($request->name != ''){
            $query->where('ordsrvhdr_name', 'LIKE',  "%$request->name%");
        }
        $data = $query->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ordsrvhdr_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editOrderService">Edit</a>';
                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ordsrvhdr_id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteOrderService">Delete</a>';
                return $btn;
            })
            ->addColumn('statusName', function($row){
                $btn = $row->ordsrvhdr_status == 1 ? "Active" : "Inactive" ;
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function edit($ordsrvhdr_id)
    {
        $program = OrderService::find($ordsrvhdr_id);
        return response()->json($program);
    }

    public function store(Request $request)
    {
        if($request->ordsrvhdr_id == ''){
            $data = new OrderService();
            $data->ordsrvhdr_name = $request->ordsrvhdr_name;
            $data->ordsrvhdr_desc = $request->ordsrvhdr_desc;
            $data->ordsrvhdr_price = $request->ordsrvhdr_price;
            $data->ordsrvhdr_status = $request->ordsrvhdr_status;
            $data->ordsrvhdr_created_by = 1;
            $data->ordsrvhdr_created_date = date(now());
            $data->save();
        }else{
            DB::table('kka_dab.mst_order_service_hdr')
                ->where('ordsrvhdr_id', $request->ordsrvhdr_id)
                ->update(['ordsrvhdr_name' => $request->ordsrvhdr_name,
                    'ordsrvhdr_desc' => $request->ordsrvhdr_desc,
                    'ordsrvhdr_price' => $request->ordsrvhdr_price,
                    'ordsrvhdr_status' => $request->ordsrvhdr_status]);
        }
        return response()->json(['success'=>'Program saved successfully.']);
    }

    public function destroy($ordsrvhdr_id)
    {
        OrderService::find($ordsrvhdr_id)->delete();
        return response()->json(['success'=>'Program deleted successfully.']);
    }
}
