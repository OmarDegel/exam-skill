<?php
namespace App\Http\traits;

use Illuminate\Support\Facades\Storage;

trait Media{

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