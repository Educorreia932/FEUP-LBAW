<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

// Home
Route::get('/', 'HomeController@show')->name("home");

// API
Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login_form');
Route::post('login', 'Auth\LoginController@login')->name("login");
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register_form');
Route::post('register', 'Auth\RegisterController@register')->name("register");

// Search Results
Route::get('auction/search_results', 'SearchResultsController@search_auctions')->name('search_auctions');
Route::get('user/search_results', 'SearchResultsController@search_users')->name('search_users');

// Auctions
Route::get("auction/{id}", "AuctionController@show")->where('id', '[0-9]+')->name("auction");
Route::get("auction/{id}/details", "AuctionController@showDetails")->where('id', '[0-9]+')->name("auction_details");
Route::get("create_auction", "CreateAuctionController@show")->name("create_auction");

// Users
Route::get("users/{username}", "UserProfileController@show")->name('user_profile');

// Dashboard
Route::get("dashboard", fn() => redirect("dashboard/created_auctions"))->name("dashboard");
Route::get("dashboard/created_auctions", "DashboardController@createdAuctions")->name("dashboard_created_auctions");
Route::get("dashboard/bidded_auctions", "DashboardController@biddedAuctions")->name("dashboard_bidded_auctions");
Route::get("dashboard/bookmarked_auctions", "DashboardController@bookmarkedAuctions")->name("dashboard_bookmarked_auctions");
Route::get("dashboard/followed", "DashboardController@followed")->name("dashboard_followed");

// Settings
Route::get("user/settings/", fn() => redirect("user/settings/account"))->name("settings");
Route::get("user/settings/account", "SettingsController@account")->name("settings_account");
Route::get("user/settings/privacy", "SettingsController@privacy")->name("settings_privacy");
Route::get("user/settings/security", "SettingsController@security")->name("settings_security");

// Other
Route::get('about', fn() => View::make("pages/about"))->name("about");
Route::get('faq', fn() => View::make("pages/faq"))->name("faq");
