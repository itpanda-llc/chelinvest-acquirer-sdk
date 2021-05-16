<?php

/**
 * Файл из репозитория Chelinvest-Acquirer-SDK
 * @link https://github.com/itpanda-llc/chelinvest-acquirer-sdk
 */

declare(strict_types=1);

namespace Panda\Chelinvest\AcquirerSdk;

/**
 * Class PaymentPage
 * @package Panda\Chelinvest\AcquirerSdk
 * Переход на страницу оплаты
 */
class PaymentPage extends Order
{
    /**
     * Наименование параметра "Уникальный номер заказа в системе"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/paymentPage
     */
    protected const ORDER_ID = 'orderId';

    /**
     * Наименование параметра "Адрес почты"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/paymentPage
     */
    private const MAIL = 'mail';

    /**
     * @param string $orderId Уникальный номер заказа в системе
     * @param string|null $mail Адрес почты
     * @return string Адрес страницы оплаты
     */
    public static function get(string $orderId,
                               string $mail = null): string
    {
        $order[self::ORDER_ID] = $orderId;
        $order[self::MAIL] = $mail;

        return sprintf("%s?%s",
            Url::PAYMENT_PAGE,
            http_build_query($order));
    }
}
