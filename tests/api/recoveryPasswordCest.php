<?php 

class recoveryPasswordCest
{
    public $route = '/auth/requestRecoveryPassword';


    public function _before(ApiTester $I)
    {
    }

    /**
     * @param ApiTester $I
     */
    public function sendGetRecoveryPasswordEmptyError(ApiTester $I)         // Recovery Password
    {
        $I->sendGET($this->route, [
            'email' => ''
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeErrorMessage(['email' => ["Поле E-Mail адрес обязательно для заполнения."]]);
    }
    /**
     * @param ApiTester $I
     */
    public function sendGetRecoveryPasswordNullError(ApiTester $I)          // Recovery Password
    {
        $I->sendGET($this->route, [
            'email' => null
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeErrorMessage(['email' => ["Поле E-Mail адрес обязательно для заполнения."]]);
    }
    /**
     * @param ApiTester $I
     */
    public function sendGetRecoveryPasswordFakeError(ApiTester $I)           // Recovery Password
    {
        $I->sendGET($this->route, [
            'email' => "lilian.purdy@example.net"
        ]);
        $I->seeResponseCodeIs(404);
        $I->seeErrorMessage(["Пользователь с email: lilian.purdy@example.net не найден"]);
    }
    /**
     * @param ApiTester $I
     */
    public function sendGetRecoveryPasswordValid(ApiTester $I)           // Recovery Password
    {
        $I->sendGET($this->route, [
            'email' => "yurii.lobas@gmail.com"
        ]);
        $I->seeResponseCodeIs(200);
    }










}
