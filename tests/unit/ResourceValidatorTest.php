<?php

declare(strict_types=1);

namespace VirComTest\TypesValidator;

use ArrayIterator;
use PHPUnit\Framework\TestCase;
use stdClass;
use VirCom\TypesValidator\Exception\InvalidArgumentTypeException;
use VirCom\TypesValidator\ResourceValidator;

class ResourceValidatorTest extends TestCase
{
    private ResourceValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new ResourceValidator();
    }

    public function testThatValidatorNotThrowsInvalidArgumentTypeExceptionWhenArgumentIsResource(): void
    {
        $this->assertNull(
            $this->validator->validate(fopen('php://temp', 'r'))
        );
    }

    public function invalidArgumentsDataProvider(): array
    {
        return [
            [true],
            [false],
            [[]],
            [[new ResourceValidator(), 'validate']],
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
            [''],
            ['test string'],
        ];
    }

    /**
     * @dataProvider invalidArgumentsDataProvider
     */
    public function testThatValidatorThrowsInvalidArgumentTypeExceptionWhenArgumentIsNotAResource(
        $argument
    ): void {
        $this->expectException(InvalidArgumentTypeException::class);

        $this->validator->validate($argument);
    }
}
