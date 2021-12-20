@extends('admin.layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('_partials._messages')
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">{{$quizzes[0]->name}}</h6>
                    <a class="text-info" href="{{route('quizzes.index')}}">Back</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Questions</th>

                            </tr>
                            </thead>

                            <tbody>

                            @forelse($quizzes as $quiz)
                                @foreach($quiz->questions as $key => $question)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>
                                            <h3>
                                                <a href="{{route('questions.show', $question)}}">
                                                    {{$question->question}}

                                                </a>
                                            </h3>

                                            @foreach($question->answers as $answer)
                                              <p>
                                                  {{$answer->answer}}
                                                  @if($answer->is_correct)
                                                      <span class="badge badge-success">
                                                          Correct answer
                                                      </span>
                                                  @endif
                                              </p>
                                            @endforeach
                                        </td>

                                    </tr>


                                @endforeach


                            @empty
                                <tr>  No records</tr>

                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
