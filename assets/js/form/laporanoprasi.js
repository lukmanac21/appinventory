var base_url_tag = global_url+'LaporanOprasi/';

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
    $("#menu_laporan_stock").addClass("active");
    
    var dataGrid = $('#datatable').dataTable({
        processing : true,
        serverSide : true,
        searching : false,
        ajax : {
            url : base_url_tag + 'getDataOprasi/',
            type : 'post',
            data:  function(d){
                d.date1 = $('#date1').val();
                d.date2 = $('#date2').val();
                d.status_pembayaran = $('#status_pembayaran').val();
            }
        },
        columns : [
            {data : 'nosep'},
            {data : 'pasien'},
            {data : 'tanggal'},
            {data : 'jenis'},
            {data : 'dokter'},
            {data : 'status'},
            {data : 'notes'},
            
        ]         
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