<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Api\ApiTokenService;
use Exception;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApiTokenController extends Controller
{
    /**
     * @throws Exception
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
