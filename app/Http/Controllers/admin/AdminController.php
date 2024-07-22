<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles=Role::get();
        return view("admin.admins.createAdmin",compact("roles"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=> "required|string",
            "email"=> "required|email",
            "password" => "required|min:7|max:20|confirmed",
            "password_confirmation" => "required|min:7|max:20",
            "role_id"=> "required|exists:roles,id",
        ]);

        User::create([
            "name" => $request ->name,
            "email" => $request ->email,
            "password" => Hash::make($request ->password),
            "role_id" => $request->role_id,
        ]);
        return redirect(url("dashboard/admin"));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
