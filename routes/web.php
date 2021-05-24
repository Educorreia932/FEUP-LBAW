<?php

use Facade\FlareClient\View;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', 'HomeController@show')->name("home");

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login_form');
Route::post('login', 'Auth\LoginController@login')->name("login");
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register_form');
Route::post('register', 'Auth\RegisterController@register')->name("register");

// Search Results
Route::get('auction/search', 'SearchResultsController@search_auctions')->name('search_auctions');
Route::get('user/search', 'SearchResultsController@search_users')->name('search_users');

// Auctions
Route::get("auction/{id}", "AuctionController@show")->where('id', '[0-9]+')->name("auction");
Route::get("auction/{id}/details", "AuctionController@showDetails")->where('id', '[0-9]+')->name("auction_details");



// Authenticated only
Route::middleware(['auth'])->group(function () {

    // Authentication
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    // Create Auction
    Route::get("auction/create", "AuctionController@create")->name("create_auction");
    Route::post("auction/create", "AuctionController@store")->name("store_auction");

    // Bid Auction
    Route::post("auction/{id}/bid", "AuctionController@bid")->name("auction_bid");

    // User Profile
    Route::get("users/me", "UserController@showMyProfile")->name('my_profile');

    // Auction Report
    Route::post("auction/{id}/report", "AuctionController@report")->where('id', '[0-9]+')->name("auction_report");

    // Auction Editing
    Route::post("auction/{id}/edit", "AuctionController@edit")->where('id', '[0-9]+')->name("auction_edit");

    // Auction Bookmark
    Route::put("auction/{id}/bookmark", "AuctionController@bookmark")->where('id', '[0-9]+')->name("bookmark");
    Route::delete("auction/{id}/bookmark", "AuctionController@unbookmark")->where('id', '[0-9]+')->name("unbookmark");

    // Follow
    Route::put("users/{username}/follow", "UserController@follow")->name("follow");
    Route::delete("users/{username}/follow", "UserController@unfollow")->name("unfollow");

    // Dashboard
    Route::get("dashboard", fn() => redirect("dashboard/created_auctions"))->name("dashboard");
    Route::get("dashboard/created_auctions", "DashboardController@createdAuctions")->name("dashboard_created_auctions");
    Route::get("dashboard/bidded_auctions", "DashboardController@biddedAuctions")->name("dashboard_bidded_auctions");
    Route::get("dashboard/bookmarked_auctions", "DashboardController@bookmarkedAuctions")->name("dashboard_bookmarked_auctions");
    Route::get("dashboard/followed", "DashboardController@followed")->name("dashboard_followed");

    // Settings
    Route::get("user/settings/", fn() => redirect("user/settings/account"))->name("settings");
    Route::get("user/settings/account", "SettingsController@account")->name("settings_account");
    Route::put("user/settings/account", "SettingsController@save_account_changes")->name("save_account_changes");
    Route::get("user/settings/privacy", "SettingsController@privacy")->name("settings_privacy");
    Route::put("user/settings/privacy/toggle", "SettingsController@toggle_settings")->name("toggle_settings");
    Route::get("user/settings/security", "SettingsController@security")->name("settings_security");
    Route::put("user/settings/security", "SettingsController@change_password")->name("change_password");
});


// User Profile
Route::get("users/{username}", "UserController@showProfile")->name('user_profile');

// Other
Route::get('about', "AboutController@show")->name("about");
Route::get('faq', "AboutController@faq")->name("faq");
