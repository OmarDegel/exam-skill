<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class MainModel extends Model
{
    use HasFactory;
    // protected $guarded =["id","created_at","updated_at"];//dont use guarded 

    public function getTranslatedAttribute($attribute, $lang = null)
    {
        $lang = $lang ?? App::getLocale();
        $value = json_decode($this->{$attribute});
        return $value->$lang ?? $value->en; // Assuming English as fallback
    }
}
