<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Hash;
use DB;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        return view('setting');
    }

    public function changePassword(Request $request)
    {

        $user = Auth::user()->user_email;
        $pass = $request->password;
        $newPass = Hash::make($request->newPassword);
    
        $users = DB::table('kka_dab.mst_user')->where(['user_email'=> $user])->first();
    
        if($users==''){
    
            return redirect('/')->with('failed','Login gagal');
    
        } else{
            
            // var_dump(Hash::check($pass, $users->user_password));die;
            if($users->user_email == $user AND Hash::check($pass, $users->user_password) ){
                DB::table('kka_dab.mst_user')
                ->where('user_email', $user)
                ->update(['user_password' => $newPass]);
                return response()->json(['success'=>'1']);

            } else {
                return response()->json(['success'=>'0']);
            }
        }
    }

}