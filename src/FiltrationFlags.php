<?php
/** j4s\validation */

declare(strict_types=1);

namespace j4s\validation;

/**
 * Класс реализующий функционал флагов фильтрации
 *
 * @package     validation
 * @author      Eugeniy Makarkin <soloscriptura@mail.ru>
 * @version     v0.2.0 2018-11-19 14:48:50
 */
class FiltrationFlags extends ApplyFlags
{

    /**
     * Флаг фильтрации числового значения (integer).
     * Возвращает фильтруемое значение, если оно integer иначе возвращает заданное значение по умолчанию.
     * @version v0.2.0 2018-11-19 14:52:13
     * @param int $defaultValue - значение по умолчанию
     * @return int
     */
    public function int(int $defaultValue = 0) : int
    {
        $integer = ((int) $this->target);
        $this->target = $integer == $this->target ? $integer : $defaultValue;

        return $this->target;
    }

}
