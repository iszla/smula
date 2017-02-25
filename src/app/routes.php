<?php

use Http\Route;
use Render\View;
use Controllers\PostController;

Route::get('/', function() {
    $files = PostController::getAll();
    return View::render('home', ['CONTENT' => '_Smula_', 'FILES' => $files]);
});

Route::get('/p/{post}', function($data) {
    $post = PostController::getPost($data);
    return View::render('post', $post);
});
