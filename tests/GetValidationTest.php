<?php
/** j4s\validation */

declare(strict_types=1);

namespace j4s\validation;

use j4s\superglobals\Get;

/**
 * Тесты для класса GetValidation
 *
 * @package     validation
 * @author      Eugeniy Makarkin <soloscriptura@mail.ru>
 * @version     v0.1.0 2019-05-24 19:57:18
 */
class GetValidationTest
{

    /**
     * Запускает тесты данного класса
     * @version v0.1.0 2019-05-24 19:57:51
     * @return void
     */
    public static function run()
    {
        echo '<div class="utest__section">';
        echo '<h5>GetValidation:</h5>';
        echo self::identTest();
        echo '</div>';
    }

    /**
     * Тест для флага ident в методе validateAttribute
     * @version v0.1.0 2019-05-24 19:58:44
     * @global object $UTest - Глобальный объект UTest
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function identTest() : string
    {
        global $UTest;

        $UTest->methodName = 'validateAttribute(x, \'ident\')';


        // Arrange Test
        $UTest->nextHint = 'Является пустым';
        $expect = true;
        // Act
        set_error_handler('testsErrorHandler');
        Get::validateAttribute('onlykey', 'ident');
        restore_error_handler();
        $act = !is_null($UTest->triggeredErrorText);
        $UTest->triggeredErrorText = null;
        // Assert Test
        $UTest->isEqual("ident();", $expect, $act);


        return $UTest->functionResults;
    }

}
