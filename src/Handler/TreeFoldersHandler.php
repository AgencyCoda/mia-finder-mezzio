<?php

namespace Mia\Finder\Handler;

use Mia\Finder\Model\MiaFinder;

/**
 * Description of ListHandler
 * 
 * @OA\Get(
 *     path="/mia-finder/tree-folders",
 *     summary="Get all data",
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/MiaFinder")
 *     )
 * )
 *
 * @author matiascamiletti
 */
class TreeFoldersHandler extends \Mia\Core\Request\MiaRequestHandler
{
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Fetch By Parent Id
        $parentId = $this->getParam($request, 'parent_id', null);
        // Fetch All folders
        $folders = MiaFinder::with('nestedChildren')->where('type', MiaFinder::TYPE_FOLDER)->where('parent_id', $parentId)->get();
        // Return dat
        return new \Mia\Core\Diactoros\MiaJsonResponse($folders->toArray());
    }
}