<?php

/**
 * Файл из репозитория Chelinvest-Acquirer-PHP-SDK
 * @link https://github.com/itpanda-llc
 */

namespace Panda\Chelinvest\AcquirerSDK;

/**
 * Class URL
 * @package Panda\Chelinvest\AcquirerSDK
 * URL-адреса web-запросов и формирования адреса страницы оплаты заказа
 */
class URL
{
    /**
     * Запрос регистрация заказа
     */
    public const REGISTER = 'https://mpi.chelinvest.ru/gorodUnified/registerCommon';

    /**
     * Формирование адреса страницы оплаты заказа
     */
    public const PAYMENT = 'https://mpi.chelinvest.ru/gorodUnified/';

    /**
     * Запрос оплаты заказа
     */
    public const PROCESS = 'https://mpi.chelinvest.ru/gorodUnified/payment';

    /**
     * Запрос состояния заказа
     */
    public const STATE = 'https://mpi.chelinvest.ru/gorodUnified/getOrderStatusShort';

    /**
     * Запрос состояния заказа / Расширенный
     */
    public const DETAIL = 'https://mpi.chelinvest.ru/gorodUnified/getOrderStatus';
}
