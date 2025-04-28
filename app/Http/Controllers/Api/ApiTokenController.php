<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Api\ApiTokenService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Работа с токеном пользователя
 */
class ApiTokenController extends Controller
{
    /**
     * Удаление всех токенов у авторизированного пользователя
     * и создание нового
     * @return RedirectResponse Возвращает редирект профиля пользователя
     * с блоком, в котором отображается его новый созданный токен.
     * @throws Exception Возвращает редирект профиля пользователя
     *  с блоком, в котором отображается ошибка создания токена.
     */
    public function createToken(): RedirectResponse
    {
        try {
            $user = User::all()->findOrFail(Auth::id());
            return redirect()->back()->with('token', app(ApiTokenService::class)->createToken($user));
        } catch (Exception $exception) {
            return redirect()->back()->withErrors(['error_token' => $exception->getMessage()]);
        }
    }

    /**
     * Удаляет все токены авторизированного пользователя и создает ему новый
     * @return JsonResponse Возвращает json ответ с токеном пользователя либо с ошибкой
     * его генерации
     */
    public function getToken(): JsonResponse
    {
        try {
            $user = User::all()->findOrFail(Auth::id());
            return response()->json(['token' => app(ApiTokenService::class)->createToken($user)]);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }
}
