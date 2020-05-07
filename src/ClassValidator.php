<?php

declare(strict_types=1);

namespace VirCom\TypesValidator;

use VirCom\TypesValidator\Exception\InvalidArgumentTypeException;

class ClassValidator extends AbstractValidator
{
    public function __construct(
        string ...$allowedArgumentTypes
    ) {
        parent::__construct($allowedArgumentTypes);
    }

    /**
     * @throws InvalidArgumentTypeException
     */
    public function validate($value): void
    {
        if (! is_object($value)) {
            throw new InvalidArgumentTypeException(
                $this->getFormattedExceptionMessageText($value)
            );
        }

        foreach ($this->allowedArgumentTypes as $allowedArgumentType) {
            if (is_a($value, $allowedArgumentType)) {
                return;
            }
        }

        throw new InvalidArgumentTypeException(
            $this->getFormattedExceptionMessageText($value)
        );
    }
}
