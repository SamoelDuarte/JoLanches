@extends('admin.layout.app')


@section('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Primeira coluna -->
            <div class="col-md-6">
                <h4>Itens da Venda</h4>
                <table class="table table-bordered tabelaVenda" id="tabelaVenda">
                    <thead>
                        <tr>
                            <th>Nome do Produto</th>
                            <th>Quantidade</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Adicione dinamicamente as linhas da tabela com os itens da venda -->
                        <!-- Exemplo: -->
                        <tr>
                        </tr>
                        <!-- ... adicione mais linhas conforme necessário -->
                    </tbody>
                </table>
            </div>

            <!-- Segunda coluna -->
            <div class="col-md-6">
                <h4>Adicionar Produto</h4>
                <div class="form-group">
                    <label for="produtoSelect">Selecione um Produto:</label>
                    <select class="form-control" id="produtoSelect">
                        <!-- Opções dinâmicas do banco de dados ou outro meio -->
                    </select>
                </div>

            </div>
        </div>

        <div class="row mt-4">
            <!-- Terceira coluna -->
            <div class="col-md-6">
                <h4>Formas de Pagamento</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nome da Forma de Pagamento</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Adicione dinamicamente as linhas da tabela com as formas de pagamento -->
                        <!-- Exemplo: -->
                        <tr>
                            <td>PIX</td>
                            <td>R$ 30,00</td>
                        </tr>
                        <!-- ... adicione mais linhas conforme necessário -->
                    </tbody>
                </table>
            </div>

            <!-- Quarta coluna -->
            <div class="col-md-6">
                <h4>Valor Total</h4>
                <!-- Exiba dinamicamente o valor total da venda -->
                <p class="lead">R$ 50,00</p>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#produtoSelect').select2({
                ajax: {
                    url: '/venda/buscar-produtos', // Endpoint para buscar produtos
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        var results = data.map(function(produto) {
                            return {
                                id: produto.id,
                                text: produto.name + ' - ' + formatarPreco(produto
                                .price), // Concatenando nome e preço
                                produtoGet: produto // Armazenando informações adicionais se necessário
                            };
                        });

                        return {
                            results: results
                        };
                    },
                    cache: true
                },
                placeholder: 'Selecione um Produto',
                minimumInputLength: 3 // Número mínimo de caracteres para acionar a busca
            });

            $('#produtoSelect').on('change', function(e) {
                var produtoSelecionado = $(this).select2('data')[0].produtoGet;

                adicionarLinhaTabela(produtoSelecionado);

                $(this).val(null).trigger('change');
            });

            function adicionarLinhaTabela(newProduto) {
                var tabela = $('#tabelaVenda tbody');

                var novaLinha = $('<tr>');
                novaLinha.append($('<td>').text(newProduto.name));
                novaLinha.append($('<td>').text('1'));
                novaLinha.append($('<td>').text(formatarPreco(newProduto.price)));

                // Adicionar coluna de ação (botão Delete)
                var colunaAcao = $('<td>');
                var botaoDelete = $('<button>').text('Delete').addClass('btn btn-danger btn-sm');
                botaoDelete.on('click', function() {
                    // Chamada da função para remover a linha
                    removerLinhaTabela(novaLinha);
                });
                colunaAcao.append(botaoDelete);
                novaLinha.append(colunaAcao);

                tabela.append(novaLinha);
            }

            function removerLinhaTabela(linha) {
                linha.remove();
            }

            function formatarPreco(preco) {
                preco = parseFloat(preco);
                return 'R$ ' + preco.toFixed(2);
            }
        });
    </script>
@endsection
