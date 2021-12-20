<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionStoreRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.question.index', [
           'questions' => Question::latest()->with('quiz')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.question.create', [
            'quizzes' => Quiz::orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validationRules($request);
        $question = (new Question)->storeQuestion($data);
        $answer = (new Answer)->storeAnswer($data, $question); // $question - kvoli question_id

        return redirect()->route('questions.index')->with('success', 'Question created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return view('admin.question.show', [
           'question' => $question->load('answers', 'quiz')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('admin.question.edit', [
            'question' => $question->load('answers'),
            'quizzes' => Quiz::orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validationRules($request);
        $question = (new Question)->updateQuestion($id, $request);
        (new Answer)->updateAnswer($request, $question);
        return redirect()->route('questions.show', $id)
            ->with('success', 'Question updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @return void
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Question deleted');
    }

    /**
     * Validation rules
     * @param $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validationRules($request)
    {
        return $this->validate($request, [
            'quiz' => 'required',
            'question' => 'required|min:3|max:255',
            'options' => 'bail|required|array|min:3',
            'options.*' => 'bail|required|string|distinct',
            'correct_answer' => 'required'
        ]);
    }
}
