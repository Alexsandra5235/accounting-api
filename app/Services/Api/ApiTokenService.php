<?php

namespace App\Services\Api;

use App\Models\User;
use App\Repository\Api\ApiTokenRepository;
use Exception;

class ApiTokenService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * @throws Exception
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
