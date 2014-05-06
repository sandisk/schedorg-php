<?php

namespace Sched\Request\Session;

use Sched\Request\AbstractRequest;

/**
 * @method \Sched\Request\Session\CreateRequest setSessionKey($key)
 * @method \Sched\Request\Session\CreateRequest setName($name)
 * @method \Sched\Request\Session\CreateRequest setSessionType($type)
 * @method \Sched\Request\Session\CreateRequest setSessionSubtype($subtype)
 * @method \Sched\Request\Session\CreateRequest setDescription($description)
 * @method \Sched\Request\Session\CreateRequest setMediaUrl($url)
 * @method \Sched\Request\Session\CreateRequest setVenue($venue)
 * @method \Sched\Request\Session\CreateRequest setAddress($address)
 * @method \Sched\Request\Session\CreateRequest setMap($url)
 * @method \Sched\Request\Session\CreateRequest setSeats($seats)
 */
class CreateRequest extends AbstractRequest
{

    protected $params = [
        'session_key', 'name', 'session_start', 'session_end', 'session_type', 'session_subtype', 'description',
        'media_url', 'venue', 'address', 'map', 'tags', 'seats'
    ];

    /**
     * @param \DateTime $date
     * @return \Sched\Request\Session\CreateRequest
     */
    public function setSessionStart(\DateTime $date)
    {
        return parent::setSessionStart($date->format('Y-m-d H:i'));
    }

    /**
     * @param \DateTime $date
     * @return \Sched\Request\Session\CreateRequest
     */
    public function setSessionEnd(\DateTime $date)
    {
        return parent::setSessionEnd($date->format('Y-m-d H:i'));
    }

    /**
     * @param array $tags
     * @return \Sched\Request\Session\CreateRequest
     */
    public function setTags(array $tags)
    {
        return parent::setTags(implode(',', $tags));
    }

    /**
     * @return string
     */
    public function getApiEndpoint()
    {
        return 'session/add';
    }

    /**
     * @return \Sched\Response\Session\CreateResponse
     */
    public function getResponseObject()
    {
        return new \Sched\Response\Session\CreateResponse();
    }
}