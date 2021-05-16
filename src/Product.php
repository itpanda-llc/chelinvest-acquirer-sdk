<?php

/**
 * Файл из репозитория Chelinvest-Acquirer-SDK
 * @link https://github.com/itpanda-llc/chelinvest-acquirer-sdk
 */

declare(strict_types=1);

namespace Panda\Chelinvest\AcquirerSdk;

/**
 * Class Product
 * @package Panda\Chelinvest\AcquirerSdk
 * Список товаров
 */
class Product
{
    /**
     * Наименование параметра "Сумма"
     * @link https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/registerCommon
     */
    private const AMOUNT = 'amount';

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
     * @var array Параметры заказа/запроса
     */
    public $order = [];

    /**
     * Product constructor.
     * @param string|null $name Название товара
     * @param int|null $count Количество товара
     * @param int|null $sum Сумма за единицу товара
     * @param string $code Код продукта
     */
    public function __construct(string $name = null,
                                int $count = null,
                                int $sum = null,
                                string $code = '0')
    {
        if (!is_null($name)
            && !is_null($count)
            && !is_null($sum))
            $this->add($name, $count, $sum, $code);
    }

    /**
     * @param string $name Название товара
     * @param int $count Количество товара
     * @param int $sum Сумма за единицу товара
     * @param string $code Код продукта
     * @return $this
     */
    public function add(string $name,
                        int $count,
                        int $sum,
                        string $code = '0'): self
    {
        static $products;

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
}
