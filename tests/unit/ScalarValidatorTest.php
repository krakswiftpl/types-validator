<?php

declare(strict_types=1);

namespace VirComTest\TypesValidator;

use ArrayIterator;
use PHPUnit\Framework\TestCase;
use stdClass;
use VirCom\TypesValidator\Exception\InvalidArgumentTypeException;
use VirCom\TypesValidator\ScalarValidator;

class ScalarValidatorTest extends TestCase
{
    private ScalarValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new ScalarValidator();
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsBooleanTrue(): void
    {
        $this->assertNull(
            $this->validator->validate(true)
        );
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsBooleanFalse(): void
    {
        $this->assertNull(
            $this->validator->validate(false)
        );
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

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsEmptyString(): void
    {
        $this->assertNull(
            $this->validator->validate('')
        );
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsNotEmptyString(): void
    {
        $this->assertNull(
            $this->validator->validate('examoke value')
        );
    }

    public function invalidArgumentsDataProvider(): array
    {
        return [
            [[]],
            [[new ScalarValidator(), 'validate']],
            ['substr'],
            [new ArrayIterator()],
            [null],
            [new stdClass()],
            [fopen('php://temp', 'r')],
        ];
    }

    /**
     * @dataProvider invalidArgumentsDataProvider
     */
    public function testThatValidatorThrowsInvalidArgumentTypeExceptionWhenArgumentIsNotAScalar(
        $argument
    ): void {
        $this->expectException(InvalidArgumentTypeException::class);

        $this->validator->validate($argument);
    }
}
