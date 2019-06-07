<?php 
    use App\Core\Route;
     return [ 
        Route::get('|^user/login/?$|',                      'Main',                   'getLogin'),
        Route::post('|^user/login/?$|',                     'Main',                   'postLogin'),

        Route::get('|^user/dashboard/?$|',                  'UserDashboard',          'index'),

        Route::get('|^category/([0-9]+)/?$|',               'Category',               'show'),
        Route::get('|^book/([0-9]+)/?$|',                   'Book',                   'show'),
        
        # API rute:
        Route::get('|^api/book/([0-9]+)/?$|',               'ApiBook',                'show'),

        # User role:
        Route::get('|^user/categories/?$|',                 'UserCategoryManagment',  'categories'),
        Route::get('|^user/categories/edit/([0-9]+)/?$|',   'UserCategoryManagment',  'getEdit'),
        Route::post('|^user/categories/edit/([0-9]+)/?$|',  'UserCategoryManagment',  'postEdit'),
        Route::get('|^user/categories/add/?$|',             'UserCategoryManagment',  'getAdd'),
        Route::post('|^user/categories/add/?$|',            'UserCategoryManagment',  'postAdd'),


        Route::get('#^.*$#',                                'Main',                   'home')
    ];