@extends('admin.layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">{{ __('Edit Quiz') }}</div>

                <div class="card-body">
                    <form action="{{route('quizzes.update', $quiz)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"
                                   name="name"
                                   placeholder="Name of a quiz" value="{{$quiz->name}}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="minutes">Duration</label>
                            <input class="form-control @error('minutes') is-invalid @enderror" type="number" id="minutes"
                                   name="minutes" value="{{$quiz->minutes}}">
                            @error('minutes')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" type="text"
                                      id="description" name="description"
                                      placeholder="Describe">{{$quiz->description}}</textarea>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <button class="btn btn-outline-success">Update</button>
                        <a class="btn btn-outline-secondary" href="{{route('quizzes.index')}}">
                            Back
                        </a>

                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection
