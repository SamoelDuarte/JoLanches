@extends('admin.layout.app')


@section('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <style>
        .lista-caixa {
            display: flex;
            flex-direction: column;
            margin-top: 40px;
            position: absolute;
            right: 19px;
            bottom: 31px;
        }

        .item {
            text-align: center;
            font-size: 60px;
        }

        .titulo {
            font-weight: bold;
        }

        .valor {
            color: green;
            /* ou outra cor desejada */
            font-size: 1.2em;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid mt-4 h-100 ">
        <form id="vendaForm" method="POST" action="{{ route('admin.sale.store') }}">
            @csrf
            <input type="hidden" id="totalVendasInput" name="total_vendas" value="">
            <div class="row h-50">
                <!-- Primeira coluna -->
                <div class="col-md-6 h-100 d-flex flex-column">
                    <h4>Itens da Venda</h4>
                    <table class="table table-bordered tabelaVenda" id="tabelaVenda">
                        <thead>
                            <tr>
                                <th>Nome do Produto</th>
                                <th>Quantidade</th>
                                <th>Valor</th>
                                <th>Total</th>
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
                    <div>
                        <h4>Formas de Pagamento</h4>
                        <table class="table table-bordered tabelaFormPaid" id="tabelaFormPaid">
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

                                </tr>
                                <!-- ... adicione mais linhas conforme necessário -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Segunda coluna -->
                <div class="col-md-6 h-100 d-flex flex-column">
                    <div class="col-md-6">
                        <button class="btn btn-info" type="button" onclick="addVariedade()">Variedade <i
                                class="fas fa-plus"></i></button>
                        <button class="btn btn-info" type="button" onclick="addProduto()">Novo Produto <i
                                class="fas fa-plus"></i></button>
                    </div>
                    <h4>Adicionar Produto</h4>
                    <div class="form-group">
                        <select class="form-control" id="produtoSelect">
                            <!-- Opções dinâmicas do banco de dados ou outro meio -->
                        </select>
                    </div>


                </div>

            </div>
        </form>
    </div>

    <div class="lista-caixa align-self-end ms-auto">

        <div class="item">
            <span class="titulo">Valor Total</span>
            <span class="valor" id="valorTotal">R$ 0,00</span>
        </div>
        <div class="">
            <button class="btn btn-success" onclick="finalizarVenda()">Finalizar</button>
            <button type="button" class="btn btn-primary" id="btnAbrirModalFormaPagamento">Adicionar Pagamento</button>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal  modalQuantidade fade" tabindex="-1" id="modalQuantidade" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informe a Quantidade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="quantidadeInput">Quantidade:</label>
                    <input type="number" class="form-control" id="quantidadeInput" placeholder="Quantidade"
                        onkeypress="checarTeclaEnter(event)">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" onclick="adicionarComQuantidade()">Adicionar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal modalProduto fade" id="modalProduto" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="productForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Nome do produto" value="{{ old('name') }}">
                                </div>

                                <div class="form-group">
                                    <label for="price">Preço</label>
                                    <input type="text" name="price" id="price" class="form-control money"
                                        placeholder="Preço do produto" value="{{ old('price') }}">
                                </div>

                                <div class="form-group" hidden>
                                    <label for="name">Site/Sistema</label>
                                    <select name="sistem" class="form-control">
                                        <option value="1" selected>Sistema</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="newProduct()" class="btn btn-primary">Salvar</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal modalFormaPagamento fade" id="modalFormaPagamento" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Forma de Pagamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <label for="quantidadeInput">Valor:</label>
                            <input type="text" class="form-control money" id="valorFormPagamentos"
                                placeholder="Valor">
                        </div>
                        <div class="form-group">
                            <label for="quantidadeInput">Forma de Pagamento</label>
                            <select name="form_pagamento" class="form-control" id="form_pagamento">
                                @foreach ($formaPagamentos as $formaPagamento)
                                    <option value="{{ $formaPagamento->id }}">{{ $formaPagamento->nome }}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary"
                        onclick="adicionarFormadePagamento()">Adicionar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <script>
        function newProduct() {
            // Coletar dados do formulário
            var formData = new FormData($('#productForm')[0]);

            // Enviar uma solicitação Ajax
            $.ajax({
                url: "{{ route('admin.product.storeSistem') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data.success) {

                        // Fechar o modal (opcional)
                        $('#modalProduto').modal('hide');

                        // Limpar o formulário (opcional)
                        $('#productForm')[0].reset();

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
                    alert('Erro ao salvar o produto. Por favor, tente novamente.');
                }
            });
        }

        var produtoSelected; // Declaramos fora da função para ter escopo global
        var modalAberto = false;

        function addVariedade() {
            alert('dsfs');
        }

        function addProduto() {
            $('#modalProduto').modal('show');
        }

        $(document).ready(function() {
            $('#produtoSelect').select2({
                ajax: {
                    url: '/venda/buscar-produtos',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        var results = data.map(function(produto) {
                            return {
                                id: produto.id,
                                text: produto.name + ' - ' + formatarPreco(produto.price),
                                produtoGet: produto
                            };
                        });

                        return {
                            results: results
                        };
                    },
                    cache: true
                },
                placeholder: 'Selecione um Produto',
                minimumInputLength: 3
            });

            $('#produtoSelect').on('change', function(e) {
                var produtoSelecionado = $(this).select2('data')[0].produtoGet;
                produtoSelected = produtoSelecionado;
                exibirModalQuantidade(produtoSelecionado);
            });

            function exibirModalQuantidade(produto) {
                $('.modalQuantidade').modal('show');

                $('#quantidadeInput').focus();
                modalAberto = true;

            }


        });

        $('.modalQuantidade').on('shown.bs.modal', function() {
            $('#quantidadeInput').focus();

        });

        // Função para adicionar com quantidade, precisa ser global
        function adicionarComQuantidade() {
            var quantidade = $('#quantidadeInput').val();
            if (quantidade !== "") {
                adicionarLinhaTabela(quantidade);
                $('.modalQuantidade').modal('hide');
                modalAberto = false;
            }
        }


        var totais = []; // Lista para armazenar os totais associados a cada linha
        var valorTotal = 0; // Variável para armazenar o valor total global

        function adicionarLinhaTabela(quantidade) {
            var tabela = $('#tabelaVenda tbody');

            var precoUnitario = parseFloat(produtoSelected.price);
            var totalLinha = quantidade * precoUnitario;



            // Adiciona o total da linha à lista
            totais.push(parseFloat(totalLinha));

            // console.log('totais' + totais);

            // Atualiza o valor total global
            valorTotal = totais.reduce((total, valor) => total + valor, 0);

            // alert("Valor Total"+valorTotal);





            // Cria a nova linha
            var novaLinha = $('<tr>');
            novaLinha.append($('<td>').text(produtoSelected.name));
            novaLinha.append($('<td>').text(quantidade));
            novaLinha.append($('<td>').text(formatarPreco(precoUnitario)));
            novaLinha.append($('<td>').text(formatarPreco(totalLinha)));

            // Adiciona um input oculto com id "produto_quantidade" na nova linha
            novaLinha.append($('<input>').attr('type', 'hidden').attr('id', 'produto_id').attr('name', 'produto_id[]').val(
                produtoSelected.id));
            novaLinha.append($('<input>').attr('type', 'hidden').attr('id', 'produto_quantidade').attr('name',
                'produto_quantidade[]').val(quantidade));


            // Adiciona a coluna de ação (botão Delete)
            var colunaAcao = $('<td>');
            var botaoDelete = $('<button>').text('Delete').addClass('btn btn-danger btn-sm');
            botaoDelete.on('click', function() {
                // Obtém o total associado à linha antes de remover a linha
                var index = tabela.find('tr').index(novaLinha) - 1;
                var totalRemover = totais[index];

                // Remove a linha da tabela
                removerLinhaTabela(novaLinha);

                // Atualiza o valor total global removendo o total associado à linha
                valorTotal -= totalRemover;
                $('#valorTotal').text(calcularTotalVenda());


                // Remove o total associado à linha da lista
                totais.splice(index, 1);
            });
            colunaAcao.append(botaoDelete);
            novaLinha.append(colunaAcao);

            tabela.append(novaLinha);

            $('#valorTotal').text(calcularTotalVenda());
        }

        function removerLinhaTabela(linha) {
            // Remove a linha da tabela
            linha.remove();
        }
        // Função para adicionar uma nova linha à tabela


        function adicionarFormadePagamento() {

            var valorFormaPagamento = parseFloat($('#valorFormPagamentos').val().replace(',', '.'));
            var tabelaFromPaid = $('#tabelaFormPaid tbody');

            var valor = $("#valorFormPagamentos").val();
            var formaPagamentoId = $("#form_pagamento").val();
            var formaPagamentoNome = $("#form_pagamento option:selected").text();



            // Verifica se o valor da forma de pagamento é maior que o valor total

            // alert(valorFormaPagamento + '   valor 2  '+valorTotal);
            if (valorFormaPagamento > Number(valorTotal).toFixed(2)) {
                // Exibe uma mensagem de alerta
                alert('O valor da forma de pagamento é maior que o valor total.');
                return; // Sai da função sem realizar a adição
            }

            // Atualiza o valor total global removendo o valor da forma de pagamento
            // Atualiza o valor total global removendo o valor da forma de pagamento


            valorTotal -= valorFormaPagamento;

            // alert('Valor aki'+valorTotal);

            // Verifica se o valorTotal é NaN ou vazio
            if (isNaN(valorTotal) || valorTotal === "") {

                valorTotal = 0.00;
            }

            $('#valorTotal').text(formatarPreco(valorTotal));

            // Outras ações relacionadas à adição da forma de pagamento
            // ...

            // Fecha o modal
            $('#modalFormaPagamento').modal('hide');

            var novaLinha = $("<tr>")
                .append($("<td>").text(formaPagamentoNome))
                .append($("<td>").text(formatarPreco(valor)))
                .append($("<td>").html(
                    `<button type='button' class='btn btn-danger' onclick='excluirFormadePagamento(this)'>Excluir</button>`
                ))
                .append($("<input>").attr('type', 'hidden').attr('name', 'form_pagamento_id[]').val(formaPagamentoId))
                .append($("<input>").attr('type', 'hidden').attr('name', 'form_pagamento_valor[]').val(formatarPreco(
                    valor)));;




            // Adiciona a nova linha à tabela
            $("#tabelaFormPaid tbody").append(novaLinha);

            // Fecha o modal
            $("#modalFormaPagamento").modal("hide");
            finalizarVenda();
        }

        function removerLinhaTabela(linha) {
            linha.remove();
        }

        function formatarPreco(preco) {
            preco = parseFloat(preco);
            return preco.toFixed(2);
        }

        // Função para verificar se a tecla pressionada é "Enter"
        function checarTeclaEnter(event) {
            if (event.keyCode === 13 && modalAberto) {
                adicionarComQuantidade();
            }
        }

        $(document).keydown(function(e) {
            // Verifica se a tecla "Insert" foi pressionada
            if (e.which === 45) {
                // Abre o Select2
                $('#produtoSelect').select2('open');
            }
        });
        $(document).keydown(function(e) {
            // Verifica se a tecla pressionada é a tecla "Enter" (código 13)
            if (e.which === 35 || e.keyCode === 35 || e.key === "End") {
                // Aciona o botão "Finalizar"
                finalizarVenda()
                $('#form_pagamento').focus();
            }
        });

        $('#btnAbrirModalFormaPagamento').on('click', function() {
            // Exibir o modal
            $('#modalFormaPagamento').modal('show');
        });

        // Exclui a forma de pagamento da tabela
        function excluirFormadePagamento(button) {
            // Obtém a linha da tabela que contém o botão clicado
            var row = $(button).closest("tr");

            // Obtém o valor associado à linha antes de remover a linha
            var valorRemover = parseFloat(row.find('td:eq(1)').text().replace(',', '.'));

            // Remove a linha da tabela
            row.remove();

            // Atualiza o valor total global adicionando o valor associado à linha removida
            valorTotal += valorRemover;
            $('#valorTotal').text(formatarPreco(valorTotal));
        }

        function finalizarVenda() {

            if ($('#tabelaVenda tbody tr').length === 1) {
                alert('Não há produtos na venda. Adicione produtos antes de finalizar.');
                return;
            }

            // Lógica de submissão ou qualquer outra coisa que você precise fazer ao finalizar a venda
            // ...

            // Preenche o campo de valor no modal
            $("#valorFormPagamentos").val(formatarPreco(valorTotal));



            // Atualiza o campo oculto no formulário principal (vendaForm)
            $("#totalVendasInput").val(calcularTotalVenda());

            if (valorTotal === 0) {
                //  alert('chamasubmit valor '+valorTotal);
                $('#vendaForm').submit();
            } else {
                // Abre o modal
                $('#modalFormaPagamento').modal('show');

                $('#form_pagamento').focus();

                // Se o valor for zero, submeta o formulário
            }




        }

        function calcularTotalVenda() {
            var totalVendas = 0;

            $('#tabelaVenda tbody tr').each(function() {
                var totalLinhas = $(this).find('td:eq(3)').text().trim();
                totalLinhas = totalLinhas.replace('R$', '').replace(',', '.').trim();

                if (totalLinhas !== "") {
                    totalVendas += parseFloat(totalLinhas);
                }
            });

            return totalVendas.toFixed(2);
        }
    </script>
@endsection
