<?php

namespace App\Interfaces\Api;

use App\Models\User;

/**
 * Реализует работу с токеном пользователя для
 * прохождения аутентификации Sanctum
 */
interface ApiTokenInterface
{
    /**
     * Создание токена пользователя
     * @param User $user
     * @return string
     */
    public function createToken(User $user) : string;

    /**
     * Удаление всех токенов пользователя
     * @param User $user
     * @return bool
     */
    public function deleteToken(User $user) : bool;
}
