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
 * @version     v0.2.1 2018-11-26 06:37:58
 */
class ValidationFlags extends ApplyFlags
{
    /** @var bool $convertNumeric пытаться ли конвертировать строку в число? */
    public $convertNumeric = false;

    /**
     * Флаг валидации значения идентификатора(ident).
     * Идентификатор отвечает следующим условиям: 
     * 1. Начинается с прописной латинской буквы.
     * 2. Может состоять только из прописных латинских букв, цифр и нижнего подчеркивания.
     * @version v0.2.1 2018-11-26 06:37:40
     * @return bool
     */
    public function ident() : bool
    {
        return preg_match('/^[a-z]([a-z0-9_])*$/', $this->target) === 1;
        return preg_match('/^\w([\w\d_])*$/', $this->target) === 1;
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
        return preg_match('/^http/', $this->target) === 1;
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
     * @version v0.1.0 2018-12-05 22:06:40
     * @since v1.0.0-alpha.6
     * @return bool
     */
    public function int() : bool
    {
        $value = $this->target;
        if ($this->convertNumeric) {
            $value = (int) $value;
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

}
