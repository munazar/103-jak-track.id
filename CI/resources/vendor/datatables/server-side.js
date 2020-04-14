function append_table(data_url,id_table, data={}) {
     var tablename=$('#'+id_table);
     table= tablename.DataTable({
                    "ajax": {
                        "url":data_url ,
                        "type": "POST",
                        "data" : data
                    },
                    "deferRender": true,
                    "processing": true,
                    "serverSide": true,
                    "stateSave": false,
                    "pageLength": 25,
                    "order": [],
                    "columnDefs": [
                    {
                        "targets": [ 0 ],
                        "orderable": false,
                    },
                    ],
                    "language": {
                        "sProcessing":   "<i class='fa fa-spinner animated pulse infinite'> </i> &nbsp&nbsp Sedang memproses...",
                        "sLengthMenu":   "<i class='fa fa-book'> </i> &nbsp&nbspTampil&nbsp&nbsp  _MENU_ &nbsp&nbsp baris",
                        "sZeroRecords":  "Tidak ada data",
                        "sInfo":         "Data ke _START_ sampai _END_ Dari _TOTAL_ Data",
                        "sInfo":         "",
                        "sInfoEmpty":    "",
                        "sInfoFiltered": "Di filter dari _MAX_ Data",
                        "sInfoPostFix":  "",
                        "sSearch":       "<i class='fa fa-search animated bounceIn'> </i>&nbsp&nbsp Cari : ",
                        "sUrl":          "",
                        "oPaginate": {
                            "sFirst":    "Pertama",
                            "sPrevious": "<i class='fa fa-backward'></i>",
                            "sNext":     "<i class='fa fa-forward'></i>",
                            "sLast":     "Terakhir"
                        }
                    }

        });

    tablename.on('page.dt', function () {
    var info = table.page.info();
        $('#pageInfo').html('Currently showing page ' + (info.page + 1) + ' of ' + info.pages + ' pages.');
    });
}

function client_side(id_table) {
     var tablename=$('#'+id_table);
     table= tablename.DataTable({
                    "processing": true,
                    "stateSave": false,
                    "pageLength": 10,
                    "order": [],
                    "ordering": false,
                    "columnDefs": [
                    {
                        "targets": [ 0 ],
                        "orderable": false,
                    },
                    ],
                    "language": {
                        "sProcessing":   "<i class='fa fa-spinner animated pulse infinite'> </i> &nbsp&nbsp Sedang memproses...",
                        "sLengthMenu":   "<i class='fa fa-book'> </i> &nbsp&nbspTampil&nbsp&nbsp  _MENU_ &nbsp&nbsp baris",
                        "sZeroRecords":  "Tidak ada data",
                        "sInfo":         "Data ke _START_ sampai _END_ Dari _TOTAL_ data",
                        "sInfo":         "",
                        "sInfoEmpty":    "",
                        "sInfoFiltered": "Di filter dari _MAX_ Data",
                        "sInfoPostFix":  "",
                        "sSearch":       "<i class='fa fa-search animated bounceIn'> </i>&nbsp&nbsp Cari : ",
                        "sUrl":          "",
                        "oPaginate": {
                            "sFirst":    "Pertama",
                            "sPrevious": "<i class='fa fa-backward'></i>",
                            "sNext":     "<i class='fa fa-forward'></i>",
                            "sLast":     "Terakhir"
                        }
                    }

        });

    tablename.on('page.dt', function () {
    var info = table.page.info();
        $('#pageInfo').html('Currently showing page ' + (info.page + 1) + ' of ' + info.pages + ' pages.');
    });
};