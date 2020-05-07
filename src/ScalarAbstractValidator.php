<?php

declare(strict_types=1);

namespace VirCom\TypesValidator;

use VirCom\TypesValidator\Exception\InvalidArgumentTypeException;

abstract class ScalarAbstractValidator extends AbstractValidator
{
    /**
     * @throws InvalidArgumentTypeException
     */
    public function validate($value): void
    {
        if (is_callable($value) || ! in_array(gettype($value), $this->allowedArgumentTypes, true)) {
            throw new InvalidArgumentTypeException(
                $this->getFormattedExceptionMessageText($value)
            );
        }
    }
}
