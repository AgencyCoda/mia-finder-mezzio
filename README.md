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
    $app->route('/mia-finder/tree-folders', [\Mia\Finder\Handler\TreeFoldersHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia-finder.tree-folders');
    $app->route('/mia-finder/upload-item', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Finder\Handler\UploadItemHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia-finder.upload-item');
```