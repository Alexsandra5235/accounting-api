<?php

namespace App\Interfaces;

/**
 * Реализует удаление данных из таблицы
 */
interface DeleteInterface
{
    /**
     * Удаление записи из таблицы
     * @param int $id Индификатор записи, которую необходимо
     * удалить
     * @return bool В случае успеха вернет true, если нет, то будет
     * выброшено исключение.
     */
    public function destroy(int $id): bool;
}
