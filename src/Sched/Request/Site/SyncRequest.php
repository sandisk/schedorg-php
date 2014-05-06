<?php

namespace Sched\Request\Site;

use Sched\Request\AbstractRequest;
use Sched\Response\Site\SyncResponse as Response;

class SyncRequest extends AbstractRequest
{

    protected $params = ['modify_date'];

    /**
     * @param \DateTime $date
     * @return \Sched\Request\Site\SyncRequest
     */
    public function setModifyDate(\DateTime $date)
    {
        return parent::setModifyDate($date->getTimestamp());
    }

    /**
     * @return string
     */
    public function getApiEndpoint()
    {
        return 'site/sync';
    }

    /**
     * @return \Sched\Response\Site\SyncResponse
     */
    public function getResponseObject()
    {
        return new \Sched\Response\Site\CreateResponse();
    }
}