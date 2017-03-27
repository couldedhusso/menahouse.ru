<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Obivlenie;
use App\User;

class AdvertsPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
