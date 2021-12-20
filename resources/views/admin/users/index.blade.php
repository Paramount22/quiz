@extends('admin.layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">

            @include('_partials._messages')
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">All Users</h6>
                    <a class="text-info" href="{{route('users.create')}}">Create user</a>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Occupation</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>

                            <tbody>

                            @forelse($users as $key => $user)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->visible_password}}</td>
                                    <td>{{$user->occupation}}</td>

                                    <td>
                                        <a href="{{route('users.edit', $user)}}" class="text-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" data-toggle="modal" data-target="#exampleModal{{$user->id}}"
                                           class="text-danger">
                                            <i class="far fa-trash-alt"></i>
                                        </a>

                                    <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1"
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
                                                        <form action="{{route('users.destroy', $user)}}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger"

                                                            >Delete</button>
                                                        </form>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>  No records</tr>

                            @endforelse
                            </tbody>
                        </table>
                    </div>
                {{$users->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection

