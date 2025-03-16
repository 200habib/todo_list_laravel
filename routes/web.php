<?php

use App\Models\Post;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});




