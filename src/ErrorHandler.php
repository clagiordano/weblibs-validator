<?php

namespace clagiordano\weblibs\validator;

/**
 *
 */
class ErrorHandler
{
    private $errorsList = [];

    public function addError($message, $key = null)
    {
        if (is_null($key)) {
            $this->errorsList[] = $message;
            return;
        }
     
        $this->errorsList[$key][] = $message;
    }

    public function getErrors($key = null)
    {
        if (isset($this->errorsList[$key])) {
            return $this->errorsList[$key];
        }

        return $this->errorsList;
    }

    public function hasErrors($key = null)
    {
        return count($this->getErrors($key)) ? true : false;
    }

    public function getFirst($key = null)
    {
        $error = null;
        if ($this->hasErrors($key)) {
            $error = $this->getErrors($key)[0];
        }

        return $error;
    }
}
