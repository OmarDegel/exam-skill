<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Cat;
use App\Models\Skill;
use App\Http\traits\Media;
use Illuminate\Http\Request;
use App\Http\Requests\SkillRequest;
use App\Http\Controllers\MainController;

class AdminSkillController extends MainController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cats=Cat::get();
        $skills=Skill::latest()->filter(request(["search","category"]))->paginate(10);
        return view("admin.skill.index",compact("skills","cats"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SkillRequest $request)
    {
        
        $image=$request->file('img')->store('skills','public');

        Skill::create([
            "name"=>json_encode([
                "en" => $request -> name_en,
                "ar" => $request -> name_ar,
                
            ]),
            "cat_id" =>$request->cat_id,
            'img'=> $image
        ]);
        

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
//         $cats = Cat::all();
//         $skill = Skill::query();

//         if (request('search')) {
//     $skill->where('name', 'like', '%' . request('search') . '%');
// }
//     $skill=$skill->paginate(10);

// return view('admin.skill.index', compact('skills', 'cats'));
        $cats = Cat::all();
        $skill=Skill::where("id",$id);
        $skills=Skill::latest()->filter(request(["search","category"]))->paginate(10);

    return view('admin.skill.index', compact('skills', 'cats' ,"skill"));    
    }

    
    public function update(SkillRequest $request, string $id)
    {

        $skill=Skill::where("id",$request->id)->first();
        
        $newImagePath=$this->editPhoto($skill->img,$request);
        Skill::where("id",$id)->update([
            "name"=>json_encode([
                "en" => $request -> name_en,
                "ar" => $request -> name_ar,
                
            ]),
            "cat_id" =>$request->cat_id,
            'img'=> $newImagePath
        ]);
        $request->session()->flash("msg","updated successd");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        try{
            $skill=Skill::where("id",$id)->first();
            $skill->delete();
            $this->deletePhoto($skill);

        }catch(Exception $e){
        $msg="cant deleted";
    }

                $request->session()->flash("msg",$msg);
                return back();
    }
    public function toggle($id){
        $model=Skill::where("id",$id);
        return $this->ToggleMain($model);
    }

    public function searchh(Request $request){
        $cats=Cat::get();
        $skills = Skill::get();
        if(request("search")){
            $skills->where("name","like","%".request("search")."%");
        }
        return view("admin.skill.index",compact("skills","cats"));
    }
}


