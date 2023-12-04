@extends('admin.layout.app')


@section('css')
    <style>
        .note-editable {
            height: 90px !important;
        }
    </style>
@endsection

@section('content')
    <section id="add-product">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="text-center">
                        <div style="display: inline-grid;">
                            <img id="previewImage" src="/assets/images/sem-imagem.png" alt="Preview" class="rounded-circle"
                                style="width: 150px; height: 150px;">
                            <label for="imageInput" style="cursor: pointer">
                                <i class="fas fa-camera"></i> Adicionar Imagem
                            </label>
                            <input type="file" id="imageInput" name="imageInput" style="display: none;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <textarea name="description" id="description" class="form-control summernote" placeholder="Descrição do produto">
                            {{ old('description') }}
                        </textarea>
                    </div>




                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Nome do produto" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="name">Categoria</label>
                        <select name="category_id" class="form-control">
                            <option value="">__SELECIONE__</option>
                            @foreach ($categories as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="price">Preço</label>
                        <input type="text" name="price" id="price" class="form-control money"
                            placeholder="Preço do produto" value="{{ old('price') }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Site/Sistema</label>
                        <select name="sistem" class="form-control">

                            <option value="0">Site</option>
                            <option value="1">Sistema</option>

                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar</button>

                </div>
        </form>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#imageInput').change(function() {
                readURL(this);
            });

            $('.summernote').summernote({
                height: 90,
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
