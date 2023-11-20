@extends('admin.layout.app')

@section('css')
<style>
    .note-editable{
        height: 90px !important;
    }
</style>
@endsection

@section('content')
    <section id="edit-product">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Adicione isso para indicar que é uma atualização -->
            <div class="row">
                <div class="col-md-6">
                    <div class="text-center">
                        <div style="display: inline-grid;">
                            <img id="previewImage" src="{{ $product->image ? asset( $product->image) : "/assets/images/sem-imagem.png" }}" alt="Preview" class="rounded-circle" style="width: 150px; height: 150px;">
                            <label for="imageInput" style="cursor: pointer">
                                <i class="fas fa-camera"></i> Alterar Imagem
                            </label>
                            <input type="file" id="imageInput" name="imageInput" style="display: none">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nome do produto" value="{{ $product->name }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <textarea name="description" id="description" class="form-control summernote" placeholder="Descrição do produto">
                            {{ $product->description }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Categoria</label>
                        <select name="category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="price">Preço</label>
                        <input type="text" name="price" id="price" class="form-control money" placeholder="Preço do produto" value="{{ $product->price }}">
                    </div>
                    <div class="form-group">
                        <label for="price">Site/Sistema</label>
                        <select name="sistem" class="form-control">
                      
                                <option value="1" {{ $product->sistem == 1 ? 'selected' : '' }}>Sistema</option>
                                <option value="0" {{ $product->sistem == 0 ? 'selected' : '' }}>Site</option>
                        
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </div>
        </form>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#imageInput').change(function() {
                readURL(this);
            });

            $('.summernote').summernote({
                height: 200,
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
        });
    </script>
@endsection
