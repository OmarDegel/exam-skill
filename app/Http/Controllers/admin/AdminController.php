<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use App\Models\User;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\MainController;

class AdminController extends MainController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $superadminRole=Role::where("name","superadmin")->first();
        $adminRole=Role::where("name","admin")->first();
        $admins = User::whereIn("role_id", [$superadminRole->id, $adminRole->id])
        ->orderByDesc("id")
        ->paginate(10);
        return view("admin.admins.index",compact("admins"));
    }

    
    public function create()
    {
        $roles=Role::get();
        return view("admin.admins.createAdmin",compact("roles"));
    }

    
    public function store(AdminRequest $request)
    {
        
        User::create([
            "name" => $request ->name,
            "email" => $request ->email,
            "password" => Hash::make($request ->password),
            "role_id" => $request->role_id,
        ]);
        
        return redirect(url("dashboard/admin"));
    }

    
    public function promote(string $id)
    {
        $admin=User::where('id',$id)->first();
        $admin->update([
            "role_id"=>Role::where("name" , "superadmin")->first()->id,
        ]);
        return redirect()->back();
    }


    public function demote(string $id)
    {
        $admin=User::where('id',$id)->first();
        $admin->update([
            "role_id"=>Role::where("name" , "admin")->first()->id,
        ]);
        return redirect()->back();
    }
}
