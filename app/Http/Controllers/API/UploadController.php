<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    function upload(Request $request){
    $image = $request->file('image');
        if ($request->hasFile('image')) {
        $new_name = rand().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('/uploads/images'),$new_name);
        return response()->json([
            'message'=>'Sukses',
            'data'=>$new_name
        ]);
        }else{
            return response()->json('image null');
        }    
    }
}
