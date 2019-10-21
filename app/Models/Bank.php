<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Bank extends Model
{
    protected $table = 'kka_dab.mst_bank';
    protected $primaryKey = 'bank_id'; // or null

    public $incrementing = true;
    public $timestamps = false;

    public static function getPaging($request){
        $query = Bank::query();

        if($request->name != ''){
            $query->where('bank_name_short', 'LIKE',  "%$request->name%");
            $query->orWhere('bank_name_full', 'LIKE',  "%$request->name%");
        }

        $length = $request->length != '' ? $request->length : 10;
        $query->skip($request->start)->take($length)->get();

        $data = $query->orderBy('bank_id')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->bank_id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBank">Edit</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public static function storeData($request){
        $exception = DB::transaction(function() use ($request) {
            if($request->bank_id == ''){
                $data = new bank();
                $data->bank_name_short = $request->bank_name_short;
                $data->bank_name_full = $request->bank_name_full;
                $data->bank_created_by = Auth::id();
                $data->bank_created_date = date(now());
                $data->save();
            }else{
                DB::table('kka_dab.mst_user_type')
                    ->where('bank_id', $request->bank_id)
                    ->update(['bank_name_short' => $request->bank_name_short,
                        'bank_name_full' => $request->bank_name_full]);
            }
    
        });
        return is_null($exception) ? response()->json(['success'=>'Order comfirm successfully.']) : $exception;
    }
}
