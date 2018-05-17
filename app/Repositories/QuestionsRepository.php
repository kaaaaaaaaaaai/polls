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

/**
 * Class PollsRepository
 * @package App\Repositories
 * @property int id
 * @property string title
 * @property Carbon updated_at
 *
 */
class QuestionsRepository
{
    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    public function vote($id){
        $model = $this->question->find($id);
        $model->vote++;
        $model->save();

        return $model;
    }


}