<?php

declare(strict_types=1);

namespace VirCom\TypesValidator;

use VirCom\TypesValidator\Exception\InvalidArgumentTypeException;

class IterableValidator extends AbstractValidator
{
    public function __construct()
    {
        parent::__construct([
            'iterable',
        ]);
    }

    /**
     * @throws InvalidArgumentTypeException
     */
    public function validate($value): void
    {
        if (is_callable($value) || ! is_iterable($value)) {
            throw new InvalidArgumentTypeException(
                $this->getFormattedExceptionMessageText($value)
            );
        }
    }
}
