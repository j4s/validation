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
 * @version     v0.2.0 2018-11-19 15:00:40
 */
class ValidationFlags extends ApplyFlags
{

    /**
     * Флаг валидации значения идентификатора(ident).
     * @version v0.2.0 2018-11-19 14:52:13
     * @return bool
     */
    public function ident() : bool
    {
        return preg_match('/^[a-z]([a-z0-9_])*$/', $this->target);
    }

    /**
     * Флаг валидации домена.
     * Возврает true, только если $this->target содержит домен, допустимо с указанием протокола и www
     * @version v0.2.0 2018-11-19 14:52:13
     * @return bool
     */
    public function domain() : bool
    {
        return preg_match('/^(https?:\/\/)?([a-zA-z0-9-]*\.)*[a-zA-z0-9-]*\.[a-zA-z0-9-]*$/', $this->target);
    }

    /**
     * Флаг валидации домена или url.
     * Возврает true, только если $this->target начинается с протокола https или http
     * @version v0.2.0 2018-11-19 14:52:13
     * @return bool
     */
    public function protocol() : bool
    {
        return preg_match('/^http/', $this->target);
    }

    /**
     * Флаг валидации домена или url.
     * Возвращает true, только если $this->target начинается с www либо с протокола и www
     * @version v0.2.0 2018-11-19 14:52:13
     * @return bool
     */
    public function www() : bool
    {
        return preg_match('/^(https?:\/\/)?(www\.)/', $this->target);
    }

}
