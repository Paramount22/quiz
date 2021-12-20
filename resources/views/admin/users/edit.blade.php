@extends('admin.layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">


            <div class="card">
                <div class="card-header">{{ __('Edit User') }}</div>

                <div class="card-body">
                    <form action="{{route('users.update', $user)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"
                                   name="name"
                                   value="{{$user->name}}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" id="email"
                                   name="email" value="{{$user->email}}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror"
                                   type="text" id="password"
                                   name="password" value="{{$user->visible_password}}">
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
                                   name="occupation" value="{{$user->occupation}}">
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
                                   name="address" value="{{$user->address}}">
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
                                   name="phone" value="{{$user->phone}}">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>



                        <button class="btn btn-success">Submit</button>
                        <a class="btn btn-outline-secondary" href="{{route('users.index')}}">
                            Back
                        </a>
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection
