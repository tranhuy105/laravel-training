<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request, $locale)
    {
        if (!in_array($locale, ['en', 'vi'])) {
            abort(404);
        }

        Session::put('lang', $locale);

        return redirect()->back();
    }
}
