<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try {

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => 'required',
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required'],
                'address' => 'required',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'username' => $request->username
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


                return redirect(route('login'));
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}
