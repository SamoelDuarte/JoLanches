@extends('admin.layout.app')



@section('css')
    <link href="{{ asset('/assets/css/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/admin/css/dash.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
@endsection

@section('content')
    <section id="device">
        <div id="bottom-section">
            <div class="row">
                <div class="col-sm-12">
                    <form class="form-inline float-sm-right mt-3 mt-sm-0">
                        <div class="form-group mb-sm-0">
                            <h4 for="filter-days">Filtro: &nbsp;&nbsp;</h4>
                            <div id="filter-days" class="form-control">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="main">
            <div class="headerMain">
                <div class="box1">
                    <div class="headerBox">
                        Venda <i class='bx bx-up-arrow-circle bx-sm' style="color: var(--Green);"></i>
                    </div>
                    <p>R$ </p>
                </div>
                <div class="box1 sangria">
                    <div class="headerBox">
                        Saída <i class='bx bx-down-arrow-circle bx-sm' style="color: var(--Red);"></i>
                    </div>
                    <p>R$ </p>
                </div>
                <div class="box2" style="background: <?= 1 >= 0 ? 'var(--Green)' : 'var(--Red)' ?>;">
                    <div class="headerBox">
                        Total <i class='bx bx-money-withdraw bx-sm'></i>
                    </div>
                    <p>R$ </p>
                </div>
            </div>
        </div>

       
    </section>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/dash.js') }}"></script>

    
@endsection
