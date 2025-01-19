<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        $search = $request->input('search');

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%');
        }

        $users = $query->orderByDesc('id')->paginate(5);
        $total = User::count();

        return view('admin.users.index', compact('users', 'total', 'search'));
    }  
    
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|max:16',
        'usertype' => 'required|in:admin,user',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'usertype' => $request->usertype,
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }


    public function edit(User $user)
    {
        return view('admin.users.update', compact('user'));
    }

    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required',
        'email' => [
            'required',
            'email',
            Rule::unique('users')->ignore($user->id),
        ],
        'password' => 'nullable|min:8',
        'usertype' => 'required|in:admin,user',
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password ? Hash::make($request->password) : $user->password,
        'usertype' => $request->usertype,
    ];

    $user->update($data);

    return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
}

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
