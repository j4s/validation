<?php
/** j4s\validation */

declare(strict_types=1);

namespace j4s\validation;

/**
 * Тесты для класса FiltrationFlags
 *
 * @package     filtration
 * @author      Eugeniy Makarkin <soloscriptura@mail.ru>
 * @version     v1.0.2 2018-12-08 01:25:11
 */
class FiltrationFlagsTest
{

    /**
     * Запускает тесты данного класса
     * @version v1.0.1 2018-12-08 01:45:41
     * @return void
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
     * @version v1.0.2 2018-12-08 01:45:53
     * @global object $UTest - Глобальный объект UTest
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function intTest() : string
    {
        global $UTest;

        $UTest->methodName = 'int';


        // Arrange Test
        $UTest->nextHint = 'Пустое значение';
        $expect = 0;
        // Act
        $Filtration = new FiltrationFlags('');
        $act = $Filtration->int();
        // Assert Test
        $UTest->isEqual("int();", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Не число';
        $expect = 0;
        // Act
        $Filtration = new FiltrationFlags('onlykey');
        $act = $Filtration->int();
        // Assert Test
        $UTest->isEqual("int();", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Число';
        $expect = 123;
        // Act
        $Filtration = new FiltrationFlags(123);
        $act = $Filtration->int();
        // Assert Test
        $UTest->isEqual("int();", $expect, $act);


        return $UTest->functionResults;
    }
}