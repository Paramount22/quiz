@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="text-center mb-2">Your result</h3>
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
