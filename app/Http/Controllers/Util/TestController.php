<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    
    public function test(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'name' => 'required',
        ]);

        return response()->json([
            'message' => "Welcome $request->name"
       ]);
    }
}
