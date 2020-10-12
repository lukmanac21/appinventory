var base_url_tag = global_url+'workorder/';

$(function() {
    if ($('#myModal').length > 0) {
        $('#myModal').modal();                     
        $('#myModal').modal('show');  
    }

    $('#date').datepicker({
        locale: {
            format: 'DD/MM/YYYY'
        }
    });

   $('#formworkorder').on('keypress', function(e){
        return e.which !== 13;
    });
});

function addBarang(){
    var lastRow = parseInt($('#index_row').val());
    var htmlRow = $("#barang_0").html();
    var nextRow = lastRow + 1;
    htmlRow = htmlRow.replace('style="display: none;"', '');
    htmlRow = htmlRow.split("id_barang_0").join("id_barang_"+nextRow); 
    htmlRow = htmlRow.split("jumlah_0").join("jumlah_"+nextRow);
    htmlRow = htmlRow.split("delete_0").join("delete_"+nextRow);
    htmlRow = htmlRow.split("barang_0").join("barang_"+nextRow);
    htmlRow = '<tr id="barang_'+nextRow+'">'+htmlRow+'</tr>';
    $("#tabel_barang tbody").append(htmlRow);
    $('#index_row').val(nextRow);
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
    msg = "Apakah Anda Akan menghapus Detail Work Order Ini ? ";
    
    var r = confirm(msg);
    if (r==true) {
           window.location = locationDel;
    }
}