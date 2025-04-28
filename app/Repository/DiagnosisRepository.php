<?php

namespace App\Repository;

use App\Interfaces\DeleteInterface;
use App\Interfaces\DiagnosisInterface;
use App\Models\Patient\Classifiers;
use App\Models\Patient\Diagnosis;
use App\Services\ClassifiersService;
use app\Traits\HasLog;
use Exception;
use Illuminate\Http\Request;

/**
 * Работа с данными модели Diagnosis
 */
class DiagnosisRepository implements DiagnosisInterface, DeleteInterface
{
    use HasLog;

    /**
     * Создание записи в таблице
     * @param Classifiers $wound Данные причины травмы
     * @param Classifiers $state Данные диагноза заболевания
     * @return Diagnosis Возвращает созданный объект
     */
    public function create(Classifiers $wound, Classifiers $state): Diagnosis
    {
        return Diagnosis::query()->create([
            'wound_id' => $wound->id,
            'state_id' => $state->id,
        ]);
    }

    /**
     * Нахождение записи по id и удаление ее и связанных с ней данных
     * в таблице Classifiers
     * @param int $id Индификатор записи для удаления
     * @return bool Вернут true в случае успеха
     * @throws Exception Выбросит исключение в случае неудачи
     */
    public function destroy(int $id): bool
    {
        try {
            $diagnosis = $this->findByIdLog($id, Diagnosis::class);
            if ($diagnosis instanceof Diagnosis) {
                app(ClassifiersService::class)->destroy($diagnosis->wound->id);
                app(ClassifiersService::class)->destroy($diagnosis->state->id);
            }
            $diagnosis->delete();
            return true;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * Нахождение по диагнозу связанных данных и обновление их
     * @param Diagnosis $diagnosis Объект, данные которого необходимо обновить
     * @param Request $request Данные из запроса
     * @return bool Вернут true в случае успеха
     * @throws Exception Выбросит исключение в случае неудачи
     */
    public function update(Diagnosis $diagnosis, Request $request): bool
    {
        try {
            return app(ClassifiersService::class)->update($diagnosis, $request);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
