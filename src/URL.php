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
 * Class URL URLы web-запросов и формирования адреса страницы оплаты заказа
 * @package Panda\Chelinvest\AcquirerSDK
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
