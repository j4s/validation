<?php
/** j4s\validation */

declare(strict_types=1);

namespace j4s\validation;

/**
 * Class FiltrationFlagsTest - Тесты для класса FiltrationFlags
 *
 * @package     superglobals
 * @author      Eugeniy Makarkin <soloscriptura@mail.ru>
 * @version     v1.0.0 2018-11-27 11:00:22
 * @todo Проверить комментарии phpDocumentor!!
 */
class FiltrationFlagsTest
{

    /**
     * Запускает тесты данного класса
     * @version v1.0.0 2018-11-27 11:00:11
     * @return Null
     */
    public static function run()
    {
        echo '<div class="utest__section">';
        echo '<h5>FiltrationFlags:</h5>';
        echo self::intTest();
        echo '</div>';
    }

    /**
     * Тест для метода int
     * @version v1.0.0 2018-11-27 11:01:31
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function intTest()
    {
        global $UTest, $RE1;

        $UTest->methodName = 'int';


        // Arrange Test
        $UTest->nextHint = 'Пустое значение';
        $expect = 0;
        // Act
        $RE1 = new FiltrationFlags('');
        $act = $RE1->int();
        // Assert Test
        $UTest->isEqual("int();", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Не цифра';
        $expect = 0;
        // Act
        $RE1 = new FiltrationFlags('onlykey');
        $act = $RE1->int();
        // Assert Test
        $UTest->isEqual("int();", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Цифра';
        $expect = 123;
        // Act
        $RE1 = new FiltrationFlags(123);
        $act = $RE1->int();
        // Assert Test
        $UTest->isEqual("int();", $expect, $act);


        return $UTest->functionResults;
    }
}