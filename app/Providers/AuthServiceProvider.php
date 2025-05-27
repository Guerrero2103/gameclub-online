<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\HelpEntry;
use App\Policies\FaqPolicy;
use App\Models\News;
use App\Policies\NewsPolicy;
use App\Models\User;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        HelpEntry::class => FaqPolicy::class,
        News::class => NewsPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('manage-faq', [FaqPolicy::class, 'manageFaq']);
        Gate::define('manage-news', [NewsPolicy::class, 'manageNews']);
        Gate::define('manage-users', [UserPolicy::class, 'manageUsers']);
    }
}
