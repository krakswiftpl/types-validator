<?php

declare(strict_types=1);

namespace VirComTest\TypesValidator;

use ArrayIterator;
use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestCase;
use stdClass;
use VirCom\TypesValidator\ClassValidator;
use VirCom\TypesValidator\Exception\InvalidArgumentTypeException;

class ClassValidatorTest extends TestCase
{
    private ClassValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new ClassValidator(
            ClassValidator::class,
            TestCase::class,
            Test::class,
        );
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsValidClass(): void
    {
        $this->assertNull(
            $this->validator->validate($this->validator)
        );
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsValidSubClass(): void
    {
        $this->assertNull(
            $this->validator->validate($this->validator)
        );
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsValidInterface(): void
    {
        $this->assertNull(
            $this->validator->validate($this->validator)
        );
    }

    public function invalidArgumentsDataProvider(): array
    {
        return [
            [true],
            [false],
            [[]],
            [[new ClassValidator(), 'validate']],
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
    public function testThatValidatorThrowsInvalidArgumentTypeExceptionWhenArgumentIsNotAnAllowedClass(
        $argument
    ): void {
        $this->expectException(InvalidArgumentTypeException::class);

        $this->validator->validate($argument);
    }
}
