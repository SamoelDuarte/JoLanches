@extends('admin.layout.app')


@section('css')
@endsection

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Lista de Vendas</h1>

    <table class="table" id="vendas-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Data da Venda</th>
                <th>Total</th>
                <th>Ações</th> <!-- Adicione uma coluna para os botões de ação -->
            </tr>
        </thead>
        <tbody>
            @foreach ($vendas as $venda)
                <tr>
                    <td>{{ $venda->id }}</td>
                    <td>{{ $venda->data_venda }}</td>
                    <td>{{ $venda->total }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm visualizar-btn" data-venda-id="{{ $venda->id }}">
                            Visualizar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal para mostrar detalhes da venda -->
<div class="modal fade" id="detalhesVendaModal" tabindex="-1" role="dialog" aria-labelledby="detalhesVendaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detalhesVendaModalLabel">Detalhes da Venda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detalhesVendaModalBody">
                <!-- Conteúdo da tabela de detalhes será adicionado aqui -->
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script>
 $(document).ready(function () {
    // Inicializa o DataTable
    var table = $('#vendas-table').DataTable();

    // Configuração do botão "Visualizar" usando delegação de eventos
    $('#vendas-table').on('click', '.visualizar-btn', function () {
        var vendaId = $(this).data('venda-id');

        // Exemplo de requisição AJAX (você precisará ajustar isso conforme sua lógica):
        $.ajax({
            url: '/venda/' + vendaId + '/detalhes', // Rota que retorna os detalhes da venda
            type: 'GET',
            success: function (response) {
                $('#detalhesVendaModalBody').html(response);
                // Abre o modal
                $('#detalhesVendaModal').modal('show');
            },
            error: function (error) {
                $('#detalhesVendaModalBody').html('<p>Erro ao carregar detalhes da venda.</p>');
            }
        });
    });
});
</script>

@endsection
