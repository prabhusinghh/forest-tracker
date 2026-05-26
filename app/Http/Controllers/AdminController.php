<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function pendingUsers()
    {
        $users = User::where('is_approved', false)->where('role', 'conservationist')->get();

        return view('admin.pending-users', compact('users'));
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'is_approved' => true
        ]);

        return redirect()->back();
    }
}
