<?php

namespace App\Http\Controllers;

use App\UserType;
use Illuminate\Http\Request;
use Redirect,Response;

class AjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['usertype'] = UserType::orderBy('usertype_id','desc')->paginate(8);

        return view('ajax-crud',$data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usertypeId = $request->usertype_id;
        $usertype   =   UserType::updateOrCreate(['id' => $usertypeId],
            ['usertype_name' => $request->usertype_name,
            'usertype_desc' => $request->usertype_desc,
            'usertype_created_by' => '1',
            'usertype_status' => '1',
            'usertype_created_date' => '2017-07-07 00:00:00']);

        return Response::json($usertype);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $user  = User::where($where)->first();

        return Response::json($user);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id',$id)->delete();

        return Response::json($user);
    }
}
