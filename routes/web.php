<?php


Route::group(['prefix'=>'cms',                'as'=>'cms.',             'namespace'=>'Auth\\'], function(){
    $this->get('',                           ['as'=>'login',             'uses'=>'LoginController@getLogin']);
    $this->post('',                          ['as'=>'login',             'uses'=>'LoginController@login']);
    $this->get('logout',                     ['as'=>'logout',            'uses'=>'LoginController@logout']);
    $this->get('password/reset',             ['as'=>'reset.password',    'uses'=>'ResetPasswordController@showLinkRequestForm']);
});

$this->group(['prefix'=>'cms/',                 'as'=>'cms.',               'middleware'=>'auth',      'namespace'=>'Admin\\'], function() {
    
    
    $this->get('dashboard',                                ['as'=>'dashboard',                                         'uses'=>'DashboardController']);
    
    $this->get('home',                                      ['as'=>'home',                                              'uses'=>'DashboardController@home']);
    
    /*Rug Designs*/
    
    $this->get('rug-designs',                               ['as'=>'rug-designs',                                       'uses'=>'RugDesignsController@index']);
    
    $this->get('rug-designs/add',                           ['as'=>'rug-designs.add',                                   'uses'=>'RugDesignsController@add']);
    
    $this->post('rug-designs/store',                        ['as'=>'rug-designs.store',                                 'uses'=>'RugDesignsController@store']);

    $this->get('rug-designs/show',                          ['as'=>'rug-designs.show-products',                         'uses'=>'RugDesignsController@show']);

    $this->get('rug-designs/delete/{id}',                   ['as'=>'rug-designs.delete',                                'uses'=>'RugDesignsController@delete']);

    $this->get('rug-designs/edit/{id}',                     ['as'=>'rug-designs.edit',                                  'uses'=>'RugDesignsController@edit']);

    $this->put('rug-designs/update/{id}',                   ['as'=>'rug-designs.update',                                'uses'=>'RugDesignsController@update']);

    $this->put('rug-designs/update_seo/{id}',               ['as'=>'rug-designs.update_seo',                            'uses'=>'RugDesignsController@updateSeo']);

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

    $this->post('rug-designs/colourway/change-order',           ['as'=>'rug-designs.colourway.change-order',                'uses'=>'ColourwaysController@changeOrder']);
    
    $this->post('rug-designs/colourway/published-status',       ['as'=>'rug-designs.colourway.published-status',                'uses'=>'ColourwaysController@publishedStatus']);
});



Route::get('/',                                 ['as'=>'marcus-paul.home', 'uses'=>'Frontend\\FrontendController']);
$this->get('rug-designs',                                                               ['as'=>'marcus-paul.rug-designs',                   'uses'=>        'Frontend\\FrontendController@rugDesigns']);
$this->get('bespoke-rug-service',                                                       ['as'=>'marcus-paul.bespoke-rug-service',           'uses'=>        'Frontend\\FrontendController@beSpokeRugs']);
$this->get('about-us',                                                                  ['as'=>'marcus-paul.about-us',                      'uses'=>        'Frontend\\FrontendController@aboutUs']);
$this->get('contact-us',                                                                ['as'=>'marcus-paul.contact-us',                    'uses'=>        'Frontend\\FrontendController@contactUs']);
$this->get('rug-design-details/{slug}',                                                 ['as'=>'marcus-paul.rug-design-details',            'uses'=>        'Frontend\\FrontendController@rugDetails']);
$this->post('send-mail',                                                                ['as'=>'marcus-paul.send-mail',                     'uses'=>        'Frontend\\FrontendController@sendMail']);
$this->post('send-form',                                                                ['as'=>'marcus-paul.send-form',                     'uses'=>        'Frontend\\FrontendController@sendForm']);
$this->get('get-colourway-data/{id}',                                                   ['as'=>'marcus-paul.get-colourway-data',            'uses'=>        'Frontend\\FrontendController@getColourwayData']);
$this->get('rug-designs/enquire/{product_alias?}/{colourway_alias?}',                   ['as'=>'marcus-paul.enquire',                       'uses'=>        'Frontend\\FrontendController@enquireForm']);
$this->post('rug-designs/enquire-previous',                                         ['as'=>'marcus-paul.enquire.previous',                  'uses'=>        'Frontend\\FrontendController@previous']);





