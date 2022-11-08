<?php

namespace Rd\Test\Helper;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\UserTable;

class User
{
    /**
     * возвращающий все глассные буквы из `NAME`, `LAST_NAME`,
     * `SECOND_NAME` пользователя в нижнем регистре без пробелов с
     * соответствующим параметру ID пользователя
     * @param int $userId
     * @param $lang
     * @return string
     * @throws \Exception
     */
    public static function getUsernameVowels(int $userId, $lang = 'ru')
    {
        try {
            if ($lang == 'ru')
                $patt = '~(?<find>[бвгджзйклмнпрстфхцчшщъь])~iu';
            elseif ($lang == 'eng')
                $patt = '~(?<find>[bcdfghjklmnpqrstvwxyz])~iu';
            else
                throw new ArgumentException('"' . $lang . '" language is not processed');

            $query = UserTable::query()
                ->where('ID', $userId)
                ->setSelect(['NAME', 'LAST_NAME', 'SECOND_NAME'])
                ->exec();
            if ($res = $query->fetch()) {
                preg_match_all($patt, mb_strtolower(implode('', $res)), $match);
                return implode('', $match['find']);
            } else
                throw new \Exception('user not found');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
