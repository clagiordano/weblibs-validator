<?php

namespace clagiordano\weblibs\validator;

use clagiordano\weblibs\validator\ErrorHandler;

/**
 *
 */
class Validator
{
    /** @var ErrorHandler $errorHandler */
    protected $errorHandler = null;
    /** @var array $validatorRules */
    protected $validatorRules = [];
    /** @var array $validatorMessages */
    protected $validatorMessages = [];
    /** @var array $dataArray */
    protected $dataArray = [];

    public function __construct(ErrorHandler $errorHandler)
    {
        $this->errorHandler = $errorHandler;
    }

    public function setRules(array $validatorRules = [])
    {
        $this->validatorRules = $validatorRules;
    }

    public function setMessages(array $validatorMessages = [])
    {
        $this->validatorMessages = $validatorMessages;
    }

    public function doCheck(array $dataArray)
    {
        $this->dataArray = $dataArray;

        foreach ($this->dataArray as $field => $value) {
            if (isset($this->validatorRules[$field])) {
                $this->doValidate(
                    $field,
                    $value,
                    $this->validatorRules[$field]
                );
            }
        }
    }

    protected function doValidate($field, $value, $rules)
    {
        foreach ($rules as $rule => $satisfier) {
            $validatorFunction = 'validate' . $this->allowedValidator[$rule];

            if (!is_callable($this->{$validatorFunction})) {
                //call_user_func()
            }
        }
    }
}