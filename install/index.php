<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\EventManager;
use Bitrix\Main\Localization\Loc;
use Rd\Test\Rest;


class Rd_Test extends \CModule
{
    var $MODULE_ID,
        $MODULE_VERSION,
        $MODULE_VERSION_DATE,
        $MODULE_NAME,
        $MODULE_DESCRIPTION,
        $PARTNER_NAME,
        $PARTNER_URI;


    public function __construct()
    {
        $arModuleVersion = [];
        include(__DIR__ . '/version.php');
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        $this->MODULE_ID = 'rd.test';
        $this->MODULE_NAME = Loc::GetMessage('RD_TEST_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::GetMessage('RD_TEST_MODULE_DESC');
        $this->PARTNER_NAME = Loc::GetMessage('RD_TEST_PARTNER_NAME');
        $this->PARTNER_URI = Loc::GetMessage('RD_TEST_PARTNER_URI');
    }

    public function doInstall()
    {
        if ($this->installEvents()) {
            RegisterModule($this->MODULE_ID);
            return true;
        } else
            return false;
    }

    public function doUninstall()
    {
        UnRegisterModule($this->MODULE_ID);
        $this->uninstallEvents();
    }


    public function installEvents()
    {
        $eventManager = EventManager::getInstance();
        $eventManager->registerEventHandler("rest", "OnRestServiceBuildDescription", $this->MODULE_ID, Rest::class, "onRestServiceBuildDescription");

        return true;
    }

    public function uninstallEvents()
    {
        $eventManager = EventManager::getInstance();
        $eventManager->unRegisterEventHandler("rest", "OnRestServiceBuildDescription", $this->MODULE_ID, Rest::class, "onRestServiceBuildDescription");

        return true;
    }

}
