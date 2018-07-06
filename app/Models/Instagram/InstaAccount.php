<?php

namespace App\Models\Instagram;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InstaAccount
 *
 * @package App\Models\Instagram
 * @property int $id
 * @property string $name Account name in Instagram
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Instagram\InstaAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Instagram\InstaAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Instagram\InstaAccount whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Instagram\InstaAccount whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InstaAccount extends Model
{
	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'insta_accounts';

	/**
	 * The attributes that are not mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'created_at',
		'updated_at',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'id',
	];
}
