<?php

namespace App\Interfaces;

use App\Models\Patient\Classifiers;
use App\Models\Patient\Diagnosis;
use Illuminate\Http\Request;

/**
 * Реализует интерфейс для работы с классом Classifiers
 */
interface ClassifiersInterface
{
    /**
     * Создание диагноза
     * @param Request $request Данные из запроса
     * @return Classifiers Возвращает созданный объект
     */
    public function createState(Request $request): Classifiers;

    /**
     * Создание причины травмы
     * @param Request $request Данные из запроса
     * @return Classifiers Возвращает созданный объект
     */
    public function createWound(Request $request): Classifiers;

    /**
     * Обновление диагноза
     * @param Diagnosis $diagnosis Объект, данные которого
     * необходимо обновить
     * @param Request $request Данные из запроса
     * @return bool Возвращает true в случае успеха,
     * в случае неудачи выбрасывает исключение.
     */
    public function updateState(Diagnosis $diagnosis, Request $request): bool;

    /**
     * Обновление причины травмы
     * @param Diagnosis $diagnosis Объект, данные которого
     * необходимо обновить
     * @param Request $request Данные из запроса
     * @return bool Возвращает true в случае успеха,
     * в случае неудачи выбрасывает исключение.
     */
    public function updateWound(Diagnosis $diagnosis, Request $request): bool;
}
