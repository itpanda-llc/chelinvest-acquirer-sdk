<?php

/**
 * Файл из репозитория Chelinvest-Acquirer-SDK
 * @link https://github.com/itpanda-llc/chelinvest-acquirer-sdk
 */

namespace Panda\Chelinvest\AcquirerSdk;

/**
 * Class Order
 * @package Panda\Chelinvest\AcquirerSdk
 * Заказ / Запрос
 */
class Order
{
    /**
     * @var string|null URL-адрес
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/registerCommon
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/paymentPage
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/payment
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/getOrderStatusShort
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/getOrderStatus
     */
    public $url;

    /**
     * @var array Параметры заказа/запроса
     */
    public $order = [];
}
