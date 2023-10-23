var url = window.location.origin;
console.log(url);
$('#table-agendamento').DataTable({
    processing: true,
    serverSide: true,
    "ajax": {
        "url": url + "/mensagem/getAgendamentos",
        "type": "GET"
    },
    "columns": [{
        "data": "data_agendamento"
    }, {
        "data": "number"
    },
    {
        "data": "display_size"
    },

    {
        "data": "status"
    },

    {
        "data": "data_agendamento"
    },

    {
        "data": "status"
    }
    ],
    'columnDefs': [
        {
            targets: [2],
            className: 'dt-body-center'
        }
    ],
    'rowCallback': function (row, data, index) {
        // let btn = 'success';
        // if(data['display_status'] == "Desconectado"){
        //     btn = "danger";
        // }
        $('td:eq(0)', row).html( '<label>'+data['display_created_at']+'</label>');
        $('td:eq(4)', row).html( '<label>'+data['display_data_agendamento']+'</label>');
         $('td:eq(5)', row).html( '<a href="javascript:;" data-toggle="modal" onClick="configModalDelete(' + data["id"] + ')" data-target="#modalDelete" class="btn btn-sm btn-danger delete"><i class="far fa-trash-alt"></i></a>');


    },
});

