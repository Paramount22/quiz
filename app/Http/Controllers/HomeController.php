<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $authUser = auth()->id(); // auth user
        $assignedQuizId = []; // empty array of assigned quiz id
        $userQuizzes = (new Quiz)->getUsersQuizzes($authUser); // all user quizzes
        //push user quizzes to assigned quizz array
        foreach ($userQuizzes as $data) {
            array_push($assignedQuizId, $data->quiz_id);
        }
        $quizzes = (new Quiz)->areQuizzesAssigned($assignedQuizId); // get all assigned quizzes
        $isExamAssigned = (new Quiz)->isQuizAssigned($authUser); // check if user has assigned quiz
        $wasQuizCompleted = (new Quiz)->wasQuizCompleted($authUser); // check if quiz was completed
        return view('home', compact('quizzes', 'wasQuizCompleted', 'isExamAssigned'));
    }
}
