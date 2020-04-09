<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Str;

class EntranceController extends Controller
{

    public function index(Request $request) {
        $request->session()->forget('user');
        return view('entrance.index', [
            'prefix' => $request->session()->get('prefix')
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
            'error' => true
        ]);
    }


    public function new_prefix(Request $request) {
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

    
    public function show_credentials(Request $request) {
        $user = $request->session()->get('user');
        if(!$user) {
            return redirect('/');
        }
        if(!isset($user['prefix'])) {
            return redirect('/editor');
        }
        $conf = [
            'prefix' => $user['prefix'],
            'password' => $user['password'],
            'host' => $request->getSchemeAndHttpHost()
        ];
        return view('entrance.credentials', [
            'user' => $user,
            'conf' => $conf
        ]);
    }    

}