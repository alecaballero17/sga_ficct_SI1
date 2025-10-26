<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('inicio'); });


use Illuminate\Support\Facades\DB;

Route::get('/test-db', function () {
    try {
        $result = DB::select('select version()');
        return response()->json(['ok' => true, 'version' => $result]);
    } catch (\Throwable $e) {
        return response()->json(['ok' => false, 'error' => $e->getMessage()]);
    }
});
