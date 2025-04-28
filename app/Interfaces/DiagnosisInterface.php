<?php

namespace App\Interfaces;

use App\Models\Patient\Classifiers;
use App\Models\Patient\Diagnosis;
use Illuminate\Http\Request;

/**
 * Реализует работу с данными в таблице Diagnosis.
 */
interface DiagnosisInterface
{
    /**
     * Создание диагноза
     * @param Classifiers $wound Причина травмы
     * @param Classifiers $state Диагноз заболевания
     * @return Diagnosis Возвращает созданный объект
     */
    public function create(Classifiers $wound, Classifiers $state) : Diagnosis;

    /**
     * Обновление диагноза
     * @param Diagnosis $diagnosis Объект, который необходимо обновить
     * @param Request $request Данные из запроса
     * @return bool Возвращает true в случае успеха.
     * В случае неудачи выкинет исключение.
     */
    public function update(Diagnosis $diagnosis, Request $request) : bool;

}
