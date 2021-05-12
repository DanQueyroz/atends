<div class="d-sm-flex align-items-center justify-content-between mt-4 shado py-2">
    <div>
        <h4>Relatório</h4>
    </div>
    <div>
        <form>
            <div class="form-row align-items-center">
              <div class="col-auto my-1">
                <input class="" type="search" name="buscar" placeholder="Cliente, Técnico, Tipo">
              </div>
              <div class="col-auto my-1">
                <button type="submit" class="btn btn-sm btn-primary">Buscar</button>
              </div>
            </div>
        </form>
    </div>
</div>

<div class="">
    <table class="table table-striped table-hover table-dark text-center">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Data</th>
                <th scope="col">Cliente</th>
                <th scope="col">Técnico</th>
                <th scope="col">Tipo de Atendimento</th>
                <th scope="col">Observação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($relatorios as $atendimento)
                <tr>
                    <th scope="row">{{ $atendimento->id }}</th>
                    <td>{{ $atendimento->data }}</td>
                    <td>{{ $atendimento->cliente }}</td>
                    <td>{{ $atendimento->tecnico }}</td>
                    <td>{{ $atendimento->tipo }}</td>
                    <td>{{ $atendimento->observacao}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>