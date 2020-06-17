<?php

/**
 * Файл из репозитория Chelinvest-Acquirer-PHP-SDK
 * @link https://github.com/itpanda-llc
 */

namespace Panda\Chelinvest\AcquirerSDK;

/**
 * Class Register
 * @package Panda\Chelinvest\AcquirerSDK
 * Запрос регистрации заказа
 */
class Register extends Order
{
    /**
     * Наименование параметра "URL-адрес перехода после оплаты"
     */
    private const RETURN_URL = 'returnUrl';

    /**
     * Наименование параметра "Стоимость заказа"
     */
    private const ORDER_AMOUNT = 'amount';

    /**
     * Наименование параметра "Описание заказа"
     */
    private const ORDER_DESCRIPTION = 'description';

    /**
     * Наименование параметра "Номер заказа"
     */
    private const ORDER_NUMBER = 'orderNumber';

    /**
     * Наименование параметра "Список товаров"
     */
    private const ORDER_PRODUCT = 'product';

    /**
     * Наименование параметра "Наименование товара"
     */
    private const PRODUCT_NAME = 'name';

    /**
     * Наименование параметра "Количество товара"
     */
    private const PRODUCT_COUNT = 'count';

    /**
     * Наименование параметра "Стоимость товара"
     */
    private const PRODUCT_SUM = 'sum';

    /**
     * Наименование параметра "Код товара"
     */
    private const PRODUCT_CODE = 'code';

    /**
     * @var array Параметры продуктов
     */
    private $products = [];

    /**
     * @var string URL-адрес web-запроса
     */
    public $url = URL::REGISTER;

    /**
     * Register constructor.
     * @param string $returnURL URL-адрес перехода после оплаты
     * @param string|null $orderNumber Номер заказа
     * @param string|null $orderDescription Описание заказа
     */
    public function __construct(string $returnURL,
                                string $orderNumber = null,
                                string $orderDescription = null)
    {
        $this->order[self::RETURN_URL] = $returnURL;
        $this->order[self::ORDER_NUMBER] = $orderNumber;
        $this->order[self::ORDER_DESCRIPTION] = $orderDescription;
    }

    /**
     * @param string $name Наименование товара
     * @param int $count Количество товара
     * @param int $sum Стоимость товара
     * @param string $code Код товара
     * @return Register
     */
    public function addProduct(string $name,
                               int $count,
                               int $sum,
                               string $code): Register
    {
        $product[self::PRODUCT_NAME] = $name;
        $product[self::PRODUCT_COUNT] = $count;
        $product[self::PRODUCT_SUM] = $sum;
        $product[self::PRODUCT_CODE] = $code;

        $this->products[self::ORDER_PRODUCT][] = $product;
        $this->order[self::ORDER_PRODUCT] =
            json_encode($this->products);

        $this->order[self::ORDER_AMOUNT] =
            $this->order[self::ORDER_AMOUNT] ?? 0;
        $this->order[self::ORDER_AMOUNT] += $count * $sum;

        return $this;
    }
}
