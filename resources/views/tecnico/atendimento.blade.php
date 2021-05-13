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
        <div class="card mt-5 w-50">

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

            <div class="card-header">
                <h4>Editar Atendimento</h4>
            </div>
            <div class="card-body">
                <form action="{{route('editar.atendimento')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Data</label>
                        <input type="date" value="{{date('Y-m-d', strtotime($atendimento->data_da_execucao))}}" class="form-control" name="data" required>
                    </div>
                    <div class="form-group">
                        <label for="">Cliente</label>
                        <input type="text" value="{{$atendimento->cliente}}" class="form-control" name="cliente" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tipo de Atendimento</label>
                        <select class="form-control" name="tipo_de_atendimento" required>
                            <option selected value="{{$atendimento->tipo_atendimento_id}}">{{$atendimento->tipo->nome}}</option>
                            @foreach ($tipos as $tipo)
                                <option  value="{{$tipo->id}}">{{$tipo->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Observação</label>
                        <textarea class="form-control" name="observacao" value="{{$atendimento->observacao}}"
                            placeholder="{{$atendimento->observacao}}"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Técnico</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                        <input type="hidden" name="tecnico_id" value="{{ Auth::user()->id }}">
                    </div>
                    <input type="hidden" value="{{$atendimento->id}}" name="atendimento_id">
                    <button class="btn btn-primary w-25">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection



