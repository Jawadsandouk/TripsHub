<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Config;

Route::get('/test-locale', function () {
    $locale = request()->cookie('locale', 'en');
    
    Config::set('app.locale', $locale);
    
    $key = 'Dashboard';
    $translated = __($key);
    
    return "Cookie: $locale | Config: " . config('app.locale') . " | Translated: $translated";
});

Route::get('/set-locale/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'ar'])) {
        abort(400);
    }
    
    return redirect('/test-locale')->withCookie(cookie('locale', $locale, 43200));
});