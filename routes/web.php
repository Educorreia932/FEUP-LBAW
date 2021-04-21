<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

// Home
Route::get('/', 'HomeController@show')->name("home");

// Cards
Route::get('cards', 'CardController@list');
Route::get('cards/{id}', 'CardController@show');

// API
Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Search
Route::get('search', 'SearchController@search')->name('search');

// Auctions
Route::get("auction", "AuctionController@show")->name("auction");
Route::get("create_auction", "CreateAuctionController@show")->name("create_auction");

// Users
Route::get("user_profile", "UserProfileController@show")->name("user_profile");

// Dashboard
Route::get("dashboard", "DashboardController@show")->name("dashboard");

// Other
Route::get('about', fn() => View::make("pages/about"));
Route::get('faq', fn() => View::make("pages/faq"));
