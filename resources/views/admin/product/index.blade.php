@extends('admin.layout.app')


@section('css')
    <style>
        .rounded-image-column img {
            border-radius: 50%;
        }

        .element-center {
            display: flex;
            justify-content: center;
        }
    </style>
@endsection

@section('content')
    <section id="add-product">
        <!-- Page Heading -->
        <div class="page-header-content py-3">

            <div class="d-sm-flex align-items-center justify-content-between">
                <h1 class="h3 mb-0 text-gray-800">Produtos</h1>
                <a href="{{ route('admin.product.create') }}"
                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus text-white-50"></i> Novo Produto
                </a>
            </div>

            <ol class="breadcrumb mb-0 mt-4">
                <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Produtos</li>
            </ol>

        </div>
        <div class="container-fluid">
            <table id="productTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th class="rounded-image-column">Imagem</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Site/Sistema</th>
                        <th class="element-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <img src="{{ $product->sistem ? '/assets/images/sem-imagem.png' : asset($product->image) }}"
                                    alt="Imagem do Produto" class="rounded-circle rounded-product-image"
                                    style="width: 50px; height: 50px;">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{!! $product->description !!}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->sistema_display }}</td>
                            <td style="text-align: center;">
                                <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}"
                                    class="btn btn-primary">Editar</a>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                    data-productid="{{ $product->id }}">Excluir</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



        <!-- Modal de confirmação para exclusão -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar Exclusão</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Tem certeza de que deseja excluir o produto?
                        <input type="hidden" id="productId" name="productId" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <form action="{{ route('admin.product.destroy', '') }}" method="POST" id="deleteForm">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </section>
@endsection
@section('scripts')
    <script>
        $('#productTable').DataTable();
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var productId = button.data('productid');
            var modal = $(this);
            modal.find('#productId').val(productId);
            var deleteUrl = "{{ route('admin.product.destroy', ':id') }}";
            deleteUrl = deleteUrl.replace(':id', productId);
            $('#deleteForm').attr('action', deleteUrl);
        });
    </script>
@endsection
