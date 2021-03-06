<?php
/** j4s\validation */

declare(strict_types=1);

namespace j4s\validation;

/**
 * Содержит статические функции валидации
 * 
 * @package     validation
 * @author      Eugeniy Makarkin <soloscriptura@mail.ru>
 * @version     v0.3.1 2019-09-16 08:55:37
 */
class Validator
{
    /** @var string $arrayName Имя массива, атрибуты которого проверяются */
    public static $arrayName;

    /**
     * Статический метод валидации заданного атрибута, в соответствии с заданными флагами.
     * В случае непрохождения валидации выбрасывает пользовательскую ошибку с заданным текстом
     * @param string $attribute атрибут
     * @param string $flags флаги
     * @param string|null $errorMessage - текст ошибки
     * @return void
     * @version v1.2.1 2019-09-16 08:54:34
     */
    public static function validateAttribute(string $attribute, string $flags, ?string $errorMessage = null)
    {
        // Если атрибут не задан, прерываем валидацию
        if (static::isNotSet($attribute)) {
            return;
        }

        // Задаем объект ФлагиВалидации
        $ValidationFlags = new ValidationFlags(static::get($attribute));
        $ValidationFlags->convertNumeric = static::$convertNumeric;

        // Последовательно применяем флаги
        $flags = explode('|', $flags);
        foreach ($flags as $flag) {
            if ($flag !== '' && !$ValidationFlags->applyFlag($flag)) {
                // "Атрибут '{$attribute}' массива $" . static::$arrayName . " не прошел валидацию по флагу '{$flag}'."
                $value = htmlentities(static::get($attribute));
                $type = gettype(static::get($attribute));
                $errorMessage = $errorMessage ?? "Attribute \"{$attribute}\" of the array $" . static::$arrayName . " failed validation by flag \"{$flag}\". Current value is \"<strong>{$value}</strong>\"({$type})";
                trigger_error($errorMessage, E_USER_ERROR);
            }
        }
    }

    /**
     * Валидация обязательного атрибута.
     * Статический метод проверки наличия заданного атрибута и его валидации в
     * соответствии с заданными флагами.
     * В случае отсутствия атрибута выбрасывает пользовательскую ошибку с заданным текстом.
     * @version v1.2.0 2019-05-25 14:38:35
     * @param string $attribute атрибут
     * @param string $flags флаги, разделенные символом "|"
     * @return void
     */
    public static function requiredAttribute(string $attribute, string $flags = '', ?string $errorMessage = null)
    {
        // Проверяем задан ли обязательный атрибут
        if (static::isNotSet($attribute)) {
            // Обязательный Атрибут \"" . $attribute . "\" отсутствует
            trigger_error("Required attribute \"{$attribute}\" is missing.", E_USER_ERROR);
        }
        // Проводим валидацию значения
        static::validateAttribute($attribute, $flags, $errorMessage);
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
