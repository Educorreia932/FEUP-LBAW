<?php

namespace App\Providers;

use App\Models\Auction;
use App\Models\Member;
use App\Models\MessageThread;
use App\Policies\AuctionPolicy;
use App\Policies\MemberPolicy;
use App\Policies\MessagePolicy;
use App\Policies\MessageThreadPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Member::class => MemberPolicy::class,
        Auction::class => AuctionPolicy::class,
        Message::class => MessagePolicy::class,
        MessageThread::class => MessageThreadPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
