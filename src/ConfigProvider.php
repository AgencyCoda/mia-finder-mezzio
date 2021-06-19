<?php

/**
 * @see       https://github.com/mezzio/mezzio-authorization for the canonical source repository
 * @copyright https://github.com/mezzio/mezzio-authorization/blob/master/COPYRIGHT.md
 * @license   https://github.com/mezzio/mezzio-authorization/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Mia\Finder;

use Mia\Finder\Factory\AbstractHandlerFactory;
use Mia\Finder\Handler\FetchHandler;
use Mia\Finder\Handler\ListItemsHandler;
use Mia\Finder\Handler\TagsHandler;
use Mia\Finder\Handler\TreeFoldersHandler;
use Mia\Finder\Handler\UploadItemHandler;

class ConfigProvider
{
    /**
     * Return the configuration array.
     */
    public function __invoke() : array
    {
        return [
            'dependencies'  => $this->getDependencies()
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
                Task\LogFinderTask::class => Task\LogFinderTask::class,
            ],
            'factories' => [
                TreeFoldersHandler::class => AbstractHandlerFactory::class,
                UploadItemHandler::class => AbstractHandlerFactory::class,
                ListItemsHandler::class => AbstractHandlerFactory::class,
                FetchHandler::class => AbstractHandlerFactory::class,
                TagsHandler::class => AbstractHandlerFactory::class,
                //\Mia\Auth\Handler\AuthOptionalHandler::class => \Mia\Auth\Factory\AuthOptionalHandlerFactory::class,
                //\Mia\Auth\Handler\LoginHandler::class => \Mia\Auth\Factory\LoginHandlerFactory::class,
                //\Mia\Auth\Handler\Social\GoogleSignInHandler::class => \Mia\Auth\Factory\GoogleSignInHandlerFactory::class,
            ],
        ];
    }
}