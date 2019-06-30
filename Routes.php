<?php 
    use App\Core\Route;
     return [ 
        Route::get('|^user/login/?$|',                                  'Main',                   'getLogin'),
        Route::post('|^user/login/?$|',                                 'Main',                   'postLogin'),

        # Student
        Route::get('|^student/dashboard/?$|',                           'StudentDashboard',       'index'),
        Route::get('|^student/book/search/?$|',                         'StudentDashboard',       'getSearch'),
        Route::post('|^student/book/search/?$|',                        'StudentDashboard',       'postSearch'),
        Route::get('|^student/debt/?$|',                                'StudentDashboard',       'debt'),

        # Bibliotekar   
        Route::get('|^librarian/dashboard/?$|',                         'LibrarianDashboard',     'index'),

        Route::get('|^category/([0-9]+)/?$|',                           'Category',               'show'),
        Route::get('|^book/([0-9]+)/?$|',                               'Book',                   'show'),
        
        # API rute:
        Route::get('|^api/book/([0-9]+)/?$|',                           'ApiBook',                'show'),

        # Bibliotekar role:
        Route::get('|^librarian/categories/?$|',                        'LibrarianCategoryManagment',  'categories'),
        Route::get('|^librarian/categories/edit/([0-9]+)/?$|',          'LibrarianCategoryManagment',  'getEdit'),
        Route::post('|^librarian/categories/edit/?$|',                  'LibrarianCategoryManagment',  'postEdit'),
        Route::get('|^librarian/categories/add/?$|',                    'LibrarianCategoryManagment',  'getAdd'),
        Route::post('|^librarian/categories/add/?$|',                   'LibrarianCategoryManagment',  'postAdd'),

        Route::get('|^librarian/books/?$|',                             'LibrarianBookManagment',       'books'),
        Route::get('|^librarian/book/([0-9]+)/?$|',                     'LibrarianBookManagment',       'bookId'),
        Route::get('|^librarian/book/edit/?$|',                         'LibrarianBookManagment',       'getEdit'),
        Route::get('|^librarian/book/edit/([0-9]+)/?$|',                'LibrarianBookManagment',       'getEdit'),
        Route::post('|^librarian/book/edit/([0-9]+)/?$|',               'LibrarianBookManagment',       'postEdit'),
      
        Route::post('|^librarian/book/add/?$|',                         'LibrarianBookManagment',       'postAdd'),
        Route::post('|^librarian/book/search/?$|',                      'LibrarianBookManagment',       'postSearch'),

        Route::get('#^.*$#',                                            'Main',                   'home')
    ];