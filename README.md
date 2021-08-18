# AgencyCoda Finder Mezzio

1. Incluir libreria:
```bash
composer require agencycoda/mia-core-mezzio
composer require agencycoda/mia-auth-mezzio
composer require agencycoda/mia-finder-mezzio
```
5. Agregando las rutas:
```php
    /** MIA FINDER **/
    $app->route('/mia-finder/tree-folders', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Finder\Handler\TreeFoldersHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia-finder.tree-folders');
    $app->route('/mia-finder/list-items', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Finder\Handler\ListItemsHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia-finder.list-items');
    $app->route('/mia-finder/upload-item', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Finder\Handler\UploadItemHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia-finder.upload-item');
    $app->route('/mia-finder/fetch/{id}', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Finder\Handler\FetchHandler::class], ['GET', 'OPTIONS', 'HEAD'], 'mia-finder.fetch');
    $app->route('/mia-finder/tags', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Finder\Handler\TagsHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia-finder.tags');
    $app->route('/mia-finder/move-item', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Finder\Handler\MoveItemHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia-finder.move-item');
    $app->route('/mia-finder/remove/{id}', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Finder\Handler\RemoveHandler::class], ['GET', 'DELETE', 'OPTIONS', 'HEAD'], 'mia-finder.remove');
```