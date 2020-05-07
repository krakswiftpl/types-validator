<?php

declare(strict_types=1);

namespace VirCom\TypesValidator;

use VirCom\TypesValidator\Exception\InvalidArgumentTypeException;

class ResourceValidator extends AbstractValidator
{
    public function __construct()
    {
        parent::__construct([
            'resource',
        ]);
    }

    /**
     * @throws InvalidArgumentTypeException
     */
    public function validate($value): void
    {
        if (! is_resource($value)) {
            throw new InvalidArgumentTypeException(
                $this->getFormattedExceptionMessageText($value)
            );
        }
    }
}
