<?php

namespace App\Repository\Chart;

use App\Interfaces\Chart\ChartInterface;
use App\Models\Logs\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Реализует работу по выборке данных для графиков
 */
class ChartRepository implements ChartInterface
{

    /**
     * Группирует данные по дате и кол-ву поступивших пациентов
     * @param Request $request Параметр группировки
     * @return Collection Возвращает сгруппированную коллекцию
     */
    public function getAdmissions(Request $request): Collection
    {
        $dateFormat = $this->getDateFormat($request);
        return Log::query()->selectRaw("DATE_FORMAT(log_receipts.date_receipt, '{$dateFormat}') as period, COUNT(*) as count")
            ->join('log_receipts', 'logs.log_receipt_id', '=', 'log_receipts.id')
            ->whereNotNull('logs.log_receipt_id')
            ->whereNotNull('log_receipts.date_receipt')
            ->groupBy('period')
            ->pluck('count', 'period');
    }

    public function getCurrentPatient(): Collection
    {
        return Log::query()->selectRaw("COUNT(*) as count")
            ->join('log_discharges', 'logs.log_discharge_id', '=', 'log_discharges.id')
            ->whereNull('log_discharges.datetime_discharge')
            ->pluck('count');
    }

    public function getTodayReceipt(): Collection
    {
        return Log::query()->selectRaw("COUNT(*) as count")
            ->join('log_receipts', 'logs.log_receipt_id', '=', 'log_receipts.id')
            ->whereNotNull('log_receipts.date_receipt')
            ->whereToday('log_receipts.date_receipt')
            ->pluck('count');
    }

    public function getTodayDischarge(): Collection
    {
        return Log::query()->selectRaw("COUNT(*) as count")
            ->join('log_discharges', 'logs.log_discharge_id', '=', 'log_discharges.id')
            ->whereNotNull('log_discharges.datetime_discharge')
            ->whereToday('log_discharges.datetime_discharge')
            ->pluck('count');
    }

    /**
     * Группирует данные по дате и кол-ву выписанных пациентов
     * @param Request $request Параметр группировки
     * @return Collection возвращает сгруппированную коллекцию
     */
    public function getDischarges(Request $request): Collection
    {
        $dateFormat = $this->getDateFormat($request);
        return Log::query()->selectRaw("DATE_FORMAT(log_discharges.datetime_discharge, '{$dateFormat}') as period, COUNT(*) as count")
            ->join('log_discharges', 'logs.log_discharge_id', '=', 'log_discharges.id')
            ->whereNotNull('logs.log_discharge_id')
            ->whereNotNull('log_discharges.datetime_discharge')
            ->groupBy('period')
            ->pluck('count', 'period');
    }

    /**
     * Создание формата даты
     * @param Request $request Необходимый формат (day, month, year)
     * @return string Возвращает необходимый формат
     */
    public function getDateFormat(Request $request): string
    {
        return match ($request->input('grouping')) {
            'month' => '%Y-%m',
            'year' => '%Y',
            default => '%Y-%m-%d',
        };
    }
}
