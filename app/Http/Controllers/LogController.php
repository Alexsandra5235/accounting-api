<?php

namespace App\Http\Controllers;


use App\Models\Logs\Log;
use App\Services\LogDischargeService;
use App\Services\LogService;
use Exception;
use http\Env\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\String\Exception\ExceptionInterface;

class LogController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'date_receipt' => ['required'],
                'time_receipt' => ['required'],
                'name' => ['required'],
                'gender' => ['required'],
                'birth_day' => ['required'],
                'medical_card' => ['required'],
            ]);
            $log = app(LogService::class)->create($request);
            return response()->json($log);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }

    }

    /**
     * @throws Exception
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            app(LogService::class)->destroy($id);
            return response()->json(['success' => 'Log deleted successfully.']);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 400);
        }
    }
    public function update(int $id, Request $request): JsonResponse
    {
        try {
            $request->validate([
                'date_receipt' => ['required'],
                'time_receipt' => ['required'],
                'name' => ['required'],
                'gender' => ['required'],
                'birth_day' => ['required'],
                'medical_card' => ['required'],
            ]);
            app(LogService::class)->update($id, $request);
            return response()->json(['message' => 'Log updated successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()],400);
        }
    }
    public function findAll(): JsonResponse
    {
        $logs = app(LogService::class)->findAll();
        return response()->json($logs);
    }
    public function findById(int $id): JsonResponse
    {
        try {
            $log = app(LogService::class)->findById($id);
            return response()->json($log);
        } catch (Exception $exception){
            return response()->json(['error' => $exception->getMessage()]);
        }
    }
    public function edit(int $id): View|RedirectResponse
    {
        try {
            $log = app(LogService::class)->findById($id);
            return view('log.logEdit', compact('log'));
        } catch (Exception $exception){
            return redirect()->route('dashboard')->withErrors(['error_edit' => $exception->getMessage()]);
        }
    }
    public function add() : View
    {
        return view('log.logAdd');
    }
}
