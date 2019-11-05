<?php
namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
// use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Input;

class HalamanController extends Controller
{
    public function index()
    {
        $id = Input::get('hitung');
        return view('transaction.halaman', ['id' => $id]);
    }

    public function getHalaman(Request $request){

        $id = $request->id;
        
        $q0 = DB::select("SELECT 
            ordchdr_periode
            from kka_dab.trn_order_hdr a 
            join kka_dab.trn_order_dtl b on a.ordhdr_id = b.orddtl_hdrid
            join kka_dab.trn_order_calc_hdr c on c.ordchdr_orddtlid = b.orddtl_id 
            where a.ordhdr_ordnum = '$id'
            group by ordchdr_periode
            order by ordchdr_periode desc
        ");

        $q1 = DB::select("SELECT
            c.ordchdr_periode,
            sum(case when c.ordchdr_age_val < a.ordhdr_pension_age then 1 else 0 end) as pegawai_pensiun,
            sum(case when c.ordchdr_age_val > a.ordhdr_pension_age then 1 else 0 end) as pegawai_non_pensiun,
            sum(case when c.ordchdr_age_val < a.ordhdr_pension_age then c.ordchdr_val_sal else 0 end) as pegawai_upah_pensiun,
            sum(case when c.ordchdr_age_val > a.ordhdr_pension_age then c.ordchdr_val_sal else 0 end) as pegawai_upah_non_pensiun,
            avg(case when c.ordchdr_age_val < a.ordhdr_pension_age then c.ordchdr_age_val else 0 end) as pegawai_umur_pensiun,
            avg(case when c.ordchdr_age_val > a.ordhdr_pension_age then c.ordchdr_age_val else 0 end) as pegawai_umur_non_pensiun,
            avg(c.ordchdr_past_srv) as kerja_lalu,
            avg(c.ordchdr_future_srv) as kerja_depan
            from kka_dab.trn_order_hdr a 
            join kka_dab.trn_order_dtl b on a.ordhdr_id = b.orddtl_hdrid
            join kka_dab.trn_order_calc_hdr c on c.ordchdr_orddtlid = b.orddtl_id 
            where a.ordhdr_ordnum = '$id'
            group by ordhdr_ordnum,ordchdr_periode
            order by c.ordchdr_periode desc
            ");

        
        
        $q2 =  DB::select("SELECT 
            ordass_periode
            ,avg(case when d.ordass_code = 'TDI' then d.ordass_value end) as diskonto
            ,avg(case when d.ordass_code = 'TPE' then d.ordass_value end) as tingkat_pengunduran_diri
            ,avg(case when d.ordass_code = 'TCA' then d.ordass_value end) as tingkat_cacat
            ,avg(case when a.ordhdr_sal_increase > 0 then a.ordhdr_sal_increase else 0 end) as kenaikan_upah
            ,avg(case when a.ordhdr_pension_age > 0 then a.ordhdr_pension_age end) as umur_pensiun
            from kka_dab.trn_order_hdr a 
            join kka_dab.trn_order_assumption d on d.ordass_hdrid = a.ordhdr_id 
            where a.ordhdr_ordnum = '$id'
            group by ordass_periode
            order by ordass_periode desc
        ");
        
        $q3 = DB::select("SELECT 
            ordass_periode,
            ordpro_amt_min,
            ordpro_amt_max,
            ordpro_value
            from kka_dab.trn_order_hdr a 
            join kka_dab.trn_order_assumption d on d.ordass_hdrid = a.ordhdr_id 
            join kka_dab.trn_order_progresive e on d.ordass_id = e.ordpro_assid
            where a.ordhdr_ordnum = '$id'
            order by ordass_periode desc, ordpro_amt_min
        ");

        $q4 = DB::select("SELECT 
            ordchdr_periode,
            sum (now_service_fee) as biaya,
            sum (obligation_under_pension) as pegawai_dibawah_pensiun,
            sum (obligation_above_pension)as pegawai_diatas_pensiun,
            sum (now_service_fee) as jasa_kini
            FROM kka_dab.sum_beban_biaya_neraca x
            WHERE ordchdr_ordnum = '$id'
            group by ordchdr_periode
            order by ordchdr_periode desc
        ");

        $q5 = collect(DB::select("SELECT b.bizpart_coy_name
        from kka_dab.trn_order_hdr a 
        join kka_dab.mst_bizpartner b on a.ordhdr_bizpartid = b.bizpart_id
        where a.ordhdr_ordnum = '$id'"))->first();

        // $progressive = [];
        // foreach ($q3 as $key=> $value) {
        //     $progressive[$value->ordass_periode][] = $value;
        // }

        $progressive = new \stdClass();
        foreach ($q3 as $key=> $value) {
            $tempPro = new \stdClass();
            $keyName = $value->ordpro_amt_min." - ".$value->ordpro_amt_max;
            $tempPro = new \stdClass();
            $tempPro->min = $value->ordpro_amt_min;
            $tempPro->max = $value->ordpro_amt_max;
            $tempPro->value = $value->ordpro_value;
            $tempPro->periode = $value->ordass_periode;
            
            $progressive->{$keyName}[$value->ordass_periode] = $tempPro;
        }

        $varReturn = new \stdClass();
        $varReturn->detail = [];
        $varReturn->coy_name  = $q5->bizpart_coy_name;
        $varReturn->tpe = $progressive;

        foreach ($q0 as $key=> $value) {
            $varTemp = new \stdClass();
            $varTemp->{$value->ordchdr_periode} = new \stdClass();
            $varTemp->{$value->ordchdr_periode} = (object) array_merge((array) $q1[$key], (array) $q2[$key], (array) $q4[$key]);
            // $varTemp->{$value->ordchdr_periode}->progressive = $progressive[$value->ordchdr_periode];
            $varReturn->detail[] = $varTemp->{$value->ordchdr_periode};
        }

        return response()->json($varReturn);
    }
}