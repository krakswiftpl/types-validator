<?php

declare(strict_types=1);

namespace VirComTest\TypesValidator;

use ArrayIterator;
use PHPUnit\Framework\TestCase;
use stdClass;
use VirCom\TypesValidator\Exception\InvalidArgumentTypeException;
use VirCom\TypesValidator\ObjectValidator;

class ObjectValidatorTest extends TestCase
{
    private ObjectValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new ObjectValidator();
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsObject(): void
    {
        $this->assertNull(
            $this->validator->validate(new stdClass())
        );
    }

    public function invalidArgumentsDataProvider(): array
    {
        return [
            [true],
            [false],
            [[]],
            [[new ObjectValidator(), 'validate']],
            ['substr'],
            [PHP_FLOAT_MIN],
            [0.0],
            [PHP_FLOAT_MAX],
            [PHP_INT_MIN],
            [0],
            [PHP_INT_MAX],
            [new ArrayIterator()],
            [null],
            [fopen('php://temp', 'r')],
            [''],
            ['test string'],
        ];
    }

    /**
     * @dataProvider invalidArgumentsDataProvider
     */
    public function testThatValidatorThrowsInvalidArgumentTypeExceptionWhenArgumentIsNotAnObject(
        $argument
    ): void {
        $this->expectException(InvalidArgumentTypeException::class);

        $this->validator->validate($argument);
    }
}
