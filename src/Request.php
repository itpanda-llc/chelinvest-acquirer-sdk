<?php

/**
 * Файл из репозитория Chelinvest-Acquirer-PHP-SDK
 * @link https://github.com/itpanda-llc
 */

namespace Panda\Chelinvest\AcquirerSDK;

use Panda\Chelinvest\AcquirerSDK\Exception\ClientException;

/**
 * Class Request
 * @package Panda\Chelinvest\AcquirerSDK
 * Web-запрос
 */
class Request
{
    /**
     * @param string $url URL-адрес
     * @param string $data Параметры
     * @return string Результат
     */
    protected function send(string $url, string $data): string
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        if (($response = curl_exec($ch)) === false)
            throw new ClientException(curl_error($ch));

        curl_close($ch);

        return $response;
    }
}
