<?php

declare(strict_types=1);

namespace VirComTest\TypesValidator;

use ArrayIterator;
use PHPUnit\Framework\TestCase;
use stdClass;
use VirCom\TypesValidator\Exception\InvalidArgumentTypeException;
use VirCom\TypesValidator\NumberValidator;

class NumberValidatorTest extends TestCase
{
    private NumberValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new NumberValidator();
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsMinInteger(): void
    {
        $this->assertNull(
            $this->validator->validate(PHP_INT_MIN)
        );
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsIntegerZero(): void
    {
        $this->assertNull(
            $this->validator->validate(0)
        );
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsMaxinteger(): void
    {
        $this->assertNull(
            $this->validator->validate(PHP_INT_MAX)
        );
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsMinFloat(): void
    {
        $this->assertNull(
            $this->validator->validate(PHP_FLOAT_MIN)
        );
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsFloatZero(): void
    {
        $this->assertNull(
            $this->validator->validate(0.0)
        );
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsMaxFloat(): void
    {
        $this->assertNull(
            $this->validator->validate(PHP_FLOAT_MAX)
        );
    }

    public function invalidArgumentsDataProvider(): array
    {
        return [
            [true],
            [false],
            [[]],
            [[new NumberValidator(), 'validate']],
            ['substr'],
            [new ArrayIterator()],
            [null],
            [new stdClass()],
            [fopen('php://temp', 'r')],
            [''],
            ['test string'],
        ];
    }

    /**
     * @dataProvider invalidArgumentsDataProvider
     */
    public function testThatValidatorThrowsInvalidArgumentTypeExceptionWhenArgumentIsNotANumber(
        $argument
    ): void {
        $this->expectException(InvalidArgumentTypeException::class);

        $this->validator->validate($argument);
    }
}
