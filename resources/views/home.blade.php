@extends('layouts.dashboard')

@section('content')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="chartjs-size-monitor">
            <div class="chartjs-size-monitor-expand">
                <div class=""></div>
            </div>
            <div class="chartjs-size-monitor-shrink">
                <div class=""></div>
            </div>
        </div>

        <div class="container">
            <!-- Exibindo success -->
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <strong>{{ Session::get('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Exibindo errors -->
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <strong>{{ Session::get('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (Auth::user()->role == 0)
                @include('gestor.index')
            @else    
                @include('tecnico.index')
            @endif
            
        </div>
    </main>

@endsection
