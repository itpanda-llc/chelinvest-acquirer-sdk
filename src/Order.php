<?php

/**
 * Файл из репозитория Chelinvest-Acquirer-PHP-SDK
 * @link https://github.com/itpanda-llc
 */

namespace Panda\Chelinvest\AcquirerSDK;

/**
 * Class Order
 * @package Panda\Chelinvest\AcquirerSDK
 * Заказ
 */
class Order
{
    /**
     * Наименование параметра "Номер заказа"
     */
    protected const ORDER_ID = 'orderId';

    /**
     * @var string URL-адрес web-запроса
     */
    public $url;

    /**
     * @var array Параметры заказа
     */
    public $order = [];
}
