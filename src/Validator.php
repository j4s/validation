<?php
/** j4s\validation */

declare(strict_types=1);

namespace j4s\validation;

/**
 * Содержит статические функции валидации
 * 
 * @package     validation
 * @author      Eugeniy Makarkin <soloscriptura@mail.ru>
 * @version     v0.2.1 2018-12-08 01:13:34
 */
class Validator
{
    /** @var string $arrayName Имя массива, атрибуты которого проверяются */
    public static $arrayName;

    /**
     * Статический метод валидации заданного атрибута, в соответствии с заданными флагами.
     * В случае непрохождения валидации выбрасывает пользовательскую ошибку
     * @version v1.1.1 2018-12-08 01:13:24
     * @param string $attribute атрибут
     * @param string $flags флаги
     * @return void
     */
    public static function validateAttribute(string $attribute, string $flags)
    {
        // Если атрибут не задан, прерываем валидацию
        if (static::isNotSet($attribute)) {
            return;
        }

        // Задаем объект ФлагиВалидации
        $ValidationFlags = new ValidationFlags(static::get($attribute));
        $ValidationFlags->convertNumeric = static::$convertNumeric;

        // Последовательно применяем флаги
        $flags = explode("|", $flags);
        foreach ($flags as $flag) {
            if ($flag !== '' && !$ValidationFlags->applyFlag($flag)) {
                // "Атрибут '{$attribute}' массива $" . static::$arrayName . " не прошел валидацию по флагу '{$flag}'."
                $value = htmlentities(static::get($attribute));
                $type = gettype(static::get($attribute));
                trigger_error("Attribute \"{$attribute}\" of the array $" . static::$arrayName . " failed validation by flag \"{$flag}\". Current value is \"<strong>{$value}</strong>\"({$type})", E_USER_ERROR);
            }
        }
    }

    /**
     * Валидация обязательного атрибута.
     * Статический метод проверки наличия заданного атрибута и его валидации в
     * соответствии с заданными флагами.
     * В случае отсутствия атрибута выбрасывает пользовательскую ошибку.
     * @version v1.1.0 2018-11-19 15:13:04
     * @param string $attribute атрибут
     * @param string $flags флаги, разделенные символом "|"
     * @return void
     */
    public static function requiredAttribute(string $attribute, string $flags = '')
    {
        // Проверяем задан ли обязательный атрибут
        if (static::isNotSet($attribute)) {
            // Обязательный Атрибут \"" . $attribute . "\" отсутствует
            trigger_error("Required attribute \"{$attribute}\" is missing.", E_USER_ERROR);
        }
        // Проводим валидацию значения
        static::validateAttribute($attribute, $flags);
    }

    /**
     * Фильтрация атрибута.
     * Метод фильтрации заданного ключа дочернего массива по заданным флагам
     * @version v1.1.0 2018-11-19 15:13:51
     * @param string - $attribute имя ключа
     * @param string - $flags список флагов разделенных |
     * @return mixed
     */
    public static function filterAttribute(string $attribute, string $flags)
    {
        $FiltrationFlags = new FiltrationFlags(static::get($attribute));

        $flags = explode("|", $flags);
        foreach ($flags as $flag) {
            $result = $FiltrationFlags->applyFlag($flag);
        }

        return $result;
    }

}
