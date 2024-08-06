<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Skill  extends MainModel
{
    // use HasFactory;
    // protected $guarded =["id","created_at","updated_at"];
    protected $fillable=["name","img","cat_id","active"];

    public function cat(){
        return $this->belongsTo(Cat::class);
    }
    public function exams(){
        return $this->hasMany(Exam::class);
    }

    public function name($lang=null){
        // $lang=$lang?? App::getLocale();
    
        // return json_decode($this->name)->$lang;
        return $this->getTranslatedAttribute('name', $lang);

    }
    public function studentCount(){
        $stuNum=0;
        foreach($this->exams as $exam ){
            $stuNum=$exam->users()->count();
        }
        return $stuNum;
    }
    public function scopeActive($query){
        return $query->where("active",1);
    }
    public function scopeFilter($query ,array $filter){
        $query->when($filter['search'] ?? false ,function($query , $search){

            $query
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('cat_id', 'like', '%' . $search . '%')->get();
        

        });
        $query->when($filter['category'] ?? false ,function($query , $category_id){

            $query->where("cat_id",$category_id)->get();
                
        

        });
    }
}
