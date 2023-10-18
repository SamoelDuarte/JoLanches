@extends('admin.layout.app')

@section('content')
    <div class="container">
        <div class="page-header-content py-3">

            <div class="d-sm-flex align-items-center justify-content-between">
                <h1 class="h3 mb-0 text-gray-800">Camarotes</h1>
                <a href="{{ route('admin.camarote.create') }}"
                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus text-white-50"></i> Novo Camarote
                </a>
            </div>

            <ol class="breadcrumb mb-0 mt-4">
                <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Camarotes</li>
            </ol>

        </div>

        <!-- Tabela DataTables -->
        <table id="agendamento-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>IMG</th>
                    <th>Data do Evento</th>
                    <th>Cliente</th>
                    <th>Ações</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#agendamento-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.agendamento.data') !!}',
                columns: [{
                        data: 'caminho_foto',
                        name: 'caminho_foto',
                        render: function(data, type, full, meta) {

                            var imagemUrl = '{{ asset('storage') }}/' + data;
                            return '<img src="' + imagemUrl + '" height="50">';
                        }
                    }, {
                        data: 'data_agendamento',
                        name: 'data_agendamento',
                        render: function(data, type, full, meta) {
                            if (type === 'display' || type === 'filter') {
                                // Formata a data para DD/MM/AAAA
                                var parts = data.split('-');
                                if (parts.length === 3) {
                                    var day = parts[2];
                                    var month = parts[1];
                                    var year = parts[0];
                                    return day + '/' + month + '/' + year;
                                }
                            }
                            return data;
                        }
                    }, {
                        data: 'customer.name',
                        name: 'customer.name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });


        });
    </script>
@endsection
