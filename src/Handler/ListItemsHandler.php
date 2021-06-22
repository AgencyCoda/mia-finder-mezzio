<?php

namespace Mia\Finder\Handler;

use Mia\Core\Exception\MiaException;
use Mia\Finder\Repository\MiaFinderRepository;

/**
 * Description of ListHandler
 * 
 * @OA\Post(
 *     path="/mia-finder/list-items",
 *     summary="MiaFinder List",
 *     tags={"MiaFinder"},
 *     @OA\RequestBody(
 *         description="Object query",
 *         required=false,
 *         @OA\MediaType(
 *             mediaType="application/json",                 
 *             @OA\Schema(
 *                  @OA\Property(
 *                      property="page",
 *                      type="integer",
 *                      description="Number of pace",
 *                      example="1"
 *                  ),
 *                  @OA\Property(
 *                      property="where",
 *                      type="string",
 *                      description="Wheres | Searchs",
 *                      example=""
 *                  ),
 *                  @OA\Property(
 *                      property="withs",
 *                      type="array",
 *                      description="Array of strings",
 *                      example="[]"
 *                  ),
 *                  @OA\Property(
 *                      property="search",
 *                      type="string",
 *                      description="String of search",
 *                      example=""
 *                  ),
 *                  @OA\Property(
 *                      property="ord",
 *                      type="string",
 *                      description="Ord",
 *                      example=""
 *                  ),
 *                  @OA\Property(
 *                      property="asc",
 *                      type="integer",
 *                      description="Integer",
 *                      example="1"
 *                  ),
 *                  @OA\Property(
 *                      property="limit",
 *                      type="integer",
 *                      description="Limit",
 *                      example="50"
 *                  )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Property(ref="#/components/schemas/MiaJsonResponse"),
 *                  @OA\Property(
 *                      property="response",
 *                      type="array",
 *                      @OA\Items(type="object", ref="#/components/schemas/MiaFinder")
 *                  )
 *              }
 *          )
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     },
 * )
 *
 * @author matiascamiletti
 */
class ListItemsHandler extends AbstractFinderHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface 
    {
        // Get Current User
        $user = $this->getUser($request);
        // Configurar query
        $configure = new \Mia\Database\Query\Configure($this, $request);
        // Verify if need auth
        if($this->service->isAuthNeed){
            $configure->addJoin('mia_finder_permission', 'mia_finder_permission.finder_id', 'mia_finder.id');
            $configure->addWhere('mia_finder_permission.user_id', $user->id);
        }
        // Verify if where with tags
        $tagWhere = $configure->getWhere('tag_id');
        if($tagWhere != null){
            $configure->removeWhere('tag_id');

            $configure->addJoin('mia_finder_tag_rel', 'mia_finder_tag_rel.finder_id', 'mia_finder.id');
            $configure->addWhere('mia_finder_tag_rel.tag_id', $tagWhere['value']);
        }
        // Process Query
        $rows = MiaFinderRepository::fetchByConfigure($configure);
        // Return data
        return new \Mia\Core\Diactoros\MiaJsonResponse($rows->toArray());
    }
}