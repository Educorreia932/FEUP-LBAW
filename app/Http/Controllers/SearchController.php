<?php
namespace App\Http\Controllers;

class SearchController extends Controller {
    public function search() {
        return view('pages.search');
    }
}