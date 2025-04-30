<?php

namespace App\Services\Chart;

use App\Repository\Chart\ChartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Реализует работу по подготовке данных для графиков
 */
class ChartService
{
    /**
     * Группирует данные (кол-во поступивших пациентов) по параметру
     * @param Request $request Параметр группировки (grouping)
     * @return Collection Возвращает сгруппированную коллекцию
     */
    public function getAdmissions(Request $request): Collection
    {
        return app(ChartRepository::class)->getAdmissions($request);
    }

    /**
     * Группирует данные (кол-во выписанных пациентов) по параметру
     * @param Request $request Параметр группировки (grouping)
     * @return Collection Возвращает сгруппированную коллекцию
     */
    public function getDischarges(Request $request): Collection
    {
        return app(ChartRepository::class)->getDischarges($request);
    }
}
