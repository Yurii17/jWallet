<?php 

use Faker\Factory as fake;
require_once __DIR__.'/loginCest.php';

class profileCest
{
    public $route = ['/profile' , '/ticket', '/transfer?lang=ru'];

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


    public function sendPostTicketValid(ApiTester $I)
    {
        $I->haveHttpHeader('Content-type', 'application/json');
        $I->removeAuthHeader();
        $I->sendPOST($this->route[1] ,[
            "data" => ["access_token" =>
                "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImI0NDk3ZmM4YjE4ODY3MjJkM2Y4YWEwY2VjMjg
                4NThlZTI3YTZmZTdlMDQxYmY3MTlkZThkYjBhYjg5MDBmODViMzZiNTRjYjJlMzAwMzdlIn0.eyJhdWQiOiI
                zIiwianRpIjoiYjQ0OTdmYzhiMTg4NjcyMmQzZjhhYTBjZWMyODg1OGVlMjdhNmZlN2UwNDFiZjcxOWRlOGR
                iMGFiODkwMGY4NWIzNmI1NGNiMmUzMDAzN2UiLCJpYXQiOjE1NDQ0Mzg2NDIsIm5iZiI6MTU0NDQzODY0Miw
                iZXhwIjoxNTc1OTc0NjQyLCJzdWIiOiIzOCIsInNjb3BlcyI6W119.gE-xwg8zNg3LhWL5TSDsDqDI-6gmlSE0
                -K9Sa9LMDvz_p2SYCszbOf3Vg51-Bm9O-ThnqxclFoT2NC8pYBh_Adk50wTIhnK05GN-Me3gGZ1-3VnDPxHgNOH
                _bUSm9mCDh4aIqb-FDmt8uFA9QQ517YbK7ERqzxo-SQ231qc2IKOgGOoItyVt48ocnCU7AGeTQLiJhC4d31R9Kc
                YswijYNtV0hhVm4ak9uvhROfEkyL5Icsg1bEwU5LGbtHxnULJGk5UcRdWa2IMFkpjP3tsUsay5erTk7cEHAt0PvW
                _r0uB3SmntcehuphyZy98zZL36vi0w_tmYnkIRmqeQLDWdyZdLdXYg-I0QUvTr4qvAd1ymBci7TDBsent3eOVBfhi
                LdDBLD3Sw7VqG0wSJGqgxE6MrkDgnsxhtJmTKDf1myhKwNIEqC7k1r0VnLgdZhqedUpLaKbRK9SAv1evCgRbHW8vA
                BgSN0oOg66WPNwAORq8dx7eCQQJq2CQbfQ2RtOw55dfFk2mHFxIoZd0pFLOJ1TBhzMIhZg6Jrh8R5k2ACSyQ_dLVnn
                CURS9fSop8AMTobNnGJs81rV1c8ufyZZWpd3xH93c9GTfcouNAZB7FXBJXL_C9gXIzOAQQLG94FZS5GfY53VnTrytyd
                4eos-ioxo-VsJhod94XE-fwrvRXopU",
                "token_type" => "Bearer",
                "expires_at" => "2018-12-10 10:59:02",
                "id" => 38,
                "email" => "yurii.lobas@gmail.com",
                "name" => "Yurii QA",
                "sign" => null,
                "user_contacts" => null,
                "user_signup_time" => "2018-10-16 11:11:14",
                "user_status" => 2,
                "user_config" => ["cryptoProxy_BTC" => "2N8S9KjaywUPrmjrvL97re1mpDeWkysZhUq",
                    "cryptoProxy_LTC" => "2Mu4yAAj2eJ34pPcevwwLGRQdfGK34ZH62G",
                    "email_notifications_disabled" => [],
                    "ip" => ["123.123.123.1"],
                    "session_timeout" => 900],
                "user_memory" => ["ui_money_hide" => false],
                "user_from" => null,
                "user_ip" => "193.93.219.113",
                "balance" => [["id" => 27,
                    "wallet_id" => "JU181016909",
                    "balance" => "8768755.45",
                    "currency" => "USD"]],
                "limit" => ["limit_out_daily" => 9000000,
                    "limit_out_daily_used" => 0,
                    "limit_out_daily_used_percent" => 0,
                    "limit_available" => 9000000],
                "server_time" => "2018-12-10 10:44:03",
                "server_timezone" => "UTC",
                "paypin_secret" => "WBUHX5JQSE2Y7XHJ",
                "paypin_barcode_url" =>
                    "https://chart.googleapis.com/chart?chs=200x200&chld=M|0
                    &cht=qr&chl=otpauth%3A%2F%2Ftotp%2FjWallet%3Fsecret%3DWBUHX5JQSE2Y7XHJ"],
                "message" => "success"
        ]);
        $I->seeAuthErrorMessage();

    }

    // ApiAccountTransfer

    /**
     * @param ApiTester $I
     * @throws Exception
     */
    public function JWReceiverError(ApiTester $I)
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
    /**
     * @param ApiTester $I
     * @throws Exception
     */
    public function JWAmountLimitError(ApiTester $I)
    {
        $I->sendPOST($this->route[2], [
            "eps_code" => "JW",
            "transfer_input" => "transfer_send",
            "transfer_receive_amount" => "10000000.00",
            "transfer_receiver_type" => "text",
            "transfer_receiver_value" => "JU000000000",
            "transfer_send_amount" => "10000000"
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeErrorMessage(["Превышен лимит. Максимальная сумма отправления - 8999653.44USD"]);
    }
    /**
     * @param ApiTester $I
     * @throws Exception
     */
    public function JWMinAmountError(ApiTester $I)
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
    /**
     * @param ApiTester $I
     * @throws Exception
     */
    public function JWDigitsError(ApiTester $I)
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
        ["Поле transfer send amount должно быть числом."]]);
    }
    /**
     * @param ApiTester $I
     * @throws Exception
     */
    public function JWTextError(ApiTester $I)
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
        ["Количество символов в поле transfer subject не может превышать 200."]]);
    }













}
