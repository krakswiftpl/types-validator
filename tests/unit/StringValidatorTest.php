<?php

declare(strict_types=1);

namespace VirComTest\TypesValidator;

use ArrayIterator;
use PHPUnit\Framework\TestCase;
use stdClass;
use VirCom\TypesValidator\Exception\InvalidArgumentTypeException;
use VirCom\TypesValidator\StringValidator;

class StringValidatorTest extends TestCase
{
    private StringValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new StringValidator();
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsEmptyString(): void
    {
        $this->assertNull(
            $this->validator->validate('')
        );
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsAString(): void
    {
        $this->assertNull(
            $this->validator->validate('test string')
        );
    }

    public function invalidArgumentsDataProvider(): array
    {
        return [
            [true],
            [false],
            [[]],
            [[new StringValidator(), 'validate']],
            ['substr'],
            [PHP_FLOAT_MIN],
            [0.0],
            [PHP_FLOAT_MAX],
            [PHP_INT_MIN],
            [0],
            [PHP_INT_MAX],
            [new ArrayIterator()],
            [null],
            [new stdClass()],
            [fopen('php://temp', 'r')],
        ];
    }

    /**
     * @dataProvider invalidArgumentsDataProvider
     */
    public function testThatValidatorThrowsInvalidArgumentTypeExceptionWhenArgumentIsNotAString(
        $argument
    ): void {
        $this->expectException(InvalidArgumentTypeException::class);

        $this->validator->validate($argument);
    }
}
