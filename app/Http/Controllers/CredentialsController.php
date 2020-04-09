<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CredentialsController extends Controller
{
    public function show(Request $request) {
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
        return view('credentials.index', [
            'user' => $user,
            'conf' => $conf
        ]);
    }    


    public function confirm(Request $request) {
        $user = $request->session()->get('user');
        $request->session()->put('user', [
            'id' => $user['id']
        ]);
        return redirect('/editor');
    }
}
