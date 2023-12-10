@extends('admin.layout.app')

@section('css')
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="page-header-content py-3">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 text-gray-800">Sangrias</h1>
            <a href="#" id="btnNovaSangria" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus text-white-50"></i> Nova Sangria
            </a>
        </div>
        <ol class="breadcrumb mb-0 mt-4">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sangrias</li>
        </ol>
    </div>

    <div class="container-fluid">
        <table id="sangriaTable" class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Data</th>
                    <th>Valor</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <!-- Aqui você pode iterar sobre seus dados para preencher a tabela -->
            <tbody>
                {{-- Exemplo de como iterar sobre sangrias --}}
                @foreach ($sangrias as $sangria)
                    <tr>
                        <td>{{ $sangria->id }}</td>
                        <td>{{ $sangria->data }}</td>
                        <td>{{ $sangria->valor }}</td>
                        <td>{{ $sangria->descricao }}</td>
                        <td>
                            <!-- Botão Editar com Modal -->
                            <button class="btn btn-warning btn-editar" data-id="{{ $sangria->id }}" data-toggle="modal"
                                data-target="#editarModal">
                                Editar
                            </button>

                            <!-- Botão Deletar com Modal de Confirmação -->
                            <button class="btn btn-danger btn-deletar" data-id="{{ $sangria->id }}" data-toggle="modal"
                                data-target="#deletarModal">
                                Deletar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal para Nova Sangria -->
    <div class="modal" tabindex="-1" role="dialog" id="novaSangriaModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.sangria.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Nova Sangria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Adicione aqui os campos de data, valor e descrição -->

                        <div class="form-group">
                            <label for="dataInput">Data</label>
                            <input type="text" id="dataInput" name="data" class="form-control datepicker"
                                placeholder="Selecione a Data">
                        </div>
                        <div class="form-group">
                            <label for="valorInput">Valor</label>
                            <input type="text" id="valorInput" name="valor" class="form-control money"
                                placeholder="Informe o Valor">
                        </div>
                        <div class="form-group">
                            <label for="descricaoInput">Descrição</label>
                            <input type="text" id="descricaoInput" name="descricao" class="form-control"
                                placeholder="Informe a Descrição">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- editarModal.blade.php -->

    <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Sangria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Adicione seus campos de edição aqui -->
                    <form id="editarForm">
                        @csrf
                        <div class="form-group">
                            <label for="editData">Data:</label>
                            <input type="text" class="form-control datepicker" id="editData" name="data">
                        </div>
                        <div class="form-group">
                            <label for="editValor">Valor:</label>
                            <input type="text" class="form-control money" id="editValor" name="valor">
                        </div>
                        <div class="form-group">
                            <label for="editDescricao">Descrição:</label>
                            <input type="text" class="form-control" id="editDescricao" name="descricao">
                            <input type="hidden" class="form-control" id="idSangria" name="id_sangria">
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <!-- Adicione os scripts JS necessários para o DataTables e Bootstrap-datepicker -->
    <script>
        // No script jQuery que você já tem
        // ...

        // Manipulação do clique no botão Deletar
        $('.btn-deletar').on('click', function() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var sangriaId = $(this).data('id');


            // Exiba um alerta de confirmação com SweetAlert2
            Swal.fire({
                title: 'Tem certeza?',
                text: 'Você não poderá reverter esta ação!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sim, exclua!',
                cancelButtonText: 'Cancelar'
            }).then(function(result) {
                if (result.isConfirmed) {
                    // Aqui você pode fazer uma chamada AJAX para excluir a sangria
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        url: '/sangria/deletar/' + sangriaId,
                        type: 'DELETE',
                        success: function(response) {
                            // Exiba um alerta de sucesso com SweetAlert2
                            Swal.fire({
                                icon: 'success',
                                title: 'Sucesso',
                                text: 'Sangria Excluída com Sucesso',
                                showConfirmButton: false,
                                timer: 3000 // Tempo em milissegundos, neste caso, 3000 ms (3 segundos)
                            }).then(function() {
                                // Após o tempo definido, recarregue a página
                                location.reload();
                            });
                        },
                        error: function(error) {
                            console.error(error);
                        }
                    });
                }
            });
        });

        // Restante do seu script...

        $(document).ready(function() {
            $('#sangriaTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json" // Adiciona o arquivo de localização para português
                },
                "order": [[0, 'desc']],

            });

            // Inicialize o datepicker
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                language: 'pt-BR', // Define o idioma para português
            });

            // Exibir o modal quando o botão Nova Sangria for clicado
            $('#btnNovaSangria').on('click', function() {
                $('#novaSangriaModal').modal('show');
            });
        });



        // Manipulação do clique no botão Editar
        $('.btn-editar').on('click', function() {
            var sangriaId = $(this).data('id');
            $('#editarModal .modal-body #idSangria').val(sangriaId);

            // Aqui você pode fazer uma chamada AJAX para obter os detalhes da sangria
            $.ajax({
                url: '/sangria/detalhes/' + sangriaId, // Substitua pelo caminho real
                type: 'GET',
                success: function(response) {
                    // Popule o modal com os detalhes da sangria
                    $('#editarModal .modal-body #editData').val(response.data);
                    $('#editarModal .modal-body #editValor').val(response.valor);
                    $('#editarModal .modal-body #editDescricao').val(response.descricao);

                    // Inicialize os campos de data e valor com plugins (datepicker e money)
                    $('#editarModal .datepicker').datepicker({
                        format: 'dd/mm/yyyy',
                        autoclose: true,
                    });
                    $('#editarModal .money').mask('000.000.000,00', {
                        reverse: true
                    });

                    // Abra o modal
                    $('#editarModal').modal('show');
                },
                error: function(error) {
                    console.error(error);
                }
            });


        });

        // Manipulação do envio do formulário de edição
        $('#editarForm').on('submit', function(e) {
            e.preventDefault();

            // Aqui você pode fazer uma chamada AJAX para enviar os dados de edição
            $.ajax({
                url: '/sangria/editar',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {

                    $('#editarModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: 'Sangria Atualizada com Sucesso',
                        showConfirmButton: false,
                        timer: 2000 // Tempo em milissegundos, nest e caso, 3000 ms (3 segundos)
                    }).then(function() {
                        // Após o tempo definido, recarregue a página
                        location.reload();
                    });


                },
                error: function(error) {
                    console.error(error);
                }


                // // Feche o modal
                // $('#editarModal').modal('hide');
            });
        });
    </script>
@endsection
