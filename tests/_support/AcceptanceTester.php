<?php

use Page\jWallet as Page;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    public function setOfActions2($link)
    {
        $I = $this;
        $I->wait(3);
        $I->click($link['el']);
        $I->wait(3);
        $I->seeInCurrentUrl($link['url']);
        $I->click(page::$Logo);
    }
    /**
     * @param AcceptanceTester $I
     * @throws Exception
     */
    public function Login(AcceptanceTester $I)
    {
        $I = $this;
        $I->click(page::$LoginBtn);
        $I->waitForElementVisible(page::$LoginEmail, 100);
        $I->fillField(page::$LoginEmail, 'yurii.lobas@gmail.com');
        $I->fillField(page::$LoginPassword, '12345678');
        $I->seeInField(page::$LoginEmail, 'yurii.lobas@gmail.com');
        $I->seeInField(page::$LoginPassword, '12345678');
        $I->click(page::$LoginBtnModal);
        $I->wait(5);
    }

    public function HistorySet(AcceptanceTester $I)
    {
        $I = $this;
        $value = $I->grabTextFrom(page::$historyGrabLine);
        $I->click(page::$historyFilterTypeDrop);
        $I->click(page::$historyFilterTypeOutput);                          // Исходящий
        $I->wait(2);
        $value1 = $I->grabTextFrom(page::$historyGrabLine);                 // Грабаэться цілий рядок
        $I->assertNotSame($value, $value1);
        $I->click(page::$historyFilterTypeDrop);
        $I->click(page::$historyFilterTypeInput);                           // Входящий
        $I->wait(2);
        $I->seeElement(page::$historyFilterEmptyValue);                     // Пусте значення поки
        $I->reloadPage('/account/history');
        $I->click(page::$historyFilterTypeStatus);
        $value2 = $I->grabTextFrom(page::$historyFilterTypeStatusDrop[0]);  // Не подтвержден
        $I->click(page::$historyFilterTypeStatusDrop[0]);
        $I->wait(2);
        $value3 = $I->grabTextFrom(page::$historyStatusCol);
        $I->assertSame($value2, $value3);
        $I->click(page::$historyFilterTypeStatus);
        $value4 = $I->grabTextFrom(page::$historyFilterTypeStatusDrop[1]);  // Подтвержден
        $I->click(page::$historyFilterTypeStatusDrop[1]);
        $I->wait(2);
        $value5 = $I->grabTextFrom(page::$historyStatusCol);
        $I->assertSame($value4, $value5);
        $I->click(page::$historyFilterTypeStatus);
        $value6 = $I->grabTextFrom(page::$historyFilterTypeStatusDrop[2]);  // В Очереди
        $I->click(page::$historyFilterTypeStatusDrop[2]);
        $I->wait(2);
        $value7 = $I->grabTextFrom(page::$historyStatusCol);
        $I->assertSame($value6, $value7);
        $I->click(page::$historyFilterTypeStatus);
        $value8 = $I->grabTextFrom(page::$historyFilterTypeStatusDrop[3]);  // Исполнен  - пусте значення поки
        $I->click(page::$historyFilterTypeStatusDrop[3]);
        $I->wait(2);
        $value9 = $I->grabTextFrom(page::$historyFilterEmptyValue);          // Исполнен  - пусте значення поки
        $I->assertNotSame($value8, $value9);
        $I->click(page::$historyFilterTypeStatus);
        $value10 = $I->grabTextFrom(page::$historyFilterTypeStatusDrop[4]);  // Отменен
        $I->click(page::$historyFilterTypeStatusDrop[4]);
        $I->wait(2);
        $value11 = $I->grabTextFrom(page::$historyStatusCol);
        $I->assertSame($value10, $value11);
        $I->click(page::$historyFilterTypeStatus);
        $value12 = $I->grabTextFrom(page::$historyFilterTypeStatusDrop[5]);  // В процессе
        $I->click(page::$historyFilterTypeStatusDrop[5]);
        $I->wait(2);
        $value13 = $I->grabTextFrom(page::$historyFilterEmptyValue);
        $I->assertNotSame($value12, $value13);
        $I->reloadPage('/account/history');
        $I->wait(2);
        $I->click(page::$historyFilterSystemPayDrop);
        $value14 = $I->grabTextFrom(page::$historyFilterSystemPay[0]);       // Все Системи
        $I->click(page::$historyFilterSystemPay[0]);
        $I->wait(2);
        $value15 = $I->grabTextFrom(page::$historySystemPayCol);
        $I->assertNotSame($value14, $value15);
        $I->click(page::$historyFilterSystemPayDrop);
        $value16 = $I->grabTextFrom(page::$historyFilterSystemPay[1]);       // jWallet
        $I->click(page::$historyFilterSystemPay[1]);
        $I->wait(2);

        $I->click(page::$historyFilterCalendar);
        $I->click(page::$historyFilterCalendarPrev);
        $I->click(page::$historyFilterCalendarDay);
        $I->wait(2);

        $value17 = $I->grabTextFrom(page::$historySystemPayCol);
        $I->assertSame($value16, $value17);                                  // jWallet
        $I->click(page::$historyFilterSystemPayDrop);
        $value18 = $I->grabTextFrom(page::$historyFilterSystemPay[2]);       // Bitcoin
        $I->click(page::$historyFilterSystemPay[2]);
        $I->wait(2);
        $value19 = $I->grabTextFrom(page::$historyFilterEmptyValue);         // Bitcoin - Empty Result
        $I->assertNotSame($value18, $value19);
        /*$I->click(page::$historyFilterSystemPayDrop);
        $value20 = $I->grabTextFrom(page::$historyFilterSystemPay[3]);       // BTC-E USD kod
        $I->click(page::$historyFilterSystemPay[3]);
        $I->wait(2);
        $value21 = $I->grabTextFrom(page::$historySystemPayCol);             // BTC-E USD kod
        $I->assertSame($value20, $value21);
        $I->click(page::$historyFilterSystemPayDrop);
        $value22 = $I->grabTextFrom(page::$historyFilterSystemPay[4]);       // Paxum
        $I->click(page::$historyFilterSystemPay[4]);
        $I->wait(2);
        $value23 = $I->grabTextFrom(page::$historyFilterEmptyValue);
        $I->assertNotSame($value22, $value23);                               // Paxum - Empty Result
        $I->click(page::$historyFilterSystemPayDrop);
        $value24 = $I->grabTextFrom(page::$historyFilterSystemPay[5]);       // Perfect Money
        $I->click(page::$historyFilterSystemPay[5]);
        $I->wait(2);
        $value25 = $I->grabTextFrom(page::$historySystemPayCol);
        $I->assertSame($value24, $value25);                                  // Perfect Money
        $I->click(page::$historyFilterSystemPayDrop);
        $value26 = $I->grabTextFrom(page::$historyFilterSystemPay[6]);       // PayPal - PP
        $I->click(page::$historyFilterSystemPay[6]);
        $I->wait(2);
        $value27 = $I->grabTextFrom(page::$historySystemPayCol);
        $I->assertSame($value26, $value27);
        */
        $I->click(page::$EXIT);
        $I->wait(4);

        var_dump($value, $value1, $value2, $value4, $value4, $value5,
            $value6, $value7, $value8, $value9, $value10, $value11,
            $value12, $value13, $value14, $value15,
            $value16, $value17, $value18, $value19
            /*$value20, $value21, $value22, $value23,
            $value24, $value25, $value26, $value27*/);
    }











}
