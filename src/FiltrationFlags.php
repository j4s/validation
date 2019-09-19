<?php
/** j4s\validation */

declare(strict_types=1);

namespace j4s\validation;

/**
 * Класс реализующий функционал флагов фильтрации
 *
 * @package     filtration
 * @author      Eugeniy Makarkin <soloscriptura@mail.ru>
 * @version     v0.2.2 2018-12-08 01:24:19
 */
class FiltrationFlags extends ApplyFlags
{

    /**
     * Флаг фильтрации числового значения (integer).
     * Возвращает фильтруемое значение, если оно integer иначе возвращает заданное значение по умолчанию.
     * @version v0.2.2 2019-09-19 10:01:53
     * @param mixed $defaultValue - значение по умолчанию
     * @return int
     */
    public function int($defaultValue = 0) : int
    {
        if ((int) $this->target === $this->target) {
            return $this->target;
        }

        return $defaultValue;
    }

}
