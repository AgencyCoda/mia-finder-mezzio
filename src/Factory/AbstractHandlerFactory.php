<?php

namespace Mia\Finder\Factory;

use Mia\Finder\Handler\AbstractFinderHandler;
use Mia\Finder\Service\MiaFinderService;
use Psr\Container\ContainerInterface;

class AbstractHandlerFactory
{
    public function __invoke(ContainerInterface $container, $requestName): AbstractFinderHandler
    {
        // Get config
        $config = $container->get('config')['mia_finder'];
        // Init Service
        $service = new MiaFinderService($config);
        // Generate Handler
        return new $requestName($service);
    }
}