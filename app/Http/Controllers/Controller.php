<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Controller extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $user;

    public function __construct() {
        // $this->user = Auth::user(); // TODO: Why isn't this working?
        $this->user = Member::find(20);
        Auth::login($this->user);

        View::share("user", $this->user);
    }
}
