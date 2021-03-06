<?php
/** j4s\validation */

declare(strict_types=1);

namespace j4s\validation;

/**
 * Класс реализующий функционал флагов валидации
 * Каждый метод данного класса возвращает результат проверки значения $this->target
 * (соответствует ли оно регулярному выражению, либо другим условиям) в формате bool
 * @package     validation
 * @author      Eugeniy Makarkin <soloscriptura@mail.ru>
 * @version     v0.3.0 2019-05-25 11:53:19
 */
class ValidationFlags extends ApplyFlags
{
    /** @var bool $convertNumeric пытаться ли конвертировать строку в число? */
    public $convertNumeric = false;

    /**
     * Конструктор
     * @version v0.1.0 2018-12-08 08:14:26
     * @since v1.0.0-alpha.3
     * @param mixed $target - Значение атрибута, которое проходит валидацию
     */
    public function __construct($target = null)
    {
        parent::__construct($target);

        $this->symbolFlags = array(
            '>'  => 'greaterThan',
            '>=' => 'greaterThanEq',
            '<'  => 'lessThan',
            '<=' => 'lessThanEq',
            '<>' => 'notEq',
            '='  => 'eq'
        );
    }

    /**
     * Флаг валидации значения идентификатора(ident).
     * Идентификатор отвечает следующим условиям: 
     * 1. Начинается с прописной латинской буквы.
     * 2. Может состоять только из прописных латинских букв, цифр и нижнего подчеркивания.
     * @version v0.2.2 2018-12-08 01:03:48
     * @return bool
     */
    public function ident() : bool
    {
        return preg_match('/^[a-z]([a-z0-9_])*$/', $this->target) === 1;
    }

    /**
     * Флаг валидации домена.
     * Возврает true, только если $this->target содержит домен, допустимо с указанием протокола и www
     * @version v0.2.0 2018-11-19 14:52:13
     * @return bool
     */
    public function domain() : bool
    {
        return preg_match('/^(https?:\/\/)?([a-zA-z0-9-]*\.)*[a-zA-z0-9-]*\.[a-zA-z0-9-]*$/', $this->target) === 1;
    }


    /**
     * Флаг валидации URL.
     * Возврает true, только если $this->target содержит url, допустимо с указанием протокола и www
     * @version v0.1.0 2018-11-26 13:43:12
     * @since v1.0.0-alpha.5
     * @return bool
     */
    public function url() : bool
    {
        return preg_match('/^(https?:\/\/)?([a-zA-z0-9-]*\.)*[a-zA-z0-9-]*\.[a-zA-z0-9-]*/', $this->target) === 1;
    }

    /**
     * Флаг валидации домена или url на наличие протокола.
     * Возврает true, только если $this->target начинается с протокола https или http
     * @version v0.2.1 2018-11-26 13:39:36
     * @return bool
     */
    public function protocol() : bool
    {
        return 0 === strpos($this->target, 'http');
    }

    /**
     * Флаг валидации домена или url.
     * Возвращает true, только если $this->target начинается с www либо с протокола и www
     * @version v0.2.0 2018-11-19 14:52:13
     * @return bool
     */
    public function www() : bool
    {
        return preg_match('/^(https?:\/\/)?(www\.)/', $this->target) === 1;
    }


    /**
     * Флаг валидации integer.
     * Возвращает true, только если $this->target является целым числом
     * @version v0.1.2 2019-05-25 15:17:03
     * @since v1.0.0-alpha.6
     * @return bool
     */
    public function int() : bool
    {
        $value = $this->target;
        if ($this->convertNumeric) {
            return (string)$value === (string)(int)$value;
        }

        return is_int($value);
    }


    /**
     * Флаг валидации greaterThan.
     * Возвращает true, только если $this->target больше чем заданное число
     * @version v0.1.0 2018-12-05 22:38:49
     * @since v1.0.0-alpha.6
     * @param int|float $number - число, с которым сравнивается $this->target
     * @return bool
     */
    public function greaterThan($number) : bool
    {
        return $this->target > $number;
    }

    /**
     * Флаг валидации eq.
     * Возвращает true, только если $this->target равен заданному значению
     * @version v0.1.0 2019-05-25 11:50:43
     * @since v1.0.0-alpha.7
     * @param string $value - Значение
     * @return bool
     */
    public function eq($value) : bool
    {
        return $this->target == $value;
    }

    /**
     * Флаг валидации date.
     * Возвращает true, только если $this->target Является корректной датой формата Y-m-d
     * @version v0.1.0 2019-05-28 21:48:32
     * @since v1.0.0-alpha.7
     * @return bool
     */
    public function date() : bool
    {
        $date = $this->target;

        if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $date) && strtotime($date)) {
            return $date === date('Y-m-d', strtotime($date));
        }

        return false;
    }

}
