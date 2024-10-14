<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BasePolicy
{
    use HandlesAuthorization;

    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    protected function isGestor(): bool
    {
        return $this->user->role->name === 'Gestor';
    }
}
