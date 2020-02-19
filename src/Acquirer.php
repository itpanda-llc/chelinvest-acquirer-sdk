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

use Panda\Yandex\TranslateSDK\Detect;

/**
 * Class Acquirer Формирование и выполнение запроса в банк
 * @package Panda\Chelinvest\AcquirerSDK
 */
class Acquirer extends Request
{
    /**
     * Наименование параметра "Имя пользователя"
     */
    private const USER_NAME = 'userName';

    /**
     * Наименование параметра "Пароль"
     */
    private const PASSWORD = 'password';

    /**
     * @var array Параметры заказа
     */
    private $order = [];

    /**
     * Pilot constructor.
     * @param string|null $userName Имя пользователя
     * @param string|null $password Пароль
     */
    public function __construct(string $userName = null,
                                string $password = null)
    {
        $this->order[self::USER_NAME] = $userName;
        $this->order[self::PASSWORD] = $password;
    }

    /**
     * @param string $orderId Номер заказа
     * @return string Результат web-запроса
     */
    public function getState(string $orderId): string
    {
        $state = new State($orderId);

        return $this->request($state);
    }

    /**
     * @param string $orderId Номер заказа
     * @return string Результат web-запроса
     */
    public function getDetail(string $orderId): string
    {
        $detail = new Detail($orderId);

        return $this->request($detail);
    }

    /**
     * @param Order $order Параметры заказа
     * @return string Результат web-запроса
     */
    public function request(Order $order): string
    {
        return parent::send($order->url,
            http_build_query(array_merge($this->order,
                $order->order)));
    }
}
