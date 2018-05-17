<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Poll
 * @package App\Models
 */
class Poll extends Model
{
    protected $table = "polls";

    public function question(){
        return $this->belongsToMany(Question::class);
    }

    public function countVote(){
        //questionの合計vote
        return $this->question->sum("vote");
    }
}
