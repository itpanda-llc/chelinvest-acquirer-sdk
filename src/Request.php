<?php

/**
 * Файл из репозитория Chelinvest-Acquirer-SDK
 * @link https://github.com/itpanda-llc/chelinvest-acquirer-sdk
 */

declare(strict_types=1);

namespace Panda\Chelinvest\AcquirerSdk;

/**
 * Class Request
 * @package Panda\Chelinvest\AcquirerSdk
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
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        if (($response = curl_exec($ch)) === false)
            throw new Exception\ClientException(curl_error($ch));

        curl_close($ch);

        return $response;
    }
}
