<?php

namespace Mia\Finder\Task;

use Mia\Core\Task\MiaTask;
use Mia\Finder\Model\MiaFinderLog;

class LogFinderTask extends MiaTask 
{
    /**
     * @var string
     */
    protected $queueId = 'mia-finder-queue';

    public function process($params)
    {
        // Save in Database
        MiaFinderLog::create($params);
    }
}