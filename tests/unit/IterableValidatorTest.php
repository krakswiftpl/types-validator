<?php

declare(strict_types=1);

namespace VirComTest\TypesValidator;

use ArrayIterator;
use PHPUnit\Framework\TestCase;
use stdClass;
use VirCom\TypesValidator\Exception\InvalidArgumentTypeException;
use VirCom\TypesValidator\IterableValidator;

class IterableValidatorTest extends TestCase
{
    private IterableValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new IterableValidator();
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsIterable(): void
    {
        $this->assertNull(
            $this->validator->validate(new ArrayIterator())
        );
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsArray(): void
    {
        $this->assertNull(
            $this->validator->validate([])
        );
    }

    public function invalidArgumentsDataProvider(): array
    {
        return [
            [true],
            [false],
            [[new IterableValidator(), 'validate']],
            ['substr'],
            [PHP_FLOAT_MIN],
            [0.0],
            [PHP_FLOAT_MAX],
            [PHP_INT_MIN],
            [0],
            [PHP_INT_MAX],
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
    public function testThatValidatorThrowsInvalidArgumentTypeExceptionWhenArgumentIsNotAnIterable(
        $argument
    ): void {
        $this->expectException(InvalidArgumentTypeException::class);

        $this->validator->validate($argument);
    }
}
