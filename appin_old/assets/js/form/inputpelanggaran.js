var base_url_tag = global_url+'pelanggaran/';

$(function() {
    if ($('#myModal').length > 0) {
        $('#myModal').modal();                     
        $('#myModal').modal('show');  
    }

   $('#formworkorder').on('keypress', function(e){
        return e.which !== 13;
    });
    $('#date').datepicker({
        locale: {
            format: 'DD/MM/YYYY'
        }
    });
     $("#menu_pelanggaran").addClass("active");
    $("#menu_pelanggaran_input").addClass("active"); 
    $(".select2").select2();
    var dataGrid = $('#datatable').dataTable({
        processing : true,
        serverSide : true,
        searching : false,
        ajax : {
            url : base_url_tag + 'ajaxlist/',
            type : 'post',
            data:  function(d){
               // alert(d);
                d.idsiswa = $('#idsiswa').val();
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
        $("#form-head").html("Edit Data Pelanggaran ");
        $("#id").val(msg.id);
        $("#nama").val(msg.nama);
          $("#nilai_pelanggaran").val(msg.nilai_pelanggaran);
        console.log(msg);
         $("#batal").css("display","inline");
         } else {
              $("#batal").css("display","none");
         }
    });
    return false;
}
