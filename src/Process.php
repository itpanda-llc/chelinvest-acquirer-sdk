<?php

/**
 * Файл из репозитория Chelinvest-Acquirer-PHP-SDK
 * @link https://github.com/itpanda-llc
 */

namespace Panda\Chelinvest\AcquirerSDK;

/**
 * Class Process
 * @package Panda\Chelinvest\AcquirerSDK
 * Запрос оплаты заказа
 */
class Process extends Order
{
    /**
     * Наименование параметра "PAN-номер карты"
     */
    private const PAN_NUMBER = '$PAN';

    /**
     * Наименование параметра "Месяц истечения срока действия карты"
     */
    private const EXPIRY_MONTH = 'MM';

    /**
     * Наименование параметра "Год истечения срока действия карты"
     */
    private const EXPIRY_YEAR = 'YYYY';

    /**
     * Наименование параметра "Дата истечения срока действия карты"
     */
    private const EXPIRY = '$EXPIRY';

    /**
     * Наименование параметра "Имя владельца карты"
     */
    private const OWNER_NAME = 'TEXT';

    /**
     * Наименование параметра "CVV2/CVC2/ППК2-код карты"
     */
    private const CVC_CODE = '$CVC';

    /**
     * @var string URL-адрес web-запроса
     */
    public $url = URL::PROCESS;

    /**
     * Process constructor.
     * @param string $orderId Номер заказа
     */
    public function __construct(string $orderId)
    {
        $this->order[self::ORDER_ID] = $orderId;
    }

    /**
     * @param string $panNumber PAN-номер карты
     * @param string $expiryMonth Месяц истечения срока действия карты
     * @param string $expiryYear Год истечения срока действия карты
     * @param string $ownerName Имя владельца карты
     * @param string $cvcCode CVV2/CVC2/ППК2-код карты
     */
    public function addCard(string $panNumber,
                            string $expiryMonth,
                            string $expiryYear,
                            string $ownerName,
                            string $cvcCode): void
    {
        $this->order[self::PAN_NUMBER] = $panNumber;
        $this->order[self::EXPIRY_MONTH] = $expiryMonth;
        $this->order[self::EXPIRY_YEAR] = $expiryYear;
        $this->order[self::OWNER_NAME] = $ownerName;
        $this->order[self::CVC_CODE] = $cvcCode;

        $this->order[self::EXPIRY] = $expiryYear;
        $this->order[self::EXPIRY] .= $expiryMonth;
    }
}
