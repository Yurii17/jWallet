<?php
namespace Helper;


use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverElement;
use Facebook\WebDriver\Interactions\WebDriverActions;
// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Actions extends \Codeception\Module
{
    public $module ='WebDriver';


    /** @param $element ... */
    public function ScrollText($element, $x = null , $y = null){

    }
    /**
     * @param $element
     * @param null $x
     * @param null $y
     * @throws \Codeception\Exception\ModuleException
     */


    public function slide($element, $x = null, $y = null)
    {
        $el = $this->getModule($this->module)->webDriver->findElement(\WebDriverBy::cssSelector($element));
        $action = new WebDriverActions($this->getModule($this->module)->webDriver);
        $action->clickAndHold($el)
            ->moveByOffset($x, $y)
            ->release()
            ->perform();
    }





















}
