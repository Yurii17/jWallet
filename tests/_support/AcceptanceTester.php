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
        $I->click($link['el']);
        $I->wait(3);
        $I->seeInCurrentUrl($link['url']);
        $I->click(page::$Logo);
    }

    public function Login(AcceptanceTester $I)
    {
        $I = $this;
        $I->click(page::$LoginBtn);
        $I->wait(2);
        $I->fillField(page::$LoginEmail, 'yurii.lobas@gmail.com');
        $I->fillField(page::$LoginPassword, '12345678');
        $I->seeInField(page::$LoginEmail, 'yurii.lobas@gmail.com');
        $I->seeInField(page::$LoginPassword, '12345678');
        $I->click(page::$LoginBtnModal);
        $I->wait(5);
    }











}
