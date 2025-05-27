<?php

namespace App\Policies;

use App\Models\User;
use App\Models\News;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can manage news items.
     */
    public function manageNews(User $user): bool
    {
        return $user->role === 'admin';
    }
} 