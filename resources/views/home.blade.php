@extends('admin.layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8">
            @include('_partials._danger')
            <div class="card">
                <div class="card-header">{{ __('Quiz') }}</div>
                @if($isExamAssigned)
                    @foreach($quizzes as $quiz)
                        <div class="card-body">
                           <h3>{{$quiz->name}}</h3>
                            <p>{{$quiz->description}}</p>
                            <p>{{$quiz->minutes}} minutes</p>
                            <p>{{$quiz->questions->count() }} questions</p>
                            <p>
                                @if(!in_array($quiz->id, $wasQuizCompleted))
                                    <a class="btn btn-success" href="{{route('quiz.questions', $quiz->id)}}">
                                        Start quiz
                                    </a>
                                @else
                                    <span class="d-flex justify-content-between align-items-center">
                                        <a class="d-block"
                                           href="result/user/{{auth()->id()}}/quiz/{{$quiz->id}}">
                                            View result
                                        </a>
                                        <span class="badge badge-success">Completed</span>
                                    </span>

                                @endif
                            </p>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-info" role="alert">
                        You have not assigned any exam!
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{auth()->user()->name}}</div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">{{auth()->user()->email}}</li>
                        <li class="list-group-item">{{auth()->user()->occupation}}</li>
                        <li class="list-group-item">{{auth()->user()->address}}</li>
                        <li class="list-group-item">{{auth()->user()->phone}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

