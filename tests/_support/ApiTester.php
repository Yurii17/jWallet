<?php

use loginCest;
use profileCest;
use recoveryPasswordCest;

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
class ApiTester extends \Codeception\Actor
{
    use _generated\ApiTesterActions;

   /**
    * Define custom actions here
    */

    /**
     * @param $email
     * @param $password
     * @throws Exception
     * @var \loginCest
     */
   public function loginAs($email, $password) {
       $helper = new loginCest();
       $this->sendPOST($helper->route, [
           'email' => $email,
           'password' => $password
       ]);
       $this->seeResponseIsOK();
       $token = $this->grabDataFromResponseByJsonPath('$.data.access_token');
       $this->amBearerAuthenticated($token[0]);
   }

   public function seeResponseIsOK()
   {
       $this->seeResponseCodeIs(200);
   }

   public function seeResponseIsUnauthorized()
   {
       $this->seeResponseCodeIs(401);
   }

   public function seeErrorMessage($message)
   {
       $this->seeResponseContainsJson([
           "data" => [],
           "message" => "error",
           "errors" => $message
       ]);
   }

   public function removeAuthHeader()
   {
       $this->deleteHeader('Authorization');
   }

   public function seeAuthErrorMessage()
   {
        $this->seeResponseCodeIs(401);
        $this->seeErrorMessage(['Не авторизован']);
   }

   public function seeErrorLoginMessage()
   {
       $this->seeResponseCodeIs(400);
       $this->seeErrorMessage([
           'email' => ['Поле \'Email\' обязательно для заполнения.'],
           'password' => ['Поле \'Пароль\' обязательно для заполнения.']]);
   }

   public function seeErrorEmailMessage()
   {
       $this->seeResponseCodeIs(400);
       $this->seeErrorMessage(['email' => ['Поле \'Email\' обязательно для заполнения.']]);
   }

   public function seeErrorPasswordMessage()
   {
       $this->seeResponseCodeIs(400);
       $this->seeErrorMessage(['password' => ['Поле \'Пароль\' обязательно для заполнения.']]);
   }

   public function seeErrorWrongPasswordMessage()
   {
       $this->seeResponseCodeIs(403);
       $this->seeErrorMessage(['Неверное имя пользователя или пароль']);
   }

}
