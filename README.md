# 777score.ru - Парсер
<h1>Примеры</h1>

## Получить доступные категории по дате

```php
$parser = new \San4ezZ\Parser777\Parser();

/*date in dd-mm-yyyy format*/
var_dump( $parser->getCountry('14-04-2021'));
```

## Получение матчей в выбраной категории по дате

```php
$parser = new \San4ezZ\Parser777\Parser();

$countries = [
    'Россия. Молодежное первенство',
    'Бразилия. Кубок Бразилии'
];

$date = '14-04-2021';

var_dump($parser->getAllMatches($countries, $date));
```

## Информация об одном матче по ссылке

```php
$parser = new \San4ezZ\Parser777\Parser();


$link = 'football/matches/ural-youth-dinamo-moscow-youth-2021-04-14';

var_dump($parser->getMatch($link));
```

## Установка

[Composer](https://getcomposer.org/).

```bash
composer require san4ezz_89/777parser
```

<hr>

## License

Free for commercial and non-commercial use under the [Apache 2.0](http://www.apache.org/licenses/LICENSE-2.0.html)
or [GPL 2.0](http://www.gnu.org/licenses/gpl-2.0.html) licenses.