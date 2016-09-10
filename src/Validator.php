<?php

namespace clagiordano\weblibs\validator;

use ErrorHandler;

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
}