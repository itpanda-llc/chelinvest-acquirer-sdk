<?php

/**
 * Файл из репозитория Chelinvest-Acquirer-PHP-SDK
 * @link https://github.com/itpanda-llc/chelinvest-acquirer-php-sdk
 */

declare(strict_types=1);

namespace Panda\Chelinvest\AcquirerSdk;

/**
 * Class RegisterCommon
 * @package Panda\Chelinvest\AcquirerSdk
 * Запрос регистрации заказа
 */
class RegisterCommon extends Order
{
    /**
     * Наименование параметра "Сумма"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/registerCommon
     */
    private const AMOUNT = 'amount';

    /**
     * Наименование параметра "Описание заказа"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/registerCommon
     */
    private const DESCRIPTION = 'description';

    /**
     * Наименование параметра "Номер (идентификатор) заказа в системе магазина"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/registerCommon
     */
    private const ORDER_NUMBER = 'orderNumber';

    /**
     * Наименование параметра "Список товаров"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/registerCommon
     */
    private const PRODUCT = 'product';

    /**
     * Наименование параметра "Название товара"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/registerCommon
     */
    private const NAME = 'name';

    /**
     * Наименование параметра "Количество товара"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/registerCommon
     */
    private const COUNT = 'count';

    /**
     * Наименование параметра "Сумма за единицу товара"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/registerCommon
     */
    private const SUM = 'sum';

    /**
     * Наименование параметра "Код продукта"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/registerCommon
     */
    private const CODE = 'code';

    /**
     * Наименование параметра "Идентификатор клиента"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/registerCommon
     */
    private const CLIENT_ID = 'clientId';

    /**
     * Наименование параметра "Адрес перенаправления после оплаты"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/registerCommon
     */
    private const RETURN_URL = 'returnUrl';

    /**
     * Наименование параметра "Флаг для открытия платежной страницы во фрейме"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/registerCommon
     */
    private const IFRAME = 'iframe';

    /**
     * @var string URL-адрес
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/registerCommon
     */
    public $url = Url::REGISTER_COMMON;

    /**
     * RegisterCommon constructor.
     * @param string $returnUrl Адрес перенаправления после оплаты
     * @param Product|null $product Список товаров
     */
    public function __construct(string $returnUrl,
                                Product $product = null)
    {
        $this->order[self::RETURN_URL] = $returnUrl;
        $this->order += $product->order ?? [];
    }

    /**
     * @param string $orderNumber Номер (идентификатор) заказа в системе магазина
     * @return $this
     */
    public function setOrderNumber(string $orderNumber): self
    {
        $this->order[self::ORDER_NUMBER] = $orderNumber;

        return $this;
    }

    /**
     * @param string $description Описание заказа
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->order[self::DESCRIPTION] = $description;

        return $this;
    }

    /**
     * @param string $name Название товара
     * @param int $count Количество товара
     * @param int $sum Сумма за единицу товара
     * @param string $code Код продукта
     * @return $this
     */
    public function addProduct(string $name,
                               int $count,
                               int $sum,
                               string $code = '0'): self
    {
        static $products;

        if (isset($this->order[self::PRODUCT]))
            $products = $products
                ?? json_decode($this->order[self::PRODUCT], true);

        $products[self::PRODUCT][] = [
            self::NAME => $name,
            self::COUNT => $count,
            self::SUM => $sum,
            self::CODE => $code
        ];

        $this->order[self::PRODUCT] = json_encode($products);
        $this->order[self::AMOUNT] =
            ($this->order[self::AMOUNT] ?? 0) + $count * $sum;

        return $this;
    }

    /**
     * @param string $clientId Идентификатор клиента
     * @return $this
     */
    public function setClientId(string $clientId): self
    {
        $this->order[self::CLIENT_ID] = $clientId;

        return $this;
    }

    /**
     * @param bool $iframe Флаг для открытия платежной страницы во фрейме
     * @return $this
     */
    public function setIframe(bool $iframe): self
    {
        $this->order[self::IFRAME] = $iframe;

        return $this;
    }

    /**
     * @param string $name Название товара
     * @param int $count Количество товара
     * @param int $sum Сумма за единицу товара
     * @param string $code Код продукта
     * @return Product
     */
    public static function newProduct(string $name,
                                      int $count,
                                      int $sum,
                                      string $code = '0'): Product
    {
        return new Product($name, $count, $sum, $code);
    }
}
