var url = window.location.origin;
console.log( url);
$('#table-agendamento').DataTable({
    processing: true,
    serverSide: true,
    "ajax": {
        "url": url + "/mensagem/getAgendamentos",
        "type": "GET"
    },
    "columns": [{
        "data": "id"
    },{
        "data": "number"
    },
    {
        "data": "size"
        },
    
    {
        "data": "status"
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
        // $('td:eq(0)', row).html( '<div class="imagem-round"><img src="'+data['picture']+'" /></div>');
        // $('td:eq(2)', row).html('<button class="btn btn-'+btn+'">'+data['display_status']+'</button>');
        // $('td:eq(3)', row).html( '<a href="javascript:;" data-toggle="modal" onClick="configModalDelete(' + data["id"] + ')" data-target="#modalDelete" class="btn btn-sm btn-danger delete"><i class="far fa-trash-alt"></i></a>');


    },
});

