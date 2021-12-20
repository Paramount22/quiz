<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;


class ExamController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.exam.assign', [
            'quizzes' => Quiz::orderBy('name')->get(),
            'users' => User::orderBy('name')->where('is_admin', false)->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $quiz = (new Quiz)->assignExam($request->all());
        return redirect()->route('view.exam')->with('success', 'Exam assigned to user');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function userExam()
    {
        return view('admin.exam.index', [
             'quizzes' => Quiz::all()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeExam(Request $request)
    {
        $userId = $request->get('user_id');
        $quizId = $request->get('quiz_id');
        $quiz = Quiz::findOrFail($quizId);
        // chceck if exam already exists in table Results
        $result = Result::where('quiz_id', $quizId)
            ->where('user_id', $userId)
            ->exists();
        if($result) {
            return back()->with('warning', 'This quiz is played by user, it cannot be removed.');
        } else {
            // remove exam
            $quiz->users()->detach($userId);
            return back()->with('success', 'Quiz removed.');
        }

    }

    /**
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getQuizQuestions($quizId)
    {
        $authUser = auth()->id();
        // chceck if user has been assigned particular quiz
        $userId = ( new Quiz )->checkUser($authUser);
        if(!in_array($quizId, $userId)) {
            return redirect('/home')->with('danger', 'You are not assigned this exam');
        }
        $quiz = Quiz::findOrFail($quizId);
        $time = Quiz::where('id', $quizId)->value('minutes');
        $quizQuestions = Question::where('quiz_id', $quizId)->with('answers')->get();
        $authUserHasPlayedQuiz = Result::where(['user_id' => $authUser], ['quiz_id' => $quizId])->get();

        //has user played particular quiz
        $wasCompleted = ( new Quiz )->checkUserResult($authUser);
        if( in_array($quizId, $wasCompleted) ) {
            return redirect('/home')->with('danger', 'You already participated in this exam.');
        }
        return view('quiz.quiz', compact('quiz', 'time', 'quizQuestions', 'authUserHasPlayedQuiz'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function storeResult(Request $request)
    {
        $questionId = $request['questionId'];
        $quizId = $request['quizId'];
        $answerId = $request['answerId'];
        $authUserId = auth()->id();
       return $userQuestionAnswer = Result::updateOrCreate(
            [
                'user_id' => $authUserId,
                'quiz_id' => $quizId,
                'question_id' => $questionId
            ],
            ['answer_id' => $answerId,]);
    }

    /**
     * @param $userId
     * @param $quizId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function viewResult($userId, $quizId)
    {
       $results = (new Result)->getResult($userId, $quizId);
       return view('results.show', compact('results'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function result()
    {
        $quizzes = Quiz::get();
        return view('admin.result.index', compact('quizzes'));
    }

    /**
     * @param $userId
     * @param $quizId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function usersResults($userId, $quizId)
    {
        $results = (new Result)->getResult($userId, $quizId);
        $user = User::where('id', $userId)->get();
        $totalQuestions = Question::where('quiz_id', $quizId)->count();
        $attemptQuestion = Result::where('quiz_id', $quizId)->where('user_id', $userId)->count();

        $ans = [];
        foreach ($results as $answer) {
            array_push($ans, $answer->answer_id);
        }
        $userCorrectedAnswers = Answer::whereIn('id', $ans)->where('is_correct', 1)->count();
        //dd($userCorrectedAnswer);
        $userWrongAnswers = $totalQuestions - $userCorrectedAnswers;

        $percentage = ($userCorrectedAnswers / $totalQuestions) * 100;

        return view('admin.result.show', compact('results', 'user', 'userWrongAnswers','userCorrectedAnswers', 'percentage'));
    }
}
