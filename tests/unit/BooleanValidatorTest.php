<?php

declare(strict_types=1);

namespace VirComTest\TypesValidator;

use ArrayIterator;
use PHPUnit\Framework\TestCase;
use stdClass;
use VirCom\TypesValidator\BooleanValidator;
use VirCom\TypesValidator\Exception\InvalidArgumentTypeException;

class BooleanValidatorTest extends TestCase
{
    private BooleanValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new BooleanValidator();
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsTrue(): void
    {
        $this->assertNull(
            $this->validator->validate(true)
        );
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsFalse(): void
    {
        $this->assertNull(
            $this->validator->validate(false)
        );
    }

    public function invalidArgumentsDataProvider(): array
    {
        return [
            [[]],
            [[new BooleanValidator(), 'validate']],
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
            [''],
            ['test string'],
        ];
    }

    /**
     * @dataProvider invalidArgumentsDataProvider
     */
    public function testThatValidatorThrowsInvalidArgumentTypeExceptionWhenArgumentIsNotABoolean(
        $argument
    ): void {
        $this->expectException(InvalidArgumentTypeException::class);

        $this->validator->validate($argument);
    }
}
