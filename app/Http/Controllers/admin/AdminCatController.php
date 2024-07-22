<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Question;
use Exception;
use Illuminate\Http\Request;

class AdminCatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cats=Cat::orderByDesc("id")->paginate(15);
        return view("admin.cat.index",compact("cats"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "hi";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name_en"=>"required|string|max:250",
            "name_ar"=>"required|string|max:50"
        ]);
        Cat::create([
            "name"=>json_encode([
                "en" => $request -> name_en,
                "ar" => $request -> name_ar
            ]),
        ]);
        $request->session()->flash("msg","created successd");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
            "name_en"=>"required|string|max:250",
            "name_ar"=>"required|string|max:50"
        ]);
        Cat::where("id",$id)->update([
            "name"=>json_encode([
                "en" => $request -> name_en,
                "ar" => $request -> name_ar
            ]),
        ]);
        $request->session()->flash("msg","updated successd");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id ,Request $request)
    {
        
        try{
            Cat::where("id",$id)->delete();
            $msg="done deleted";
        }catch(Exception $e){
            $msg="cant deleted";
        }
        
        $request->session()->flash("msg",$msg);
        return back();
    }
    public function toggle($id){
        $cat=Cat::where("id",$id)->first();
        
        Cat::where("id",$id)->update([
            "active" => ! $cat->active,
        ]);
        return redirect()->back();
    }
}
