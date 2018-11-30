<?php

use Page\jWallet as Page;
use \Facebook\WebDriver\WebDriverElement;

class jWalletCest
{
    public $valueFalse = ['', 'mail.ru', 'tt@ma#il.com', 'R.@gmail.com@', '#@%^%#$@#$@#.com', '@domain.com', 'Joe Smith <email@domain.com>', '.email@domain.com'];
    public $valueTrue = ['email@domain.com', 'firstn.lastn@domain.com', 'email@subdomain.domain.com', 'firstn+lastn@domain.com', 'email@123.123.com', '"email..email"@domain.com'];
    public $valueNames = ['Nola Lauderdale', 'Kerstin Stiff', 'Bradley Bahena','Dortha Klink', 'Celinda Kibble', 'Lisabeth Cipolla', 'Catherin Belk','Rosenda Yeoman', 'Deanna Kerney', 'Debi Regan','Rina Rotunno', 'Kasi Leo', 'Clark Schoen','Audie Pocock', 'Gwenn Steelman'];


    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/');
    }
    /**
     * @param AcceptanceTester $I
     * @throws Exception
     */
    // tests
    public function Login(AcceptanceTester $I)
    {
        $I->Login($I);
        $value = $I->grabTextFrom(page::$profileBalance);
        var_dump($value);
        $I->click(page::$profileUserBtn);
        $I->click(page::$profileSettingsBtn);
        $I->waitForElementVisible(page::$ProfileActive);
        $I->seeElement(page::$ProfileActive);
        $I->seeElement(page::$Security);
        $I->seeElement(page::$ProfileContentItem[0]);
        $I->seeElement(page::$ProfileContentItem[1]);
        $I->seeElement(page::$ProfileContentItem[2]);
        $I->seeElement(page::$ProfileContentItem[3]);
        $I->seeElement(page::$ProfileContentSecurity);
        $I->seeCheckboxIsChecked(page::$ProfileContentCheckbox[0]);
        $I->seeCheckboxIsChecked(page::$ProfileContentCheckbox[1]);
        $I->seeCheckboxIsChecked(page::$ProfileContentCheckbox[2]);
        $I->click(page::$ProfileSaveBtn);
        $I->click(page::$Security);
        $I->seeElement(page::$Profile);
        $I->seeElement(page::$SecurityRestrictionOnIP);
        $I->fillField(page::$SecurityIpField, '123.123.123.1');
        $I->seeInField(page::$SecurityIpField, '123.123.123.1');
        $I->seeElement(page::$SecurityIpActiveButton);
        $I->click(page::$SecurityIpActiveButton);
        $I->seeElement(page::$SecurityAllowedIp);
        $I->click(page::$SecurityAllowedIpClose);
        $I->seeElement(page::$SecurityPin);
        $I->click(page::$SecurityPinCheckButton);
        $I->wait(2);
        $I->seeElement(page::$SecurityPinModal);
        $I->seeElement(page::$SecurityPinModalType);
        $I->click(page::$SecurityPinModalTypeDrop);
        $I->wait(2);
        $I->seeElement(page::$SecurityPinModalTypeDropPin);
        $I->seeElement(page::$SecurityPinModalTypeDropGoogle);
        $I->checkOption(page::$SecurityPinModalTypeDropPin);
        $I->seeInField(page::$SecurityPinModalTypeNewPin,'');
        $I->seeInField(page::$SecurityPinModalTypeNewPin2,'');
        $I->fillField(page::$SecurityPinModalTypeNewPin,'12345678');
        $I->fillField(page::$SecurityPinModalTypeNewPin2,'12345678');
        $I->seeElement(page::$SecurityPinModalTypeSwitchButton);
        $I->seeElement(page::$SecurityPinModalStatus);
        $I->click(page::$SecurityPinModalClose);
        $I->click(page::$EXIT);
        $I->wait(2);

    }

    public function HomePageLink(AcceptanceTester $I)
    {
        $menu_links =[
            ['url' => '/', 'el' => page::$AboutCompany],
            ['url' => '/fees', 'el' => page::$Tariffs],
            ['url' => '/faq', 'el' => page::$FAQ],
            ['url' => '/contacts', 'el' => page::$Contacts],
            ['url' => '/signup', 'el' =>page::$cabinetBtn]
        ];
        foreach ($menu_links as $link ){
            $I->setOfActions2($link);
        }
    }

    public function Registration(AcceptanceTester $I)
    {
        $I->seeElement(page::$RegistrationModal);
        $value1 = $this->valueFalse[array_rand($this->valueFalse)];

        if ($value1 == false )

        $I->fillField(page::$RegistrationEmail, $value1) == true ?
            $I->seeInField(page::$RegistrationEmail, $value1) :
            $I->seeElement(page::$registrationBtnDisabled);

        else($value1 == false);
        $value2 = $this->valueTrue[array_rand($this->valueTrue)];
            $I->fillField(page::$RegistrationEmail, $value2);
                $I->seeInField(page::$RegistrationEmail, $value2);
                $I->seeElement(page::$registrationBtnActive);
                $I->click(page::$registrationBtn);
                $I->wait(2);
                $I->seeInCurrentUrl('signup?email=');
                $I->seeInField(page::$registrationFieldEmail, $value2);
        var_dump ($value1, $value2);
    }
    /**
     * @param AcceptanceTester $I
     * @throws Exception
     */
    public function MoneyTransaction(AcceptanceTester $I)
    {
        $I->executeJS("window.confirm = function(msg){return true;};");
        $I->Login($I);
        $I->waitForElementVisible(page::$Vacancies,100);
        $I->click(page::$Tariffs);
        $value = $I->grabTextFrom(page::$profileBalance);
        $I->wait(3);
        $I->click(page::$moneyTransactionExmo);
        $I->waitForElementVisible(page::$moneyTransactionSum,100);
        $I->fillField(page::$moneyTransactionSum,'10.15');
        $I->wait(2);
        $I->seeInField(page::$moneyTransactionSumComission,'10.00');
        $I->click(page::$moneyTransactionBtn);
        $I->wait(3);
        $value1 = $I->grabTextFrom(page::$moneyTransactionSum1);
        $value2 = $I->grabTextFrom(page::$moneyTransactionSumComission1);
        $I->click(page::$moneyTransactionApproveBtn);
        $I->wait(2);
        $value3 = $I->grabTextFrom(page::$moneyTransactionSum1);
        $value4 = $I->grabTextFrom(page::$moneyTransactionSumComission1);
        $I->assertSame($value1, $value3);
        $I->assertSame($value2, $value4);
        $I->click(page::$moneyTransactionStatusBtn);
        $I->waitForElementVisible(page::$historyFilter, 100);
        $I->amOnPage('/account/history');
        $I->seeElement(page::$historyFilter);
        $I->click(page::$historyID);
        $I->wait(3);
        $value3 = $I->grabTextFrom(page::$profileBalance);
        $value4 = $I->grabTextFrom(page::$historyGrabLine);
        var_dump($value1, $value2, $value, $value3, $value4);
        $I->click(page::$EXIT);
        $I->assertNotSame($value,$value3);
    }
    /**
     * @param AcceptanceTester $I
     * @throws Exception
     */
    public function PayService(AcceptanceTester $I)
    {
        $I->executeJS("window.confirm = function(msg){return true;};");
        $I->Login($I);
        $I->click(page::$payService);
        $value = $I->grabTextFrom(page::$profileBalance);
        $I->wait(3);
        $I->fillField(page::$payServiceURL,'https://jw3.zxczxc.cc/account/service-payment');
        $I->fillField(page::$payServiceDescription, 'TEST of Test');
        $I->click(page::$payServiceDrop);
        $I->seeElement(page::$payServiceDropList[0]);
        $I->seeElement(page::$payServiceDropList[1]);
        $I->seeElement(page::$payServiceDropList[2]);
        $I->click(page::$payServiceDropList[0]);
        $I->wait(2);
        $I->seeElement(page::$payServiceBtnDisabled);
        $I->fillField(page::$payServiceSum,'10');
        $I->seeElement(page::$payServiceBtnActive);
        $value1 = $I->grabValueFrom(page::$payServiceSum);
        $value2 = $I->grabValueFrom(page::$payServiceSum2);
        $I->click(page::$payServiceBtnActive);
        $I->wait(2);
        $value3 = $I->grabTextFrom(page::$payServiceApproveSum);
        $value4 = $I->grabTextFrom(page::$payServiceApproveSum2);
        $I->click(page::$payServiceApproveBtn);
        $I->wait(2);
        $value5 = $I->grabTextFrom(page::$payServiceApproveSum);
        $value6 = $I->grabTextFrom(page::$payServiceApproveSum2);
        $I->assertSame($value3, $value5);
        $I->assertSame($value4, $value6);
        $I->click(page::$payServiceStatusBtn);
        $I->waitForElementVisible(page::$historyFilter, 100);
        $I->amOnPage('/account/history');
        $I->seeElement(page::$historyFilter);
        $I->click(page::$historyID);
        $I->wait(3);
        $value7 = $I->grabTextFrom(page::$profileBalance);
        $value8 = $I->grabTextFrom(page::$historyGrabLine);
        $I->click(page::$EXIT);
        $I->assertNotSame($value,$value7);

        var_dump($value1, $value2, $value3, $value4, $value, $value7, $value8);

    }
    /**
     * @param AcceptanceTester $I
     * @throws Exception
     */
    public function MassTransaction(AcceptanceTester $I)
    {
        $I->Login($I);
        $value01 = $I->waitForElementVisible(page::$MassTransaction,5);

            if ($value01 == false)
                $I->reloadPage('/');
            else($value01 == true);
            $I->click(page::$MassTransaction);

        $value = $I->grabTextFrom(page::$profileBalance);
        $I->waitForElementVisible(page::$addPayment,100);
        $I->click(page::$addPayment);
        $I->seeElement(page::$addPaymentDrop[0]);
        $I->seeElement(page::$addPaymentDrop[1]);
        $I->seeElement(page::$addPaymentDrop[2]);
        $I->seeElement(page::$addPaymentDrop[3]);
        $I->seeElement(page::$addPaymentDrop[4]);
        $I->seeElement(page::$addPaymentDrop[5]);
        $I->checkOption(page::$addPaymentDrop[0]);
        $I->wait(2);
        $I->fillField(page::$addPaxumEmail,'vvvv@mail.com');
        $I->fillField(page::$addPaxumSum,'10');
        $value1 = $I->grabValueFrom(page::$addPaxumControlField);
        $I->click(page::$addPaxumBtn);
        $I->click(page::$addPayment);
        $I->checkOption(page::$addPaymentDrop[0]);
        $I->wait(2);
        $I->fillField(page::$addPaxumEmail2,'vvvv@mail.com');
        $I->fillField(page::$addPaxumSum2,'20');
        $value2 = $I->grabValueFrom(page::$addPaxumControlField2);
        $I->click(page::$addPaxumBtn);
        $I->executeJS("window.confirm = function(msg){return true;};");
        $I->wait(3);
        $value3 = $I->grabTextFrom(page::$addPaxumConfirm);
        $value4 = $I->grabTextFrom(page::$addPaxumConfirm2);
        $I->click(page::$addPaxumConfirmBtn);
        $I->wait(2);
        $value5 = $I->grabTextFrom(page::$addPaxumStatusConfirm);
        $value6 = $I->grabTextFrom(page::$addPaxumStatusConfirm2);
        $I->assertSame($value3, $value5);
        $I->assertNotSame($value4, $value6);
        $I->click(page::$payServiceStatusBtn);
        $I->wait(4);
        $I->seeInCurrentUrl('history');
        $I->amOnPage('/account/history');
        $I->seeElement(page::$historyFilter);
        $I->click(page::$historyID);
        $I->wait(3);
        $value7 = $I->grabTextFrom(page::$profileBalance);
        $value8 = $I->grabTextFrom(page::$historyGrabLine);
        $I->click(page::$EXIT);

        var_dump($value1, $value2, $value3, $value4, $value, $value7, $value8);
    }
    /*
    public function RecallsSend (AcceptanceTester $I)           // Поставили кепчу  // Поки зняли
    {
        $I->click(page::$Recalls);
        $I->wait(3);
        $value = $this->valueNames[array_rand($this->valueNames)];
        $value1 = $this->valueFalse[array_rand($this->valueFalse)];
        $I->fillField(page::$recallsName, $value);
        $I->fillField(page::$recallsEmail, $value1);
        $I->fillField(page::$recallsComent, 'Test ...');
        $value2 = $this->valueTrue[array_rand($this->valueTrue)];
        $I->fillField(page::$recallsEmail, $value2);
        $I->click(page::$recallsBtnActive);
        $value3 = $I->grabTextFrom(page::$recallsGrabName);
        $value4 = $I->grabTextFrom(page::$recallsGrabDate);
        var_dump ($value, $value1, $value2, $value3, $value4);
    }

    public function Vacancies(AcceptanceTester $I)              //Поставили кепчу // Поки зняли
    {
        $I->click(page::$Vacancies);
        $I->waitForElementVisible(page::$vacanciesForm);
        $value = $this->valueTrue[array_rand($this->valueTrue)];
        $value1 = $this->valueFalse[array_rand($this->valueFalse)];
        $I->fillField(page::$vacanciesName, $value);
        $I->fillField(page::$vacanciesEmail, $value1);
        $I->fillField(page::$vacanciesComent,'TEST..');
        $I->fillField(page::$vacanciesEmail,'test@gmail.com');
        $I->click(page::$vacanciesBtnActive);
    }
    */
    /**
     * @param AcceptanceTester $I
     * @throws Exception
     */
    public function Contacts(AcceptanceTester $I)               // Поставили кепчу
    {
        $I->click(page::$Contacts);
        $I->waitForElementVisible(page::$contactsForm);
        $value = $this->valueTrue[array_rand($this->valueTrue)];
        $value1 = $this->valueFalse[array_rand($this->valueFalse)];
        $I->fillField(page::$contactsName, $value);
        $I->fillField(page::$contactsEmail, $value1);
        $I->fillField(page::$contactsComent,'TEST..');
        $I->fillField(page::$contactsEmail,'test@gmail.com');
        $I->click(page::$contactsBtnActive);
    }
    /**
     * @param AcceptanceTester $I
     * @throws Exception
     */
    public function SliderTime(AcceptanceTester $I)
    {
        $I->Login($I);
        $I->seeInCurrentUrl('/account/news');
        $I->click(page::$profileUserBtn);
        $I->click(page::$profileSettingsBtn);
        $I->wait(2);
        $I->click(page::$Security);
        $I->wait(2);
        $before = $I->grabTextFrom(page::$sliderTime);
        $I->slide(page::$sliderSlide,460,0);
        $after = $I->grabTextFrom(page::$sliderTime);
        $I->assertNotSame($before,$after);
        $I->click(page::$securitySaveBtn);
        $I->click(page::$EXIT);
        $I->wait(4);
        $I->Login($I);
        $I->click(page::$profileUserBtn);
        $I->click(page::$profileSettingsBtn);
        $I->wait(2);
        $I->click(page::$Security);
        $I->scrollTo(page::$sliderSlide);
        $last = $I->grabTextFrom(page::$sliderTime);
        $I->assertSame($after, $last);
        $I->wait(3);
        $I->slide(page::$sliderSlide,-460,0);
        $I->wait(2);
        $I->click(page::$securitySaveBtn);
        $I->wait(2);
        $I->click(page::$EXIT);
    }
    /**
     * @param AcceptanceTester $I
     * @throws Exception
     */
    public function HistorySet(AcceptanceTester $I)
    {
        $I->Login($I);
        $I->click(page::$historyLink);
        $I->amOnPage('/account/history');
        $I->HistorySet($I);
    }
    /**
     * @param AcceptanceTester $I
     * @throws Exception
     */
    public function ForgotPassword(AcceptanceTester $I)
    {
        $I->click(page::$LoginBtn);
        $I->waitForElementVisible(page::$LoginEmail,100);
        $I->click(page::$LoginForgotPassword);
        $value = $this->valueFalse[array_rand($this->valueFalse)];

        if ($value == false )

            $I->fillField(page::$LoginForgotPasswordEmail, $value) == true ?
                $I->seeInField(page::$LoginForgotPasswordEmail, $value) :
                $I->click(page::$LoginForgotPasswordBtn);

        else($value == false);
            $I->fillField(page::$LoginForgotPasswordEmail, 'yurii.lobas@gmail.com');
            $I->click(page::$LoginForgotPasswordBtn);
            $I->wait(2);
            $I->seeElement(page::$RegistrationModal);
            var_dump($value);
    }
    /**
     * @param AcceptanceTester $I
     * @throws Exception
     */
    public function BalanceVisable(AcceptanceTester $I)
    {
        $I->Login($I);
        $I->waitForElementVisible(page::$profileBalance);
        $value = $I->grabTextFrom(page::$profileBalance);
        $I->click(page::$profileUserBtn);
        $value1 = $I->grabTextFrom(page::$profileHideBalanceGrab);
        $I->click(page::$profileHideBalanceBtn);
        $I->wait(2);
        $value2 = $I->grabTextFrom(page::$profileHideBalanceGrab);
        $I->click(page::$profileUserBtn);
        $I->wait(2);
        $value3 = $I->grabTextFrom(page::$profileBalance);
        $I->assertSame($value, $value1);
        $I->assertSame($value2, $value3);
        $I->click(page::$profileUserBtn);
        $I->wait(2);
        $I->click(page::$profileHideBalanceBtn);
        $I->click(page::$EXIT);
        $I->wait(2);

        var_dump($value, $value1, $value2, $value3);
    }
    /*/**
     * @param AcceptanceTester $I
     * @throws Exception

    public function SliderElement(AcceptanceTester $I)
    {
        $I->wait(4);
        $before = $I->grabTextFrom(page::$sliderGrabElement);
        $I->click(page::$sliderNextBtn);
        $I->waitForElementChange(page::$sliderElementChange, function(WebDriverElement $el) {
            return $el->isDisplayed();
        }, 100);
        $after = $I->grabTextFrom(page::$sliderGrabElement);
        $I->assertNotSame($before,$after);
        $I->wait(2);
        $before1 = $I->grabTextFrom(page::$sliderGrabElement);
        $I->click(page::$sliderPrevBtn);
        $I->waitForElementChange(page::$sliderElementChange, function(WebDriverElement $el) {
            return $el->isDisplayed();
        }, 100);
        $after1 = $I->grabTextFrom(page::$sliderGrabElement);
        $I->assertNotSame($before1,$after1);
    }
    */
    /**
     * @param AcceptanceTester $I
     * @throws Exception
     */
    public function OpenTransactionHistory(AcceptanceTester $I)
    {
        $I->Login($I);
        $I->click(page::$historyLink);
        $I->amOnPage('/account/history');
        $I->click(page::$historyFilterTypeStatus);
        $value = $I->grabTextFrom(page::$historyFilterTypeStatusDrop[0]);
        $I->click(page::$historyFilterTypeStatusDrop[0]);
        $I->wait(2);
        $I->fillField(page::$historyFieldSearch, 'Px');
        $I->click(page::$historyFilterRefreshBtn);
        $I->wait(2);
        $value1 = $I->grabValueFrom(page::$historyFieldSearch);
        $value2 = $I->grabTextFrom(page::$historyFilterTypeStatus);
        $I->click(page::$historyFilterRow);
        $I->wait(2);
        $I->seeElement(page::$historyFilterRovOpenBtn);
        $value3 = $I->grabTextFrom(page::$historyFilterRovOpenGrabSystem);
        $value4 = $I->grabTextFrom(page::$historyFilterRovOpenGrabSum).
            $I->grabTextFrom(page::$historyFilterRovOpenGrabSum2);
        $I->click(page::$EXIT);
        $I->wait(3);
        $I->assertSame($value, $value2);
        $I->assertNotSame($value1, $value3);
        var_dump($value4);
    }
    /**
     * @param AcceptanceTester $I
     * @throws Exception
     */
    public function SearchHistoryFilter(AcceptanceTester $I)
    {
        $I->Login($I);
        $I->click(page::$historyLink);
        $I->amOnPage('/account/history');
        $I->click(page::$historyFilterTypeStatus);
        $value = $I->grabTextFrom(page::$historyFilterTypeStatusDrop[0]);
        $I->click(page::$historyFilterTypeStatusDrop[0]);
        $I->wait(2);
        $I->fillField(page::$historyFieldSearch, 'Mass');
        $I->click(page::$historyFilterRefreshBtn);
        $I->wait(2);
        $value1 = $I->grabTextFrom(page::$historySystemPayCol);
        $I->click(page::$historyFilterRow);
        $value2 = $I->grabTextFrom(page::$historyFilterRovOpenGrabSystem);
        $I->click(page::$historyFilterRovOpenListBtn);
        $I->waitForElementVisible(page::$historyFilterRovOpenListModal, 20);
        $value3 = $I->grabTextFrom(page::$historyFilterRovOpenListModalGrab);
        $I->click(page::$historyFilterRovOpenListModalClose);
        $I->click(page::$EXIT);
        $I->wait(3);
        $I->assertSame($value1, $value2);
        $I->assertSame($value2, $value3);
        var_dump($value);

    }



    
















}
