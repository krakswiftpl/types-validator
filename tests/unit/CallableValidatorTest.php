<?php

declare(strict_types=1);

namespace VirComTest\TypesValidator;

use ArrayIterator;
use PHPUnit\Framework\TestCase;
use stdClass;
use VirCom\TypesValidator\CallableValidator;
use VirCom\TypesValidator\Exception\InvalidArgumentTypeException;

class CallableValidatorTest extends TestCase
{
    private CallableValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new CallableValidator();
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsCallableArray(): void
    {
        $this->assertNull(
            $this->validator->validate([new CallableValidator(), 'validate'])
        );
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsCallableString(): void
    {
        $this->assertNull(
            $this->validator->validate('substr')
        );
    }

    public function invalidArgumentsDataProvider(): array
    {
        return [
            [true],
            [false],
            [[]],
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
            [''],
            ['test string'],
        ];
    }

    /**
     * @dataProvider invalidArgumentsDataProvider
     */
    public function testThatValidatorThrowsInvalidArgumentTypeExceptionWhenArgumentIsNotACallable(
        $argument
    ): void {
        $this->expectException(InvalidArgumentTypeException::class);

        $this->validator->validate($argument);
    }
}
