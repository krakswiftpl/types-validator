<?php

declare(strict_types=1);

namespace VirCom\TypesValidator;

interface ValidatorInterface
{
    public function validate($value): void;
}
