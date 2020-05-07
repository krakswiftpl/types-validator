<?php

declare(strict_types=1);

namespace VirCom\TypesValidator;

use VirCom\TypesValidator\Exception\InvalidArgumentTypeException;

class CallableValidator extends AbstractValidator
{
    public function __construct()
    {
        parent::__construct([
            'callable',
        ]);
    }

    /**
     * @throws InvalidArgumentTypeException
     */
    public function validate($value): void
    {
        if (! is_callable($value)) {
            throw new InvalidArgumentTypeException(
                $this->getFormattedExceptionMessageText($value)
            );
        }
    }
}
