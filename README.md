# Panda Chelinvest-Acquirer-PHP-SDK

Библиотека для интеграции с процессинговым центром [ПАО "Челябинвестбанка"](https://chelinvest.ru)

[![GitHub license](https://img.shields.io/badge/license-MIT-blue)](LICENSE)

## Разработка

[![](___logo100x120.png)](https://github.com/itpanda-llc)

* [Страница](https://github.com/itpanda-llc)

## О проекте

[![](left.png)](https://chelinvest.ru)

* [Страница](https://chelinvest.ru)
* [Документация](https://mpi.chelinvest.ru/gorodUnified/documentation/doc/start)

## Возможности

* Формирование заказа
* Запрос регистрации заказа в банке
* Формирование адреса страницы оплаты заказа
* Запрос оплаты заказа
* Запрос состояния заказа
* Запрос состояния заказа / Расширенный

## Требования

* PHP >= 7.2
* JSON
* cURL

## Установка

С использованием Composer

```
require itpanda-llc/chelinvest-acquirer-php-sdk
```

С использованием Git

```
clone https://github.com/itpanda-llc/chelinvest-acquirer-php-sdk
```

## Примеры использования

Подключение

```php
// После Composer-установки
require_once 'vendor/autoload.php';

// После Git-установки
require_once 'chelinvest-acquirer-php-sdk/autoload.php';
```
Импортирование

```php
use Panda\Chelinvest\AcquirerSDK\Acquirer;
use Panda\Chelinvest\AcquirerSDK\Register;
use Panda\Chelinvest\AcquirerSDK\Payment;
use Panda\Chelinvest\AcquirerSDK\Process;
use Panda\Chelinvest\AcquirerSDK\State;
use Panda\Chelinvest\AcquirerSDK\Detail;
use Panda\Chelinvest\AcquirerSDK\Exception\ClientException;
```

### Создание сервиса

```php
// Необязательные параметры: "Имя пользователя", "Пароль"
$acquirer = new Acquirer('P000504', 'N80jHq');
```

### Запрос регистрации заказа

```php
// Создание заказа
// Обязательный параметр: "Адрес перехода после оплаты"
// Небязательные параметры: "Номер", "Описание"
$register = new Register('https://chelinvest.ru/', '20016551', 'Оплата заказа');

// Добавление позиций
// Обязательные параметры: "Наименование", "Количество", "Стоимость", "Код товара"
$register->addProduct('Кабель силовой ВВГнг(А)-LS 2х1,5пл, м', 15, 3850, '18670900')
    ->addProduct('Кабель силовой ПВС 3х2,5, м', 17, 5415, '19470907')
    ->addProduct('Саморез по дереву 4.2x76 мм, кг', 1, 16300, '0')
    ->addProduct('Саморез гипсокартон-дерево 4.2x90 мм, кг', 2, 29700, '0');

try {
    // Списком
    // Обязательные параметры: "Наименование", "Количество", "Стоимость", "Код товара"
    $register->addProductList([['Кабель силовой ВВГнг(А)-LS 2х1,5пл, м', 15, 3850, '18670900'],
            ['Кабель силовой ПВС 3х2,5, м', 17, 5415, '19470907']])
        ->addProductList([['Саморез по дереву 4.2x76 мм, кг', 1, 16300, '0'],
            ['Саморез гипсокартон-дерево 4.2x90 мм, кг', 2, 29700, '0']]);
} catch (ClientException $e) {
    echo $e->getMessage();
}

try {
    // Выполнение запроса в банк
    // Обязательный параметр: "Заказ"
    print_r($acquirer->request($register));
} catch (ClientException $e) {
    echo $e->getMessage();
}
```

### Формирование адреса страницы оплаты заказа

```php
// Обязательный параметр: "Номер"
// Необязательный параметр: "Адрес электронной почты"
print_r(Payment::getURL('09184470-0054-2910-2002-029501921683', 'info@chelinvest.ru'));
```

### Запрос оплаты заказа

```php
// Создание заказа
// Обязательный параметр: "Номер"
$process = new Process('09184470-0054-2910-2002-029501921683');

// Добавление карты оплаты
// Обязательные параметры: "PAN-номер", "Месяц" и "Год" истечения срока действия, "Имя владельца", "CVV2/CVC2/ППК2-код"
$process->addCard('5412792043768301', '08', '2022', 'TEST', '944');

// При запросе оплаты заказа, согласно документации,
// параметры аутентификации (логин и пароль) не передаются в запросе,
// следовательно создание сервиса выполняется без параметров
$acquirer = new Acquirer;

try {
    // Выполнение запроса в банк
    // Обязательный параметр: "Заказ"
    print_r($acquirer->request($process));
} catch (ClientException $e) {
    echo $e->getMessage();
}
```

### Запрос состояния заказа

```php
try {     
    // Способ №1
    // Обязательный параметр: "Заказ"
    print_r($acquirer->getState('09184470-0054-2910-2002-029501921683'));
} catch (ClientException $e) {
    echo $e->getMessage();
}

// Способ №2
// Создание заказа
// Обязательный параметр: "Номер"
$state = new State('09184470-0054-2910-2002-029501921683');

try {
    // Выполнение запроса в банк
    // Обязательный параметр: "Заказ"
    print_r($acquirer->request($state));
} catch (ClientException $e) {
    echo $e->getMessage();
}
```

### Запрос состояния заказа / Расширенный

```php
try {     
    // Способ №1
    // Обязательный параметр: "Заказ"
    print_r($acquirer->getDetail('09184470-0054-2910-2002-029501921683'));
} catch (ClientException $e) {
    echo $e->getMessage();
}

// Способ №2
// Создание заказа
// Обязательный параметр: "Номер"
$detail = new Detail('09184470-0054-2910-2002-029501921683');

try {
    // Выполнение запроса в банк
    // Обязательный параметр: "Заказ"
    print_r($acquirer->request($detail));
} catch (ClientException $e) {
    echo $e->getMessage();
}
```
