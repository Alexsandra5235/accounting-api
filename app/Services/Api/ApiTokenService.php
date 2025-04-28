<?php

namespace App\Services\Api;

use App\Models\User;
use App\Repository\Api\ApiTokenRepository;
use Exception;

/**
 * Работа с токеном пользователя
 */
class ApiTokenService
{

    /**
     * Удаляет все токены пользователя и создает новый
     * @param User $user пользователь, для которого
     * будет создан токен
     * @return string Возвращает токен пользователя
     * @throws Exception Возвращает исключение, если оно возникло
     */
    public function createToken(User $user): string
    {
        try {
            app(ApiTokenRepository::class)->deleteToken($user);
            return app(ApiTokenRepository::class)->createToken($user);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
