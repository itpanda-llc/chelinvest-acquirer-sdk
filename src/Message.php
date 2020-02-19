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

/**
 * Class Message Сообщения исключений
 * @package Panda\Chelinvest\AcquirerSDK
 */
class Message
{
    /**
     * Ошибка параметров списка позиций
     */
    public const PRODUCT_ERROR = 'Неправильные параметры списка позиций';

    /**
     * Ошибка выполнения web-запроса
     */
    public const REQUEST_ERROR = 'Web-запрос не выполнен';
}
