var base_url_tag = global_url+'stokgudang/';

$(function() {
    if ($('#myModal').length > 0) {
        $('#myModal').modal();                     
        $('#myModal').modal('show');  
    }

   $('#formworkorder').on('keypress', function(e){
        return e.which !== 13;
    });
    
    $("#menu_gudang").addClass("active");
    $("#menu_stok_gudang").addClass("active");
    
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
      $(document).ready(function(){
            $("#jenis_barang").change(function (){
               var url = base_url_tag+"barang/"+$(this).val();
                $('#id_barang').load(url);
                return false;
            })
			
        });
    var dataGrid = $('#datatable').dataTable({
        processing : true,
        serverSide : true,
        searching : false,
        ajax : {
            url : base_url_tag + 'ajax_list/',
            type : 'post',
            data:  function(d){
                d.jenis_barang = $('#jenis_barang').val();
                d.id_barang = $('#id_barang').val();
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
