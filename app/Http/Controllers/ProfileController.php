<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user= $user;
    }

    public function profile_edit($id)
    {
        $user = User::find($id);
        // $user = $this->user->findOrFail(Auth::user()->id);
        return view('profile_edit', compact('user'));
    }

//     public function profile_update(Request $request, $id)
// {
//     $request->validate([
//         'name' => 'required|unique:users,name,' . Auth::user()->id,
//         'email' => 'required|email|unique:users,email,' . Auth::user()->id,
//         'avatar' => 'nullable|image|max:1048'
//     ]);

//     $user = Auth::user();
//     $user->name = $request->name;
//     $user->email = $request->email;

//     if ($request->hasFile('avatar')) {
//         if ($user->avatar) {
//             Storage::disk('public')->delete($user->avatar);
//         }
//         $avatarPath = $request->file('avatar')->store('avatars', 'public');
//         $user->avatar = $avatarPath;
//     }

//     $user->save();

//     if ($request->expectsJson()) {
//         return response()->json([
//             'message' => 'Profile updated successfully!',
//             'avatarUrl' => Storage::url($user->avatar)
//         ]);
//     }

//     return redirect()->route('myrecipe', $user->id)->with('success', 'Profile updated successfully!');
// }

    public function profile_update(Request $request, $id)
    {
        $user = $this->user->findOrFail($id);

        if(Auth::user()->id !== $user->id && Auth::user()->role_id === 2) 
        {
            return redirect()->route('home');
        }

        $request->validate([
            'name' => 'required|min:1|unique:users,name,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'avatar' => 'mimes:jpeg,png,jpg,gif,svg|max:1048'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('avatar')) {
            $user->avatar = 'data:image/' . $request->avatar->extension() . ';base64,' . base64_encode(file_get_contents($request->avatar));
            // if ($user->avatar) {
            //     $oldAvatarPath = public_path('avatars/' . basename($user->avatar));
            //     if (file_exists($oldAvatarPath)) {
            //         unlink($oldAvatarPath);
            //     }
            // }

            // $avatarFile = $request->file('avatar');
            // $avatarPath = 'avatars/' . uniqid() . '.' . $avatarFile->getClientOriginalExtension();
            // $avatarFile->move(public_path('avatars'), $avatarPath);
            // $user->avatar = $avatarPath;
        }

        $user->save();

        // if ($request->expectsJson()) {
        //     return response()->json([
        //         'message' => 'Profile updated successfully!',
        //         'avatarUrl' => asset($user->avatar)
        //     ]);
        // }

        return redirect()->back();
    }


}
