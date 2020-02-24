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
 * Class Order Заказ
 * @package Panda\Chelinvest\AcquirerSDK
 */
class Order
{
    /**
     * Наименование параметра "Номер заказа"
     */
    protected const ORDER_ID = 'orderId';

    /**
     * @var string URL web-запроса
     */
    public $url;

    /**
     * @var array Параметры заказа
     */
    public $order = [];
}
