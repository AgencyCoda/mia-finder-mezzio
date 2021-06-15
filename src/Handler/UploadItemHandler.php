<?php

namespace Mia\Finder\Handler;

use Mia\Core\Exception\MiaException;
use Mia\Core\Helper\GoogleTasksHelper;
use Mia\Core\Helper\StringHelper;
use Mia\Finder\Model\MiaFinder;
use Mia\Finder\Model\MiaFinderLog;
use Mia\Finder\Task\LogFinderTask;

/**
 * Description of ListHandler
 * 
 * @OA\Post(
 *     path="/mia-finder/upload-item",
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
class UploadItemHandler extends AbstractFinderHandler
{
    /**
     * 
     *
     * @var boolean
     */
    protected $isNew = false;

    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Get Current User
        $user = $this->getUser($request);
        // Obtener item a procesar
        $item = $this->getForEdit($request);
        // Guardamos data
        $item->title = $this->getParam($request, 'title', '');
        $item->slug = $item->creator_id . '-' . StringHelper::createSlug($item->title) . '_' . time();

        $item->parent_id = intval($this->getParam($request, 'parent_id', 0));
        if($item->parent_id <= 0){
            $item->parent_id = null;
        }

        $item->type = intval($this->getParam($request, 'type', 0));
        $item->status = intval($this->getParam($request, 'status', 0));
        $item->item_relation_one = intval($this->getParam($request, 'item_relation_one', 0));
        $item->item_relation_two = intval($this->getParam($request, 'item_relation_two', 0));
        $item->url = $this->getParam($request, 'url', '');
        $item->size = intval($this->getParam($request, 'size', 0));

        $item->block_user_id = intval($this->getParam($request, 'block_user_id', 0));
        if($item->block_user_id <= 0){
            $item->block_user_id = null;
        }
        
        try {
            $item->save();
        } catch (\Exception $exc) {
            return new \Mia\Core\Diactoros\MiaJsonErrorResponse(-2, $exc->getMessage());
        }

        if($this->isNew){
            $typeLog = MiaFinderLog::TYPE_CREATED;
        } else {
            $typeLog = MiaFinderLog::TYPE_EDIT;
        }

        GoogleTasksHelper::executeTask(LogFinderTask::class, [
            'finder_id' => $item->id,
            'user_id' => $user->id,
            'type' => $typeLog,
            'caption' => '',
            'data' => [
                'user' => $user->toArray()
            ]
        ]);

        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse($item->toArray());
    }
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return MiaFinder
     */
    protected function createNew(\Psr\Http\Message\ServerRequestInterface $request)
    {
        // Set Is New
        $this->isNew = true;
        // Get Current User
        $user = $this->getUser($request);

        $item = new MiaFinder();
        $item->creator_id = $user->id;

        return $item;
    }
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return MiaFinder
     */
    protected function getForEdit(\Psr\Http\Message\ServerRequestInterface $request)
    {
        // Get ID in params
        $itemId = $this->getParam($request, 'id', 0);
        // Verify if ID 
        if($itemId <= 0){
            return $this->createNew($request);
        }
        // Generate Query
        $query = MiaFinder::where('id', $itemId);
        // Verify if Need Auth
        if($this->service->isAuthNeed){
            // Get Current User
            $user = $this->getUser($request);
            // Add query
            $query->join('mia_finder_permission', 'mia_finder_permission.finder_id', '=', 'mia_finder.id')->where('mia_finder_permission.user_id', $user->id)->select('mia_finder.*');
        }
        // Search if exist
        $item = $query->first();
        // verificar si existe
        if($item === null){
            throw new MiaException('Not exist finder or you not have permission');
        }
        // Return item
        return $item;
    }
}