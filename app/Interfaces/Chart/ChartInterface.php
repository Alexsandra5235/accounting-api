<?php

namespace App\Interfaces\Chart;



use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Реализуй обработку данных для графиков
 */
interface ChartInterface
{
    /**
     * Возвращает кол-во поступивших пациентов за определенный период
     * @param Request $request Содержит данные по группировке (day, month или year)
     * @return Collection
     */
    public function getAdmissions(Request $request): Collection;

    /**
     * Возвращает кол-во выписанных пациентов за определенный период
     * @param Request $request Содержит данные по группировке (day, month или year)
     * @return Collection
     */
    public function getDischarges(Request $request): Collection;
}
