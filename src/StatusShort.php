<?php

/**
 * Файл из репозитория Chelinvest-Acquirer-PHP-SDK
 * @link https://github.com/itpanda-llc/chelinvest-acquirer-php-sdk
 */

namespace Panda\Chelinvest\AcquirerSdk;

/**
 * Class StatusShort
 * @package Panda\Chelinvest\AcquirerSdk
 * Запрос состояния заказа
 */
class StatusShort extends Order
{
    /**
     * Наименование параметра "Уникальный номер заказа в системе"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/getOrderStatusShort
     */
    protected const ORDER_ID = 'orderId';

    /**
     * @var string URL-адрес
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/getOrderStatusShort
     */
    public $url = Url::ORDER_STATUS_SHORT;

    /**
     * StatusShort constructor.
     * @param string $orderId Номер заказа системы
     */
    public function __construct(string $orderId)
    {
        $this->order[self::ORDER_ID] = $orderId;
    }
}
