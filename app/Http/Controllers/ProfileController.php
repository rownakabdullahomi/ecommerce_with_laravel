<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Image;

class ProfileController extends Controller
{
    function index(){
        return view('profile.index');
    }
    function namechange(Request $request){
        $user_id = Auth::id();
        $old_name = Auth::user()->name;
        $new_name = $request->name;
        User::find($user_id)->update([
            "name" => $new_name
        ]);
        return back()->with('updatestatus', 'Name updated from '. $old_name .' to '. $new_name .' successfully !!');
    }
    function passwordchange(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        //strong password validation start
        $uppercase = preg_match('@[A-Z]@', $request->password);
        $lowercase = preg_match('@[a-z]@', $request->password);
        $number    = preg_match('@[0-9]@', $request->password);
        if (!$uppercase || !$lowercase || !$number || strlen($request->password) < 8) {
            // tell the user something went wrong
            return back()->with('passwordweak', "Password must have a number, uppercase letter, lowercase letter and minimum 8 character !!");
        }
        //strong password validation end
        else{
            if (Hash::check($request->old_password, Auth::user()->password)) {
                User::find(Auth::id())->update([
                    'password' => bcrypt($request->password)
                ]);
                return back()->with('passwordupdate', "Password changed successfully !!");
            } else {
                return back()->with('oldpassworderror', "Old password does not match !!");
            }
        }

        // $user_id = Auth::id();
        // $old_name = Auth::user()->name;
        // $new_name = $request->name;
        // User::find($user_id)->update([
        //     "name" => $new_name
        // ]);
        // return back()->with('updatestatus', 'Name updated from '. $old_name .' to '. $new_name .' successfully !!');
    }

    function photochange(Request $request){
        $request->validate([
            //'new_profile_photo' => 'required | mimes:jpg,bmp,png'
            'new_profile_photo' => 'required| image| file|max:5000| dimensions:min_width=100, min_height=200'
        ]);
        $new_profile_photo = $request->file('new_profile_photo');
        $extention =  $new_profile_photo->getClientOriginalExtension();
        $new_profile_photo_name = Auth::id() . "." . $extention;
        if(Auth::user()->profile_photo != "default.jpg"){
           $path = public_path(). "/uploads/profile_photos/" . Auth::user()->profile_photo;
           unlink($path);
        }

        Image::make($new_profile_photo)->save(base_path('public/uploads/profile_photos/' . $new_profile_photo_name));
        //database update start
        User::find(Auth::id())->update([
            'profile_photo' => $new_profile_photo_name
        ]);
        //database update end
        return back()->with('photouploadstatus', "Profile photo updated successfully !!");
    }
}
