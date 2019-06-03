<?php 
    use App\Core\Route;
     return [ 
        Route::get('|^user/login/?$|',                  'Main', 'getLogin'),
        Route::post('|^user/login/?$|',                 'Main', 'postLogin'),

        Route::get('|^user/profile/?$|',                'UserDashboard', 'index'),

        Route::get('|^category/([0-9]+)/?$|',           'Category', 'show'),
        Route::get('|^book/([0-9]+)/?$|',               'Book',  'show'),
        
        # API rute:
        Route::get('|^api/book/([0-9]+)/?$|',           'ApiBook',  'show'),

        Route::get('#^.*$#', 'Main', 'home')
    ];