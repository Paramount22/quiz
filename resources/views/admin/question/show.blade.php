@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('_partials._messages')
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-lg d-flex justify-content-between">
                       <div>
                           {{ $question->question }}
                       </div>
                        <div>
                            {{$question->quiz->name}}
                        </div>

                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($question->answers as $key => $answer)
                                <li class="list-group-item">
                                   <span class="mr-2">{{$key + 1}}.)</span>
                                    {{$answer->answer}}

                                    @if($answer->is_correct)
                                        <span class="badge badge-success ml-2">correct</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer d-flex">
                        <a class="btn btn-sm btn-outline-info" href="{{route('questions.index')}}">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
