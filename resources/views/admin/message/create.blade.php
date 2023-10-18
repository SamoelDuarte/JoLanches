@extends('admin.layout.app')

@section('css')
    <link href="{{ asset('/assets/admin/css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')
    <section>
        <div class="page-header-content py-3">

            <div class="d-sm-flex align-items-center justify-content-between">
                <h1 class="h3 mb-0 text-gray-800">Envio em Massa</h1>

            </div>

            <ol class="breadcrumb mb-0 mt-4">
                <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.message.index') }}">Relatório de Envio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Envio em Massa</li>
            </ol>

        </div>

        <form id="myForm" action="{{ route('admin.message.bulk') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Mensagem</label>
                <textarea name="texto" class="form-control" name="" id="" rows="3"></textarea>
            </div>
            <div class="form-group">
                <div class="input-wrapper">
                    <div class="left-input">
                        <label for="csvFile" id="uploadLabel" class="btn btn-primary">Escolha um arquivo</label>
                        <small id="helpId" class="form-text text-muted">Arquivo .csv com Contatos </small>
                    </div>
                    <div class="right-input">
                        <button type="submit" class="btn btn-success ">Enviar</button>
                        <input type="file" name="csvFile" id="csvFile" style="display: none;">
                    </div>
                   
                </div>

                <div id="resultado"></div>


            </div>


        </form>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#csvFile').change(function() {
                var file = $(this)[0].files[0];
                var formData = new FormData();
                formData.append('csvFile', file);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: '/mensagem/countContact',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#resultado').text('Total de Contatos a ser enviado: ' + response
                            .totalLinhas);
                    }
                });
            });
        });
    </script>
@endsection
