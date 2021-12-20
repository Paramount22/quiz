@extends('admin.layouts.app')

@section('content')

    <quiz-component
        :times="{{$quiz->minutes}}"
        :quiz-id="{{$quiz->id}}"
        :quiz-questions="{{$quizQuestions}}"
        :has-quiz-played="{{$authUserHasPlayedQuiz}}"

    ></quiz-component>


@endsection
