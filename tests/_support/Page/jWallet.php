<?php
namespace Page;


class jWallet
{
    // include url of current page
    public static $URL = '';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    // Home
    public static $Logo = '#__layout > div > div:nth-child(2) > header > a.logo.logo-device.nuxt-link-active > img';
    public static $Header = '#__layout > div > div:nth-child(2) > header';
    public static $cabinetBtn = 'div.col-12.col-lg-7.align-self-center > div > a';

    // Login form
    public static $LoginBtn = 'div:nth-child(2) > header > div.user-box > div > button';
    public static $LoginBtnModal = '#authModal___BV_modal_body_ > div > div.common-side.right-side > form > div.common-link-btn > button';
    public static $LoginToAccount = 'authModal___BV_modal_body_';
    public static $LoginEmail = 'div.common-side.right-side > form > div:nth-child(1) > input';
    public static $LoginPassword = 'div.common-side.right-side > form > div:nth-child(2) > input';
    public static $LoginRegistration = 'div.common-side.right-side > form > div.common-link-btn > div > a';
    public static $LoginForgotPassword = 'div.common-side.right-side > form > div.common-link-btn > div > span';
    public static $LoginForgotPasswordEmail = 'div.common-side.right-side > form > div.form-group > input';
    public static $LoginForgotPasswordBtn = 'div.common-link-btn > button';


    //Registration
    public static $RegistrationModal = 'div.container.clearfix > div.right-col > div';
    public static $RegistrationEmail = 'div.container.clearfix > div.right-col > div > form > div > input';
    public static $registrationBtnDisabled = 'button.btn[disabled="disabled"]';
    public static $registrationBtnActive = 'button.btn';
    public static $registrationBtn = 'div.container.clearfix > div.right-col > div > form > button';
    public static $registrationFieldEmail = '#email';


    //Account settings
    public static $Profile = 'div.tabs-with-btn.d-flex.justify-content-between > div > nav > a:nth-child(1)';
    public static $profileUserBtn = 'div.user-box > div > div';
    public static $profileSettingsBtn = 'div.drop-btn.dropdown.show > div > div > div.user-name.online > a';
    public static $profileBalance = '#__layout > div > div:nth-child(2) > header > div.user-box > div > span > strong';
    public static $profileHideBalanceBtn = 'div.user-name.online > div';
    public static $profileHideBalanceGrab = 'div.wallet-bal > div > span.float-right';
    public static $ProfileActive = 'div.tabs-with-btn.d-flex.justify-content-between > div > nav > a.nav-item.nav-link.active';
    public static $ProfileContent = '#__layout > div > section > div.container > div > div:nth-child(2) > div:nth-child(1) > div.tab-content > div:nth-child(1) > div > div.col-12.col-md-6.col-lg-4.border-right > div';
    public static $ProfileContentItem = [
        'div.col-12.col-md-6.col-lg-4.border-right > div > div:nth-child(1)',
        'div.col-12.col-md-6.col-lg-4.border-right > div > div:nth-child(2)',
        'div.col-12.col-md-6.col-lg-4.border-right > div > div:nth-child(3)',
        'div.col-12.col-md-6.col-lg-4.border-right > div > div:nth-child(4)'
    ];
    public static $ProfileContentSecurity = 'div.col-12.col-md-6.col-lg-8 > form';
    public static $ProfileContentCheckbox = [
        'input[type="checkbox"][id="login_ok"][name="login_ok"]',
        'input[type="checkbox"][id="transaction_out"][name="transaction_out"]',
        'input[type="checkbox"][id="transaction_in"][name="transaction_in"]',
    ];
    public static $ProfileSaveBtn = 'div.col-12.col-md-6.col-lg-8 > form > button';

    public static $Security = 'div.tabs-with-btn.d-flex.justify-content-between > div > nav > a:nth-child(2)';
    public static $SecurityActive = 'div.tabs-with-btn.d-flex.justify-content-between > div > nav > a.nav-item.nav-link.active';
    public static $SecurityRestrictionOnIP = 'div.col-12.col-lg-6.padding-r-custom';
    public static $SecurityIp = 'div:nth-child(4) > div > span:nth-child(2)';
    public static $SecurityIpField = 'div.col-12.col-lg-6.padding-r-custom > div.form-group > div > div.input-group-inner > input';
    public static $SecurityIpActiveButton = 'div.col-12.col-lg-6.padding-r-custom > div.form-group > div > div.input-group-append > button';
    public static $SecurityAllowedIp = 'div.col-12.col-lg-6.padding-r-custom > div:nth-child(4) > div';
    public static $SecurityAllowedIpClose = 'div.col-12.col-lg-6.padding-r-custom > div:nth-child(4) > div > span > i';
    public static $SecurityPin = 'div.col-12.col-lg-6.padding-l-custom';
    public static $SecurityPinCheckButton = 'div.col-12.col-lg-6.padding-l-custom > div > button';
    public static $SecurityPinModal = '#tfa___BV_modal_body_';
    public static $SecurityPinModalType = '#tfa___BV_modal_body_ > div > div > div:nth-child(1)';
    public static $SecurityPinModalTypeDrop = '#tfa___BV_modal_body_ > div > div > div:nth-child(1) > div > div > div > div';
    public static $SecurityPinModalTypeDropOptionSelected = 'div:nth-child(1) > div > div > div > div > ul > li.option.selected.focus';
    public static $SecurityPinModalTypeDropPin = '#tfa___BV_modal_body_ > div > div > div:nth-child(1) > div > div > div > div > ul > li:nth-child(2)';
    public static $SecurityPinModalTypeDropGoogle = 'li:nth-child(3)';
    public static $SecurityPinModalTypeNewPin = '#paypin_password';
    public static $SecurityPinModalTypeNewPin2 = '#paypin_password_confirmation';
    public static $SecurityPinModalTypeSwitchButton = 'div:nth-child(3) > button';
    public static $SecurityPinModalStatus = '#tfa___BV_modal_body_ > div > div.row.justify-content-between.align-items-center > div.col-sm-4.text-right > div > span.st.off';
    public static $SecurityPinModalStatusActive = '';
    public static $SecurityPinModalClose = '#tfa___BV_modal_body_ > i';
    public static $securitySaveBtn = 'div.text-center > button';
    public static $EXIT = '#__layout > div > div:nth-child(2) > header > div.user-box > div > a';

    // About company
    public static $AboutCompany = '#__layout > div > div:nth-child(2) > header > nav > ul > li:nth-child(1)';

    // Tariffs
    public static $Tariffs = '#__layout > div > div:nth-child(2) > header > nav > ul > li:nth-child(2)';

    // FAQ
    public static $FAQ = 'div:nth-child(2) > header > nav > ul > li:nth-child(3)';

    // Recalls
    public static $Recalls = 'div:nth-child(2) > header > nav > ul > li:nth-child(4)';
    public static $recallsName = 'div.col-12.col-lg-5.col-xl-4 > div > form > div:nth-child(2) > input';
    public static $recallsEmail = 'div.col-12.col-lg-5.col-xl-4 > div > form > div:nth-child(3) > input';
    public static $recallsComent = 'div.col-12.col-lg-5.col-xl-4 > div > form > div:nth-child(4) > textarea';
    public static $recallsBtnDisabled = 'button.btn[disabled="disabled"]';
    public static $recallsBtnActive = 'button.btn[type="submit"]';
    public static $recallsGrabName = 'div:nth-child(1) > h5';
    public static $recallsGrabDate = 'div:nth-child(1) > p.date';


    // Vacancies
    public static $Vacancies = 'div:nth-child(2) > header > nav > ul > li:nth-child(5)';
    public static $vacanciesForm = 'div.col-12.col-lg-5 > div > form';
    public static $vacanciesName = 'div.col-12.col-lg-5 > div > form > div:nth-child(2) > input';
    public static $vacanciesEmail = 'div.col-12.col-lg-5 > div > form > div:nth-child(3) > input';
    public static $vacanciesComent = 'div.col-12.col-lg-5 > div > form > div:nth-child(4) > textarea';
    public static $vacanciesBtnDisabled = 'button.btn[disabled="disabled"]';
    public static $vacanciesBtnActive = 'button.btn[type="submit"]';


    // Contacts
    public static $Contacts = 'div:nth-child(2) > header > nav > ul > li:nth-child(3)';
    public static $contactsForm = 'div.col-12.col-lg-5.col-xl-6 > div';
    public static $contactsName = 'div.col-12.col-lg-5.col-xl-6 > div > div:nth-child(2) > input';
    public static $contactsEmail = 'div.col-12.col-lg-5.col-xl-6 > div > div:nth-child(3) > input';
    public static $contactsComent = 'div.col-12.col-lg-5.col-xl-6 > div > div:nth-child(4) > textarea';
    public static $contactsBtnDisabled = 'button.btn[disabled="disabled"]';
    public static $contactsBtnActive = 'button.btn[type="submit"]';


    // Language
    public static $LanguageDrop = '#drop-lang';
    public static $EN = '#drop-lang > div > a:nth-child(1)';
    public static $RU = '#__BVID__30__BV_toggle_';



    //Mass transfer
    public static $MassTransaction = 'div:nth-child(2) > header > nav > ul > li:nth-child(5)';
    public static $addPayment = 'div:nth-child(2) > form > div.text-center > div';
    public static $addPaymentDrop = [
        '#__layout > div > section > div.container > div > div:nth-child(2) > form > div.text-center > div > div > a:nth-child(1)',
        'a:nth-child(2)',
        'a:nth-child(3)',
        'a:nth-child(4)',
        'a:nth-child(5)',
        'a:nth-child(6)'
        ];
    public static $addPaxum = '#__layout > div > section > div.container > div > div:nth-child(2) > form > div.text-center > div > div > a:nth-child(1)';
    public static $addPaxumEmail = 'div.col-12.col-sm-6.col-lg-3 > div > input';
    public static $addPaxumSum = 'div.input-group-inner > input';
    public static $addPaxumControlField = ' div.item > div > div:nth-child(5) > div > div > div.input-group-inner > input';
    public static $addPaxumBtn = 'div.col-12.col-md-6.text-center.text-md-right > button';
    public static $addPaxumEmail2 = ' div:nth-child(3) > div > div.col-12.col-sm-6.col-lg-3 > div > input';
    public static $addPaxumSum2 = '#__layout > div > section > div.container > div > div:nth-child(2) > form > div.content-box.payments > div > div:nth-child(3) > div > div:nth-child(4) > div > div > div.input-group-inner > input';
    public static $addPaxumControlField2 = ' div:nth-child(3) > div > div:nth-child(5) > div > div > div.input-group-inner > input';
    public static $addPaxumConfirm = 'div:nth-child(1) > table > tbody > tr:nth-child(5) > td';
    public static $addPaxumConfirm2 = 'div:nth-child(1) > table > tbody > tr:nth-child(6) > td';
    public static $addPaxumStatusConfirm = 'div:nth-child(2) > table > tbody > tr:nth-child(5) > td';
    public static $addPaxumStatusConfirm2 = 'div:nth-child(2) > table > tbody > tr:nth-child(6) > td';

    public static $addPaxumConfirmBtn = 'button.btn.btn-warn.d-block.text-center.text-uppercase.mr-sm-5 > span';
    public static $addPaxumConfirmBtnCancel = 'button.btn.btn-danger.d-block.text-center.text-uppercase';



    //Money Transaction
    public static $moneyTransactionExmo = 'div:nth-child(2) > div > div > div:nth-child(4) > a';
    public static $moneyTransactionSum = 'div:nth-child(1) > div:nth-child(1) > div > input';
    public static $moneyTransactionSumComission = 'div:nth-child(1) > div:nth-child(3) > div > input';
    public static $moneyTransactionBtn = 'form > div:nth-child(2) > div > button';
    public static $moneyTransactionSum1 = 'tr:nth-child(5) > td';
    public static $moneyTransactionSumComission1 = 'tr:nth-child(6) > td';
    public static $moneyTransactionApproveBtn = 'button.btn.btn-warn.d-block.text-center.text-uppercase';
    public static $moneyTransactionStatusBtn = 'button.btn.btn-danger.d-block.text-center.text-uppercase';


    //Transaction History
    public static $historyLink = 'div:nth-child(2) > header > nav > ul > li:nth-child(3)';
    public static $historyFilter = 'div.content-box.history';
    public static $historyBtn = '#__layout > div > section > div.container > div > div:nth-child(2) > div.table-history > div.pagination-box > ul > li:nth-child(9) > a';
    public static $historyFieldSearch = 'div.col-12.col-xl-5.d-flex.justify-content-around.align-items-end.padding-l-n.filter-bottom > div:nth-child(2) > input';
    public static $historyFilterDate = 'div.table-history > div.table > div.d-flex.head > div:nth-child(4)';
    public static $historyFilterTypeDrop = 'div.col-12.col-xl-7.d-flex.justify-content-around.align-items-end.padding-r-n.filter-top > div:nth-child(3) > div > div > div';
    public static $historyFilterTypeInput = 'div.col-12.col-xl-7.d-flex.justify-content-around.align-items-end.padding-r-n.filter-top > div:nth-child(3) > div > div > div > ul > li:nth-child(3)';
    public static $historyFilterTypeOutput = 'div.col-12.col-xl-7.d-flex.justify-content-around.align-items-end.padding-r-n.filter-top > div:nth-child(3) > div > div > div > ul > li:nth-child(2)';
    public static $historyFilterTypeStatus = 'div.col-12.col-xl-7.d-flex.justify-content-around.align-items-end.padding-r-n.filter-top > div:nth-child(4) > div > div > div';
    public static $historyFilterRefreshBtn = 'div.col-12.col-xl-5.d-flex.justify-content-around.align-items-end.padding-l-n.filter-bottom > button';
    public static $historyFilterEmptyValue = '#__layout > div > section > div.container > div > div:nth-child(2) > div.content-box.history-alert > div';
    public static $historyFilterTypeStatusDrop = [
        'div:nth-child(4) > div > div > div > ul > li:nth-child(2)',
        'div:nth-child(4) > div > div > div > ul > li:nth-child(3)',
        'div:nth-child(4) > div > div > div > ul > li:nth-child(4)',
        'div:nth-child(4) > div > div > div > ul > li:nth-child(5)',
        'div:nth-child(4) > div > div > div > ul > li:nth-child(6)',
        'div:nth-child(4) > div > div > div > ul > li:nth-child(7)'
        ];
    public static $historyFilterSystemPayDrop = 'div.col-12.col-xl-5.d-flex.justify-content-around.align-items-end.padding-l-n.filter-bottom > div:nth-child(1) > div > div > div';
    public static $historyFilterSystemPay = [
        'div [class="nice-select open"] > [class = "list"] > li:nth-child(1)',
        'div [class="nice-select open"] > [class = "list"] > li:nth-child(2)',
        'div [class="nice-select open"] > [class = "list"] > li:nth-child(3)',
        'div [class="nice-select open"] > [class = "list"] > li:nth-child(4)',
        'div [class="nice-select open"] > [class = "list"] > li:nth-child(5)',
        'div [class="nice-select open"] > [class = "list"] > li:nth-child(6)',
        'div [class="nice-select open"] > [class = "list"] > li:nth-child(7)',
        'div [class="nice-select open"] > [class = "list"] > li:nth-child(8)'
        ];
    public static $historySystemPayCol = 'div.table-history > div.table > div.body > div:nth-child(1) > div > div:nth-child(3)';
    public static $historyGrabLine = 'div.body > div:nth-child(1)';
    public static $historyID = 'div.d-flex.head > div:nth-child(1)';
    public static $historyStatusCol = 'div [class="d-flex operation-row"] > div:nth-child(5) > span';
    public static $historyBalance = 'div.table-history > div.table > div.d-flex.head > div:nth-child(7)';
    public static $historyFilterRow = 'div.table-history > div > div.body > div:nth-child(1) > div';
    public static $historyFilterRovOpenBtn = 'button.btn';
    public static $historyFilterRovOpenListBtn = 'div.history-details > div:nth-child(5) > button';
    public static $historyFilterRovOpenListModal = '#infoModal > div > div';
    public static $historyFilterRovOpenListModalGrab = 'tr:nth-child(4) > td';
    public static $historyFilterRovOpenListModalClose = '#infoModal___BV_modal_body_ > i';
    public static $historyFilterRovOpenGrabSystem = 'div:nth-child(1) > strong';
    public static $historyFilterRovOpenGrabSum = 'div:nth-child(3) > strong';
    public static $historyFilterRovOpenGrabSum2 = 'div:nth-child(4) > strong';
    public static $historyFilterCalendar = 'div.form-group.date-input > div > div:nth-child(1) > input';
    public static $historyFilterCalendarPrev = 'div:nth-child(2) > header > span.prev';
    public static $historyFilterCalendarDay = 'span:nth-child(12)';



    //Slider Time
    public static $sliderTime = 'div.scroll-time.vue-slider-component.vue-slider-horizontal.vue-slider-has-label';
    public static $sliderSlide = 'div.scroll-time.vue-slider-component.vue-slider-horizontal.vue-slider-has-label > div > div.vue-slider-always.vue-slider-dot';



    //Pay Service
    public static $payService = 'div:nth-child(2) > header > nav > ul > li:nth-child(4)';
    public static $payServiceURL = '#url';
    public static $payServiceDescription = '#description';
    public static $payServiceDrop = 'div:nth-child(4) > div > div:nth-child(1) > div > div > div > div > div > div';
    public static $payServiceDropList = [
        'div:nth-child(1) > div > div > div > div > div > div > ul > li:nth-child(1)',
        'div:nth-child(1) > div > div > div > div > div > div > ul > li:nth-child(2)',
        'div:nth-child(1) > div > div > div > div > div > div > ul > li:nth-child(3)',
    ];
    public static $payServiceSum = 'div:nth-child(1) > div > div:nth-child(2) > div > div > div.input-group-inner > input';
    public static $payServiceSum2 = '#__layout > div > section > div.container > div > div:nth-child(2) > div.content-box > div > form > div > div:nth-child(4) > div > div:nth-child(1) > div > div:nth-child(3) > div > div > div.input-group-inner > input';
    public static $payServiceBtnDisabled = 'button.btn[disabled="disabled"]';
    public static $payServiceBtnActive = 'form > div > div:nth-child(4) > div > div:nth-child(2) > div > button';
    public static $payServiceApproveSum = 'tr:nth-child(6) > td';
    public static $payServiceApproveSum2 = 'tr:nth-child(7) > td';
    public static $payServiceApproveBtn = 'button.btn.btn-warn.d-block.text-center.text-uppercase';
    public static $payServiceStatusBtn = 'button.btn.btn-danger.d-block.text-center.text-uppercase';


    // Slider
    public static $sliderGrabElement = '#carousel1___BV_inner_';
    public static $sliderElementChange = '#carousel1';
    public static $sliderPrevBtn = '#carousel1 > a.carousel-control-prev';
    public static $sliderNextBtn = '#carousel1 > a.carousel-control-next';

    // Terms
    public static $terms = 'div.logo-s.text-center > div > a:nth-child(1)';


    // Support
    public static $supportLink = 'div.user-box > div > div > div > div > ul > li:nth-child(2) > a';
    public static $supportBalance = 'li:nth-child(2) > span';
    public static $supportTicketBtn = 'div.tabs-with-btn.d-flex.justify-content-between > button';
    public static $supportDropSelect = 'div.new-ticket.pt-5 > div:nth-child(2) > div > div > div';
    public static $supportSelectList = [
        'div:nth-child(2) > div > div > div > ul > li:nth-child(1)',
        'div:nth-child(2) > div > div > div > ul > li:nth-child(2)',
        'div:nth-child(2) > div > div > div > ul > li:nth-child(3)'
    ];
    public static $supportText = '#message';
    public static $supportCreateDisabledBtn = 'button.btn[disabled="disabled"]';
    public static $supportCreateActiveBtn = 'div.d-flex.justify-content-between > button:nth-child(1)';






























    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL.$param;
    }


}
