<?php

namespace Sched\Request;

use Sched\Exception\InvalidParamException;

abstract class AbstractRequest
{
    protected $params = [];

    protected $data = [];

    /**
     * @return string
     */
    abstract public function getApiEndpoint();

    /**
     * @return \Sched\Response\AbstractResponse
     */
    abstract public function getResponseObject();

    /**
     * @param $name
     * @param $value
     * @return $this|null
     * @throws \Sched\Exception\InvalidParamException
     */
    public function __call($name, $value)
    {
        if (substr($name, 0, 3) !== 'set') {
            return null;
        }

        $name = $this->propertyToParam(substr($name, 3));
        if (!in_array($name, $this->params)) {
            throw new InvalidParamException(sprintf('Invalid request parameter "%s"', $name));
        }
        $this->data[$name] = current($value);

        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data = [])
    {
        $this->data = $data;
    }

    /**
     * @param $name
     * @return string
     */
    protected function propertyToParam($name)
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $name));
    }
}