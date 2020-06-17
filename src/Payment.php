<?php

/**
 * Файл из репозитория Chelinvest-Acquirer-PHP-SDK
 * @link https://github.com/itpanda-llc
 */

namespace Panda\Chelinvest\AcquirerSDK;

/**
 * Class Payment
 * @package Panda\Chelinvest\AcquirerSDK
 * Формирование URL-адреса страницы оплаты заказа
 */
class Payment extends Order
{
    /**
     * Наименование параметра "Адрес электронной почты"
     */
    private const MAIL = 'mail';

    /**
     * @param string $orderId Номер заказа
     * @param string|null $mail Адрес электронной почты
     * @return string Адрес страницы оплаты заказа
     */
    public static function getURL(string $orderId,
                                  string $mail = null): string
    {
        $order[self::ORDER_ID] = $orderId;
        $order[self::MAIL] = $mail;

        return sprintf("%s?%s",
            URL::PAYMENT,
            http_build_query($order));
    }
}
