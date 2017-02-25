<?php

use Http\Route;
use Render\View;
use Controllers\PostController as Posts;

Route::get('/', function() {
    $files = Posts::allTidy();
    return View::render('home', ['CONTENT' => '_Smula_', 'FILES' => $files]);
});

Route::get('/p/{post}', function($data) {
    $post = Posts::get($data);
    return View::render('post', $post);
});
