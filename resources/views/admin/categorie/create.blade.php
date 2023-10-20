@extends('admin.layout.app')


@section('css')
   
@endsection

@section('content')
   
        <div class="page-header-content py-3">

            <div class="d-sm-flex align-items-center justify-content-between">
                <h1 class="h3 mb-0 text-gray-800">Nova Categorias</h1>
           
            </div>

            <ol class="breadcrumb mb-0 mt-4">
                <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.categorie.index') }}">Categorias</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nova Categorias</li>
            </ol>

        </div>


        <form action="{{ url('/categorias') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome da Categoria:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
        </form>

        
    


  
@endsection
@section('scripts')
   

@endsection
