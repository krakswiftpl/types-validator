<?php

declare(strict_types=1);

namespace VirCom\TypesValidator;

class ScalarValidator extends ScalarAbstractValidator
{
    public function __construct()
    {
        parent::__construct([
            'boolean',
            'integer',
            'double',
            'string',
        ]);
    }
}
