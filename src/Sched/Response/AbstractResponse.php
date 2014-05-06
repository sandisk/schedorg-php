<?php

namespace Sched\Response;

use GuzzleHttp\Message\Response;

abstract class AbstractResponse
{

    /**
     * @var \GuzzleHttp\Message\Response
     */
    protected $response;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param Response $response
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
        if ($this->isSuccess()) {
            $this->data = json_decode($response->getBody());
        }
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return substr($this->response->getBody(), 0, 4) !== 'ERR:';
    }

    /**
     * @return null|string
     */
    public function getError()
    {
        return $this->isSuccess()
            ? null
            : substr($this->response->getBody(), 5);
    }

    public function __call($name, $value)
    {
        if (substr($name, 0, 3) !== 'get') {
            return null;
        }

        $name = $this->propertyToParam(substr($name, 3));
        return isset($this->data->$name) ? $this->data->$name : null;
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