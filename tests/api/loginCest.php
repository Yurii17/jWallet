<?php

use Faker\Factory as fake;

use \Codeception\Util\HttpCode as response;

class loginCest
{
    public $route = '/auth/login';

    public function _before(ApiTester $I)
    {
//        $I->haveHttpHeader('Accept', 'application/json');
//        $I->haveHttpHeader('Content-type' ,'application/json');
    }

    public function _after(ApiTester $I)
    {
    }

    /**
     * @param ApiTester $I
     * @throws Exception
     */
    public function sendPostLoginValid(ApiTester $I)
    {
        $I->loginAs("yurii.lobas@gmail.com", "12345678");
    }

    /**
     * @param ApiTester $I
     */
    public function sendPostDataNullError(ApiTester $I)
    {
        $I->sendPOST($this->route, [
            'email' => null,
            'password' => null
        ]);
        $I->seeErrorLoginMessage();
    }

    /**
     * @param ApiTester $I
     */
    public function sendPostDataEmptyError(ApiTester $I)
    {
        $I->sendPOST($this->route, [
            'email' => ' ',
            'password' => ' '
        ]);
        $I->seeErrorLoginMessage();
    }

    /**
     * @param ApiTester $I
     */
    public function sendPostEmailEmptyError(ApiTester $I)
    {
        $I->sendPOST($this->route, [
            'email' => null,
            'password' => fake::create()->password
        ]);
        $I->seeErrorEmailMessage();
    }

    /**
     * @param ApiTester $I
     */
    public function sendPostPasswordEmptyError(ApiTester $I)
    {
        $I->sendPOST($this->route, [
            'email' => fake::create()->safeEmail,
            'password' => null
        ]);
        $I->seeErrorPasswordMessage();
    }
    /**
     * @param ApiTester $I
     */
    public function sendPostWrongPasswordError(ApiTester $I)
    {
        $I->sendPOST($this->route, [
            'email' => 'yurii.lobas@gmail.com',
            'password' => fake::create()->password
        ]);
        $I->seeErrorWrongPasswordMessage();
    }

    /**
     * @param ApiTester $I
     */
    public function sendPostPasswordEmailError(ApiTester $I)
    {
        $I->sendPOST($this->route, [
            'email' => fake::create()->safeEmail,
            'password' => fake::create()->password
        ]);
        $I->seeErrorWrongPasswordMessage();
    }

    /**
     * @param ApiTester $I
     */
    public function sendPostPasswordLengthError(ApiTester $I)
    {
        $I->sendPOST($this->route, [
            'email' => fake::create()->safeEmail,
            'password' => '12'
        ]);
        $I->seeErrorWrongPasswordMessage();
    }
    /**
     * @param ApiTester $I
     */
    public function sendPostWrongEmailError(ApiTester $I)
    {
        $I->sendPOST($this->route, [
            'email' => fake::create()->safeEmail,
            'password' => '12345678'
        ]);
        $I->seeErrorWrongPasswordMessage();
    }

    /**
     * @param ApiTester $I
     */
    public function sendPostHeaders(ApiTester $I)
    {
        $I->haveHttpHeader('Content-type', 'application/json');
        $I->sendPOST($this->route, [
            'email' => "yurii.lobas@gmail.com",
            'password' => "12345678"
        ]);
        $I->seeResponseCodeIs(200);
    }




















}





