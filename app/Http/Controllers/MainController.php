<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    public function returnMessage($message){
        session()->flash("msg",$message);
        return redirect()->back();
    }
    public function ToggleMain($model){
        $val=$model->first();
        $model->update([
            "active" => ! $val->active,
        ]);
        return redirect()->back();
    }

    public function editPhoto($img,$request){
        if ($request->hasFile('img')) {
            
            $oldImage = $img;
            Storage::disk('public')->delete($oldImage);
        
            $newImagePath = $request->file('img')->store('skills', 'public');
            return $newImagePath;
    } else {
        $newImagePath = $img;
        return $newImagePath;
    }}

    public function deletePhoto($input){
        $oldImage = $input->img;
            Storage::disk('public')->delete($oldImage);
    }
}
