<?php

namespace App\Repository;

use App\User;
use App\tasks;

class TaskRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return tasks::where('user_id', $user->id)
                    ->orderBy('created_date', 'asc')
                    ->get();
    }
}