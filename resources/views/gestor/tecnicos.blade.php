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
            <div class="d-sm-flex align-items-center justify-content-between mt-4 shado py-2">
                <div>
                    <h4>Tipos de Atendimentos</h4>
                </div>
                <div>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Criar
                        novo</button>
                </div>
            </div>

            <!-- Modal Criar Tipo de Atendimento -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('criar.tecnico') }}" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Criar Atendimento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @csrf
                                <div class="form-group">
                                    <label for="">Nome</label>
                                    <input type="text" class="form-control" name="nome" required>
                                </div>
                                <div class="form-group">
                                    <label for="">E-mail</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Senha</label>
                                    <input type="password" class="form-control" name="senha" min="4" max="25" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Fim Modal Criar Tipo de Atendimento-->

            <div class="">
                <table class="table table-striped table-hover table-dark text-center">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tecnicos as $tecnico)
                            <tr>
                                <th scope="row">{{ $tecnico->id }}</th>
                                <td>{{ $tecnico->name }}</td>
                                <td>{{ $tecnico->email }}</td>
                                @if ($tecnico->status == 1)
                                    <td>Ativo</td>
                                @else
                                    <td>Desativado</td>
                                @endif
                                <td class="">
                                    <div class="row align-items-center">
                                        <form class="mx-1" action="{{route('desativar.tecnico')}}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{$tecnico->id}}" name="tecnico_id">
                                            <input type="hidden" value="0" name="ative">
                                            <button  type="submit" class="btn btn-sm btn-secondary" onclick="return confirm(&quot;Deseja realmente desativaro tecnico {{$tecnico->name}}?&quot;)">Desativar</button>
                                        </form>
                                        <form class="mx-1" action="{{route('excluir.tecnico')}}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{$tecnico->id}}" name="tecnico_id">
                                            <button  type="submit" class="btn btn-sm btn-danger" onclick="return confirm(&quot;Deseja realmente excluir o tipo {{$tecnico->name}}?&quot;)">Excluir</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

@endsection
