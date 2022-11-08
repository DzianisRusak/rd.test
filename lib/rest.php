<?php

namespace Rd\Test;

use Bitrix\Rest\RestException;
use IRestService;
use Rd\Test\Helper;


/**
 * Class Rest
 * @package Rd\Tests
 */
class Rest extends IRestService
{
    /**
     * Handler of `rest/onRestServiceBuildDescription` event.
     * @return array
     */
    public static function onRestServiceBuildDescription()
    {
        return [
            'rd.test' => [
                'get.username.vowels' => [
                    'callback' => [__CLASS__, 'getUserNameVowels'],
                    'options' => []
                ],
            ]
        ];
    }

    public static function getUsernameVowels($query, $n, \CRestServer $server)
    {
        try {
            if (empty($query['userId']))
                throw new RestException('required parameter "userId" is missing', 400, \CRestServer::STATUS_WRONG_REQUEST);

            return [
                'userId' => $query['userId'],
                'result' => Helper\User::getUsernameVowels($query['userId']),
                'status' => 'success'
            ];
        } catch (RestException $exception) {
            return array(
                'status' => 'error',
                'error_message' => $exception->getMessage(),
            );
        }
    }

}
