<?php

declare(strict_types=1);

namespace VirCom\TypesValidator;

class IntegerValidator extends ScalarAbstractValidator
{
    public function __construct()
    {
        parent::__construct([
            'integer',
        ]);
    }
}
