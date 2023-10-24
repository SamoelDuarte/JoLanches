@extends('layouts/main')

<style>
    .card-cardapio{
        background: #ffffff96;
    padding: 8px;
    border-radius: 20px;
    border-style: double;
    margin-top: 65px;
    }
</style>

@section('content')



<div class="card-cardapio">
    @foreach ($categories as $categorie)
    <div class="py-content">
        <div>
            <div class="text-center">
                <h3 class="title-section text-uppercase category-title">{{ $categorie->name }}</h3>
            </div>
        </div>
        <div class="row">
            @foreach ($categorie->produtos as $produtos)
            <div class="col-md-6">
                <div class="product">
                    <div class="product-name">{{ $produtos->name }}</div>
                    <div class="dots">
                        <span class="dots-line"></span>
                    </div>
                    <div class="product-price">R$ {{ $produtos->price }}</div>
                </div>
                <div class="description">{!! $produtos->description !!}</div>
            </div>
            @endforeach
           
           
    
        </div>
    
    
    
    </div>
    @endforeach
</div>

 
@endsection
