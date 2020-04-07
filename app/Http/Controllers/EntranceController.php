<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntranceController extends Controller
{

    public function index(Request $request) {
        return view('entrance.index');
    }

    public function check_prefix(Request $request) {
        $prefix = $request->get('prefix');
        $user = User::where('prefix', $prefix);
        if($user) {
            return redirect('/ask_password')->with('prefix', $prefix);
        }
        $password = Str::random(10);
        User::create([
            'prefix' => $prefix,
            'password' => Hash::make($password)
        ]);
        return redirect('/show_password')->with([
            'prefix' => $prefix,
            'password' => $password
        ]);
    }

    public function ask_password(Request $request) {
        return view('entrance.ask_password');
    }

    public function show_password(Request $request) {
        return view('entrance.show_password');
    }    
    
    public function check_password(Request $request) {
        $user = User::where('prefix', $prefix);
        if(!$user) {
            return redirect()->back()->with('prefix', $prefix)->withErrors([
                'password' => 'Wrong password'
            ]);
        }        
        return redirect('/editor')->with([
            'prefix' => $prefix,
            'password' => $password
        ]);        
    }

}