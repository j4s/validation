<?php
/** j4s\validation */

declare(strict_types=1);

namespace j4s\validation;

/**
 * Абстрактный класс, для создания на его основе классов реализующий функционал флагов
 *
 * @package     validation
 * @author      Eugeniy Makarkin <soloscriptura@mail.ru>
 * @version     v0.2.3 2019-05-25 11:43:43
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
     * @version v1.0.4 2019-05-25 11:43:31
     * @param string $flag флаг
     * @return mixed
     */
    public function applyFlag(string $flag)
    {
        // Извлекаем из флага имя метода
        $realMethodName = $methodName = explode(" ", $flag)[0];

        // Извлекаем из имени метода символьный оператор ! при его наличии
        $negotiation = 0;
        if (preg_match("/^\!/", $realMethodName)) {
            $realMethodName = preg_replace("/!(.*)/", "$1", $realMethodName);
            $negotiation = 1;

        }

        // Заменяем другие символьные операторы на соответствующие имена методов
        if (array_key_exists($realMethodName, $this->symbolFlags)) {
            $realMethodName = $this->symbolFlags[$realMethodName];
        }

        // Извлекаем из флага аргументы
        $arguments = explode(",", $flag);
        $arguments[0] = substr($arguments[0], strlen($methodName) + 1);

        // Вызываем метод текущего класса
        if (method_exists($this, $realMethodName)) {
            if ($negotiation) {
                return ! call_user_func_array(array(&$this, $realMethodName), $arguments);
            } else {
                return call_user_func_array(array(&$this, $realMethodName), $arguments);
            }
        } else {
            // 'Извините, заданный метод ' . $methodName . ' не существует'
            trigger_error("Sorry, method \"{$realMethodName}\" does not exist.", E_USER_ERROR);
        }
    }

}
