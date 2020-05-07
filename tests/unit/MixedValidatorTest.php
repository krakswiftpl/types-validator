<?php

declare(strict_types=1);

namespace VirComTest\TypesValidator;

use ArrayIterator;
use PHPUnit\Framework\TestCase;
use stdClass;
use VirCom\TypesValidator\MixedValidator;

class MixedValidatorTest extends TestCase
{
    private MixedValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new MixedValidator();
    }

    public function validArgumentsDataProvider(): array
    {
        return [
            [true],
            [false],
            [[]],
            [[new MixedValidator(), 'validate']],
            ['substr'],
            [PHP_INT_MIN],
            [0],
            [PHP_INT_MAX],
            [new ArrayIterator()],
            [null],
            [new stdClass()],
            [fopen('php://temp', 'r')],
            [''],
            ['test string'],
        ];
    }

    /**
     * @dataProvider validArgumentsDataProvider
     */
    public function testThatValidatorNotThrowsInvalidArgumentTypeException(
        $argument
    ): void {
        $this->assertNull(
            $this->validator->validate($argument)
        );
    }
}
