var base_url_tag = global_url+'stokopname/';

$(document).on('click', '#add_barang', function(){
    var idBrg = $('#id_barang').val();
    var nmBrg = $('#id_barang option:selected').text();
    var JnsBrg = $('#id_barang option:selected').attr('dt-jenis');
    var StckReady = $('#stok_ready_2').val();
    var StckPros = $('#stok_proses_2').val();
    var StckRusak = $('#stok_rusak_2').val();
    $("#nama_barang").val("");
    $("#id_barang").val("");
    $("#stok_ready").val("");
    $("#stok_proses").val("");
    $("#stok_rusak").val("");
    $('#stok_ready_2').val("");
    $('#stok_proses_2').val("");
    $('#stok_rusak_2').val("");
    var elm = '<tr id="barang_'+idBrg+'" >'+
                '<td>'+nmBrg+
                       '<input type="hidden" value="'+idBrg+'" name="jenis_barang[]"/>'+
                '</td>'+
                '<td>'+JnsBrg+
                '</td>'+
                '<td>'+StckReady+
                 '<input type="hidden" value="'+StckReady+'" name="stok_ready_awal[]">'+
                        '<input type="hidden" value="'+StckReady+'" name="stok_ready[]"/>'+
                      
                '</td>'+
                '<td>'+StckPros +
                        '<input type="hidden" value="'+StckPros+'" name="stok_proses[]"/>'+
                       '<input type="hidden" value="'+StckPros+'" name="stok_proses_awal[]">'+
                '</td>'+
                '<td>'+StckRusak +
                        '<input type="hidden" value="'+StckRusak+'" name="stok_rusak[]"/>'+
                       '<input type="hidden" value="'+StckRusak+'" name="stok_rusak_awal[]">'+
                '</td>'+
                '<td>'+
                       '<a  class="btn btn-danger btn-del" ><span class="glyphicon glyphicon-trash"></span></a></td>'+
                '</td>'+
                '</tr>';

    var tabel = $('#tabel_barang').append(elm);
    //return false;
});

$(document).on('click', '.btn-del', function(){

    var elm = $(this).parent().parent();
    elm.remove();

});

$(function() {
    if ($('#myModal').length > 0) {
        $('#myModal').modal();                     
        $('#myModal').modal('show');  
    }
  
   $('#formsibk').on('keypress', function(e){
        return e.which !== 13;
    });
    
    $("#menu_gudang").addClass("active");
    $("#menu_stok_opname").addClass("active");
    
    $('#tanggal').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        }
    });
    $('#date').datepicker({
        locale: {
            format: 'DD/MM/YYYY'
        }
    });
    $(".select2").select2();

     $( "#id_barang" ).change(function() {
         var id_barang = $( "#id_barang" ).val();
       
         if(id_barang != 0){
            loadDatabarang(id_barang);
            
            $(".pilih_barang").removeAttr("disabled");
            $("#add_barang").css("display","inline");
            //resetBarang();
            $("#nama_barang").val("");
            $('#stok_ready_2').val("");
            $('#stok_proses_2').val("");
            $('#stok_rusak_2').val("");
         }
         else{
            $("#nama_barang").val("");
            $("#id_barang").val("");
            $("#stok_ready").val("");
            $("#stok_proses").val("");
            $("#stok_rusak").val("");
        
            $(".pilih_barang").attr("disabled","disabled");
            $("#add_barang").css("display","none");

           
           // resetBarang();
         }
         
      });
      var dataGrid = $('#datatable').dataTable({
        processing : true,
        serverSide : true,
        searching : false,
        ajax : {
            url : base_url_tag + 'getDataStokopname/',
            type : 'post',
            data:  function(d){
                d.tanggal = $('#tanggal').val();
                d.petugas = $('#petugas').val();
                d.kode_opname = $('#kode_opname').val();
            }
        },
        columns : [
            {data : 'kode_opname'},
            {data : 'tanggal_opname'},
            {data : 'petugas'},
            {data : 'action'},
        ]         
    });

    $('#btnFilter').click(function() {        
        dataGrid.api().ajax.reload();
    });
});


function loadDatabarang(id) {
   
    $.ajax({
        url: base_url_tag+'getStok/'+id
    })
    
    .done(function( msg ) {
        if(msg !=null){
            $("#nama_barang").val(msg.nama_barang);
            $("#id_barang").val( msg.id_barang);
            $("#stok_ready").val( msg.stok_ready);
            $("#stok_proses").val(msg.stok_proses);
            $("#stok_rusak").val( msg.stok_rusak);
        }else {
            $("#nama_barang").val();
            $("#id_barang").val();
            $("#stok_ready").val("0");
            $("#stok_proses").val("0");
            $("#stok_rusak").val("0");
         }
    });
    return false;
}

function removeBarang(id){
    var dly = 50;
    $("#"+id).remove();
    setTimeout(function (){
        getTotalHarga();
    },dly);
}


function deleteData(id) {
    locationDel = base_url_tag+"delete/"+id;
    msg = "Apakah Anda Akan menghapus Stok Opname Ini ? ";
    
    var r = confirm(msg);
    if (r==true) {
           window.location = locationDel;
    }
}
