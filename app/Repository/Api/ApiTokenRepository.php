<?php

namespace App\Repository\Api;

use App\Interfaces\Api\ApiTokenInterface;
use App\Models\User;
use Exception;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;

/**
 * Реализует работу с токеном пользователя
 */
class ApiTokenRepository implements ApiTokenInterface
{
    /**
     * Создание токена пользователя
     * @param User $user Пользователь, для которого
     * будет создан токен
     * @return string Возвращает токен пользователя
     */
    public function createToken(User $user): string
    {
        return $user->createToken('api-token')->plainTextToken;
    }

    /**
     * Удаляет все токены пользователя
     * @param User $user Пользователь, у которого
     * будут удалены все токены
     * @return bool Возвращает true, если успех
     * @throws Exception Возвращает исключение, если
     * оно возникло
     */
    public function deleteToken(User $user): bool
    {
        try {
            $user->tokens()->delete();
            return true;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
