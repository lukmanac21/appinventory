var base_url_tag = global_url+'obat/';
var idagen = $('#id').val();
$(function() {
  
    
    if ($('#myModal').length > 0) {
        $('#myModal').modal();                     
        $('#myModal').modal('show'); 
    }
    
    $("#menu_data").addClass("active");
    $("#menu_data_guru").addClass("active");
    $(".select2").select2();
 
    $(document).ready(function() {
        $('#edit').on('show.bs.modal', function (event) {
            var rowid = $(event.relatedTarget).data('id');
           
            var url = base_url_tag+"getCekObat/";
//             alert(url);
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
    $(document).ready(function() {
        $('#detail-data').on('show.bs.modal', function (event) {
            var rowid = $(event.relatedTarget).data('id');
            var url = base_url_tag+"getDetObat/";
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
 
        $('#active-data').on('show.bs.modal', function (event) {
        var div = $(event.relatedTarget).data('id');
        var url = base_url_tag+"activate/"+div;
//alert(url);
        var modal = $(this)
        modal.find('#active-true-data').attr("href",url);
        })

        });
      $(document).ready(function(){
 
        $('#non-active-data').on('show.bs.modal', function (event) {
        var div = $(event.relatedTarget).data('id');
        var url = base_url_tag+"non_activate/"+div;
//alert(url);
        var modal = $(this)
        modal.find('#non-active-true-data').attr("href",url);
        })

        });
     var dataGrid = $('#datatable').dataTable({
        processing : true,
        serverSide : true,
        searching : false,
        responsive: true,
        ajax : {
            url : base_url_tag + 'getDataObatAll/',
            type : 'post',
            data:  function(d){
                d.kode_obat = $('#kode').val();
                d.nama_obat = $('#nama_obat').val();
            }
        },
        columns : [
            {data : 'kode_obat'},
            {data : 'nama_obat'},
            {data : 'price'},
            {data : 'stock'},
            {data : 'nama_jenis'},
            {data :  'action'},
        ]         
    });

    $('#btnFilter').click(function() {        
        dataGrid.api().ajax.reload();
    });
   $(function(){
    $('.money-input').mask("#.##0", {reverse: true}); 
});

function toCurrency(n) {   
  n = parseFloat(n);
    return n.toFixed(0).replace(/./g, function(c, i, a) {
        return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
    });
}
});
