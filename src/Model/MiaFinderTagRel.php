<?php

namespace Mia\Finder\Model;

use Mia\Auth\Model\MIAUser;

/**
 * Description of Model
 * @property int $id ID of item
 * @property mixed $finder_id Description for variable
 * @property mixed $tag_id Description for variable

 *
 * @OA\Schema()
 * @OA\Property(
 *  property="id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="finder_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="tag_id",
 *  type="integer",
 *  description=""
 * )

 *
 * @author matiascamiletti
 */
class MiaFinderTagRel extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mia_finder_tag_rel';
    
    //protected $casts = ['data' => 'array'];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function finder()
    {
        return $this->belongsTo(MiaFinder::class, 'finder_id');
    }

    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function tag()
    {
        return $this->belongsTo(MiaFinderTag::class, 'tag_id');
    }
}