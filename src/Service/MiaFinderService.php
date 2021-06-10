<?php

namespace Mia\Finder\Service;

class MiaFinderService
{
    /**
     * Verify if need authorization that get files
     *
     * @var boolean
     */
    public $isAuthNeed = true;

    public function __construct($config)
    {
        $this->processConfig($config);
    }

    protected function processConfig($config)
    {
        if(!is_array($config)){
            return;
        }

        if(array_key_exists('is_auth_need', $config)){
            $this->isAuthNeed = $config['is_auth_need'];
        }
    }
}