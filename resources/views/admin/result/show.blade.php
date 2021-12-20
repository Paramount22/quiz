@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="text-center mb-4">Results of
                    @foreach($user as $userResult)
                        {{$userResult->name}}
                    @endforeach
                </h3>

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong class="text-success">Correct: {{$userCorrectedAnswers}}</strong> <br>
                            <strong class="text-danger">Wrong: {{ $userWrongAnswers}}</strong>
                        </div>

                        <div class="percentage">
                            @if($percentage <= 25)
                                <strong class="text-danger">{{$percentage}} %</strong> Very bad :-(
                            @endif
                            @if($percentage >= 70)
                                <strong class="text-success">{{$percentage}} % </strong> Good Job
                            @endif
                            @if($percentage < 70 && $percentage > 25)
                                <strong class="text-warning">{{$percentage}} %</strong> Not bad.
                            @endif
                        </div>

                    </div>
                    <p class="text-danger">

                    </p>



                @foreach($results as $key => $result)

                    <div class="card mb-2">
                        <div class="card-header">
                            {{$key + 1}}
                        </div>



                        <div class="card-body">

                            <h4 class="mb-3">
                                {{$result->question->question}}
                            </h4>
                            <ul class="list-group">
                                @php
                                    $answers = \App\Models\Answer::where('question_id', $result->question_id)->get();
                                     foreach ($answers as $answer) {
                                         echo '<li class="list-group-item">' . $answer->answer . '</li>';
                                     }
                                @endphp
                            </ul>
                            <p class="mt-2">
                                <mark>
                                    Your answer: <strong>{{$result->answer->answer}}</strong>
                                </mark>
                            </p>

                            @php
                                $correctAnswers = \App\Models\Answer::where('question_id', $result->question_id)
                                ->where('is_correct', 1)->get();
                                foreach ($correctAnswers as $correct) {
                                    echo  "Corect answer is: " . $correct->answer;

                                }
                            @endphp
                            @if($result->answer->is_correct)
                                <div class="alert alert-success mt-2" role="alert">
                                    Correct!
                                </div>
                            @else
                                <div class="alert alert-danger mt-2" role="alert">
                                    Your answer was wrong!
                                </div>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



@endsection
