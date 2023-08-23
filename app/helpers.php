<?php

use Illuminate\Support\Facades\Auth;

if (! function_exists('test')) {
    function test() {
        echo Auth::user();
    }
}