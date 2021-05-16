<?php

/**
 * Файл из репозитория Chelinvest-Acquirer-SDK
 * @link https://github.com/itpanda-llc/chelinvest-acquirer-sdk
 */

namespace Panda\Chelinvest\AcquirerSdk;

/**
 * Class Url
 * @package Panda\Chelinvest\AcquirerSdk
 * URL-адреса
 */
class Url
{
    /**
     * Запрос регистрация заказа
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/registerCommon
     */
    public const REGISTER_COMMON = 'https://mpi.chelinvest.ru/gorodUnified/registerCommon';

    /**
     * Переход на страницу оплаты
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/paymentPage
     */
    public const PAYMENT_PAGE = 'https://mpi.chelinvest.ru/gorodUnified/';

    /**
     * Запрос оплаты заказа
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/payment
     */
    public const PAYMENT = 'https://mpi.chelinvest.ru/gorodUnified/payment';

    /**
     * Запрос состояния заказа
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/getOrderStatusShort
     */
    public const ORDER_STATUS_SHORT = 'https://mpi.chelinvest.ru/gorodUnified/getOrderStatusShort';

    /**
     * Запрос состояния заказа расширенный
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/getOrderStatus
     */
    public const ORDER_STATUS = 'https://mpi.chelinvest.ru/gorodUnified/getOrderStatus';
}
