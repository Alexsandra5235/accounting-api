<?php

namespace App\Interfaces\Api;

use App\Models\User;

interface ApiTokenInterface
{
    public function createToken(User $user) : string;
    public function deleteToken(User $user) : bool;
}
