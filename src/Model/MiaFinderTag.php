<?php

namespace Mia\Finder\Model;

use Mia\Auth\Model\MIAUser;

/**
 * Description of Model
 * @property int $id ID of item
 * @property mixed $title Description for variable
 * @property mixed $slug Description for variable
 * @property mixed $ord Description for variable
 * @property mixed $is_public Description for variable

 *
 * @OA\Schema()
 * @OA\Property(
 *  property="id",
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
 *  property="ord",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="is_public",
 *  type="integer",
 *  description=""
 * )

 *
 * @author matiascamiletti
 */
class MiaFinderTag extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mia_finder_tag';
    
    //protected $casts = ['data' => 'array'];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}