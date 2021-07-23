<?php

namespace Mia\Finder\Handler;

use Mia\Finder\Model\MiaFinder;

/**
 * Description of ListHandler
 * 
 * @OA\Get(
 *     path="/mia-finder/move-item",
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
class MoveItemHandler extends AbstractFinderHandler
{
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Get Current User
        $user = $this->getUser($request);
        // Fetch By Parent Id
        $parentId = $this->getParam($request, 'parent_id', null);
        // Fetch Item Id
        $id = $this->getParam($request, 'id', null);
        // Fetch item
        $item = MiaFinder::where('id', $id)->first();
        if($item === null){
            return new \Mia\Core\Diactoros\MiaJsonResponse(false);
        }
        // Save new parent
        $item->parent_id = $parentId;
        $item->save();
        // Return dat
        return new \Mia\Core\Diactoros\MiaJsonResponse(true);
    }
}