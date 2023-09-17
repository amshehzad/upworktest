<?php

namespace App\Http\Controllers;

use App\Mail\AccountSuspendedMail;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index()
    {
        $users = User::paginate(25);
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $data = array();
        $data['route'] = route('users.store');
        return view('user.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email|max:100',
            'password' => 'required|max:20|min:6',
        ]);

        $request->merge([
            'password' => bcrypt($request->password)
        ]);

        User::create($request->only('name', 'email', 'password'));

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
    }

    public function edit(User $user)
    {
        $data = array();
        $data['route'] = route('users.update', $user);
        $data['user'] = $user;
        $data['method'] = 'PUT';

        return view('user.form', $data);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users,email,'. $user->id,
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->route('users.index');
    }

    public function toggleAccess(User $user)
    {
        $user->update([
            'active' => !$user->active
        ]);

        $message = 'User access has been '. ($user->active ? 'granted' : 'cancelled');

        if ( ! $user->active) {
            \Mail::to($user)->send(new AccountSuspendedMail());
        }

        return redirect()->route('users.index')->with('success', $message);
    }
}
