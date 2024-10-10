<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    function user_profile(){
        return view('backend.user.user_profile');
    }
    function user_profile_update($id){
        $users = User::find($id);
        return view('backend.user.user_profile_update',[
            'users' => $users,
        ]);
    }
    function user_profile_update_post(Request $request , $id){
        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';
        // echo '<br>';
        // die;
        
        if ($request->profile_pic) {
            if (User::find($id)->profile_pic) {
                $old_profile_pic = (public_path('backend/user/') . User::find($id)->profile_pic);
                unlink($old_profile_pic);
            }
            $profile_pic = $request->profile_pic;
            $profile_pic_ext = $profile_pic->extension();
            $profile_pic_file = $id . '_' . 'profile_pic' . '.' . $profile_pic_ext;
            Image::make($profile_pic)->save(public_path('backend/user/'. $profile_pic_file));
            User::find($id)->update([
                'profile_pic' => $profile_pic_file,
            ]);
        }
        if ($request->cover_pic) {
            if (User::find($id)->cover_pic) {
                $old_cover_pic = (public_path('backend/user/') . User::find($id)->cover_pic);
                unlink($old_cover_pic);
            }
            $cover_pic = $request->cover_pic;
            $cover_pic_ext = $cover_pic->extension();
            $cover_pic_file = $id . '_' . 'cover_pic' . '.' . $cover_pic_ext;
            Image::make($cover_pic)->save(public_path('backend/user/'. $cover_pic_file));
            User::find($id)->update([
                'cover_pic' => $cover_pic_file,
            ]);
        }

        User::find($id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'country' => $request->country,
            'city' => $request->city,
            'zip' => $request->zip,
            'bio' => $request->bio,
        ]);
        if ($request->password) {
            $request->validate([
                'password' => Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
            ]);
            if (password_verify($request->password, User::find($id)->password )) {
                return back()->with('pass_match' , "It's look like your old password, Please choose a different password.");
            }
            else{
                User::find($id)->update([
                    'password' => bcrypt($request->password),
                ]);                              
            }
        }
        return back()->with('updated' , 'Your Information Updated Successfully');
    }
}
