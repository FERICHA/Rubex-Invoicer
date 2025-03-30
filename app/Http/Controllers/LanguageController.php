<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request)
    {
        $locale = $request->input('locale');
        session()->put('locale', $locale);

       
        return redirect()->back();
    }
}
