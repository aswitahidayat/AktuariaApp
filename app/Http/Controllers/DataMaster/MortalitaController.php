<?php
namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Mortalita\Mortalita;
use App\Models\Mortalita\MortalitaDtl;
use Illuminate\Http\Request;
use DataTables;
use DB;

class MortalitaController extends Controller {

    public function index(Request $request)
    {
        return view('datamaster.mortalita.mortaliaIndex');
    }

    public function searchMortalita(Request $request){
        if($request->ajax())
        {
            $url = route('companytype.index');

            $query = Mortalita::query();
            if($request->name != ''){
                $query->where('mortalitahdr_name', 'LIKE',  "%$request->name%");
            }
            $data = $query->get();
            
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->mortalitahdr_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editMortalita">Edit</a>';
                    return $btn;
                })
                ->addColumn('statusName', function($row){
                    $btn = $row->mortalitahdr_status == 1 ? "Active" : "Inactive" ;
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function searchMortalitaDtl(Request $request){
        if($request->ajax())
        {
            $url = route('companytype.index');

            $query = MortalitaDtl::query();
            if($request->mortalitahdr_id != ''){
                $query->where('mortalitadtl_hdrid', '=',  "$request->mortalitahdr_id");
            }
            $data = $query->get();
            
            return response()->json($data);
        }
    }

    public function edit($mortalitahdr_id)
    {
        $data = Mortalita::detail($mortalitahdr_id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        if($request->mortalitahdr_id == ''){
            return $this->mortalitaTransaction($request);
        }else{
            return $this->mortalitaEditTransaction($request);
        }
    }

    function mortalitaTransaction(Request $request){
        $exception = DB::transaction(function() use ($request) {
            $q = Mortalita::createData($request);
            
            if(sizeof($request->detail) > 0){
                $this->mortalitaDtl($request->detail, $q->mortalitahdr_id);
            }
        });

        return is_null($exception) ? response()->json(['success'=>'Company Type saved successfully.']) : $exception;

    }

    function mortalitaEditTransaction(Request $request){
        $exception = DB::transaction(function() use ($request) {
            Mortalita::updateData($request);
            if(sizeof($request->detail) > 0){
                $this->mortalitaDtl($request->detail, $request->mortalitahdr_id);
            }
        });

        return is_null($exception) ? response()->json(['success'=>'Company Type edited successfully.']) : $exception;
    }

    function mortalitaDtl($detail, $id){
        foreach ($detail as $key =>$value) {
            if($value['mortalitadtl_id'] == ''){
                MortalitaDtl::create([
                    'mortalitadtl_hdrid' => $id,
                    'mortalitadtl_agework' => $value['mortalitadtl_agework'],
                    'mortalitadtl_percentage' => $value['mortalitadtl_percentage'],
                    'mortalitadtl_created_by' => 1,
                    'mortalitadtl_created_date' => date(now()),
                ]);
            } else {
                MortalitaDtl::
                where('mortalitadtl_id', $value['mortalitadtl_id'] )
                ->update([
                    'mortalitadtl_agework' => $value['mortalitadtl_agework'],
                    'mortalitadtl_percentage' => $value['mortalitadtl_percentage'],
                    'mortalitadtl_updated_by' => 1,
                    'mortalitadtl_updated_date' => date(now()),
                ]);
            }
        }

    }
}