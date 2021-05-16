<?php

/**
 * Файл из репозитория Chelinvest-Acquirer-SDK
 * @link https://github.com/itpanda-llc/chelinvest-acquirer-sdk
 */

namespace Panda\Chelinvest\AcquirerSdk;

/**
 * Class Card
 * @package Panda\Chelinvest\AcquirerSdk
 * Карта оплаты
 */
class Card
{
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
     * @var array Параметры заказа/запроса
     */
    public $order = [];

    /**
     * Card constructor.
     * @param string $pan Номер карты
     * @param string $mm Месяц истечения срока действия карты
     * @param string $yyyy Год истечения срока действия карты
     * @param string $text Имя держателя карты
     * @param string $cvc CVV2 / CVC2 / ППК2
     */
    public function __construct(string $pan,
                                string $mm,
                                string $yyyy,
                                string $text,
                                string $cvc)
    {
        $this->order[self::PAN] = $pan;
        $this->order[self::MM] = $mm;
        $this->order[self::YYYY] = $yyyy;
        $this->order[self::EXPIRY] = $yyyy;
        $this->order[self::EXPIRY] .= $mm;
        $this->order[self::TEXT] = $text;
        $this->order[self::CVC] = $cvc;
    }
}
