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
        vertical-align: top;
        /* Alinha os cards no topo */
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

    .prato-dia {
        background: #0000004d;
        border-radius: 16px;
    }

    .banner-prato-dia {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        position: relative;
        margin: 30px;
        background-size: cover;
    }

    .banner-prato-dia::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url("https://minervafoods.com/wp-content/uploads/2022/12/Strogonoff-de-Carne-HOR-1-scaled-1.jpg");
        background-size: cover;
        filter: blur(10px);
        z-index: -1;
        /* Coloca o elemento pseudo em um nível de z-index inferior */
    }


    .zoom-prato-dia {
        transform: scale(1.2);
        /* Aplica o efeito de zoom na imagem do prato do dia */
        transition: transform 0.3s ease;
    }

    .circle-prato-dia {
        width: 150px;
        height: 150px;
        background-color: #fff;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .circle-prato-dia img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
    }

    .info-prato-dia {
        flex: 1;
        margin: 20px
    }

    .info-prato-dia h2 {
        font-size: 24px;
        color: #ffffff;
        margin: 0;
    }

    .info-prato-dia p {
        font-size: 16px;
        color: #ffffff;
        margin: 10px 0;
    }
</style>

@section('content')
    <div class="col-12">
        <div class="page-title">
            <div class="col-md-8 text-center">
                <h2 class="text-uppercase ">
                    <b>Prato</b> do Dia
                </h2>
            </div>
        </div>

    </div>
    <div class="prato-dia">
        <div class="banner-prato-dia">

            <div class="circle-prato-dia">
                <img src="https://img-global.cpcdn.com/recipes/383c043f6a719121/680x482cq70/foto-principal-da-receita-picadao-com-batatas-e-cenouras.jpg"
                    alt="Prato do Dia">
            </div>
            <div class="info-prato-dia">
                <h2>Picadão</h2>
                <p> Arroz - Feijão -Picadão- Macarrão - Salada(Alface e Tomate) R$ 15.00 .</p>
            </div>
        </div>
    </div>


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
