var base_url_tag = global_url+'warna/';
var base_url = global_url+'jeniswarna/';

$(function() {
    if ($('#myModal').length > 0) {
        $('#myModal').modal();                     
        $('#myModal').modal('show');  
    }

   $('#formworkorder').on('keypress', function(e){
        return e.which !== 13;
    });
    
     $("#menu_data").addClass("active");
    $("#menu_data_jenis_tindakan").addClass("active"); 
     
    var dataGrid = $('#datatable').dataTable({
          processing: true,
        responsive: true,
        serverSide: false,
        searching: true,
        ajax : {
            url : base_url + 'ajax_list/',
            type : 'post',
            data:  function(d){
                d.IDprovinsi = $('#IDprovinsi').val();
            }
        },
          
    columnDefs: [
        { 
            targets : [ -1 ], //last column
            orderable: false, //set not orderable
        },
        ],

         
    });

    $('#btnFilter').click(function() {        
        dataGrid.api().ajax.reload();
    });
  
});
function loadData(url) {
//    alert(url);
    $.ajax({
        url: url
    })
    .done(function( msg ) {
         var segments = url.split( '/' );
        var action = segments[3];
        var controller = segments[4];
        var fungsi = segments[5];
        var id = segments[6];
//        alert(id);
        if(id != 0) {
        $("#form-head").html("Edit Data Jenis Warna ");
        $("#id").val(msg.id);
        $("#nama").val(msg.nama);
        console.log(msg);
         $("#batal").css("display","inline");
         } else {
              $("#batal").css("display","none");
         }
    });
    return false;
}
function editData(id) {
    $('#edit-data').on('show.bs.modal', function(event) {
        var url = base_url_tag + "edit/" + id;
        var modal = $(this)
        modal.find('#hapus-true-data').attr("href", url);
    })
}


function deleteData(id) {
     $('#delete-data').on('show.bs.modal', function (event) {
        var url = base_url+"delete/"+id;
        var modal = $(this)
        modal.find('#hapus-true-data').attr("href",url);
        })
    }