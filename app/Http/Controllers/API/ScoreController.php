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

    public function getStudent($id){
        // join student dengan score where id=id
        $student = Student::with('score')->where('id', $id)->first();
        // dd($student);
        return response()->json([
            'message'=>'Success',
            'data' => $student
        ],200);
    }

    // update
    public function update(Request $request, $id){
        // kita ambil id student dulu
        $student = Student::find($id);
        // dd($student);
        $student->update([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'no_telp'=>$request->no_telp
        ]);
        // sebelum create datanya kita delete dulu
        Score::where('student_id', $id)->delete();

        foreach ($request->list_pelajaran as $key => $value) {
            // dd($value);
            $score = array(
                'student_id' => $id, //cukup $id saja
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
