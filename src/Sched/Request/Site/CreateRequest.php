<?php

namespace Sched\Request\Site;

use Sched\Request\AbstractRequest;

/**
 * @method \Sched\Request\Site\CreateRequest setName($name)
 * @method \Sched\Request\Site\CreateRequest setTitle($title)
 * @method \Sched\Request\Site\CreateRequest setAdmin($email)
 * @method \Sched\Request\Site\CreateRequest setDescription($description)
 */
class CreateRequest extends AbstractRequest
{

    protected $params = ['name', 'event_start', 'event_end', 'title', 'admin', 'description'];

    /**
     * @param \DateTime $date
     * @return \Sched\Request\Site\CreateRequest
     */
    public function setEventStart(\DateTime $date)
    {
        return parent::setEventStart($date->getTimestamp());
    }

    /**
     * @param \DateTime $date
     * @return \Sched\Request\Site\CreateRequest
     */
    public function setEventEnd(\DateTime $date)
    {
        return parent::setEventEnd($date->getTimestamp());
    }

    /**
     * @return string
     */
    public function getApiEndpoint()
    {
        return 'site/add';
    }

    /**
     * @return \Sched\Response\Site\CreateResponse
     */
    public function getResponseObject()
    {
        return new \Sched\Response\Site\CreateResponse();
    }
}