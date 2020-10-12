var base_url_tag = global_url+'kelasharga/';

$(function() {
    if ($('#myModal').length > 0) {
        $('#myModal').modal();                     
        $('#myModal').modal('show');  
    }    
    $("#menu_data").addClass("active");
    $("#menu_data_kelas_harga").addClass("active"); 
});

function loadData(url) {
    $.ajax({
        url: url
    })
    .done(function( msg ) {
        $("#form-head").html("Edit Kelas Harga");
        $("#id").val(msg.id_kelas_harga);
        $("#kelas_harga").val(msg.kelas_harga);
    });
    return false;
}

function deleteData(id) {
    locationDel = base_url_tag+"delete/"+id;
    msg = "Apakah Anda Akan menghapus Kelas Harga Ini ? ";
    
    var r = confirm(msg);
    if (r==true) {
           window.location = locationDel;
    }
}