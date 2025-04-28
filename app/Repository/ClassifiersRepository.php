<?php

namespace App\Repository;

use App\Interfaces\ClassifiersInterface;
use App\Interfaces\DeleteInterface;
use App\Models\Patient\Classifiers;
use App\Models\Patient\Diagnosis;
use app\Traits\HasLog;
use Exception;
use Illuminate\Http\Request;

/**
 * Работа с данными класса Classifiers
 */
class ClassifiersRepository implements ClassifiersInterface, DeleteInterface
{
    use HasLog;

    /**
     * Удаление записи
     * @param int $id Индификатор записи, которую
     * необходимо удалить
     * @return bool Возвращается true в случае успеха
     * @throws Exception В случае неудачи будет выброшено исключение
     */
    public function destroy(int $id): bool
    {
        try {
            return $this->destroyLog($id, Classifiers::class);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * Создание диагноза
     * @param Request $request Данные из запроса
     * @return Classifiers Возвращается созданный объект
     */
    public function createState(Request $request): Classifiers
    {
        return Classifiers::query()->create([
            'code' => $request->get('state_code'),
            'value' => $request->get('state_value'),
        ]);
    }

    /**
     * Создание причины травмы
     * @param Request $request Данные из запроса
     * @return Classifiers Возвращается созданный объект
     */
    public function createWound(Request $request): Classifiers
    {
        return Classifiers::query()->create([
            'code' => $request->get('wound_code'),
            'value' => $request->get('wound_value'),
        ]);
    }

    /**
     * Поиск диагноза через передаваемый параметр и его обновление
     * @param Diagnosis $diagnosis Объект, данные диагноза которого
     * необходимо обновить
     * @param Request $request Данные из запроса
     * @return bool В случае успеха вернется true
     * @throws Exception В случае неудачи будет выброшено исключение
     */
    public function updateState(Diagnosis $diagnosis, Request $request): bool
    {
        try {
            $classifier_state = $this->findByIdLog($diagnosis->state->id, Classifiers::class);
            $classifier_state->update([
                'code' => $request->input('state_code'),
                'value' => $request->input('state_value'),
            ]);
            return true;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * Поиск причины травмы через передаваемый параметр и ее обновление
     * @param Diagnosis $diagnosis Объект, данные причины травмы которого
     * необходимо обновить
     * @param Request $request Данные из запроса
     * @return bool В случае успеха вернутся true
     * @throws Exception В случае неудачи будет выброшено исключение
     */
    public function updateWound(Diagnosis $diagnosis, Request $request): bool
    {
        try {
            $classifier_state = $this->findByIdLog($diagnosis->wound->id, Classifiers::class);
            $classifier_state->update([
                'code' => $request->input('wound_code'),
                'value' => $request->input('wound_value'),
            ]);
            return true;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
