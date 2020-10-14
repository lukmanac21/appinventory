var base_url_tag = global_url+'laporan/';

$(function() {
    if ($('#myModal').length > 0) {
        $('#myModal').modal();                     
        $('#myModal').modal('show');  
    }

    $('.money-input').mask("#.##0", {reverse: true});    
    $(".select2").select2();
    
     $('#date1').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd',
    });
    $('#date2').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd',
    });
    $('#formTransaksi').on('keypress', function(e){
        return e.which !== 13;
    });
    
    $("#menu_laporan").addClass("active");
    $("#menu_add_laporan").addClass("active");
    
    var dataGrid = $('#datatable').dataTable({
        processing : true,
        serverSide : true,
        searching : false,
        ajax : {
            url : base_url_tag + 'getData/',
            type : 'post',
            data:  function(d){
                d.id_kain = $('#id_kain').val();
                d.id_warna = $('#id_warna').val();
                d.id_satuan = $('#id_satuan').val();
            }
        },
        columnDefs: [
            { 
                targets : [ -1 ], //last column
                orderable: false, //set not orderable
            },
            ], 
    });

    $(document).on('click', '#export-xls', function(){
        $('[name="date1"]').val($('#date1').val());
        $('[name="date2"]').val($('#date2').val());        
        $('[name="status"]').val($('#status_pembayaran').val());   
        
    });

    $('#btnFilter').click(function() {        
        dataGrid.api().ajax.reload();
    });
     
});