<?php 
    use App\Core\Route;
     return [ 
        Route::get('|^category/([0-9]+)/?$|',   'Category', 'show'),
        Route::get('|^book/([0-9]+)/?$|',       'Book',  'show'),
        
        Route::get('#^.*$#', 'Main', 'home')
    ];