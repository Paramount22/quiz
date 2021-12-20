@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('_partials._messages')
                <div class="card">
                    <div class="card-header">{{ __('Create Question') }}</div>
                    <div class="card-body">
                        <form action="{{route('questions.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Select Quiz</label>
                                <select class="form-control" name="quiz" id="">
                                    @foreach( $quizzes as $quiz )
                                        <option value="{{$quiz->id}}">{{$quiz->name}}</option>
                                    @endforeach
                                </select>
                                @error('quiz')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="question">Question</label>
                                <input class="form-control @error('question') is-invalid @enderror" type="text" id="question"  name="question"
                                       placeholder="Question" value="{{old('question')}}">
                                @error('question')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="options">Options</label>

                                @for($i = 0; $i < 4; $i++)
                                    <input class="form-control mb-2 mt-2 @error('options') is-invalid @enderror"
                                           type="text"
                                           id="options"
                                           name="options[]"
                                           placeholder="Option {{$i + 1}}"
                                           value="{{old('options.[$i]')}}"
                                           >
                                        <input type="radio" name="correct_answer" value="{{$i}}">
                                        <label class="mb-3">Is correct answer</label>
                                @endfor

                                @error('options')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button class="btn btn-outline-success">Submit</button>
                            <a class="btn btn-outline-secondary" href="{{route('questions.index')}}">
                                Back
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
