<?php

namespace App\Services;

use App\Models\Patient\Classifiers;
use App\Models\Patient\Diagnosis;
use App\Repository\ClassifiersRepository;
use Exception;
use Illuminate\Http\Request;

/**
 * Сервис для работы с моделью Classifiers
 */
class ClassifiersService
{
    /**
     * Добавление диагноза болезни
     * @param Request $request Данные из запроса
     * @return Classifiers Возвращает созданный объект
     */
    public function createState(Request $request): Classifiers
    {
        return app(ClassifiersRepository::class)->createState($request);
    }

    /**
     * Создание причины травмы
     * @param Request $request Данные из запроса
     * @return Classifiers Возвращает созданный объект
     */
    public function createWound(Request $request): Classifiers
    {
        return app(ClassifiersRepository::class)->createWound($request);
    }

    /**
     * Поиск записи по id и ее удаление
     * @param int $id Индификатор записи
     * @return bool Вернет true в случае успеха
     * @throws Exception Выбросит исключение в случае неудачи
     */
    public function destroy(int $id): bool
    {
        try {
            return app(ClassifiersRepository::class)->destroy($id);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * Поиск связанный записей с моделью Diagnosis и обновление их
     * @param Diagnosis $diagnosis Модель, данные которой необходимо обновить
     * @param Request $request Данные из запроса
     * @return bool Вернет true в случае успеха
     * @throws Exception Выбросит исключение в случае неудачи
     */
    public function update(Diagnosis $diagnosis, Request $request): bool
    {
        try {
            app(ClassifiersRepository::class)->updateWound($diagnosis, $request);
            app(ClassifiersRepository::class)->updateState($diagnosis, $request);
            return true;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
