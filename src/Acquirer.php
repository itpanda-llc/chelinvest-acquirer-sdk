<?php

/**
 * Файл из репозитория Chelinvest-Acquirer-PHP-SDK
 * @link https://github.com/itpanda-llc/chelinvest-acquirer-php-sdk
 */

declare(strict_types=1);

namespace Panda\Chelinvest\AcquirerSdk;

/**
 * Class Acquirer
 * @package Panda\Chelinvest\AcquirerSdk
 * Формирование заказа / Выполнение запроса
 */
class Acquirer extends Request
{
    /**
     * Наименование параметра "Логин"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/registerCommon
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/payment
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/getOrderStatusShort
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/getOrderStatus
     */
    private const USER_NAME = 'userName';

    /**
     * Наименование параметра "Пароль"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/registerCommon
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/payment
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/getOrderStatusShort
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/getOrderStatus
     */
    private const PASSWORD = 'password';

    /**
     * @var array Параметры заказа/запроса
     */
    private $order = [];

    /**
     * Acquirer constructor.
     * @param string $userName Логин
     * @param string $password Пароль
     */
    public function __construct(string $userName,
                                string $password)
    {
        $this->order[self::USER_NAME] = $userName;
        $this->order[self::PASSWORD] = $password;
    }

    /**
     * @param string $name Название товара
     * @param int $count Количество товара
     * @param int $sum Сумма за единицу товара
     * @param string $code Код продукта
     * @return Product
     */
    public function newProduct(string $name,
                               int $count,
                               int $sum,
                               string $code = '0'): Product
    {
        return new Product($name, $count, $sum, $code);
    }

    /**
     * @param string $returnUrl Адрес перенаправления после оплаты
     * @param Product $product Список товаров
     * @return string Результат web-запроса
     */
    public function registerCommon(string $returnUrl,
                                   Product $product): string
    {
        return $this->request(new RegisterCommon($returnUrl,
            $product));
    }

    /**
     * @param string $orderId Уникальный номер заказа в системе
     * @param string|null $mail Адрес почты
     * @return string Адрес страницы оплаты
     */
    public function getPaymentPage(string $orderId,
                                   string $mail = null): string
    {
        return PaymentPage::get($orderId, $mail);
    }

    /**
     * @param string $pan Номер карты
     * @param string $mm Месяц истечения срока действия карты
     * @param string $yyyy Год истечения срока действия карты
     * @param string $text Имя держателя карты
     * @param string $cvc CVV2 / CVC2 / ППК2
     * @return Card
     */
    public function newCard(string $pan,
                            string $mm,
                            string $yyyy,
                            string $text,
                            string $cvc): Card
    {
        return new Card($pan, $mm, $yyyy, $text, $cvc);
    }

    /**
     * @param string $orderId Уникальный номер заказа в системе
     * @param Card $card Карта оплаты
     * @return string Результат web-запроса
     */
    public function payment(string $orderId, Card $card): string
    {
        return $this->request(new Payment($orderId, $card));
    }

    /**
     * @param string $orderId Номер заказа системы
     * @return string Результат web-запроса
     */
    public function getStatusShort(string $orderId): string
    {
        return $this->request(new StatusShort($orderId));
    }

    /**
     * @param string $orderId Номер заказа системы
     * @return string Результат web-запроса
     */
    public function getStatus(string $orderId): string
    {
        return $this->request(new Status($orderId));
    }

    /**
     * @param Order $order Параметры заказа/запроса
     * @return string Результат web-запроса
     */
    public function request(Order $order): string
    {
        return $this->send($order->url,
            http_build_query($order->order + $this->order));
    }
}
