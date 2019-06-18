<?php 
    use App\Core\Route;
     return [ 
        Route::get('|^user/login/?$|',                                  'Main',                   'getLogin'),
        Route::post('|^user/login/?$|',                                 'Main',                   'postLogin'),

        # Student
        Route::get('|^student/dashboard/?$|',                           'StudentDashboard',       'index'),

        # Bibliotekar   
        Route::get('|^librarian/dashboard/?$|',                         'LibrarianDashboard',     'index'),

        Route::get('|^category/([0-9]+)/?$|',                           'Category',               'show'),
        Route::get('|^book/([0-9]+)/?$|',                               'Book',                   'show'),
        
        # API rute:
        Route::get('|^api/book/([0-9]+)/?$|',                           'ApiBook',                'show'),

        # Bibliotekar role:
        Route::get('|^librarian/categories/?$|',                        'LibrarianCategoryManagment',  'categories'),
        Route::get('|^librarian/categories/edit/([0-9]+)/?$|',          'LibrarianCategoryManagment',  'getEdit'),
        Route::post('|^librarian/categories/edit/([0-9]+)/?$|',         'LibrarianCategoryManagment',  'postEdit'),
        Route::get('|^librarian/categories/add/?$|',                    'LibrarianCategoryManagment',  'getAdd'),
        Route::post('|^librarian/categories/add/?$|',                   'LibrarianCategoryManagment',  'postAdd'),


        Route::get('#^.*$#',                                            'Main',                   'home')
    ];