<?php

/**
 * Этот файл является частью репозитория
 * Panda/Chelinvest/AcquirerSDK.
 *
 * Для получения полной информации об авторских правах
 * и лицензии, пожалуйста, просмотрите файл LICENSE,
 * который был распространен с этим исходным кодом.
 */

namespace Panda\Chelinvest\AcquirerSDK;

use Panda\Chelinvest\AcquirerSDK\Exception\ClientException;

/**
 * Class Request Web-запрос
 * @package Panda\Chelinvest\AcquirerSDK
 */
class Request
{
    /**
     * @param string $url URL web-запроса
     * @param string $data Параметры web-запроса
     * @return string Результат web-запроса
     */
    protected function send(string $url, string $data): string
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($ch);

        if ($response === false) {
            throw new ClientException(sprintf('%s. Ошибка: %s',
                Message::REQUEST_ERROR,
                curl_error($ch)));
        }

        curl_close($ch);

        return $response;
    }
}
