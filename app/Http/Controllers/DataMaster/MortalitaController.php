<?php
namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Mortalita\Mortalita;
use App\Models\Mortalita\MortalitaDtl;
use Auth;
use Illuminate\Http\Request;
use DataTables;
use DB;

class MortalitaController extends Controller {
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

        return view('datamaster.mortalita.mortaliaIndex');
    }

    public function searchMortalita(Request $request){
        if($request->ajax())
        {
            $url = route('company.index');

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
            $url = route('company.index');

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
        $data = Mortalita::find($mortalitahdr_id);
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
            $q = Mortalita::create([
                'mortalitahdr_name' => $request->mortalitahdr_name,
                'mortalitahdr_status' => 1,
                'mortalitahdr_created_by' => 1,
                'mortalitahdr_created_date' => date(now())
            ]);

            if($request->mortalitahdr_agework > 0){

                $this->mortalitaDtl($request->mortalitahdr_agework, $q->mortalitahdr_id);
                // $cd = [];
                // $agework = $request->mortalitahdr_agework;
                // for ($x = 1; $x <= $agework; $x++) {
                //     $cd[]= [
                //         'mortalitadtl_hdrid' => $q->mortalitahdr_id,
                //         'mortalitadtl_agework' => $x,
                //         'mortalitadtl_created_by' => 1,
                //         'mortalitadtl_created_date' => date(now()),
                //     ];
                // }

                // MortalitaDtl::insert($cd);

                // foreach ($request->detail as $key =>$value) {
                //     $cd = MortalitaDtl::create([
                //         'mortalitadtl_hdrid' => $q->mortalitahdr_id,
                //         'mortalitadtl_agework' => $value['mortalitadtl_agework'],
                //         'mortalitadtl_percentage' => $value['mortalitadtl_percentage'],
                //         'mortalitadtl_created_by' => 1,
                //         'mortalitadtl_created_date' => date(now()),
                //     ]);
                // }
            };
        });

        return is_null($exception) ? response()->json(['success'=>'Company Type saved successfully.']) : $exception;

    }

    function mortalitaEditTransaction(Request $request){
        $exception = DB::transaction(function() use ($request) {
            Mortalita::where('mortalitahdr_id', $request->mortalitahdr_id)
                ->update(['mortalitahdr_name' => $request->mortalitahdr_name,
                    'mortalitahdr_status' => $request->mortalitahdr_status,
                    'mortalitahdr_updated_date' => date(now())
                ]);
            
            $tempCountDtl = MortalitaDtl::where('mortalitadtl_hdrid',$request->mortalitahdr_id)->count();
            
            if($tempCountDtl != $request->mortalitahdr_agework){
                MortalitaDtl::where('mortalitadtl_hdrid', $request->mortalitahdr_id)->delete();
                $this->mortalitaDtl($request->mortalitahdr_agework, $request->mortalitahdr_id);
            }

        });

        return is_null($exception) ? response()->json(['success'=>'Company Type edited successfully.']) : $exception;
    }

    function mortalitaDtl($number, $id){
        $cd = [];
        $agework = $number;
        for ($x = 1; $x <= $agework; $x++) {
            $cd[]= [
                'mortalitadtl_hdrid' => $id,
                'mortalitadtl_agework' => $x,
                'mortalitadtl_created_by' => 1,
                'mortalitadtl_created_date' => date(now()),
            ];
        }

        MortalitaDtl::insert($cd);
    }
}