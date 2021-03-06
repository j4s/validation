<?php
/** j4s\validation */

declare(strict_types=1);

namespace j4s\validation;

/**
 * Абстрактный класс, для создания на его основе классов реализующий функционал флагов
 *
 * @package     validation
 * @author      Eugeniy Makarkin <soloscriptura@mail.ru>
 * @version     v0.2.4 2019-09-19 10:00:54
 */
abstract class ApplyFlags
{
    /** @var mixed $target - Значение атрибута, который проходит валидацию */
    protected $target;
    /** @var array $symbolFlags - Массив символьных операторов с именами их алиас-методов */
    public $symbolFlags = array();

    /**
     * Конструктор
     * @version v1.0.3 2018-12-08 08:17:22
     * @param mixed $target - Значение атрибута, который проходит валидацию
     */
    public function __construct($target = null)
    {
        $this->target = $target;
    }

    /**
     * Основной метод класса - применяет к заданному значению заданный флаг.
     * Если метод с флагом отсутствует в дочернем классе, то выводит ошибку.
     * @version v1.0.5 2019-09-19 10:00:42
     * @param string $flag флаг
     * @return mixed
     */
    public function applyFlag(string $flag)
    {
        // Извлекаем из флага имя метода
        $realMethodName = $methodName = explode(' ', $flag)[0];

        // Извлекаем из имени метода символьный оператор ! при его наличии
        $negotiation = 0;
        if (preg_match('/^!/', $realMethodName)) {
            $realMethodName = preg_replace('/!(.*)/', '$1', $realMethodName);
            $negotiation = 1;

        }

        // Заменяем другие символьные операторы на соответствующие имена методов
        if (array_key_exists($realMethodName, $this->symbolFlags)) {
            $realMethodName = $this->symbolFlags[$realMethodName];
        }

        // Извлекаем из флага аргументы
        $arguments = explode(',', $flag);
        $arguments[0] = substr($arguments[0], strlen($methodName) + 1);

        if (! method_exists($this, $realMethodName)) {
            trigger_error("Sorry, method \"{$realMethodName}\" does not exist.", E_USER_ERROR);
        }

        // Вызываем метод текущего класса
        $result = call_user_func_array(array(&$this, $realMethodName), $arguments);

        return $negotiation ? ! $result : $result;
    }

}
