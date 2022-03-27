<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'alamat',
        'no_telp'
    ];

    public function score(){
        // one to many fk student_id akn di join di controller
        return $this->hasMany('App\Models\Score','student_id'); 
    }
}
