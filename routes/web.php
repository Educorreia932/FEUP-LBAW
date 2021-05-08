<?php

use Illuminate\Support\Facades\Route;

// Home
Route::get('/', 'HomeController@show')->name("home");

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
Route::get("auction/create", "AuctionController@create")->name("create_auction")->middleware("auth");
Route::post("auction/create", "AuctionController@store")->name("store_auction")->middleware("auth");

Route::post("auction/{id}/report", "AuctionController@report")->where('id', '[0-9]+')->name("auction_report");
Route::post("auction/{id}/edit", "AuctionController@edit")->where('id', '[0-9]+')->name("auction_edit");

Route::put("auction/{id}/bookmark", "AuctionController@bookmark")->where('id', '[0-9]+')->name("bookmark")->middleware("auth");
Route::delete("auction/{id}/bookmark", "AuctionController@unbookmark")->where('id', '[0-9]+')->name("unbookmark")->middleware("auth");

// Users
Route::get("users/me", "UserController@showMyProfile")->name('my_profile')->middleware("auth");
Route::get("users/{username}", "UserController@showProfile")->name('user_profile');

Route::put("users/{username}/follow", "UserController@follow")->name("follow")->middleware("auth");
Route::delete("users/{username}/follow", "UserController@unfollow")->name("unfollow")->middleware("auth");

// Dashboard
Route::get("dashboard", fn() => redirect("dashboard/created_auctions"))->name("dashboard")->middleware("auth");
Route::get("dashboard/created_auctions", "DashboardController@createdAuctions")->name("dashboard_created_auctions")->middleware("auth");
Route::get("dashboard/bidded_auctions", "DashboardController@biddedAuctions")->name("dashboard_bidded_auctions")->middleware("auth");
Route::get("dashboard/bookmarked_auctions", "DashboardController@bookmarkedAuctions")->name("dashboard_bookmarked_auctions")->middleware("auth");
Route::get("dashboard/followed", "DashboardController@followed")->name("dashboard_followed")->middleware("auth");

// Messages
Route::get("messages", "MessagesController@inbox")->name("inbox")->middleware("auth");
Route::get("messages/{thread_id}", "MessagesController@messageThread")->name("message_thread")->middleware("auth");
Route::put("messages/{thread_id}", "MessagesController@sendMessage")->name("send_message")->middleware("auth");

// Settings
Route::get("user/settings/", fn() => redirect("user/settings/account"))->name("settings")->middleware("auth");
Route::get("user/settings/account", "SettingsController@account")->name("settings_account")->middleware("auth");
Route::put("user/settings/account", "SettingsController@save_account_changes")->name("save_account_changes")->middleware("auth");
Route::get("user/settings/privacy", "SettingsController@privacy")->name("settings_privacy")->middleware("auth");
Route::get("user/settings/security", "SettingsController@security")->name("settings_security")->middleware("auth");

// Other
Route::get('about', "AboutController@show")->name("about");
Route::get('faq', "AboutController@faq")->name("faq");
