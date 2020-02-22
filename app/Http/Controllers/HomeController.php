<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the change password page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changePasswordPage()
    {
        return view('auth.change');
    }

    /**
     * Show the user profile page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userProfilePage()
    {
        return view('auth.profile');
    }

    /**
     * Update User Password.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldpassword' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'captcha' => 'required|captcha',
        ],
        [
            'captcha.captcha' => 'Please enter the correct captcha.',
        ]);
        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::findOrfail(Auth::user()->id);
        if(Hash::check($request->input('oldpassword'), $user->password))
        {
            $user->update([
                'password' => Hash::make($request->input('password'))
            ]);
            return redirect('change/password')->with('success', 'Password updated successfully!');
        }
        return redirect('change/password')->with('error', 'Please enter correct old password!');
    }

    /**
     * Update User Profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'address' => 'required|string',
            'captcha' => 'required|captcha',
        ],
        [
            'captcha.captcha' => 'Please enter the correct captcha.',
        ]);
        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::where('id', Auth::user()->id)->update([
            'name' => $request->input('name'),
            'address' => $request->input('address')
        ]);
        return redirect('profile')->with('success', 'Profile updated successfully!');
    }
}
