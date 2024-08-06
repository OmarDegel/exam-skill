<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends MainModel
{
    // use HasFactory;
    // protected $guarded =["id","created_at","updated_at"];
    protected $fillable = ["name"];


    public function users(){
        return $this->hasMany(User::class);
    }
}
