<?php
/** j4s\validation */

declare(strict_types=1);

namespace j4s\validation;

/**
 * Class ValidationFlagsTest - Тесты для класса ValidationFlags
 *
 * @package     validation
 * @author      Eugeniy Makarkin <soloscriptura@mail.ru>
 * @version     v1.0.0 2018-11-26 09:45:26
 * @todo Проверить комментарии phpDocumentor!!
 */
class ValidationFlagsTest
{

    /**
     * Запускает тесты данного класса
     * @version v1.0.0 2018-11-26 09:45:46
     * @return Null
     */
    public static function run()
    {
        echo '<div class="utest__section">';
        echo '<h5>ValidationFlags:</h5>';
        echo self::identTest();
        echo self::domainTest();
        echo self::protocolTest();
        echo self::wwwTest();
        echo '</div>';
    }

    /**
     * Тест для метода ident
     * @version v1.0.0 2018-11-26 09:45:55
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function identTest()
    {
        global $UTest, $RE1;

        $UTest->methodName = 'ident';


        // Arrange Test
        $UTest->nextHint = 'Начинается с латинской буквы';
        $expect = true;
        // Act
        $RE1 = new ValidationFlags('onlykey');
        $act = $RE1->ident();
        // Assert Test
        $UTest->isEqual("ident();", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Начинается с цифры';
        $expect = false;
        // Act
        $RE1 = new ValidationFlags('0onlykey');
        $act = $RE1->ident();
        // Assert Test
        $UTest->isEqual("ident();", $expect, $act);


        return $UTest->functionResults;
    }

    /**
     * Тест для метода domain
     * @version v1.0.0 2018-11-26 10:13:49
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function domainTest()
    {
        global $UTest, $RE1;

        $UTest->methodName = 'domain';


        // Arrange Test
        $UTest->nextHint = 'Домен';
        $expect = true;
        // Act
        $RE1 = new ValidationFlags('test.ru');
        $act = $RE1->domain();
        // Assert Test
        $UTest->isEqual("domain();", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Не домен';
        $expect = false;
        // Act
        $RE1 = new ValidationFlags('test');
        $act = $RE1->domain();
        // Assert Test
        $UTest->isEqual("domain();", $expect, $act);


        return $UTest->functionResults;
    }

    /**
     * Тест для метода protocol
     * @version v1.0.0 2018-11-26 10:16:48
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function protocolTest()
    {
        global $UTest, $RE1;

        $UTest->methodName = 'protocol';


        // Arrange Test
        $UTest->nextHint = 'С https';
        $expect = true;
        // Act
        $RE1 = new ValidationFlags('https://test.ru');
        $act = $RE1->protocol();
        // Assert Test
        $UTest->isEqual("protocol();", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Без https';
        $expect = false;
        // Act
        $RE1 = new ValidationFlags('test.ru');
        $act = $RE1->protocol();
        // Assert Test
        $UTest->isEqual("protocol();", $expect, $act);


        return $UTest->functionResults;
    }

    /**
     * Тест для метода www
     * @version v1.0.0 2018-11-26 10:16:48
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function wwwTest()
    {
        global $UTest, $RE1;

        $UTest->methodName = 'www';


        // Arrange Test
        $UTest->nextHint = 'С www';
        $expect = true;
        // Act
        $RE1 = new ValidationFlags('https://www.test.ru');
        $act = $RE1->www();
        // Assert Test
        $UTest->isEqual("www();", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Без www';
        $expect = false;
        // Act
        $RE1 = new ValidationFlags('https://test.ru');
        $act = $RE1->www();
        // Assert Test
        $UTest->isEqual("www();", $expect, $act);


        return $UTest->functionResults;
    }
}