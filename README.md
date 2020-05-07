# vircom/types-validator
-----

[![Build Status](https://travis-ci.org/vircom/types-validator.svg?branch=master)](https://travis-ci.org/vircom/types-validator)
[![Coverage Status](https://coveralls.io/repos/github/vircom/types-validator/badge.svg)](https://coveralls.io/github/vircom/types-validator)
[![Latest Stable Version](https://poser.pugx.org/vircom/types-validator/v/stable.png)](https://packagist.org/packages/vircom/types-validator)
[![Total Downloads](https://poser.pugx.org/vircom/types-validator/downloads.png)](https://packagist.org/vircom/types-validator)
[![License](https://poser.pugx.org/vircom/types-validator/license.png)](https://packagist.org/packages/vircom/types-validator)

This package provides an implementation to validate method argument types.

# Prerequisites

- PHP 7.4+

# Installation

## Install by composer

To install vircom/types-validator with Composer, run the following command:

```sh
$ composer require vircom/types-validator
```

You can see this library on [Packagist](https://packagist.org/packages/vircom/types-validator).

Composer installs autoloader at `./vendor/autoloader.php`. If you use vircom/http-parser in your php script, add:

```php
require_once 'vendor/autoload.php';
```

# Usage:

## Available validators
### Simple type validators
* `VirCom\TypesValidator\ArrayValidator` - checks is argument is an array type
* `VirCom\TypesValidator\BooleanValidator` - checks is argument is a boolean type
* `VirCom\TypesValidator\CallableValidator` - checks is argument is a callable type
* `VirCom\TypesValidator\FloatValidator` - checks is argument is a float type
* `VirCom\TypesValidator\IntegerValidator` - checks is argument is an integer type
* `VirCom\TypesValidator\IterableValidator` - checks is argument is an iterable type
* `VirCom\TypesValidator\MixedValidator` - nothing to checks :)
* `VirCom\TypesValidator\NullValidator` - checks is argument is a null type
* `VirCom\TypesValidator\NumberValidator` - checks is argument is an integer or a float type
* `VirCom\TypesValidator\ObjectValidator` - checks is argument is an object type
* `VirCom\TypesValidator\ResourceValidator` - checks is argument is a resource type
* `VirCom\TypesValidator\StringValidator` - checks is argument is a string type

**Example:**
```php
use VirCom\TypesValidator\IntegerValidator;
use VirCom\TypesValidator\Exception\InvalidArgumentTypeException;

$valueToCheck = ...;

$validator = new IntegerValidator();
try {
    $validator->validate($valueToCheck);
} catch (InvalidArgumentTypeException $exception)
    // ...
}
```

### Class type validator
Checks is argument is:
* instance of class
* instance of class that extends subclass
* instance of class that implements interface

**Example:**
```php
use VirCom\TypesValidator\ClassValidator;
use VirCom\TypesValidator\Exception\InvalidArgumentTypeException;

interface I {}
interface II extends I {}
class A implements II {}
class B extends A {}
class C {}

$valueToCheck = new B();
$validator = new ClassValidator(
    I::class,
    C::class
);

try {
    $validator->validate($valueToCheck);
} catch (InvalidArgumentTypeException $exception)
    // ...
}

```

# About


## Submitting bugs and feature requests

Bugs and feature request are tracked on [GitHub](https://github.com/vircom/types-validator/issues)

## License

Monolog is licensed under the MIT License - see the `LICENSE` file for details