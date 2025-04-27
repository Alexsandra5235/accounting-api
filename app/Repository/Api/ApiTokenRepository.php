<?php

namespace App\Repository\Api;

use App\Interfaces\Api\ApiTokenInterface;
use App\Models\User;
use Exception;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;

class ApiTokenRepository implements ApiTokenInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function createToken(User $user): string
    {
        return $user->createToken('api-token')->plainTextToken;
    }

    /**
     * @throws Exception
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
