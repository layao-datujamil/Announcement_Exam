@extends('adminlte::page')
@section('title','Announcement | Create')
@section('plugins.tempusdominus',true)
@section('plugins.SummerNote',true)
@section('plugins.Sweetalert2',true)
@section('content_header')
    <h1>Announcement</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('announcements.store')}}" method="post">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">New Announcement</h3>
                    </div>
                    <div class="card-body">
                        
                        @csrf
                
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <div class="input-group mb-3">
                                        <input type="text" id="title" name="title" class="form-control form-control-border border-width-2 {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                        value="{{ old('title') }}" placeholder="Title" autofocus>
                                        @if($errors->has('title'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                
                                <label for="startdate">Start Date:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group date" id="start_date"  data-target-input="nearest">
                                        <input type="text" id="startdate"  class="form-control datetimepicker-input {{ $errors->has('startdate') ? 'is-invalid' : '' }}" name="startdate" data-target="#start_date"/>
                                        <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        @if($errors->has('startdate'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('startdate') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="col-md-6">
                                <div class="row">
                                    
                                    <label for="enddate">End Date:</label>
                                
                                
                                    <div class="input-group mb-3">
                                        <div class="input-group date" id="end_date"  data-target-input="nearest">
                                            <input type="text" id="enddate"  class="form-control datetimepicker-input {{ $errors->has('enddate') ? 'is-invalid' : '' }}" name="enddate" data-target="#end_date"/>
                                            <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                            @if($errors->has('enddate'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('enddate') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="content" id="summernote" class="{{ $errors->has('content') ? 'is-invalid' : '' }}">{{ old('content') }}</textarea>
                                @if($errors->has('content'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{route('announcements.index')}}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
<script>

    $(document).ready(function(){
        var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        });
        var currentDate = new Date();
        var tommorowDate = new Date();
        @if(old('startdate')!="")
            currentDate = moment("{{ old('startdate') }}","MM-DD-YYYY").toDate();
        @endif
        tommorowDate.setDate(currentDate.getDate() + 1);
        @if(old('enddate')!="")
            tommorowDate = moment("{{ old('enddate') }}","MM-DD-YYYY").toDate();
        @endif
        $('#start_date').datetimepicker({
            format: 'L',
            defaultDate: currentDate, 
            change: function(dateText) {
                console.log('a');
            }
        });
        $('#end_date').datetimepicker({
            format: 'L',
            defaultDate: tommorowDate, 
            change: function(dateText) {
                console.log('a');
            }
        });
        $('#summernote').summernote({
            height: 300
        });
        @if (\Session::has('error'))
        Toast.fire({
            type:'error',
            title:"{{ \Session::get('error') }}"
        });
    @endif
    });
</script>
    
@endsection


