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
 * Class Detail Запрос состояния заказа / Расширенный
 * @package Panda\Chelinvest\AcquirerSDK
 */
class Detail extends Order
{
    /**
     * @var string URL web-запроса
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
