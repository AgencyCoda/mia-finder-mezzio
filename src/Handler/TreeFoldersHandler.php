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
class TreeFoldersHandler extends AbstractFinderHandler
{
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Get Current User
        $user = $this->getUser($request);
        // Fetch By Parent Id
        $parentId = $this->getParam($request, 'parent_id', null);
        // Generate Query
        $query = MiaFinder::with('nestedChildren')->where('type', MiaFinder::TYPE_FOLDER)->where('parent_id', $parentId);
        // Verify If need Auth
        if($this->service->isAuthNeed){
            $query->where('creator_id', $user->id);
        }
        // Fetch All folders
        $folders = $query->get();
        // Return dat
        return new \Mia\Core\Diactoros\MiaJsonResponse($folders->toArray());
    }
}