<?php
namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    public function index(Request $request) 
    {
        return view('datamaster.usertype.usertypeindex');
    }

    public function search(Request $request) 
    {
        return Bank::getPaging($request);
    }

    public function store(Request $request)
    {
        return Bank::storeData($request);
         
    }

    public function edit($usertype_id)
    {
        $utype = UserType::find($usertype_id);
        return response()->json($utype);
    }

    public function destroy($usertype_id)
    {
        UserType::find($usertype_id)->delete();
        return response()->json(['success'=>'User Type deleted successfully.']);
    }
}
