<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\MainController;
use App\Http\Requests\CatRequest;
use App\Models\Cat;
use Exception;
use Illuminate\Http\Request;

class AdminCatController extends MainController
{
    
    public function index()
    {
        $cats=Cat::orderByDesc("id")->paginate(15);
        return view("admin.cat.index",compact("cats"));
    }

    
    public function store(CatRequest $request)
    {
        
        Cat::create([
            "name"=>json_encode([
                "en" => $request -> name_en,
                "ar" => $request -> name_ar
            ]),
        ]);
        
        return $this->returnMessage("cat created successd");

    }

    

    
    public function update(CatRequest $request, string $id)
    {
        
        Cat::where("id",$id)->update([
            "name"=>json_encode([
                "en" => $request -> name_en,
                "ar" => $request -> name_ar
            ]),
        ]);
       
        return $this->returnMessage("update category ");
    }

    
    public function destroy(string $id ,Request $request)
    {
        
        try{
            Cat::where("id",$id)->delete();
            $msg="done deleted";
        }catch(Exception $e){
            $msg="cant deleted";
        }
        
        return $this->returnMessage($msg);

    }
    public function toggle($id){
        $model=Cat::where("id",$id);
        return $this->ToggleMain($model);
    }
}
