@extends('layouts.app')
@section('title','Announcements | View')


@section('content')
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">DJ</a>
    
       
    @if (Route::has('login'))
        <div class="text-right">
            @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
            @else
                <a href="{{ route('login') }}">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif
      
  </nav>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Announcements</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">Announcements</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
<section class="content">
    <div class="container-fluid">

      <!-- Timelime example  -->
    <div class="row">
    <div class="col-md-12">
        @php
                 $OldDate ='';
            @endphp
        @foreach ($announcements as $announcement)
            
            <!-- The time line -->
            @php
                $formatteddate = date_format(date_create($announcement->created_at),"Y-m-d");
            @endphp
            
            <div class="timeline">
                @if ($OldDate !=  $formatteddate)
                    <!-- timeline time label -->
                    <div class="time-label">
                        <span class="bg-red">{{  $formatteddate }}</span>
                    </div>
                @endif
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <div>
                    <i class="fas fa-envelope bg-blue"></i>
                    <div class="timeline-item">
                        <h3 class="timeline-header">{{ $announcement->title }}</h3>
  
                        <div class="timeline-body">
                            <?php echo $announcement->content ; ?>
                        </div>
                    </div>
                </div>
                <!-- END timeline item -->
                <!-- timeline item -->
            <div>
            @php
                 $OldDate =  $formatteddate;
            @endphp
        @endforeach
            <i class="fas fa-clock bg-gray"></i>
        </div>
    </div>
</div>
       

</section>


@endsection

