<?php

declare(strict_types=1);

namespace VirCom\TypesValidator;

abstract class AbstractValidator implements ValidatorInterface
{
    /**
     * @var string[]
     */
    protected $allowedArgumentTypes = [];

    protected function __construct(
        array $allowedArgumentTypes
    ) {
        $this->allowedArgumentTypes = $allowedArgumentTypes;
    }

    protected function getFormattedExceptionMessageText(
        $value
    ): string {
        $type = 'unknown';

        if (is_resource($value)) {
            $type = 'resource';
        } elseif (is_callable($value)) {
            $type = 'callable';
        } elseif (is_array($value)) {
            $type = 'array';
        } elseif (is_iterable($value)) {
            $type = 'iterable';
        } elseif (is_object($value)) {
            $type = get_class($value);
        } elseif (is_scalar($value)) {
            $type = gettype($value);
        } elseif ($value === null) {
            $type = 'null';
        }

        return sprintf(
            'Passed argument with type: \'%s\' is disallowed. List of allowed types: \'%s\'.',
            $type,
            implode('\',\' ', $this->allowedArgumentTypes)
        );
    }
}
