<!-- resources/views/admin/sale/detalhes.blade.php -->

<h3>Detalhes da Venda #{{ $venda->id }}</h3>
<p>Data da Venda: {{ $venda->data_venda }}</p>
<p>Total: {{ $venda->total }}</p>

<!-- Detalhes dos Produtos -->
<h4>Produtos:</h4>
<table class="table">
    <thead>
        <tr>
            <th>Nome do Produto</th>
            <th>Quantidade</th>
            <th>Valor Unitário</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($venda->vendaItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantidade }}</td>
                <td>{{ $item->product->price }}</td>
                <td>{{ $item->quantidade * $item->product->price }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Detalhes das Formas de Pagamento -->
<h4>Formas de Pagamento:</h4>
<table class="table">
    <thead>
        <tr>
            <th>Nome da Forma de Pagamento</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
    
        @foreach ($venda->vendaFormaPagamentos as $formaPagamento)

        {{-- {{ dd($formaPagamento)  }} --}}
            <tr>
                <td>{{ $formaPagamento->formaPagamento->nome }}</td>
                <td>{{ $formaPagamento->valor }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
