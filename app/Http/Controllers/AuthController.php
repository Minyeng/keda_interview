<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request) {
        if(!auth()->attempt(request(['email', 'password']))) {
            return response()->json(['error' => 'login error']);
        }

        return response()->json(['success' => auth()->user()->makeHidden(['password'])]);
    }

    public function getUserList() {        
        return response()->json(User::get()->makeHidden(['password', 'api_token']));
    }

    public function delete($id) {
        $user = User::with('userType')->whereHas('userType', function($q) {
            $q->where(['name' => 'Customer']);
        })->where(['id' => $id])->first();
        
        if ($user) {
            $user->delete();
            return response()->json(['success' => 'User has been deleted']);
        }
        return response()->json(['error' => 'Failed']);
        
    }

    public function deleteAll() {
        $users = User::with('userType')->whereHas('userType', function($q) {
            $q->where(['name' => 'Customer']);
        });
        
        $users->delete();
        return response()->json(['success' => 'Users have been deleted']);
    }

    public function logout() {
        auth()->logout();
    }
}
