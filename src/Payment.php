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
 * Class Payment Формирование адреса страницы оплаты заказа
 * @package Panda\Chelinvest\AcquirerSDK
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

        return sprintf('%s?%s',
            URL::PAYMENT,
            http_build_query($order));
    }
}
