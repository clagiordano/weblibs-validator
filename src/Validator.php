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

    public function getRules()
    {
        return $this->validatorRules;
    }

    public function setMessages(array $validatorMessages = [])
    {
        $this->validatorMessages = $validatorMessages;
    }

    public function getMessages()
    {
        return $this->validatorMessages;
    }

    public function doCheck(array $dataArray)
    {
        $this->dataArray = $dataArray;

        foreach ($this->dataArray as $field => $value) {
            /**
             * If field has rules defined, do validation
             */
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
            if (!isset(ValidatorConfig::$allowedValidator[$rule])) {
                throw new \InvalidArgumentException(
                    __METHOD__ . ": Ivalid validator rule '{$rule}' for field '{$field}'"
                );
            }

            $validatorFunction = 'validate' . ValidatorConfig::$allowedValidator[$rule];
            if (!is_callable([$this, $validatorFunction])) {
                throw new \InvalidArgumentException(
                    __METHOD__ . ": Ivalid validator rule '{$rule}' for field '{$field}'"
                );
            }

            if (!call_user_func_array(
                [
                    $this,
                    $validatorFunction
                ],
                [
                    $field,
                    $value,
                    $satisfier
                ]
            )) {
                echo "validation failed\n";
            }
        }
    }

    protected function validateRequired($field, $value, $satisfier)
    {
        unset($field);
        unset($satisfier);

        return !empty(trim($value));
    }

    protected function validateMinlenght($field, $value, $satisfier)
    {
        unset($field);

        return mb_strlen($value) >= $satisfier;
    }

    protected function validateMaxlenght($field, $value, $satisfier)
    {
        unset($field);

        return mb_strlen($value) <= $satisfier;
    }

    protected function validateEmail($field, $value, $satisfier)
    {
        unset($field);
        unset($satisfier);

        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    protected function validateAlphanumeric($field, $value, $satisfier)
    {
        unset($field);
        unset($satisfier);

        return ctype_alnum($value);
    }

    protected function validateMatch($field, $value, $satisfier)
    {
        unset($field);

        return ($value === $this->dataArray[$satisfier]);
    }

    protected function validateRegexp($field, $value, $satisfier)
    {
        unset($field);
        
        return preg_match("/{$satisfier}/", $value);
    }
}
