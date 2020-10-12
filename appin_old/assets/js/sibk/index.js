var base_url_tag = global_url+'sibk/';

$(function() {
    if ($('#myModal').length > 0) {
        $('#myModal').modal();                     
        $('#myModal').modal('show');  
    }
    
    $('#tanggal').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        }
    });
     $("#menu_gudang").addClass("active");
    $("#menu_sibk").addClass("active");
});