<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->status === 'suspended') {
            Auth::logout();
            return redirect('/login')->withErrors(['Your account is suspended.']);
        }
        return view('home');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // ... other fields ...
        $user->save();
        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function editUser($id) {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    public function updateUser(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // ... other fields ...
        $user->save();
        return redirect()->route('admin.users')->with('success', 'User updated!');
    }

    public function deleteUser($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted!');
    }

    public function toggleUserStatus($id) {
        $user = User::findOrFail($id);
        $user->status = $user->status === 'active' ? 'suspended' : 'active';
        $user->save();
        return redirect()->route('admin.users')->with('success', 'User status updated!');
    }
}
