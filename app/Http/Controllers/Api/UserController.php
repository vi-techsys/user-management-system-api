<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    public function profile()
    {
        $user = Auth::user();
        return $this->sendResponse($user, 'User Profile');
    }

    public function listUsers(Request $request)
    {
        $perPage = $request->input('per_page', 5);

        $users = User::paginate($perPage);

        return $this->sendResponse([
            'users' => $users->items(),
            'previous_page_url' => $users->previousPageUrl(),
            'next_page_url' => $users->nextPageUrl(),
            'totalCount' => $users->total()
        ], 'List of Users');
    }

    public function deleteUser($userId)
    {
        try {
            $user = User::findOrFail($userId);
            $user->delete();
            return $this->sendResponse($user, 'User Deleted');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->sendError('User not found', [], 404);
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => [
                'required',
                'string',
                'min:8',             // must be at least 8 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'confirm_password' => ['required', 'same:new_password'],
        ]);

        $user = auth()->user();
        // Verify the current password
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return response()->json(['error' => 'Current password is incorrect'], 401);
        }

        // Change the password
        $user->password = Hash::make($request->input('new_password'));
        $user->save();
        return $this->sendResponse($user, 'Password changed succesfully');
    }
    
    public function editProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
        ]);
        $user = auth()->user();
        $user->name = $request['name'];
        $user->save();
        return $this->sendResponse($user, 'Profile changed succesfully');
    }
}
