<?php

namespace Rd\Test\Controller;

use Bitrix\Main\Error;
use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Localization\Loc;
use Rd\Test\Helper;

class User extends Controller
{
    public function getUserNameVowelsAction($userId)
    {
        try {
            return Helper\User::getUsernameVowels($userId);
        } catch (\Throwable $e) {
            $this->addError(new Error(Loc::getMessage('', array(
                '#ERROR_MESSAGE#' => $e->getMessage()
            ))));
            return null;
        }
    }
}