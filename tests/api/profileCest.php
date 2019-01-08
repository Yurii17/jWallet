<?php 

use Faker\Factory as fake;
require_once __DIR__.'/loginCest.php';

class profileCest
{
    public $route = ['/profile' , '/ticket', '/transfer?lang=ru',
        '/walletTransactionMass?lang=ru', '/transferService?lang=ru', '/deposit?lang=ru'];

    /**
     * @param ApiTester $I
     * @throws Exception
     */
    public function _before(ApiTester $I)
    {
        $I->loginAs("yurii.lobas@gmail.com", "12345678");
    }

    // tests
    public function sendGetUserProfileValid(ApiTester $I)
    {
        $I->sendGET($this->route[0]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(["email" => "yurii.lobas@gmail.com"]);
    }

    // tests
    public function sendGetUserProfileAuthError(ApiTester $I)
    {
        $I->removeAuthHeader();
        $I->sendGET($this->route[0]);
    }

    public function sendPostTicketAuthError(ApiTester $I)
    {
        $I->removeAuthHeader();
        $I->sendPOST($this->route[1] ,[
            'title' => fake::create()->text,
            'config_id' => "ID from api/ticketConfigs"
            ]);
        $I->seeAuthErrorMessage();
    }


    // ApiAccountTransfer

    /**
     * @param ApiTester $I
     * @throws Exception
     */
    public function sendPostJWReceiverError(ApiTester $I)               //Transfer/JW
    {
        $I->sendPOST($this->route[2], [
            "eps_code" => "JW",
            "transfer_input" => "transfer_send",
            "transfer_receive_amount" => "10.00",
            "transfer_receiver_type" => "text",
            "transfer_receiver_value" => "JU000000",
            "transfer_send_amount" => "10"
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeErrorMessage(["Неправильно введен получатель"]);
    }

    public function sendPostJWValueError(ApiTester $I)                  //Transfer/JW
    {
        $I->sendPOST($this->route[2], [
            "eps_code" => "JW",
            "transfer_input" => "transfer_send",
            "transfer_receive_amount" => "1e+21",
            "transfer_receiver_type" => "text",
            "transfer_receiver_value" => "JU000000",
            "transfer_send_amount" => "999999999999999999999"
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeErrorMessage(["Введите корректную сумму"]);
    }
    /**
     * @param ApiTester $I
     * @throws Exception
     */
    public function sendPostJWAmountLimitError(ApiTester $I)             //Transfer/JW
    {
        $I->sendPOST($this->route[2], [
            "eps_code" => "JW",
            "transfer_input" => "transfer_send",
            "transfer_receive_amount" => "8999999.00",
            "transfer_receiver_type" => "text",
            "transfer_receiver_value" => "JU000000000",
            "transfer_send_amount" => "8999999"
        ]);
        $I->seeResponseCodeIs(400);
//        $I->seeErrorMessage(["Превышен лимит. Максимальная сумма отправления - 8999986USD"]);
    }

    public function sendPostJWMinAmountError(ApiTester $I)                //Transfer/JW
    {
        $I->sendPOST($this->route[2], [
            "eps_code" => "JW",
            "transfer_input" => "transfer_send",
            "transfer_receive_amount" => "1.00",
            "transfer_receiver_type" => "text",
            "transfer_receiver_value" => "JU000000000",
            "transfer_send_amount" => "1"
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeErrorMessage(["Минимальная сумма отправления - $2"]);
    }

    public function sendPostJWSendAmountError(ApiTester $I)                //Transfer/JW
    {
        $I->sendPOST($this->route[2], [
            "eps_code" => "JW",
            "transfer_input" => "transfer_send",
            "transfer_receive_amount" => "12.00",
            "transfer_receiver_type" => "text",
            "transfer_receiver_value" => "JU000000000",
            "transfer_send_amount" => "12$$#^"
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeErrorMessage(["transfer_send_amount" =>
        ["Поле 'Сумма отправления' должно быть числом."]]);
    }

    public function sendPostJWTextError(ApiTester $I)                        //Transfer/JW
    {
        $I->sendPOST($this->route[2], [
            "eps_code" => "JW",
            "transfer_input" => "transfer_send",
            "transfer_receive_amount" => "2.00",
            "transfer_receiver_type" => "text",
            "transfer_receiver_value" => "JU000000000",
            "transfer_send_amount" => "2",
            "transfer_subject" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet,
                consectetur adipiscing elit, sed do eiusmod tempor incididunt."
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeErrorMessage(["transfer_subject" =>
        ["Количество символов в поле 'Предмет перевода' не может превышать 200."]]);
    }

    public function sendPostJWNullError(ApiTester $I)                            //Transfer/JW
    {
        $I->sendPOST($this->route[2], [
            "eps_code" => "JW",
            "transfer_input" => "transfer_send",
            "transfer_receive_amount" => null,
            "transfer_receiver_type" => "text",
            "transfer_receiver_value" => "JU000000000",
            "transfer_send_amount" => null
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeErrorMessage([]);
    }

    public function sendPostBTCFakeError(ApiTester $I)                             //Transfer/BTC
    {
        $I->sendPOST($this->route[2], [
            "eps_code" => "BTC",
            "transfer_input" => "transfer_send",
            "transfer_receive_amount" => "0.051035",
            "transfer_receiver" => fake::create()->randomDigit,
            "transfer_send_amount" => "333"
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeErrorMessage(["Укажите корректный кошелек получателя"]);
    }

    public function sendPostBTCMinAmountError(ApiTester $I)                         //Transfer/BTC
    {
        $I->sendPOST($this->route[2], [
            "eps_code" => "BTC",
            "transfer_input" => "transfer_send",
            "transfer_receive_amount" => "0.001048",
            "transfer_receiver" => "222222222222222222222222",
            "transfer_send_amount" => "10"
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeErrorMessage(["Минимальная сумма к получению - 0.01 BTC"]);
    }

    public function sendPostBTCMaxAmountError(ApiTester $I)                         //Transfer/BTC
    {
        $I->sendPOST($this->route[2], [
            "eps_code" => "BTC",
            "transfer_input" => "transfer_send",
            "transfer_receive_amount" => "1.361",
            "transfer_receiver" => "222222222222222222222222",
            "transfer_send_amount" => "8797.49"
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeErrorMessage(["Максимальная сумма к получению - 1.36 BTC"]);
    }

    public function sendPostBTCOK(ApiTester $I)                                      //Transfer/BTC
    {
        $I->sendPOST($this->route[2], [
            "eps_code" => "BTC",
            "transfer_input" => "transfer_send",
            "transfer_receive_amount" => "0.01",
            "transfer_receiver" => "222222222222222222222222",
            "transfer_send_amount" => "67.85"
        ]);
        $I->seeResponseCodeIs(201);
    }

    public function sendPostPXMinTwoDeparturesError(ApiTester $I)                    // Mass-transfer
    {
        $I->sendPOST($this->route[3], [
            "conf_pp_com_type" => "payee",
            "conf_subject" => null,
            "eps" => "PX",
            "receiver" => fake::create()->safeEmail,
            "receiver_type" => "email",
            "row_index" => 0,
            "transfer_receive" => "5.00",
            "transfer_send" => "10"
            ]);
        $I->seeResponseCodeIs(400);
        $I->seeErrorMessage(["Укажите минимум 2 отправления"]);
    }

    public function sendPostPXServiceAmountLimitError(ApiTester $I)                  // Service-payment
    {
        $I->sendPOST($this->route[4], [
            "eps_code" => "PX",
            "payee_type" => "service",
            "service_info" => "",
            "service_url" => "https://dev3.jwallet.cc",
            "transfer_input" => "send",
            "transfer_receive_amount" => "98499996.00",
            "transfer_receive_currency" => "USD",
            "transfer_send_amount" => "100000000",
            "transfer_send_currency" => "USD"
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeErrorMessage(["Превышен лимит. Максимальная сумма отправления - $9000000.00"]);
    }

    public function sendPostPXUrlError(ApiTester $I)                                  // Service-payment
    {
        $I->sendPOST($this->route[4], [
            "eps_code" => "PX",
            "payee_type" => "service",
            "service_info" => "",
            "service_url" => "https://dev3.jwallet.ccLorem ipsum dolor ",
            "transfer_input" => "send",
            "transfer_receive_amount" => "98499996.00",
            "transfer_receive_currency" => "USD",
            "transfer_send_amount" => "100000000",
            "transfer_send_currency" => "USD"
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeErrorMessage(["service_url" => ["Поле 'Сылка на оплату' имеет ошибочный формат."]]);
    }

    public function sendPostPXOK(ApiTester $I)                                        // Service-payment
    {
        $I->sendPOST($this->route[4], [
            "eps_code" => "PX",
            "payee_type" => "service",
            "service_info" => "",
            "service_url" => "https://dev3.jwallet.cc ",
            "transfer_input" => "send",
            "transfer_receive_amount" => "0.92",
            "transfer_receive_currency" => "USD",
            "transfer_send_amount" => "5",
            "transfer_send_currency" => "USD"
        ]);
        $I->seeResponseCodeIs(201);
    }

    public function sendPostBTCMaxTransferError(ApiTester $I)                           // Deposit/BTC
    {
        $I->sendPOST($this->route[5], [
            "eps_code" => "BTC",
            "request_type" => "crypto",
            "transfer_input" => "transfer_send",
            "transfer_receive" => "627483.64",
            "transfer_send" => "100"
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeErrorMessage(["Максимальная сумма отправления - 1.13 BTC"]);
    }

    public function sendPostBTCTransferSendError(ApiTester $I)                      // Deposit/BTC
    {
        $I->sendPOST($this->route[5], [
            "eps_code" => "BTC",
            "request_type" => "crypto",
            "transfer_input" => "transfer_send",
            "transfer_receive" => "6274.84",
            "transfer_send" => "1&$*($@#"
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeErrorMessage(["transfer_send" => ["Поле 'Сумма к оплате' должно быть числом."]]);
    }

    public function sendPostWEXFakeCodeError(ApiTester $I)                             // Deposit/WEX
    {
        $I->sendPOST($this->route[5], [
            "eps_code" => "WEX",
            "money_code" => fake::create()->text
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeErrorMessage(["Поддерживаются только USD коды"]);
    }

    public function sendPostWEXNullCodeError(ApiTester $I)                             // Deposit/WEX
    {
        $I->sendPOST($this->route[5], [
            "eps_code" => "WEX",
            "money_code" => null
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeErrorMessage([]);
    }

    public function sendPostWEXCodeOK(ApiTester $I)                                     // Deposit/WEX
    {
        $I->sendPOST($this->route[5], [
            "eps_code" => "WEX",
            "money_code" => "WEXUSD0000000000000000000000000000000000000000"
        ]);
        $I->seeResponseCodeIs(200);
    }







}
