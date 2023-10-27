@extends('layouts/main')

<style>
    .card-cardapio {
        background: #ffffff96;
        padding: 8px;
        border-radius: 20px;
        border-style: double;
        margin-top: 65px;
    }

    /* Estilos para o banner */
    /* Estilos para o banner */
    .banner {
        background-image: url('upload/banner.jpg');
        background-size: cover;
        background-position: center;
        padding: 20px;
        text-align: center;
        margin-top: 20px;
        /* Adiciona margem superior */
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
    }

    /* Estilos gerais para os cards */
    .card {
        width: 300px;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        display: inline-block;
        vertical-align: top; /* Alinha os cards no topo */
        margin: 10px;
        background: #ffd795
    }

    .circular-image {
        margin-top: 24px;
        width: 200px;
        height: 200px;
        border: 3px solid #8B0000;
        /* Vermelho escuro */
        border-radius: 50%;
        overflow: hidden;
        display: inline-block;
    }

    .circular-image img {

        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .title {
        font-size: 24px;
        font-weight: bold;
        margin-top: 10px;
    }

    .item-list {
        margin-top: 10px;
    }

    .item-list ul {
        list-style-type: disc;
        /* Usa marcadores de disco (pontos) */
        padding: 0;
    }

    .item-list li {
        margin-bottom: 5px;
    }

    /* Estilos específicos para telas maiores (desktop) */
    @media (min-width: 768px) {
        .card {
            width: 350px;
        }
    }

    /* Estilos específicos para telas menores (mobile) */
    @media (max-width: 767px) {
        .card {
            width: 100%;
            /* Ocupa toda a largura da tela */
            margin: 0 0 20px;
            /* Adiciona margem abaixo dos cards */
            display: block;
            /* Permite que os cards se empilhem em telas menores */
        }
    }
</style>

@section('content')
    <div class="salgados">
        <div class="banner">
            <div class="card">
                <div class="circular-image">
                    <img src="upload/coxinha.jpg" alt="foto coxinha">
                </div>
                <div class="title">Salgados</div>
                <div class="item-list">
                    <ul>
                        <li>
                            <div class="product">
                                <div class="product-name">Coxinha</div>
                                <div class="dots">
                                    <span class="dots-line"></span>
                                </div>
                                <div class="product-price">R$ 2,00</div>
                            </div>
                        </li>
                        <li>
                            <div class="product">
                                <div class="product-name">Risole</div>
                                <div class="dots">
                                    <span class="dots-line"></span>
                                </div>
                                <div class="product-price">R$ 2,00</div>
                            </div>
                        </li>
                        <li>
                            <div class="product">
                                <div class="product-name">Bolinha de Queijo</div>
                                <div class="dots">
                                    <span class="dots-line"></span>
                                </div>
                                <div class="product-price">R$ 2,00</div>
                            </div>
                        </li>
                        <li>
                            <div class="product">
                                <div class="product-name">Bolinho de Carne</div>
                                <div class="dots">
                                    <span class="dots-line"></span>
                                </div>
                                <div class="product-price">R$ 2,00</div>
                            </div>
                        </li>
                        <li>
                            <div class="product">
                                <div class="product-name">Enroladinho de Salsicha </div>
                                <div class="dots">
                                    <span class="dots-line"></span>
                                </div>
                                <div class="product-price">R$ 2,00</div>
                            </div>
                        </li>
                        <li>
                            <div class="product">
                                <div class="product-name">O cento (100 unid) do mini</div>
                                <div class="dots">
                                    <span class="dots-line"></span>
                                </div>
                                <div class="product-price">R$ 45,00</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="circular-image">
                    <img src="upload/esfirra.jpeg" alt="foto impada">
                </div>
                <div class="title">Assados</div>
                <div class="item-list">
                    <ul>
                        <li>
                            <div class="product">
                                <div class="product-name">Empada de frango</div>
                                <div class="dots">
                                    <span class="dots-line"></span>
                                </div>
                                <div class="product-price">R$ 3,00</div>
                            </div>
                        </li>
                        <li>
                            <div class="product">
                                <div class="product-name">Empada de palmito</div>
                                <div class="dots">
                                    <span class="dots-line"></span>
                                </div>
                                <div class="product-price">R$ 3,00</div>
                            </div>
                        </li>
                        <li>
                            <div class="product">
                                <div class="product-name">Esfirra de Carne</div>
                                <div class="dots">
                                    <span class="dots-line"></span>
                                </div>
                                <div class="product-price">R$ 3,00</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <div class="container">
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
    </div>
@endsection
