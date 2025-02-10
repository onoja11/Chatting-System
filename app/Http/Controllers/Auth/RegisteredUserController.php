<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $departments = ['Software Eng.', 'Computer Sci.', 'Medicine', 'Law', 'Mass Com.'];
        $levels = ['100', '200', '300', '400', '500'];
        return view('auth.register', compact('departments', 'levels'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {        
        $levels = ['100', '200', '300', '400', '500'];
        $departments = ['Software Eng.', 'Computer Sci.', 'Medicine', 'Law', 'Mass Com.'];

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'profile_pic' => 'image|mimes:png,jpg,jpeg|max:1024',
            'department' => ['required', 'string', 'max:255', Rule::in($departments)],
            'level' => ['required', 'numeric', 'max:500', Rule::in($levels) ],
            'university_id' => ['required', 'string', 'max:255', 'unique:users,university_id_number']
        ]);
        if ($request->profile_pic !==null) {
            $profilePic = $request->file('profile_pic');
            $profileExt = $profilePic->extension();
            $profileName = 'profile_pic' . time()  . mt_srand() . "." . $profileExt;
            $profilePic->move('profile_pic/', $profileName);
        }
        else{
            $profileName = $request->profile_pic;
        }
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
            'profilePic' => $profileName !== '' ? $profileName : "" ,
            'department' => $request->department,
            'university_id_number' => $request->university_id
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
