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

use Panda\Chelinvest\AcquirerSDK\Exception\ClientException;

/**
 * Class Register Запрос регистрации заказа
 * @package Panda\Chelinvest\AcquirerSDK
 */
class Register extends Order
{
    /**
     * Наименование параметра "URL перехода после оплаты"
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
     * @var string URL web-запроса
     */
    public $url = URL::REGISTER;

    /**
     * Register constructor.
     * @param string $returnURL URL перехода после оплаты
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

    /**
     * @param array $productList Список параметров товаров
     * @return Register
     */
    public function addProductList(array $productList): Register
    {
        foreach ($productList as $v) {
            if ((!isset($v[0])) || (!isset($v[1]))
                || (!isset($v[2])) || (!isset($v[3]))
                || (!is_string($v[0])) || (!is_int($v[1]))
                || (!is_int($v[2])) || (!is_string($v[3])))
            {
                throw new ClientException(Message::PRODUCT_ERROR);
            }
        }

        foreach ($productList as $v) {
            $this->addProduct($v[0], $v[1], $v[2], $v[3]);
        }

        return $this;
    }
}
