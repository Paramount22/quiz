<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizStoreRequest;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class QuizController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // cache
        $quizzes = Cache::rememberForever('quizzes', function () {
                return  Quiz::latest()->get();
        });

        return view('admin.quiz.index', compact('quizzes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizStoreRequest $request)
    {

        Quiz::create($request->validated());
        // precistenie cache po ulozeni noveho suboru
        Cache::forget('quizzes');

        return redirect()->route('quizzes.index')->with('success', 'Quiz created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        return view('admin.quiz.edit', [
           'quiz' => $quiz
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizStoreRequest $request, Quiz $quiz)
    {
        $quiz->update($request->validated());
        Cache::forget('quizzes');
        return redirect()->route('quizzes.index')->with('success', 'Quiz updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        Cache::forget('quizzes');
        return redirect()->route('quizzes.index')->with('success', 'Quiz deleted');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function question($id)
    {
        return view('admin.quiz.question', [
            'quizzes' => Quiz::with('questions')->where('id', $id)->get()
        ]);
    }
}
