<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Score;
use App\Models\Student;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function create(Request $request){
        // dd($request->all());
        $student = new Student;
        $student->nama=$request->nama;
        $student->alamat=$request->alamat;
        $student->no_telp=$request->no_telp;
        $student->save();

        foreach ($request->list_pelajaran as $key => $value) {
            // dd($value);
            $score = array(
                'student_id' => $student->id,
                'mapel'=>$value['mapel'],
                'nilai'=>$value['nilai']
            );
            $scores = Score::create($score);
        }
        return response()->json([
            'message'=>'Success'
        ],200);
    }
}
