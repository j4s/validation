<?php
/** j4s\validation */

declare(strict_types=1);

namespace j4s\validation;

use j4s\superglobals\Get;

/**
 * Тесты для класса ValidationFlags
 *
 * @package     validation
 * @author      Eugeniy Makarkin <soloscriptura@mail.ru>
 * @version     v1.0.6 2018-12-08 01:50:40
 */
class ValidationFlagsTest
{

    /**
     * Запускает тесты данного класса
     * @version v1.0.2 2018-12-06 15:35:53
     * @return void
     */
    public static function run()
    {
        echo '<div class="utest__section">';
        echo '<h5>ValidationFlags:</h5>';
        echo self::identTest();
        echo self::domainTest();
        echo self::protocolTest();
        echo self::wwwTest();
        echo self::intTest();
        echo self::greaterThanTest();
        echo '</div>';
    }

    /**
     * Тест для метода ident
     * @version v1.0.3 2018-12-08 01:49:24
     * @global object $UTest - Глобальный объект UTest
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function identTest() : string
    {
        global $UTest;

        $UTest->methodName = 'ident';


        // Arrange Test
        $UTest->nextHint = 'Начинается с латинской буквы';
        $expect = true;
        // Act
        $ValidationFlags = new ValidationFlags('onlykey');
        $act = $ValidationFlags->ident();
        // Assert Test
        $UTest->isEqual("ident();", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Начинается с цифры';
        $expect = false;
        // Act
        $ValidationFlags = new ValidationFlags('0onlykey');
        $act = $ValidationFlags->ident();
        // Assert Test
        $UTest->isEqual("ident();", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Содержит лишние символы';
        $expect = false;
        // Act
        $ValidationFlags = new ValidationFlags('only^key');
        $act = $ValidationFlags->ident();
        // Assert Test
        $UTest->isEqual("ident();", $expect, $act);


        return $UTest->functionResults;
    }

    /**
     * Тест для метода domain
     * @version v1.0.3 2018-12-08 01:49:32
     * @global object $UTest - Глобальный объект UTest
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function domainTest() : string
    {
        global $UTest;

        $UTest->methodName = 'domain';


        // Arrange Test
        $UTest->nextHint = 'Домен';
        $expect = true;
        // Act
        $ValidationFlags = new ValidationFlags('test.ru');
        $act = $ValidationFlags->domain();
        // Assert Test
        $UTest->isEqual("domain();", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Не домен';
        $expect = false;
        // Act
        $ValidationFlags = new ValidationFlags('test');
        $act = $ValidationFlags->domain();
        // Assert Test
        $UTest->isEqual("domain();", $expect, $act);


        return $UTest->functionResults;
    }

    /**
     * Тест для метода protocol
     * @version v1.0.3 2018-12-08 01:49:43
     * @global object $UTest - Глобальный объект UTest
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function protocolTest() : string
    {
        global $UTest;

        $UTest->methodName = 'protocol';


        // Arrange Test
        $UTest->nextHint = 'С https';
        $expect = true;
        // Act
        $ValidationFlags = new ValidationFlags('https://test.ru');
        $act = $ValidationFlags->protocol();
        // Assert Test
        $UTest->isEqual("protocol();", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Без https';
        $expect = false;
        // Act
        $ValidationFlags = new ValidationFlags('test.ru');
        $act = $ValidationFlags->protocol();
        // Assert Test
        $UTest->isEqual("protocol();", $expect, $act);


        return $UTest->functionResults;
    }

    /**
     * Тест для метода www
     * @version v1.0.3 2018-12-08 01:49:52
     * @global object $UTest - Глобальный объект UTest
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function wwwTest() : string
    {
        global $UTest;

        $UTest->methodName = 'www';


        // Arrange Test
        $UTest->nextHint = 'С www';
        $expect = true;
        // Act
        $ValidationFlags = new ValidationFlags('https://www.test.ru');
        $act = $ValidationFlags->www();
        // Assert Test
        $UTest->isEqual("www();", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Без www';
        $expect = false;
        // Act
        $ValidationFlags = new ValidationFlags('https://test.ru');
        $act = $ValidationFlags->www();
        // Assert Test
        $UTest->isEqual("www();", $expect, $act);


        return $UTest->functionResults;
    }

    /**
     * Тест для метода int
     * @version v0.1.4 2018-12-08 01:50:00
     * @since v1.0.0-alpha.6
     * @global object $UTest - Глобальный объект UTest
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function intTest() : string
    {
        global $UTest;

        $UTest->methodName = 'int';


        // Arrange Test
        $UTest->nextHint = 'Целое число < 0';
        $expect = true;
        // Act
        $ValidationFlags = new ValidationFlags(-5);
        $act = $ValidationFlags->int();
        // Assert Test
        $UTest->isEqual("int(); -5", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Float';
        $expect = false;
        // Act
        $ValidationFlags = new ValidationFlags(5.2);
        $act = $ValidationFlags->int();
        // Assert Test
        $UTest->isEqual("int(); 5.2", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Word';
        $expect = false;
        // Act
        $ValidationFlags = new ValidationFlags('word');
        $act = $ValidationFlags->int();
        // Assert Test
        $UTest->isEqual("int(); word", $expect, $act);


        // Arrange Test
        $UTest->nextHint = '0';
        $expect = true;
        // Act
        $ValidationFlags = new ValidationFlags(0);
        $act = $ValidationFlags->int();
        // Assert Test
        $UTest->isEqual("int(); 0", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'string 1';
        $expect = false;
        // Act
        $ValidationFlags = new ValidationFlags('1');
        $act = $ValidationFlags->int();
        // Assert Test
        $UTest->isEqual("int(); 1", $expect, $act);


        return $UTest->functionResults;
    }

    /**
     * Тест для метода greaterThan
     * @version v0.1.2 2018-12-08 01:50:10
     * @since v1.0.0-alpha.6
     * @global object $UTest - Глобальный объект UTest
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function greaterThanTest() : string
    {
        global $UTest;

        $UTest->methodName = 'greaterThan';


        // Arrange Test
        $UTest->nextHint = '-5 > 0';
        $expect = false;
        // Act
        $ValidationFlags = new ValidationFlags(-5);
        $act = $ValidationFlags->greaterThan(0);
        // Assert Test
        $UTest->isEqual("greaterThan(0); -5", $expect, $act);


        // Arrange Test
        $UTest->nextHint = '5.2 > 1';
        $expect = true;
        // Act
        $ValidationFlags = new ValidationFlags(5.2);
        $act = $ValidationFlags->greaterThan(1);
        // Assert Test
        $UTest->isEqual("greaterThan(1); 5.2", $expect, $act);


        // Arrange Test
        // Необычный тест - он не выводит зеленую строку в случае успеха, но выведет trigger_error в случае неудачи.
        Get::requiredAttribute('boolean', 'int|> 0');


        return $UTest->functionResults;
    }

}
