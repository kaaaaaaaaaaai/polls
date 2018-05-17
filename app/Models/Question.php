<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 * @package App\Models
 * @property integer vote
 * @var integer vote
 * @method Model|this find()
 *
 */
class Question extends Model
{
    //
    //他もupdate_at更新
    protected $touches = array('poll');

    public function poll(){
        return $this->belongsToMany(poll::class);
    }
}
