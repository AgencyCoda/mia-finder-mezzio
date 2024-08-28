<?php

namespace Mia\Finder\Model;

use Mia\Auth\Model\MIAUser;

/**
 * Description of Model
 * @property int $id ID of item
 * @property mixed $creator_id Description for variable
 * @property mixed $title Description for variable
 * @property mixed $slug Description for variable
 * @property mixed $parent_id Description for variable
 * @property mixed $type Description for variable
 * @property mixed $status Description for variable
 * @property mixed $item_relation_one Description for variable
 * @property mixed $item_relation_two Description for variable
 * @property mixed $url Description for variable
 * @property mixed $size Description for variable
 * @property mixed $block_user_id Description for variable
 * @property mixed $created_at Description for variable
 * @property mixed $updated_at Description for variable
 * @property mixed $deleted Description for variable

 *
 * @OA\Schema()
 * @OA\Property(
 *  property="id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="creator_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="title",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="slug",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="parent_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="type",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="status",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="item_relation_one",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="item_relation_two",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="url",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="size",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="block_user_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="type_extra",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="created_at",
 *  type="",
 *  description=""
 * )
 * @OA\Property(
 *  property="updated_at",
 *  type="",
 *  description=""
 * )
 * @OA\Property(
 *  property="deleted",
 *  type="integer",
 *  description=""
 * )

 *
 * @author matiascamiletti
 */
class MiaFinder extends \Illuminate\Database\Eloquent\Model
{
    use \RecursiveRelationships\Traits\HasRecursiveRelationships;

    const TYPE_FILE = 0;
    const TYPE_FOLDER = 1;
    const TYPE_LINK = 2;

    protected $table = 'mia_finder';
    
    //protected $casts = ['data' => 'array'];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    //public $timestamps = false;

    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function blockUser()
    {
        return $this->belongsTo(MIAUser::class, 'block_user_id');
    }
    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function creator()
    {
        return $this->belongsTo(MIAUser::class, 'creator_id');
    }
    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    /*public function parent()
    {
        return $this->belongsTo(MiaFinder::class, 'parent_id');
    }*/


    /**
    * Configurar un filtro a todas las querys
    * @return void
    */
    protected static function boot(): void
    {
        parent::boot();
        
        static::addGlobalScope('exclude', function (\Illuminate\Database\Eloquent\Builder $builder): void {
            $builder->where('mia_finder.deleted', 0);
        });
    }
}