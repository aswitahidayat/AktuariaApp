<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Service\Service;
use App\Models\Service\ServiceDetail;

use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        return view('datamaster.service.serviceIndex', compact('datas'));
    }

    public function search(Request $request)
    {
        $query = Service::query();
        if($request->name != ''){
            $query->where('ordsrvhdr_name', 'LIKE',  "%$request->name%");
        }
        $data = $query->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ordsrvhdr_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editService">Edit</a>';
                // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ordsrvhdr_id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteService">Delete</a>';
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
        $program = Service::find($ordsrvhdr_id);
        return response()->json($program);
    }

    public function store(Request $request)
    {
        $exception = DB::transaction(function() use ($request) {
            if($request->ordsrvhdr_id == ''){
                $q= Service::create([
                        'ordsrvhdr_name' => $request->ordsrvhdr_name,
                        'ordsrvhdr_desc' => $request->ordsrvhdr_desc,
                        'ordsrvhdr_status' => $request->ordsrvhdr_status,
                        'ordsrvhdr_created_by' => 1,
                        'ordsrvhdr_created_date' => date(now()),
                ]);
                $this->setDetail($request->detail, $q->ordsrvhdr_id);
            }else{
                Service::
                    where('ordsrvhdr_id', $request->ordsrvhdr_id)
                    ->update(['ordsrvhdr_name' => $request->ordsrvhdr_name,
                        'ordsrvhdr_desc' => $request->ordsrvhdr_desc,
                        'ordsrvhdr_status' => $request->ordsrvhdr_status]);
                        
                $this->setDetail($request->detail);

            }

        });

        return is_null($exception) ? response()->json(['success'=>'Service saved successfully.']) : $exception;
    }
    
    public function serviceDetail(Request $request){
        $data = ServiceDetail::where('ordsrvdtl_hdrid', $request->ordsrvhdr_id)->get();
        return response()->json($data);
    }

    public function setDetail($detail, $id =''){
        foreach ($detail as $key =>$value) {
            if($value['ordsrvdtl_id'] == ''){
                ServiceDetail::create([
                    'ordsrvdtl_hdrid' => $id,
                    'ordsrvdtl_price' => !empty($value['ordsrvdtl_price'])?$value['ordsrvdtl_price']:'',
                    'ordsrvdtl_startdate' => !empty($value['ordsrvdtl_startdate'])?$value['ordsrvdtl_startdate']:'',
                    'ordsrvdtl_enddate' => !empty($value['ordsrvdtl_enddate'])?$value['ordsrvdtl_enddate']:'',
                    'ordsrvdtl_created_by' => '1',
    
                    'orddtl_created_by' => 1,
                    'ordsrvdtl_created_date' => date(now()),
                ]);
            } else {
                ServiceDetail::
                where('ordsrvhdr_id', $value['ordsrvhdr_id'] )
                ->update([
                    'ordsrvdtl_price' => !empty($value['ordsrvdtl_price'])?$value['ordsrvdtl_price']:'',
                    'ordsrvdtl_startdate' => !empty($value['ordsrvdtl_startdate'])?$value['ordsrvdtl_startdate']:'',
                    'ordsrvdtl_enddate' => !empty($value['ordsrvdtl_enddate'])?$value['ordsrvdtl_enddate']:'',
                    'ordsrvdtl_created_by' => '1',
    
                    'orddtl_created_by' => 1,
                    'ordsrvdtl_created_date' => date(now())
                     ]);
            }
        }
    }
}
