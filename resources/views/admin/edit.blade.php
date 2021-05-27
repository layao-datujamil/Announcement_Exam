@extends('adminlte::page')
@section('title','User Profile | Edit')

@section('content_header')
    <h1>User Profile</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="/users/{{ $user->id }}" method="post">
                @method('patch')
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Edit User</h3>
                    </div>
                    <div class="card-body">
                        
                        @csrf
                
                        <div class="row">
                            <div class="col-md-12">
                                {{-- Name field --}}
                        
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <div class="input-group mb-3">
                                        <input type="text" id="name" name="name" class="form-control form-control-border border-width-2 {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        value="{{ old('name') ?? $user->name }}" placeholder="Full name" autofocus>

                                        @if($errors->has('name'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                {{-- Email field --}}
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <div class="input-group mb-3">
                                        <input type="email" id="email" name="email" class="form-control form-control-border border-width-2 {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                            value="{{ old('email') ?? $user->email }}" placeholder="Email">
                                        
                                        @if($errors->has('email'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                
                        <div class="row">
                            <div class="col-md-12">
                                {{-- Password field --}}
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <div class="input-group mb-3">
                                        <input type="password" id="password" name="password"
                                            value="{{ old('password') ?? $user->password }}" class="form-control form-control-border border-width-2 {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                            placeholder="Password">
                                        
                                        @if($errors->has('password'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{-- Confirm password field --}}
                                <div class="form-group">
                                    <label for="password_confirmation">Retype Password:</label>
                                    <div class="input-group mb-3">
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            value="{{ old('password') ?? $user->password }}" class="form-control form-control-border border-width-2 {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                            placeholder="Retype password">
                                        
                                        @if($errors->has('password_confirmation'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> 
                    
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{route('users.index')}}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


