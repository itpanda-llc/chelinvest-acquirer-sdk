<?php

/**
 * Файл из репозитория Chelinvest-Acquirer-SDK
 * @link https://github.com/itpanda-llc/chelinvest-acquirer-sdk
 */

namespace Panda\Chelinvest\AcquirerSdk;

/**
 * Class Status
 * @package Panda\Chelinvest\AcquirerSdk
 * Запрос состояния заказа расширенный
 */
class Status extends StatusShort
{
    /**
     * @var string URL-адрес
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/getOrderStatus
     */
    public $url = Url::ORDER_STATUS;
}
