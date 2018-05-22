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
    protected $fillable = ["title", "description"];

    public function question(){
        return $this->belongsToMany("App\Models\Question");
    }

    public function countVote(){
        //questionの合計vote
        return $this->question->sum("vote");
    }
}
