<?php

namespace clagiordano\weblibs\validator\tests;

use clagiordano\weblibs\validator\ErrorHandler;

/**
 * Class ErrorHandlerTest
 * @package clagiordano\weblibs\validator\tests
 */
class ErrorHandlerTest extends \PHPUnit_Framework_TestCase
{
    /** ErrorHandler $errorHandler */
    private $errorHandler = null;

    public function setUp()
    {
        $this->errorHandler = new ErrorHandler();
        $this->assertInstanceOf(
            'clagiordano\weblibs\validator\ErrorHandler',
            $this->errorHandler
        );
    }

    public function testAddErrorSimple()
    {
        $this->assertFalse($this->errorHandler->hasErrors());

        $this->errorHandler->addError('test error message');

        $this->assertTrue($this->errorHandler->hasErrors());
    }

    public function testAddErrorForField()
    {
        $this->assertFalse($this->errorHandler->hasErrors());

        $this->errorHandler->addError('test error message for field', 'test_field');

        $this->assertTrue($this->errorHandler->hasErrors());
        $this->assertTrue($this->errorHandler->hasErrors('test_field'));
        $this->assertTrue($this->errorHandler->hasErrors('invalid_field'));
    }

    public function testGetErrors()
    {
        $this->assertFalse($this->errorHandler->hasErrors());
        $this->assertInternalType('array', $this->errorHandler->getErrors());
        $this->assertEquals(
            [],
            $this->errorHandler->getErrors()
        );

        $this->errorHandler->addError('test error message for field', 'test_field');
        $this->errorHandler->addError('test error message for another field', 'another_field');

        $this->assertTrue($this->errorHandler->hasErrors());

        $this->assertInternalType('array', $this->errorHandler->getErrors());

        $this->assertInternalType('array', $this->errorHandler->getErrors('test_field'));
    }

    public function testGetFirstError()
    {
        $this->assertFalse($this->errorHandler->hasErrors());
        $this->assertInternalType('array', $this->errorHandler->getErrors());
        $this->assertEquals(
            [],
            $this->errorHandler->getErrors()
        );

        $this->errorHandler->addError('test error message for field', 'test_field');
        $this->errorHandler->addError('test error message for another field', 'another_field');

        $this->assertTrue($this->errorHandler->hasErrors());

        $this->assertInternalType('string', $this->errorHandler->getFirst('test_field'));
    }
}
