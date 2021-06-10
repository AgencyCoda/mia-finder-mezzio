<?php

namespace Mia\Finder\Model;

use Mia\Auth\Model\MIAUser;

/**
 * Description of Model
 * @property int $id ID of item
 * @property mixed $user_id Description for variable
 * @property mixed $finder_id Description for variable
 * @property mixed $ord Description for variable

 *
 * @OA\Schema()
 * @OA\Property(
 *  property="id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="user_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="finder_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="ord",
 *  type="integer",
 *  description=""
 * )

 *
 * @author matiascamiletti
 */
class MiaFinderMenu extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mia_finder_menu';
    
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
    public function user()
    {
        return $this->belongsTo(MIAUser::class, 'user_id');
    }
    
}