<?php

/**
 * Файл из репозитория Chelinvest-Acquirer-SDK
 * @link https://github.com/itpanda-llc/chelinvest-acquirer-sdk
 */

declare(strict_types=1);

namespace Panda\Chelinvest\AcquirerSdk;

/**
 * Class Payment
 * @package Panda\Chelinvest\AcquirerSdk
 * Запрос оплаты заказа
 */
class Payment extends Order
{
    /**
     * Наименование параметра "Уникальный номер заказа в системе"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/payment
     */
    protected const ORDER_ID = 'orderId';

    /**
     * Наименование параметра "Номер карты"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/payment
     */
    private const PAN = '$PAN';

    /**
     * Наименование параметра "Месяц истечения срока действия карты"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/payment
     */
    private const MM = 'MM';

    /**
     * Наименование параметра "Год истечения срока действия карты"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/payment
     */
    private const YYYY = 'YYYY';

    /**
     * Наименование параметра "Срок истечения действия карты"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/payment
     */
    private const EXPIRY = '$EXPIRY';

    /**
     * Наименование параметра "Имя держателя карты"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/payment
     */
    private const TEXT = 'TEXT';

    /**
     * Наименование параметра "CVV2 / CVC2 / ППК2"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/payment
     */
    private const CVC = '$CVC';

    /**
     * @var string URL-адрес
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/payment
     */
    public $url = Url::PAYMENT;

    /**
     * Payment constructor.
     * @param string|null $orderId Уникальный номер заказа в системе
     * @param Card|null $card Карта оплаты
     */
    public function __construct(string $orderId,
                                Card $card = null)
    {
        $this->order[self::ORDER_ID] = $orderId;
        $this->order += $card->order ?? [];
    }

    /**
     * @param string $pan Номер карты
     * @param string $mm Месяц истечения срока действия карты
     * @param string $yyyy Год истечения срока действия карты
     * @param string $text Имя держателя карты
     * @param string $cvc CVV2 / CVC2 / ППК2
     * @return $this
     */
    public function setCard(string $pan,
                            string $mm,
                            string $yyyy,
                            string $text,
                            string $cvc): self
    {
        $this->order[self::PAN] = $pan;
        $this->order[self::MM] = $mm;
        $this->order[self::YYYY] = $yyyy;
        $this->order[self::EXPIRY] = $yyyy;
        $this->order[self::EXPIRY] .= $mm;
        $this->order[self::TEXT] = $text;
        $this->order[self::CVC] = $cvc;

        return $this;
    }

    /**
     * @param string $orderId Уникальный номер заказа в системе
     * @param string|null $mail Адрес почты
     * @return string Адрес страницы оплаты
     */
    public static function getPage(string $orderId,
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
    public static function newCard(string $pan,
                                   string $mm,
                                   string $yyyy,
                                   string $text,
                                   string $cvc): Card
    {
        return new Card($pan, $mm, $yyyy, $text, $cvc);
    }
}
