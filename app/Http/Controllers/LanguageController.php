<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    public function setLocale(string $locale): RedirectResponse
    {
        if (in_array($locale, ['pt', 'en'])) {
            session()->put('locale', $locale);
            App::setLocale($locale);            
        }

        return redirect()->back();
    }
}
