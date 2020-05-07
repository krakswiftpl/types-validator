<?php

declare(strict_types=1);

namespace VirCom\TypesValidator;

class NumberValidator extends ScalarAbstractValidator
{
    public function __construct()
    {
        parent::__construct([
            'integer',
            'double',
        ]);
    }
}
