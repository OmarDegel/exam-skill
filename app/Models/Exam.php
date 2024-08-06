<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Exam extends MainModel
{
    // use HasFactory;
    // protected $guarded =["id","created_at","updated_at"];
    protected $fillable = ["name","active","skill_id ",
                            "description","img","","question_no",
                            "difficulty","duration_mins"];

    public function skill(){
        return $this->belongsTo(Skill::class);
    }
    public function questions(){
        return $this->hasMany(Question::class);
    }
    public function users(){
        return $this->belongsToMany(User::class , 'exam_user')->withPivot("score","time_mins","status")->withTimestamps();
    }
    public function name($lang=null){
        // $lang=$lang ?? App::getLocale();
    
        // return json_decode($this->name)->$lang;
        return $this->getTranslatedAttribute('name', $lang);

    }
    public function desc($lang=null){
        // $lang=$lang ?? App::getLocale();
    
        // return json_decode($this->description)->$lang;
        return $this->getTranslatedAttribute('description', $lang);

    }
    public function scopeActive($query){
        return $query->where("active",1);
    }
    public function studentCount(){
        return $this->users()->count();

    }

    public function getMostExams(){
        return $this->withCount('users')->orderBy('users_count','desc')->paginate(8);
    }
}
