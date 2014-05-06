Sched.org API wrapper for PHP
============

A totally incomplete wrapper for [Sched.org](http://sched.org) API.
For now, the only available actions are:

- Create site
- Sync site
- Create a session

## Installation

To install from Github using Composer, add the following to composer.json:

    {
        "repositories": [{
            "url":  "https://github.com/sandisk/schedorg-php.git",
            "type": "git"
        }],
        "require": {
            "sandisk/schedorg-php": "dev-master"
        }
    }


## Usage

```php
use \Sched\Client\Client as Sched;
$sched = new Sched('YOUR_API_KEY', 'http://YOUR_CONFERENCE.sched.org/api');
```
    
### Creating a SCHED* site
```php
$request = new \Sched\Request\Site\CreateRequest();
$request->setName('testsite123')
    ->setTitle('Test site')
    ->setEventStart(new \DateTime('+3 days'))
    ->setEventEnd(new \DateTime('+5 days'))
    ->setAdmin('email@example.com')
    ->setDescription('Site description');

/**
 * @var $result \Sched\Response\Site\CreateResponse
 */
$result = $sched->performRequest($request);
if ($result->isSuccess()) {
    echo $result->getSite();
} else {
    echo "Error: {$result->getError()}";
}
```

### Syncing
```php
$request = new \Sched\Request\Site\SyncRequest();
$request->setModifyDate(new \DateTime('-1 day'));
$result = $sched->performRequest($request);
```

    
### Creating a session
```php
$request = new \Sched\Request\Session\CreateRequest();
$request->setSessionKey('PANELPANEL')
    ->setName('Session name')
    ->setSessionStart(new \DateTime('+1 hour'))
    ->setSessionEnd(new \DateTime('+3 hours'))
    ->setSessionType('demo')
    ->setTags([
        'demo', 'test'
    ]);
$result = $sched->performRequest($request);
```
