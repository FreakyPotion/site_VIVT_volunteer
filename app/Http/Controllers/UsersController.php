<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\EventsController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function load_user_data() {
        $users = User::where('User_ID', '=', Auth::id())->get();
        return view('profile', compact('users'));
    }

    public function upload_avatar(Request $request) {
        try {
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:8192'
            ]);
    
            $user = Auth::user();
            $path = $request->file('avatar')->store('avatars', 'public');
    
            $user->update(['Фото профиля' => $path]);
    
            return response()->json([
                'success' => true,
                'avatarUrl' => Storage::url($path)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ошибка на сервере: ' . $e->getMessage()
            ], 500);
        }
    }
}
