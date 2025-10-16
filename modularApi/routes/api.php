<?php
use Illuminate\Support\Facades\Route;
Route::get('/', function(){
    return [
        'success'=> true,
        'data'=> [
            'service'=> 'modularApi',
            'version'=> '1.0',
        ],

        
    ];
});