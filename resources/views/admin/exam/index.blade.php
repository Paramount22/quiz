@extends('admin.layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('_partials._messages')
            @include('_partials._warning')
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">User exam</h6>
                    <a class="text-info" href="{{route('quizzes.create')}}">New quiz</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Quiz</th>
                                <th>Question</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>

                            @forelse($quizzes as $quiz)
                                @foreach($quiz->users as $key => $user)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$quiz->name}}</td>
                                    <td>
                                        <a href="{{route('quiz.question', $quiz)}}">View Question</a>
                                    </td>

                                    <td>
                                        <form action="{{route('remove.exam')}}" method="post">
                                            @csrf
                                            <input class="form-control" type="hidden" name="user_id"
                                                   value="{{$user->id}}">

                                            <input class="form-control" type="hidden" name="quiz_id"
                                                   value="{{$quiz->id}}">

                                            @if($quiz->users())
                                                <button type="submit" class="btn btn-dark btn-sm">
                                                    Remove
                                                </button>
                                            @endif
                                        </form>
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
