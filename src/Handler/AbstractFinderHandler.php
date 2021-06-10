<?php

namespace Mia\Finder\Handler;

use Mia\Finder\Service\MiaFinderService;

abstract class AbstractFinderHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
{
    /**
     * Mia Finder Service
     *
     * @var MiaFinderService
     */
    protected $service;

    public function __construct(MiaFinderService $service)
    {
        $this->service = $service;
    }
}