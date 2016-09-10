<?php

namespace clagiordano\weblibs\validator\tests;

use clagiordano\weblibs\validator\ErrorHandler;
use clagiordano\weblibs\validator\Validator;

/**
 * Class ValidatorTest
 * @package clagiordano\weblibs\validator\tests
 */
class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var ErrorHandler $errorhandler */
    private $errorHandler = null;
    /** @var Validator $validator */
    private $validator = null;

    /** @var array $ruleSet */
    private $ruleSet = [
        'username' => [
            'required' => true,
            'maxlenght' => 20,
            'minlenght' => 3
        ],
        'email' => [
            'required' => true,
            'maxlenght' => 255,
            'email' => true
        ],
        'password' => [
            'required' => true,
            'minlenght' => 3
        ],
    ];

    /** @var array $messages */
    private $messages = [

    ];

    /** @var array $testData */
    private $testData = [

    ];

    public function setUp()
    {

        /**
         * Create a new errorhandler object
         **/
         $this->errorHandler = new ErrorHandler();
         $this->assertInstanceOf(
             'clagiordano\weblibs\validator\ErrorHandler', 
             $this->errorHandler
         );

        /**
         * Create a new validator object
         **/
        $this->validator = new Validator($this->errorHandler);
        $this->assertInstanceOf(
             'clagiordano\weblibs\validator\Validator', 
             $this->validator
         );

         $this->validator->setRules($this->ruleSet);
         $this->assertEquals(
             $this->ruleSet,
             $this->validator->getRules()
         );

         $this->validator->setMessages($this->messages);
         $this->assertEquals(
             $this->messages,
             $this->validator->getMessages()
         );
    }

    public function testTest()
    {
        
    }
}