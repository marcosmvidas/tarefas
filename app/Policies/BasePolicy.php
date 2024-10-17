<?php

namespace App\Policies;

use App\Models\User;

class BasePolicy
{
    protected User $user; // Aqui deve estar tipada como App\Models\User

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
