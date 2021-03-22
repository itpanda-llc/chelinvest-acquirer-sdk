# Chelinvest-Acquirer-PHP-SDK

Библиотека для интеграции с процессинговым центром [ПАО "Челябинвестбанк"](https://chelinvest.ru)

[![Packagist Downloads](https://img.shields.io/packagist/dt/itpanda-llc/chelinvest-acquirer-sdk)](https://packagist.org/packages/itpanda-llc/chelinvest-acquirer-sdk/stats)
![Packagist License](https://img.shields.io/packagist/l/itpanda-llc/chelinvest-acquirer-sdk)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/itpanda-llc/chelinvest-acquirer-sdk)

## Ссылки

* [Разработка](https://github.com/itpanda-llc)
* [О проекте (Челябинвестбанк)](https://chelinvest.ru)
* [Документация (API Челябинвестбанк)](https://mpi.chelinvest.ru/gorodUnified/documentation/inf/MPI/MPI)

## Возможности

* Запрос регистрации заказа
* Переход на страницу оплаты
* Запрос оплаты заказа
* Запрос состояния заказа
* Запрос состояния заказа расширенный

## Требования

* PHP >= 7.2
* cURL
* JSON

## Установка

```shell script
composer require itpanda-llc/chelinvest-acquirer-sdk
```

## Подключение

```php
require_once 'vendor/autoload.php';
```

## Использование

### Создание сервиса / Аутентификация

```php
use Panda\Chelinvest\AcquirerSdk;

/*
 * Логин
 * Пароль
 */
$acquirer = new AcquirerSdk\Acquirer('userName', 'password');
```

### Запрос регистрации заказа

Создание списка товаров

* Создание списка

```php
use Panda\Chelinvest\AcquirerSdk;

/*
 * Название товара
 * Количество товара
 * Сумма за единицу товара
 * Код продукта
 */
$product = new AcquirerSdk\Product('Кабель силовой ВВГнг(А)-LS 2х1,5пл, м', 15, 3850, '18670900');

// или

/*
 * Название товара
 * Количество товара
 * Сумма за единицу товара
 * Код продукта
 */
$product = AcquirerSdk\RegisterCommon::newProduct('Кабель силовой ВВГнг(А)-LS 2х1,5пл, м', 15, 3850, '18670900');

// или

/*
 * Название товара
 * Количество товара
 * Сумма за единицу товара
 * Код продукта
 */
$product = $acquirer->newProduct('Кабель силовой ВВГнг(А)-LS 2х1,5пл, м', 15, 3850, '18670900');
```

* Установка параметров

```php
/*
 * Название товара
 * Количество товара
 * Сумма за единицу товара
 * Код продукта
 */
$product->add('Кабель силовой ВВГнг(А)-LS 2х1,5пл, м', 15, 3850, '18670900')
    ->add('Провод ПВС 3х2,5, м', 17, 5415, '19470907')
    ->add('Саморез по дереву 4.2x76 мм, кг', 1, 16300)
    ->add('Саморез гипсокартон-дерево 4.2x90 мм, кг', 2, 29700);
```

Способ №1

* Создание запроса

```php
use Panda\Chelinvest\AcquirerSdk;

/*
 * Адрес перенаправления после оплаты
 * Список товаров
 */
$registerCommon = new AcquirerSdk\RegisterCommon('https://chelinvest.ru', $product);
```

* Установка параметров

```php
use Panda\Chelinvest\AcquirerSdk;

// Номер заказа в системе магазина
$registerCommon->setOrderNumber('20016551')

    // Описание заказа
    ->setDescription('Оплата заказа #20016551')
    
    /*
     * Название товара
     * Количество товара
     * Сумма за единицу товара
     * Код продукта
     */
    ->addProduct('Кабель силовой ВВГнг(А)-LS 2х1,5пл, м', 15, 3850, '18670900')
    ->addProduct('Провод ПВС 3х2,5, м', 17, 5415, '19470907')
    ->addProduct('Саморез по дереву 4.2x76 мм, кг', 1, 16300)
    ->addProduct('Саморез гипсокартон-дерево 4.2x90 мм, кг', 2, 29700)

    // Идентификатор клиента
    ->setClientId('clientId')

    // Флаг для открытия платежной страницы во фрейме
    ->setIframe(AcquirerSdk\Iframe::FLAG);
```

* Выполнение запроса

```php
use Panda\Chelinvest\AcquirerSdk;

try {
    print_r($acquirer->request($registerCommon));
} catch (AcquirerSdk\Exception\ClientException $e) {
    echo $e->getMessage();
}
```

Способ №2

```php
use Panda\Chelinvest\AcquirerSdk;

try {
    /*
     * Адрес перенаправления после оплаты
     * Список товаров
     */
    print_r($acquirer->registerCommon('https://chelinvest.ru', $product));
} catch (AcquirerSdk\Exception\ClientException $e) {
    echo $e->getMessage();
}
```

### Переход на страницу оплаты

```php
use Panda\Chelinvest\AcquirerSdk;

/*
 * Номер заказа в системе
 * Адрес почты
 */
print_r(AcquirerSdk\PaymentPage::get('09184470-0054-2910-2002-029501921683', 'info@chelinvest.ru'));

// или

/*
 * Номер заказа в системе
 * Адрес почты
 */
print_r(AcquirerSdk\Payment::getPage('09184470-0054-2910-2002-029501921683', 'info@chelinvest.ru'));

// или

/*
 * Номер заказа в системе
 * Адрес почты
 */
print_r($acquirer->getPaymentPage('09184470-0054-2910-2002-029501921683', 'info@chelinvest.ru'));
```

### Запрос оплаты заказа

Создание карты оплаты

```php
use Panda\Chelinvest\AcquirerSdk;

/*
 * Номер карты
 * Месяц истечения срока действия карты
 * Год истечения срока действия карты
 * Имя держателя карты
 * CVV2 / CVC2 / ППК2
 */
$card = new AcquirerSdk\Card('5412792043768301', '08', '2022', 'TEST', '944');

// или

/*
 * Номер карты
 * Месяц истечения срока действия карты
 * Год истечения срока действия карты
 * Имя держателя карты
 * CVV2 / CVC2 / ППК2
 */
$card = AcquirerSdk\Payment::newCard('5412792043768301', '08', '2022', 'TEST', '944');

// или

/*
 * Номер карты
 * Месяц истечения срока действия карты
 * Год истечения срока действия карты
 * Имя держателя карты
 * CVV2 / CVC2 / ППК2
 */
$card = $acquirer->newCard('5412792043768301', '08', '2022', 'TEST', '944');
```

Способ №1

* Создание запроса

```php
use Panda\Chelinvest\AcquirerSdk;

/*
 * Номер заказа в системе
 * Карта оплаты
 */
$payment = new AcquirerSdk\Payment('09184470-0054-2910-2002-029501921683', $card);
```

* Установка параметров

```php
/*
 * Номер карты
 * Месяц истечения срока действия карты
 * Год истечения срока действия карты
 * Имя держателя карты
 * CVV2 / CVC2 / ППК2
 */
$payment->setCard('5412792043768301', '08', '2022', 'TEST', '944');
```

* Выполнение запроса

```php
use Panda\Chelinvest\AcquirerSdk;

try {
    print_r($acquirer->request($payment));
} catch (AcquirerSdk\Exception\ClientException $e) {
    echo $e->getMessage();
}
```

Способ №2

```php
use Panda\Chelinvest\AcquirerSdk;

try {
    /*
     * Номер заказа в системе
     * Карта оплаты
     */
    print_r($acquirer->payment('09184470-0054-2910-2002-029501921683', $card));
} catch (AcquirerSdk\Exception\ClientException $e) {
    echo $e->getMessage();
}
```

### Запрос состояния заказа

Способ №1

* Создание запроса

```php
use Panda\Chelinvest\AcquirerSdk;

// Номер заказа в системе
$statusShort = new AcquirerSdk\StatusShort('09184470-0054-2910-2002-029501921683');
```

* Выполнение запроса

```php
use Panda\Chelinvest\AcquirerSdk;

try {
    print_r($acquirer->request($statusShort));
} catch (AcquirerSdk\Exception\ClientException $e) {
    echo $e->getMessage();
}
```

Способ №2

```php
use Panda\Chelinvest\AcquirerSdk;

try {
    // Номер заказа в системе
    print_r($acquirer->getStatusShort('09184470-0054-2910-2002-029501921683'));
} catch (AcquirerSdk\Exception\ClientException $e) {
    echo $e->getMessage();
}
```

### Запрос состояния заказа расширенный

Способ №1

* Создание запроса

```php
use Panda\Chelinvest\AcquirerSdk;

// Номер заказа в системе
$status = new AcquirerSdk\Status('09184470-0054-2910-2002-029501921683');
```

* Выполнение запроса

```php
use Panda\Chelinvest\AcquirerSdk;

try {
    print_r($acquirer->request($status));
} catch (AcquirerSdk\Exception\ClientException $e) {
    echo $e->getMessage();
}
```

Способ №2

```php
use Panda\Chelinvest\AcquirerSdk;

try {
    // Номер заказа в системе
    print_r($acquirer->getStatus('09184470-0054-2910-2002-029501921683'));
} catch (AcquirerSdk\Exception\ClientException $e) {
    echo $e->getMessage();
}
```
