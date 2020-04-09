<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Str;
use Validator;

class EntranceController extends Controller
{

    public function index(Request $request) {
        $request->session()->forget('user');
        $locale = $request->session()->get('locale');
        if(!$locale) {
            $locale = config('app.locale');
        }
        return view('entrance.index', [
            'prefix' => $request->session()->get('prefix'),
            'locales' => config('app.locales'),
            'locale' => $locale
        ]);
    }


    public function check_password(Request $request) {
        $user = User::where('prefix', $request->get('prefix'))->first();
        if($user && Hash::check($request->get('password'), $user->password)) {
            $request->session()->put('user', [
                'id' => $user->id
            ]);
            return redirect('/editor');
        }
        return redirect()->back()->with([
            'prefix' => $request->get('prefix'),
            'error_password' => true
        ]);
    }


    public function new_prefix(Request $request) {
        $validator = Validator::make($request->all(), [
            'captcha' => 'required|captcha'
        ]);       
        if($validator->fails()) {
            return redirect()->back()->with([
                'error_captcha' => true
            ]);            
        }

        $password = Str::random(config('user.password_length'));
        $user = User::create([
            'prefix' => $this->generatePrefix(),
            'password' => Hash::make($password)
        ]);
        $request->session()->put('user', [
            'id' => $user->id,
            'prefix' => $user->prefix,
            'password' => $password
        ]);
        return redirect('/credentials');
    }


    private function generatePrefix() {
        do {
            $prefix = \Str::random(config('user.prefix_length'));
        } while (User::where('prefix', $prefix)->first());
        return $prefix;
    }


}