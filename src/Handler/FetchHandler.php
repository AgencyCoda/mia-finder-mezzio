<?php

namespace Mia\Finder\Handler;

use Mia\Finder\Model\MiaFinder;

/**
 * Description of FetchHandler
 * 
 * @OA\Get(
 *     path="/mia-finder/fetch/{id}",
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
class FetchHandler extends AbstractFinderHandler
{
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Get Current User
        $user = $this->getUser($request);
        // Fetch By Parent Id
        $id = $this->getParam($request, 'id', null);
        // Generate Query
        $query = MiaFinder::with(['nestedChildren', 'nestedParents'])->where('id', $id);
        // Verify If need Auth
        if($this->service->isAuthNeed){
            $query->where('creator_id', $user->id);
        }
        // Fetch All folders
        $finder = $query->first();
        // Return dat
        return new \Mia\Core\Diactoros\MiaJsonResponse($finder->toArray());
    }
}