<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="joanadarc@jolanches.com.br">
    <meta name="author" content="samoelduarte@betasolucao.com.br">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">


    <title>Jô Lanches</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">


    <script
        src="https://maps.googleapis.com/maps/api/js?v=3&sensor=false&amp;libraries=places&key=AIzaSyAexUoFpkweVmPfHrClf8SMzt-lzHPmiJs">
    </script>
    <link rel="stylesheet" href="/assets/frameworks/bootstrap/css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link href="{{ asset('/assets/css/app.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <header id="header">

        <div class="header-nav">

            <div class="container">

                <div class="wrap">

                    <div class="logo">

                        <a href="#" class="logo-main"><img src="/upload/icone-menu.png" alt=""></a>

                    </div>

                    <div class="menu">

                        <nav class="nav">
                            <ul>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><img class="zoom"
                                            src="upload/inicio-menu.png"></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#cardapio"><img class="zoom"
                                            src="upload/cardapio-menu.png"></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#visite"><img class="zoom" style="height: 50px;"
                                            src="upload/visitenos.png"></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#contato"><img class="zoom"
                                            src="upload/contato-menu.png"></a>
                                </li>


                            </ul>
                        </nav>

                    </div>


                    <div class="icon-sidemenu d-lg-none d-flex flex-grow-1 justify-content-end align-items-center">
                        <a href="javascript:void(0)" class="sidemenu_btn" id="sidemenu_toggle">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                    </div>

                </div>

            </div>

        </div>

        <!--Side Nav-->
        <div class="side-menu hidden">
            <div class="inner-wrapper">
                <span class="btn-close" id="btn_sideNavClose"><i></i></span>
                <nav class="side-nav w-100">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>

                    </ul>
                </nav>

            </div>

        </div>

        <a id="close_side_menu" href="javascript:void(0);"></a>

    </header>
    <!-- Header -->


    <main role="main" style="margin-top: 85px;">
        <section id="home">
            <div class="row">

                <div class="col-md-7" data-aos-duration="2200" data-aos="fade-right">
                    <div class="img-fundo">
                        <div class="carrosel">
                            <br>
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#myCarousel" data-slide-to="1"></li>
                                    <li data-target="#myCarousel" data-slide-to="2"></li>
                                    <li data-target="#myCarousel" data-slide-to="3"></li>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">

                                    <div class="item active">
                                        <img src="/upload/banner01.png" alt="Chania">
                                        <div class="carousel-caption">
                                            <h3>Hamburguers</h3>
                                            <p>Monte Seu Lanche.</p>
                                        </div>
                                    </div>

                                    <div class="item">
                                        <img src="/upload/banner02.png" alt="Chania">
                                        <div class="carousel-caption">
                                            <h3>No Frio</h3>
                                            <p>Aquela Sopa!</p>
                                        </div>
                                    </div>

                                    <div class="item">
                                        <img src="/upload/banner03.png" alt="Flower">
                                        <div class="carousel-caption">
                                            <h3>Marmitex</h3>
                                            <p>Todo Dia.</p>
                                        </div>
                                    </div>

                                </div>

                                <!-- Left and right controls -->
                                <a class="left carousel-control" href="#myCarousel" role="button"
                                    data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" role="button"
                                    data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">

                    <div class="row " data-aos-duration="2200" data-aos="fade-left">
                        <div class="coluna-2">
                            <div class="sombraredondeada">
                                <img src="upload/icone-2.png">
                            </div>
                        </div>
                    </div>
                    <div class="row" data-aos-duration="2200" data-aos="fade-up">

                        <div class="coluna-3">

                            <div class="pedido passar_mouse" id="passar_mouse">
                                <div class="sombra-quadrada">
                                    <label class="txt-pedido txt-mouse" id="txt-mouse">Peça no Ifood</label>
                                </div>
                                <div class="txt-pedido mostrar" id="mostrar"><a href="https://www.ifood.com.br/delivery/sao-paulo-sp/jo-lanches-jardim-fujihara/55a59025-9625-43ef-921a-3ddcb1bea1a1" target="_blank"><img src="/assets/images/ifood.png" style="width: 80px; height: 52px;" alt=""></a></div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="cardapio">
         
                @yield('content')
       
        </section>



        <section id="visite">

            <div class="col-12">
                <div class="page-title">
                    <div class="col-md-8 text-center">
                        <h2 class="text-uppercase ">
                            <b>Venha</b> Nos Visitar
                        </h2>
                    </div>
                </div>

            </div>
            <div class="sombra-quadrada">
                <div class="row">
                    <img src="/upload/map.jpeg" class="img-fluid" alt="">
                </div>
            </div>

        </section>
    </main>

    <!-- Footer -->
    <footer id="footer">

        <div class="container">
            <div class="row footer-top">
                <div class="col-md-6 col-lg-7">

                    <img src="/upload/icone-menu.png"
                        style="    height: 150px;
                    width: 150px;
                    margin-top: 15px;
                    margin-left: 15px;"
                        alt="" class="img-fluid mb-4">


                    <p class="text-white mb-4">Mande uma Mensagem usando o formulário ao lado, ou
                        Envie por whatsapp.
                    </p>


                    <div class="mb-3">
                        <div class="me-2 d-flex align-items-center">
                            <i class="fab fa-whatsapp fs-4 text-secondary me-2" style="margin-right: 5px;"></i>
                            <span class="text-white"> (11) 91936-4812</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="me-2 d-flex align-items-center">
                            <i class="fas fa-map-marker-alt fs-4 text-secondary me-2" style="margin-right: 5px;"></i>
                            <span class="text-white"> R. José Bonifácio Pasquali n°34 Cep 04929-400 <br> <small>São Paulo –
                                    SP</small></span>
                        </div>
                    </div>

                    <div class="text-dark mt-3">

                        <a class="bg-secondary btn py-1 px-2 text-white text-decoration-none rounded-0 me-2"
                            href="https://www.facebook.com/444?_rdc=1&_rdr">
                            <i class="fab fa-facebook fs-5"></i>
                        </a>

                        <a class="bg-secondary btn py-1 px-2 text-white text-decoration-none rounded-0"
                            href="https://www.instagram.com/444.inc/">
                            <i class="fab fa-instagram fs-5"></i>
                        </a>

                    </div>

                </div>

                <div class="col-md-6 col-lg-5">

                    <div id="contato" class="form-contato mt-3 mt-md-4">
                        <div class="page-title">
                            <div class="text-start">
                                <h2 class="text-uppercase text-white">Envie uma<b> Mensagem</b></h2>
                                <p class="text-white">Ficou com alguma dúvida? Entre em contato com a nossa equipe.</p>
                            </div>
                        </div>

                        <div class="alert" style="display: none;"></div>

                        <form id="formContato" action="/actions/enviaEmail.php" method="post">

                            <div class="row">
                                <div class="form-group mb-3">
                                    <input type="text" name="nome" class="form-control rounded-0 lh-lg"
                                        placeholder="Nome completo" required>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="email" name="email" class="form-control rounded-0 lh-lg"
                                        placeholder="E-mail" required>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="phone" name="telefone" class="form-control rounded-0 lh-lg"
                                        placeholder="Telefone" required>
                                </div>

                                <div class="form-group mb-3">
                                    <textarea name="mensagem" class="form-control rounded-0" placeholder="Mensagem" rows="5" required></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <button class="btn btn-default">Enviar</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
            <div class="row bottom-footer">
                <div class="container">

                    <div class="row justify-content-between align-items-center">

                        <div class="col-sm-12 col-md-6 text-white">&copy; 2022 Jô Lanches - Todos os direitos
                            reservados
                        </div>

                        <div class="col-sm-12 col-md-6 d-flex align-items-center justify-content-md-end text-white">
                            <span class="me-2">Desenvolvido por <a class="zoom-maior" style="color: white;"
                                    href="https://betasolucao.com.br" target="_blank">Beta Solução<a></span>
                        </div>

                    </div>

                </div>
            </div>
        </div>



    </footer>
    <!-- End Footer -->
    <div id="floating-smi" class="floating-smi hidden-xs hidden-sm">
        <div class="floating-smi-wrap">
            <div class="floating-smi-list">
                <div class="textwidget custom-html-widget">
                    <ul>
                        <li>
                            <a href="https://api.whatsapp.com/send?phone=5511919364812" target="_blank"
                                rel="noopener noreferrer">
                                <span class="fab fa-whatsapp what"></span>
                            </a>
                        </li>

                        <li>
                            <a href="https://www.facebook.com/jolanches" target="_blank"
                                rel="noopener noreferrer">
                                <span class="fab fa-facebook face"></span>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/444.inc/" target="_blank" rel="noopener noreferrer">
                                <span class="fab fa-instagram insta"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>








    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        $('#passar_mouse').mouseover(function() {
            $('#mostrar').css('display', 'block');
            $('#mostrar').css('top', '50%');
            $('#mostrar').css('left', '50%');
            $('#mostrar').css('margin-right', '-50%');
            $('#mostrar').css('transform', 'translate(-50%, -50%)');
            $('#mostrar').css('margin', '0');
            $('#mostrar').css('position', 'absolute');
            $('#txt-mouse').css('display', 'none');
        });

        $('#passar_mouse').mouseout(function() {
            $('#mostrar').css('display', 'none');
            $('#txt-mouse').css('display', 'block');
        });
    </script>
    <script>
        AOS.init();
    </script>

</body>

</html>
