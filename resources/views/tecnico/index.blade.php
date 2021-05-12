<div class="d-sm-flex align-items-center justify-content-between mt-4 shado py-2">
    <div>
        <h4>Meus Atendimentos</h4>
    </div>
    <div>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Novo
            Atendimento</button>
    </div>
</div>

<!-- Modal Criar Atendimento-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('criar.atendimento') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Criar Atendimento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    @csrf
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
                        <select class="form-control" name="tipo_de_atendimento" required>
                            <option selected value="">Selecione o atendimento</option>
                            @foreach ($meus_atendimento as $tipo)
                                <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Observação</label>
                        <textarea class="form-control" name="observacao" value="Nenhuma Observação"
                            placeholder="Nenhuma Observação"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Técnico</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                        <input type="hidden" name="tecnico_id" value="{{ Auth::user()->id }}">
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
<!-- Fim Modal Criar Atendimento-->

<div class="mt-2">
    <table class="table table-striped table-hover table-dark text-center">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Data</th>
                <th scope="col">Cliente</th>
                <th scope="col">Observação</th>
            </tr>
        </thead>
        <tbody>
            @foreach (Auth::user()->atendimentos as $atendimento)
                <tr>
                    <th scope="row">{{ $atendimento->id }}</th>
                    <td>{{ date('d/m/Y', strtotime($atendimento->data_da_execucao)) }}</td>
                    <td>{{ $atendimento->cliente }}</td>
                    <td>{{ $atendimento->observacao }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>