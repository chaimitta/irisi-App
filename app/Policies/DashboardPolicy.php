<?php

namespace App\Policies;

use App\User;
use App\Dashboard;
use Illuminate\Auth\Access\HandlesAuthorization;

class DashboardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any dashboards.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the dashboard.
     *
     * @param  \App\User  $user
     * @param  \App\Dashboard  $dashboard
     * @return mixed
     */
    public function view(User $user, Dashboard $dashboard)
    {
        //
    }

    /**
     * Determine whether the user can create dashboards.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the dashboard.
     *
     * @param  \App\User  $user
     * @param  \App\Dashboard  $dashboard
     * @return mixed
     */
    public function update(User $user, Dashboard $dashboard)
    {
        return $user->id == $dashboard->user_id;
    }

    /**
     * Determine whether the user can delete the dashboard.
     *
     * @param  \App\User  $user
     * @param  \App\Dashboard  $dashboard
     * @return mixed
     */
    public function delete(User $user, Dashboard $dashboard)
    {
        //
    }

    /**
     * Determine whether the user can restore the dashboard.
     *
     * @param  \App\User  $user
     * @param  \App\Dashboard  $dashboard
     * @return mixed
     */
    public function restore(User $user, Dashboard $dashboard)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the dashboard.
     *
     * @param  \App\User  $user
     * @param  \App\Dashboard  $dashboard
     * @return mixed
     */
    public function forceDelete(User $user, Dashboard $dashboard)
    {
        //
    }
}
