@extends('admin.layout.app')

@section('css')
@endsection

@section('content')
    <section id="add-shopping-list">
        <!-- Page Heading -->
        <div class="page-header-content py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h1 class="h3 mb-0 text-gray-800">Lista de Compras</h1>
            </div>

            <ol class="breadcrumb mb-0 mt-4">
                <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lista de Compras</li>
            </ol>
        </div>
        <!-- Mensagem de Erro -->
        <div id="error-message" class="alert alert-danger" style="display:none;"></div>
        <div class="container-fluid">
            <!-- Formulário de Adição de Produto -->
            <!-- Formulário de Adição de Item -->
            <form id="addItemForm">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control" placeholder="Nome do Item">
                    </div>
                    <div class="col-md-6">
                        <button type="button" id="addItemBtn" class="btn btn-success">Adicionar Item</button>
                    </div>
                </div>
            </form>

            <div class="container-fluid">
                <!-- Tabela de Vendas -->
                <table id="vendas-table" class="table vendas-table" style="width:100%">
                    <!-- ... (Cabeçalho da tabela) -->
                </table>
            </div>
        </div>

        <!-- Modal de confirmação para exclusão -->
        <!-- ... (O conteúdo do modal permanece o mesmo) -->

    </section>
@endsection
<!-- Scripts -->
@section('scripts')
   
    <script>
        $(document).ready(function() {
            // Configuração inicial da tabela
            function configurarTabela() {
                $('#vendas-table').DataTable({
                    ajax: {
                        url: "{{ route('admin.shopping_list.getItens') }}",
                        type: "GET",
                        dataSrc: ''
                    },
                    columns: [{
                            data: 'name'
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                console.log(row);
                                // Adiciona um botão de exclusão
                                return '<button class="btn btn-danger btn-sm" onclick="excluirItem(' +
                                    row.id + ')">Excluir</button>';
                            }
                        }
                    ]
                });
            }

            // Chama a função para configurar e exibir a tabela
            configurarTabela();

            // Função para adicionar um novo item
            $('#addItemBtn').click(function() {
                var itemName = $('input[name="name"]').val();

                if (itemName.trim() === "") {
                    // Exibir mensagem de erro se o campo estiver vazio
                    $('#error-message').text('O nome do item é obrigatório.').show();
                    return;
                }

                // Esconder a mensagem de erro se estiver visível
                $('#error-message').hide();

                // Adicionar o novo item à tabela
                $.ajax({
                    url: "{{ route('admin.shopping-list.store') }}",
                    type: "POST",
                    data: {
                        name: itemName,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data['success']) {
                            $('#vendas-table').DataTable().destroy();
                            configurarTabela();

                            // Exibir uma mensagem de sucesso
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: "Salvo Com Sucesso",
                            })
                        }
                    },
                    error: function(xhr, status, error) {
                        // Exibir mensagem de erro se houver problemas
                        var errorMessage = xhr.responseJSON.message;
                        $('#error-message').text(errorMessage).show();
                    }
                });
            });

            // Função para excluir um item
            window.excluirItem = function(itemId) {
                // Solicitar confirmação antes de excluir
                Swal.fire({
                    title: 'Você tem certeza?',
                    text: "Você não poderá reverter isso!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sim, exclua!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Confirmado, proceder com a exclusão via AJAX
                        $.ajax({
                            url: "{{ route('admin.shopping-list.destroy') }}",
                            type: "DELETE",
                            data: {
                                id: itemId,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(data) {
                                if (data['success']) {
                                    // Atualizar a tabela após excluir um item
                                    $('#vendas-table').DataTable().destroy();
                                    configurarTabela();

                                    // Exibir uma mensagem de sucesso
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 5000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.addEventListener('mouseenter',
                                                Swal.stopTimer)
                                            toast.addEventListener('mouseleave',
                                                Swal.resumeTimer)
                                        }
                                    })

                                    Toast.fire({
                                        icon: 'success',
                                        title: "Excluído Com Sucesso",
                                    })
                                }
                            },
                            error: function(xhr, status, error) {
                                // Exibir mensagem de erro se houver problemas
                                var errorMessage = xhr.responseJSON.message;
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erro',
                                    text: errorMessage
                                });
                            }
                        });
                    }
                });
            };
        });
    </script>
@endsection
