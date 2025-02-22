<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin/dashboard/index');
    }

    public function change()
    {
        return view('admin/dashboard/change');
    }

    public function change_password(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        DB::table('users')  
                ->where('id', Auth::User()->id)
                ->update([
                'password' => bcrypt($request->get('new-password'))]);

        // $user = Auth::user();
        // $user->password = bcrypt($request->get('new-password'));
        // $user->save();

        return redirect('/admin/change')->with("success","Ganti Password Berhasil !");

    }
}
