var base_url_tag = global_url+'kota/';

$(function() {
    if ($('#myModal').length > 0) {
        $('#myModal').modal();                     
        $('#myModal').modal('show');  
    }    
    $("#menu_data").addClass("active");
    $("#menu_data_kota").addClass("active"); 
     $(".select2").select2();
    var dataGrid = $('#datatable').dataTable({
        processing : true,
        serverSide : true,
        searching : false,
        ajax : {
            url : base_url_tag + 'getDataAgenAll/',
            type : 'post',
            data:  function(d){
                d.id_kota = $('#id_kota').val();
                d.id_agen = $('#id_agen').val();
                d.id_kelas_harga = $('#id_kelas_harga').val();
            }
        },
        columns : [
            {data : 'kode_agen'},
            {data : 'nama_agen'},
            {data : 'alamat'},
            {data : 'txtKabupaten'},
            {data : 'id_kelas_harga'},
            {data : 'no_telpon'},
            {data :  'action'},
        ]         
    });

    $('#btnFilter').click(function() {        
        dataGrid.api().ajax.reload();
    });
});

function loadData(url) {
    $.ajax({
        url: url
    })
    .done(function( msg ) {
        $("#form-head").html("Edit Kota");
        $("#id").val(msg.id_jenis_barang);
        $("#createddate").val(msg.createddate);
        $("#nama_kota").val(msg.nama_kota);
    });
    return false;
}

function deleteData(id) {
    locationDel = base_url_tag+"delete/"+id;
    msg = "Apakah Anda Akan menghapus Data Kota Ini ? ";
    
    var r = confirm(msg);
    if (r==true) {
           window.location = locationDel;
    }
}