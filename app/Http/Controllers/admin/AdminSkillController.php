<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Skill;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSkillController extends Controller
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
    public function store(Request $request)
    {
        $request->validate([
            "name_en"=>"required|string|max:250",
            "name_ar"=>"required|string|max:50",
            'img'=>"required|image|max:2048",
            'cat_id'=>"required|exists:cats,id"
        ]);

        
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "id"=>"required|exists:skills,id",
            "name_en"=>"required|string|max:250",
            "name_ar"=>"required|string|max:50",
            'img'=>"nullable|image|max:2048",
            'cat_id'=>"required|exists:cats,id"
        ]);

        $skill=Skill::where("id",$request->id)->first();
        $oldImage = $skill->img;

    if ($request->hasFile('img')) {
        if ($oldImage) {
            Storage::disk('public')->delete($oldImage);
        }
            $newImagePath = $request->file('img')->store('skills', 'public');
    } else {
        $newImagePath = $oldImage;
    }
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
            $oldImage = $skill->img;
            $skill->delete();
            Storage::disk('public')->delete($oldImage);
                $msg="done deleted";
        }catch(Exception $e){
        $msg="cant deleted";
    }

                $request->session()->flash("msg",$msg);
                return back();
    }
    public function toggle($id){
        $skill=Skill::where("id",$id)->first();
        
        Skill::where("id",$id)->update([
            "active" => ! $skill->active,
        ]);
        return redirect()->back();
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


