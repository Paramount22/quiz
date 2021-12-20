@extends('admin.layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('_partials._messages')
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">All quizzes</h6>
                    <a class="text-info" href="{{route('quizzes.create')}}">New quiz</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Minutes</th>
                                <th>Description</th>
                                <th>View</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>

                            <tbody>

                            @forelse($quizzes as $key => $quiz)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$quiz->name}}</td>
                                    <td>{{$quiz->minutes}}</td>
                                    <td>{{$quiz->description}}</td>
                                    <td>
                                        <a href="{{route('quiz.question', $quiz)}}">View Question</a>
                                    </td>
                                    <td>
                                        <a href="{{route('quizzes.edit', $quiz)}}" class="text-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" data-toggle="modal" data-target="#exampleModal{{$quiz->id}}"
                                           class="text-danger">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                        <form id="delete-form" action="{{route('quizzes.destroy', $quiz)}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$quiz->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">

                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure ?</h5>

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                The record will be deleted.
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger"
                                                        onclick="document.getElementById('delete-form').submit();"
                                                >Delete</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
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
