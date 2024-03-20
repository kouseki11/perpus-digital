<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'role' => 'required',
            'address' => 'required',
        ]);

        if($request->password) {
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'address' => $request->address,
                'password' => bcrypt($request->password),
            ]);
        }

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        if ($request->role == "administrator") {
            $user->assignRole("administrator");
            event(new Registered($user));


            return redirect(route('admin.users.index'));
        } else if ($request->role == "staff") {
            $user->assignRole("staff");
            event(new Registered($user));


            return redirect(route('admin.users.index'));
        } else {
            $user->assignRole("loaner");
            event(new Registered($user));


            return redirect(route('admin.users.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
