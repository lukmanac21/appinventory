var base_url_tag = global_url+'diagnostik/';
var idagen = $('#id').val();
$(function() {
 
    
    if ($('#myModal').length > 0) {
        $('#myModal').modal();                     
        $('#myModal').modal('show'); 
    }
    
    $("#menu_transaksi").addClass("active");
    $("#menu_transaksi_diagnostik").addClass("active");
    $(".select2").select2();
     $('#tanggalfilter').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        }
    });
     $('#tanggal').datetimepicker({
        format: 'DD-MM-YYYY HH:mm:ss',
    });
       $('#noka').autocomplete({
            minLength:2,
                serviceUrl: base_url_tag+"search",
                onSelect: function (suggestion) {
                    $('#nama').val(''+suggestion.nama);
                    $('#id').val(''+suggestion.idpasien);
                }
            });
      $(document).ready(function(){
          $('#delete-data').on('show.bs.modal', function (event) {
        var div = $(event.relatedTarget).data('id');
        var url = base_url_tag+"delete/"+div;
//alert(url);
        var modal = $(this)
        modal.find('#hapus-true-data').attr("href",url);
        })

        });
      $(document).ready(function(){
          $('#update-data').on('show.bs.modal', function (event) {
        var div = $(event.relatedTarget).data('id');
        var url = base_url_tag+"update/"+div;
        var modal = $(this)
        modal.find('#update-true-data').attr("href",url);
        })

        });
     var dataGrid = $('#datatable').dataTable({
        processing : true,
        serverSide : true,
        searching : false,
        responsive: true,
        ajax : {
            url : base_url_tag + 'getData/',
            type : 'post',
            data:  function(d){
                d.nama_pasien = $('#nama_pasien').val();
                d.tanggalfilter = $('#tanggalfilter').val();
                d.jenis = $('#jenis').val();
                d.dokter = $('#dokter').val();
            }
        },
        columns : [
            {data : 'noka'},
            {data : 'nama'},
            {data : 'name'},
            {data : 'kode_dokter'},
            {data : 'tgl_tindakan'},
            {data : 'notes'},
            {data :  'action'},
        ]         
    });

    $('#btnFilter').click(function() {        
        dataGrid.api().ajax.reload();
    });
      
    $(document).ready(function() {
        $('#edit-data').on('show.bs.modal', function (event) {
    
            var id = $(event.relatedTarget).data('id');
            
            var url = base_url_tag+"getDiagnostik/";
                $.ajax({
                    url: url,
                    type: "POST",
                    data :  'id='+ id,
                    success : function(data){
                    $('.fetched-data').html(data);
                    $('.tanggal').datetimepicker({
        format: 'DD-MM-YYYY HH:mm:ss',
    });
    $(".select2").select2();
     $('.noka').autocomplete({
                serviceUrl: base_url_tag+"search",
                onSelect: function (suggestion) {
                    $('.nama').val(''+suggestion.nama);
                    $('.id').val(''+suggestion.idpasien);
                }
            });
                    }
                   
                })
        });
    });
    $(document).ready(function() {
        $('#detail-data').on('show.bs.modal', function (event) {
            var rowid = $(event.relatedTarget).data('id');
            var url = base_url_tag+"getDetPasien/";
                $.ajax({
                    url: url,
                    type: "POST",
                    data :  'rowid='+ rowid,
                    success : function(data){
                    $('.fetched-data').html(data);
                    }
                   
                })
        });
    });
});