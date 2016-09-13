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
        'test_alphanumeric' => [
            'required' => true,
            'alnum' => true
        ],
        'password_confirm' => [
            'required' => true,
            'minlenght' => 3,
            'match' => 'password'
        ],
        'test_regexp' => [
            'required' => true,
            'regexp' => '^(\w+)$'
        ]
    ];

    /** @var array $messages */
    private $messages = [

    ];

    /** @var array $testData */
    private $testDataEmpty = [
        'username' => null,
        'email' => null,
        'password' => null,
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

    /**
     * @group invalid
     */
    public function testInvalidRuleset()
    {
        $invalidRules = $this->ruleSet;
        $invalidRules['username']['invalidrule'] = 'test';
        $this->validator->setRules($invalidRules);
        $this->assertEquals(
            $invalidRules,
            $this->validator->getRules()
        );

        $this->setExpectedException('\InvalidArgumentException');
        $this->validator->doCheck($this->testDataEmpty);
    }

    public function testCheck()
    {
        $this->validator->doCheck($this->testDataEmpty);
    }

    /**
     * @group validator
     * @group alnum
     */
    public function testAlnum()
    {
        $testData = [
            'test_alphanumeric' => 'abc123',
        ];

        $this->validator->doCheck($testData);
        //var_dump($this->validator->doCheck($testData));
    }

    /**
     * @group validator
     * @group match
     */
    public function testMatch()
    {
        $testData = [
            'password' => '12345',
            'password_confirm' => '12345',
        ];

        var_dump($this->validator->doCheck($testData));
    }

    /**
     * @group validator
     * @group regexp
     */
    public function testRegexp()
    {
        $testData = [
            'test_regexp' => 'singleWord'
        ];

        $this->validator->doCheck($testData);
        //$this->assertTrue($this->validator->doCheck($testData));

        $testData = [
            'test_regexp' => 'Two Words'
        ];

        $this->validator->doCheck($testData);
        //$this->assertFalse($this->validator->doCheck($testData));
    }

    public function testInvalidValidator()
    {
        $ruleSet = [
            'test_field' => [
                'invalid_validator' => true
            ]
        ];

        $testData = [
            'test_field' => 'test value'
        ];

        $this->validator->setRules($ruleSet);
        $this->assertEquals($ruleSet, $this->validator->getRules());

        $this->setExpectedException('\InvalidArgumentException');
        $this->validator->doCheck($testData);
    }
}
