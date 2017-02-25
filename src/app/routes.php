<?php

use Http\Route;
use Render\View;
use Controllers\PostController;

Route::get('/', function() {
    return View::render('home', ['CONTENT' => '_Smula_']);
});

Route::get('/p/{post}', function($data) {
    $post = PostController::getPost($data);
    return View::render('post', $post);
});
