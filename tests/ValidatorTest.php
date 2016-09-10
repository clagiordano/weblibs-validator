<?php

namespace clagiordano\weblibs\validator\tests;


/**
 * Class ValidatorTest
 * @package clagiordano\weblibs\validator\tests
 */
class ValidatorTest extends \PHPUnit_Framework_TestCase
{
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

    /** @var array $testData */
    private $testData = [

    ];

    public function setUp()
    {


        /**
         * Create a new validator object
         **/
        $this->validator = new Application();
    }
}