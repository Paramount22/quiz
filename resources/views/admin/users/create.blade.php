@extends('admin.layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('_partials._messages')
            <div class="card">
                <div class="card-header">{{ __('Create User') }}</div>

                <div class="card-body">
                    <form action="{{route('users.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"
                                   name="name"
                                   value="{{old('name')}}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control @error('minutes') is-invalid @enderror" type="email" id="email"
                                   name="email" value="{{old('email')}}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password" id="password"
                                   name="password" value="{{old('password')}}">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="occupation">Occupation</label>
                            <input class="form-control @error('occupation') is-invalid @enderror" type="text"
                                   id="occupation"
                                   name="occupation" value="{{old('occupation')}}">
                            @error('occupation')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input class="form-control @error('address') is-invalid @enderror" type="text"
                                   id="address"
                                   name="address" value="{{old('address')}}">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input class="form-control @error('phone') is-invalid @enderror" type="text"
                                   id="phone"
                                   name="phone" value="{{old('phone')}}">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>



                        <button class="btn btn-outline-success">Submit</button>
                        <a class="btn btn-outline-secondary" href="{{route('users.index')}}">
                            Back
                        </a>
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection
