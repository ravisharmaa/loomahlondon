<?php

Route::group(['prefix'=>'cms',                'as'=>'cms.',             'namespace'=>'Auth\\'], function(){
    $this->get('',                           ['as'=>'login',             'uses'=>'LoginController@getLogin']);
    $this->post('',                          ['as'=>'login',             'uses'=>'LoginController@login']);
    $this->get('logout',                     ['as'=>'logout',            'uses'=>'LoginController@logout']);
    $this->get('password/reset',             ['as'=>'reset.password',    'uses'=>'ResetPasswordController@showLinkRequestForm']);
});

$this->group(['prefix'=>'cms/',                 'as'=>'cms.',               'middleware'=>'auth',      'namespace'=>'Admin\\'], function() {
    $this->get('dashboard',                                 ['as'=>'dashboard',                                         'uses'=>'DashboardController']);
    /*Rug Designs*/

    $this->get('home',                                      ['as'=>'home',                                              'uses'=>'DashboardController@home']);
    $this->get('rug-designs',                               ['as'=>'rug-designs',                                       'uses'=>'RugDesignsController@index']);
    $this->get('rug-designs/add',                           ['as'=>'rug-designs.add',                                   'uses'=>'RugDesignsController@add']);
    $this->post('rug-designs/store',                        ['as'=>'rug-designs.store',                                 'uses'=>'RugDesignsController@store']);
    $this->get('rug-designs/show',                          ['as'=>'rug-designs.show-products',                         'uses'=>'RugDesignsController@show']);
    $this->get('rug-designs/delete/{id}',                   ['as'=>'rug-designs.delete',                                'uses'=>'RugDesignsController@delete']);
    $this->get('rug-designs/edit/{id}',                     ['as'=>'rug-designs.edit',                                  'uses'=>'RugDesignsController@edit']);
    $this->put('rug-designs/update/{id}',                   ['as'=>'rug-designs.update',                                'uses'=>'RugDesignsController@update']);
    $this->post('rug-designs/sort/product-order',           ['as'=>'rug-designs.sort.product-order',                    'uses'=>'RugDesignsController@sorter']);
    $this->post('rug-designs/set/product-status',           ['as'=>'rug-designs.set-status',                            'uses'=>'RugDesignsController@setStatus']);
    /*Colourways*/

    $this->get('rug-designs/colourway/{id}',                ['as'=>'rug-designs.colourway.add',                         'uses'=>'ColourwaysController@add']);
    $this->post('rug-designs/colourway/save',               ['as'=>'rug-designs.colourway.store',                       'uses'=>'ColourwaysController@store']);
    $this->get('rug-designs/colourway/show/{id}',           ['as'=>'rug-designs.colourway.show',                        'uses'=>'ColourwaysController@show']);
    $this->post('rug-designs/colourway/change_default',     ['as'=>'rug-designs.colourway.default_colourway',           'uses'=>'ColourwaysController@changeDefault']);
    $this->get('rug-designs/colourway/edit/{id}',           ['as'=>'rug-designs.colourway.edit',                        'uses'=>'ColourwaysController@edit']);
    $this->put('rug-designs/colourway/update/{id}',         ['as'=>'rug-designs.colourway.update',                      'uses'=>'ColourwaysController@update']);
    $this->get('rug-designs/colourway/delete/{id}',         ['as'=>'rug-designs.colourway.delete',                      'uses'=>'ColourwaysController@delete']);
    $this->post('rug-designs/colourway/change-order',       ['as'=>'rug-designs.colourway.change-order',                'uses'=>'ColourwaysController@changeOrder']);
});


Route::get('/',                                 ['as'=>'marcus-paul.home', 'uses'=>'Frontend\\FrontendController@home']);

    Route::group(['prefix'=>'',                 'as'=>'marcus-paul.',               'namespace'=>'Frontend\\'], function(){

        $this->get('rug-designs',               ['as'=>'rug-designs',                   'uses'=>        'FrontendController@rugDesigns']);
        $this->get('bespoke-rug-service',       ['as'=>'bespoke-rug-service',           'uses'=>        'FrontendController@beSpokeRugs']);
        $this->get('about-us',                  ['as'=>'about-us',                      'uses'=>        'FrontendController@aboutUs']);
        $this->get('contact-us',                ['as'=>'contact-us',                    'uses'=>        'FrontendController@contactUs']);
        $this->post('send-mail',                ['as'=>'send-mail',                     'uses'=>        'FrontendController@sendMail']);

});

