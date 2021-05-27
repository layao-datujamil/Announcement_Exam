@extends('adminlte::page')
@section('title','User Profile | View')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">User Profile</h3>
                </div>
                <div class="card-body">
            
                    <div class="row">
                        <div class="col-md-12">
                            {{-- Name field --}}
                    
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="name" name="name" class="form-control form-control-border border-width-2" disabled
                                    value="{{ $user->name }}">
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
                                    <input type="email" id="email" name="email" class="form-control form-control-border border-width-2"
                                        value="{{ $user->email }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                
                </div>
                <div class="card-footer text-right">
                    <a href="{{route('users.index')}}" class="btn btn-primary">Back</a>
                </div>
            </div>

        </div>
    </div>
@endsection

