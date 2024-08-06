<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends MainModel
{
    // use HasFactory;
    // protected $guarded =["id","created_at","updated_at"];
    protected $fillable = ["exam_id","title","option_1","option_2","option_3","option_4","right_ans"];


    public function exam(){
        return $this->belongsTo(Exam::class);
    }
}
