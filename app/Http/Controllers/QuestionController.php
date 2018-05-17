<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Repositories\QuestionsRepository;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //
    public function __construct(QuestionsRepository $question)
    {
        $this->question = $question;
    }

    public function vote($id){
        return $this->question->vote($id);
    }
}
