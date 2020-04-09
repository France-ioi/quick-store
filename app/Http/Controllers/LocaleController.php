<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{

    public function set(Request $request) {
        $locale = $request->get('locale');
        $locales = config('app.locales');
        $locale = isset($locales[$locale]) ? $locale : config('app.locale');        
        $request->session()->put('locale', $locale);
        
        return redirect()->back();
    }
}
