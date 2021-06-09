# AgencyCoda Finder Mezzio

1. Incluir libreria:
```bash
composer require mobileia/mia-core-mezzio
composer require mobileia/mia-auth-mezzio
composer require mobileia/mia-finder-mezzio
```
5. Agregando las rutas:
```php
    /** MIA FINDER **/
    $app->route('/mia-finder/tree-folders', [\Mia\Finder\Handler\TreeFoldersHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia-finder.tree-folders');
```