<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Cat extends MainModel
{
    // use HasFactory;
    // protected $guarded =["id","created_at","updated_at"];
    protected $fillable = ["name","active"];
    public function skills(){
        return $this->hasMany(Skill::class);
    }
    public function name($lang=null){
        // $lang = $lang ?? App::getLocale();
        // $name = json_decode($this->name);
        // if (isset($name->$lang)) {
        // return $name->$lang;
        // } else {
        // // Handle the case where the requested language is not available
        // return $name->en; // Assuming English as fallback
        return $this->getTranslatedAttribute('name', $lang);
    }
    
    public function scopeActive($query){
        return $query->where("active",1);
    }
}
