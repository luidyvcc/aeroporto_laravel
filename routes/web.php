<?php

// Painel Admin
Route::group([
    'prefix' => 'panel',
    'namespace' => 'Panel',
    'middleware' => ['auth', 'auth.admin']
], function () {    

    // Marcas
    Route::any('brands/search', 'BrandController@search')->name('brands.search');//Deve estar sempre acima das rotas resourc, get ...
    Route::get('brands/{id}/planes', 'BrandController@planes')->name('brands.planes');
    Route::resource('brands', 'BrandController');    

    // Aviões
    Route::any('planes/search', 'PlaneController@search')->name('planes.search');//Deve estar sempre acima das rotas resourc, get ...
    Route::resource('planes', 'PlaneController');
    
    // Estados
    Route::get('states/index', 'StateController@index')->name('states.index');
    Route::any('states/search', 'StateController@search')->name('states.search');

    // Estado -> Cidade
    Route::any('state/{initials}/cities/search', 'CityController@search')->name('state.cities.search');//Any recebe get ou post
    Route::get('state/{initials}/cities', 'CityController@index')->name('state.cities');
    
    // Voos
    Route::any('flights/search', 'FlightController@search')->name('flights.search');//Any recebe get ou post
    Route::resource('flights', 'FlightController');

    // Principal
    Route::get('/', 'PanelController@index')->name('panel'); 
    
    // Aeroportos
    Route::any('city/{id}/airports/search', 'AirportController@search')->name('city.airports.search');
    Route::resource('city/{id}/airports', 'AirportController');

    // Usuários
    Route::any('users/search', 'UserController@search')->name('users.search');//Deve estar sempre acima das rotas resourc, get ...
    // Route::resource('users', 'UserController', [
    //     'except' => ['show', 'destroy']
    // ]); 
    Route::resource('users', 'UserController');

    // Reservas
    Route::any('reserves/search', 'ReserveController@search')->name('reserves.search');//Deve estar sempre acima das rotas resourc, get ...
    Route::resource('reserves', 'ReserveController'); 
});

// Site
Route::group(['middleware' => 'auth'], function () { 

    Route::get('logout', 'Panel\UserController@logout')->name('user.logout');
   
    Route::get('usuario/meu-perfil', 'Panel\UserController@myProfile')->name('site.user.profile');
    Route::post('usuario/atualizar-perfil', 'Panel\UserController@updateProfile')->name('site.user.update');
    
    Route::get('voos/detalhes/{id}', 'Site\SiteController@flightShow')->name('site.flights.show');
    Route::post('voos/reserve', 'Site\SiteController@flightReserve')->name('site.flights.reserve');

    Route::get('usuario/minhas-compras', 'Site\SiteController@myPurchases')->name('site.user.purchases');
    Route::get('usuario/detalhe-compra/{id}', 'Site\SiteController@detailPurchases')->name('site.user.purchase.detail');
    
});

Route::group(['namespace' => 'Site'], function () {  

    Route::get('promocoes', 'SiteController@promotions')->name('promotions');
    
    Route::post('voos/pesquisa', 'SiteController@flightSearch')->name('site.flights.search');
    
    Route::get('/', 'SiteController@index')->name('home');
    
});

Auth::routes();
