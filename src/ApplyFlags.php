<?php
/** j4s\validation */

declare(strict_types=1);

namespace j4s\validation;

/**
 * Абстрактный класс, для создания на его основе классов реализующий функционал флагов
 *
 * @package     validation
 * @author      Eugeniy Makarkin <soloscriptura@mail.ru>
 * @version     v0.2.1 2018-11-19 14:48:00
 */
abstract class ApplyFlags
{
    /** @var bool $target Значение атрибута, который проходит валидацию */
    protected $target;
    /** @var array $symbolOperators Массив зарегистрированных символьных операторов */
    protected $symbolOperators = array('>=', '<=', '<', '>', '!');

    /**
     * Конструктор
     * @version v1.0.2 2018-11-19 14:44:29
     * @param bool $target - Значение атрибута, который проходит валидацию
     */
    public function __construct($target = null)
    {
        $this->target = $target;
    }

    /**
     * Основной метод класса - применяет к заданному значению заданный флаг.
     * Если метод с флагом отсутствует в дочернем классе, то выводит ошибку.
     * @version v1.0.3 2018-11-19 14:45:09
     * @param string $flag флаг
     * @return mixed
     */
    public function applyFlag(string $flag)
    {
        // Извлекаем из флага имя метода
        $methodName = preg_replace("/^(.*)\s/", "$1", $flag);

        // Извлекаем из флага символьный оператор ! при его наличии
        $negotiation = 0;
        if (preg_match("/^\!/", $methodName)) {
            $methodName = preg_replace("/!(.*)/", "$1", $methodName);
            $negotiation = 1;
        }

        // Извлекаем из флага аргументы
        $arguments = explode(",", $flag);
        $arguments[0] = substr($arguments[0], strlen($methodName) + 1);

        // Вызываем метод текущего класса
        if (method_exists($this, $methodName)) {
            if ($negotiation) {
                return ! call_user_func_array(array(&$this, $methodName), $arguments);
            } else {
                return call_user_func_array(array(&$this, $methodName), $arguments);
            }
        } else {
            // 'Извините, заданный метод ' . $methodName . ' не существует'
            trigger_error("Sorry, method \"{$methodName}\" does not exist.", E_USER_ERROR);
        }
    }

}
