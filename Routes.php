<?php 
    use App\Core\Route;
     return [ 
        Route::get('|^user/login/?$|',                                  'Main',                   'getLogin'),
        Route::post('|^user/login/?$|',                                 'Main',                   'postLogin'),
        Route::get('|^user/logout/?$|',                                 'Main',                   'getLogout'),

        # Student
        Route::get('|^student/dashboard/?$|',                           'StudentDashboard',       'index'),
        Route::get('|^student/book/search/?$|',                         'StudentDashboard',       'getSearch'),
        Route::post('|^student/book/search/?$|',                        'StudentDashboard',       'postSearch'),
        Route::post('|^student/book/cat/search/?$|',                    'StudentDashboard',       'catSearch'),
        Route::get('|^student/debt/?$|',                                'StudentDashboard',       'debt'),

        Route::get('|^student/book/([0-9]+)/?$|',                       'StudentBookMan',         'getSearch'),
        Route::post('|^student/book/([0-9]+)/?$|',                      'StudentBookMan',         'postSearch'),

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

        # Bibliotekar - rezervacije
        Route::get('|^librarian/reservations/?$|',                      'LibrarianReservMan',           'getRes'),
        Route::post('|^librarian/reservations/?$|',                     'LibrarianReservMan',           'postRes'),

        Route::get('|^api/reservations/add?$|',                         'LibrarianReservApi',           'getAdd'),
        Route::post('|^api/reservations/add?$|',                        'LibrarianReservApi',           'postAdd'),

        Route::get('|^librarian/reservations/remove?$|',                'LibrarianReservMan',           'getRemove'),
        Route::post('|^librarian/reservations/remove?$|',               'LibrarianReservMan',           'postRemove'),

        Route::get('|^librarian/stats/?$|',                             'LibrarianDashboard',           'getStats'),
        Route::post('|^librarian/stats/?$|',                            'LibrarianDashboard',           'postStats'),

        Route::get('|^librarian/stud/reservations/?$|',                 'LibrarianReservMan',           'getStudRes'),

        Route::get('|^librarian/approve/res/([0-9]+)/?$|',              'LibrarianReservMan',           'approve'),
        Route::post('|^librarian/approve/res/([0-9]+)/?$|',             'LibrarianReservMan',           'postApp'),

        Route::get('#^.*$#',                                            'Main',                         'getLogin')
    ];