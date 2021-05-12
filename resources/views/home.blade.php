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
            <div class="d-sm-flex align-items-center justify-content-between mt-4 shado py-2">
                <div>
                    <h4>Meus Atendimentos</h4>
                </div>
                <div>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Novo Atendimento</button>
                </div>
            </div>

            <!-- Modal Criar Atendimento-->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Criar Atendimento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="">Data</label>
                                    <input type="date" class="form-control" name="data" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Cliente</label>
                                    <input type="text" class="form-control" name="cliente" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Tipo de Atendimento</label>
                                    <select class="form-control">
                                        <option selected value="">Selecione o atendimento</option>
                                        <option>Default select</option>
                                        <option>Default select</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Observação</label>
                                    <textarea class="form-control" name="observacao" value="Nenhuma Observação"
                                        placeholder="Nenhuma observação" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Técnico</label>
                                    <input type="text" class="form-control" name="tecnico"
                                        value="{{Auth::user()->name}}" readonly>
                                    <input type="hidden" name="tecnico_id" value="{{Auth::user()->id}}">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fim Modal Criar Atendimento-->

            <div class="mt-2">
                <table class="table table-striped table-hover table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

@endsection