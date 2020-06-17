<?php

/**
 * Файл из репозитория Chelinvest-Acquirer-PHP-SDK
 * @link https://github.com/itpanda-llc
 */

namespace Panda\Chelinvest\AcquirerSDK;

/**
 * Class Detail
 * @package Panda\Chelinvest\AcquirerSDK
 * Запрос состояния заказа / Расширенный
 */
class Detail extends Order
{
    /**
     * @var string URL-адрес web-запроса
     */
    public $url = URL::DETAIL;

    /**
     * Detail constructor.
     * @param string $orderId Номер заказа
     */
    public function __construct(string $orderId)
    {
        $this->order[self::ORDER_ID] = $orderId;
    }
}
