<?php

declare(strict_types=1);

namespace VirCom\TypesValidator;

use VirCom\TypesValidator\Exception\InvalidArgumentTypeException;

class ArrayValidator extends AbstractValidator
{
    public function __construct()
    {
        parent::__construct([
            'array',
        ]);
    }

    /**
     * @throws InvalidArgumentTypeException
     */
    public function validate($value): void
    {
        if (is_callable($value) || ! is_array($value)) {
            throw new InvalidArgumentTypeException(
                $this->getFormattedExceptionMessageText($value)
            );
        }
    }
}
