<?php
namespace App\Http\traits;

trait Api {

    public function SuccessMsg(string $msg="",int $code= 200){
        return response()->json([
            "msg"=>$msg,
            'errors'=>(object)[],
            'data'=>(object)[],
        ],
        $code
    );
    }

    public function ErorrMsg(Array $errors,string $msg="",int $code= 422){
        return response()->json([
            "msg"=>$msg,
            'errors'=>$errors,
            'data'=>(object)[],
        ],
        $code
    );
    }
    public function Data(Array $data,string $msg="",int $code= 200){
        return response()->json([
            "msg"=>$msg,
            'errors'=>(object)[],
            'data'=>$data,
        ],
        $code
    );
    }


}