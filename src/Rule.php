<?php

namespace Rakit\Validation;

abstract class Rule
{
    protected $key;

    protected $attribute;

    protected $validation;

    protected $implicit = false;

    protected $params = [];

    protected $message = "The :attribute is invalid";

    abstract public function check($value, array $params);

    public function setValidation(Validation $validation)
    {
        $this->validation = $validation;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getKey()
    {
        return $this->key ?: get_class($this);
    }

    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
    }

    public function getAttribute()
    {
        return $this->attribute ?: get_class($this);
    }

    public function getParams()
    {
        return $this->params;
    }

    public function setParams(array $params)
    {
        $this->params = $params;
    }

    public function mergeParams(array $params)
    {
        $currentParams = $this->getParams();
        return $params + $currentParams;        
    }

    public function isImplicit()
    {
        return $this->implicit === true;
    }

    public function message($message)
    {
        return $this->setMessage($message);
    }

    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }    

    public function getMessage()
    {
        return $this->message;
    }

    protected function requireParamsCount(array $params, $minCount)
    {
        $count = count($params);
        if ($count < $minCount) {
            $key = $this->getKey() ?: get_class($this);
            throw new \InvalidArgumentException("Rule {$key} requires at least ".$minCount." parameters", 1);
        }        
    }

}