<?php
/**
 * Created by PhpStorm.
 * User: kai
 * Date: 2018/05/17
 * Time: 21:35
 */

namespace App\Repositories;


use App\Models\Poll;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;

/**
 * Class PollsRepository
 * @package App\Repositories
 * @property int id
 * @property string title
 * @property Carbon updated_at
 *
 */
class PollsRepository
{
    public function __construct(Poll $poll, Question $question)
    {
        $this->poll = $poll;
        $this->question = $question;
    }

    /**
     * @param int $limit
     * @return Poll|Model
     */
    public function getRecent($limit = 12)
    {
        return $this->poll->orderBy("created_at", "DESC")->with("question")->paginate($limit);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->poll->with("question")->find($id);
    }

    /**
     * @param int $limit
     * @return mixed
     * voteを数えて、rankingにするのがめんどいのでupdateがあった順で
     */
    public function getPopular($limit = 12)
    {
        return $this->poll->orderBy("updated_at", "DESC")->with("question")->paginate($limit);
    }


    public function save($data)
    {
        $this->poll->fill($data)->save();
        foreach ($data["questions"] as $qs){
            $question = new Question();
            $q = $question->fill($qs);
            $this->poll->question()->save($q);
        }
        return $this->poll;
    }

}