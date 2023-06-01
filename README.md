# Laravel Array Helpers Extended

A set of static helper methods to check and transform array data.

## Installation

Require this package with composer
composer install ...

This package has been tested with Laravel 10


## Methods

All of the methods in the class are static, just as Laravels own array helper methods are.
As this class extends Laravels Arr helper class, you can use the ArrayHelper in place of the Arr class .

**sharesAnyValues()**

```
use ClaireDv\LaravelArrayHelpers\ArrayHelper;

$array1 = [1, 2, 3];
$array2 = [3, 4, 5];

ArrayHelper::sharesAnyValues(
    $array1, $array2); // returns true
```

**hasOnlyValue()**

```
use ClaireDv\LaravelArrayHelpers\ArrayHelper;

$array1 = ['claire'];

ArrayHelper::hasOnlyValue(
    'claire', $array2); // returns true
```

**isMulti()**

```
use ClaireDv\LaravelArrayHelpers\ArrayHelper;

$array1 = ['one' => ['two']];

ArrayHelper::isMulti($array1); // returns true
```

**arrayToString()**

```
use ClaireDv\LaravelArrayHelpers\ArrayHelper;

    $arrayToConvert = [
        'name' =>  'claire',
        'games' => [
            'discworld, 'broken age'
    ]]

$string  = ArrayHelper::arrayToString($array1);

// 'name: claire, games: discworld, broken age'
```

**replaceBracesWithValues()**

```
use ClaireDv\LaravelArrayHelpers\ArrayHelper;

$stringWithBraces = 'Dear {firstName}, Your order number is {orderNumber}';

$arrayWithValues = ['firstName' => 'Claire', 'orderNumber' => 'AB-1234'];

$string  = ArrayHelper::replaceBracesWithValues($array1);

// 'Dear Claire, Your order number is AB-1234'
```


## Tests
Includes PHPUnit test suite.

To run the tests from the root of the project in the terminal: ```./vendor/bin/phpunit```
