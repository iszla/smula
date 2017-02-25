# smula
Minimal framework for Markdown powered websites

Requirements

* Parsedown
* Twig

Written in PHP

Easily extendable with new controllers, just run `smula make:controller NameController` to generate a NameController.

# Routing
You can add routes to the file /app/routes.php.

Example routes

```php
// Manually passing data to the view
Route::get('/', function() {
    $files = Posts::allTidy();
    return View::render('home', ['CONTENT' => '_Smula_', 'FILES' => $files]);
});

// Passing a post to the view
Route::get('/p/{post}', function($data) {
    $post = Posts::get($data);
    return View::render('post', $post);
});

// A pages route
Route::get('/about', function() {
    $page = Pages::get('about');
    return View::render('page', $page);
});
```

# Posts
Posts can be put in the /posts folder. The naming convention is YYYYMMDD-name-of-your-post.md. These will be automatically be picked up by the post controller and displayed new -> old order.

# Pages
Specific pages can be put in the /pages folder. For example an `about` page can be useful here.
