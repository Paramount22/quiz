@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('_partials._messages')
                <div class="card">
                    <div class="card-header">{{ __('Assign Quiz') }}</div>
                    <div class="card-body">
                        <form action="{{route('assign.exam.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Select Quiz</label>
                                <select class="form-control" name="quiz_id">
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
                                <label for="users">Select User</label>
                                <select class="form-control" name="user_id" id="users">
                                    @foreach( $users as $user )
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                @error('users')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button class="btn btn-outline-success">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
