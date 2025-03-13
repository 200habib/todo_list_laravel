<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('/blog')-> name('blog.')-> group( function () {
    


    Route::get('/', function (Request $request) {
        return [
            'link' => \route('blog.show', ['slug' => 'article', 'id' => 13]),
        ];
    })->name('index');
    
    Route::get('/{slug}-{id}', function (string $slug, string $id) {
        return [
            'slug' => $slug,
            'id' => $id,
        ];
    })->where([
        'id' => '[0-9]+',
        'slug' => '[a-z0-9\-]+',
    ]
    ) ->name('show');

}
);

