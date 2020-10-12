var base_url = global_url+'produk/';

$(function() {
    if ($('#myModal').length > 0) {
        $('#myModal').modal();                     
        $('#myModal').modal('show');  
    }
    $(".select2").select2();
   $('#formworkorder').on('keypress', function(e){
        return e.which !== 13;
    });
     $('.money-input').mask("#.##0", {reverse: true});    
     $("#menu_data").addClass("active");
    $("#menu_data_produk").addClass("active"); 
     
   var dataGrid = $('#datatable').dataTable({
        processing: true,
        responsive: true,
        serverSide: false,
        searching: true,
        ajax : {
            url : base_url + 'ajax_list/',
            type : 'post',
            data:  function(d){
                d.IDprovinsi = $('#IDprovinsi').val();
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

function editData(id) {
    $('#edit-data').on('show.bs.modal', function(event) {
        var url = base_url + "edit/" + id;
        var modal = $(this)
        modal.find('#hapus-true-data').attr("href", url);
    })
}

function deleteData(id) {
     $('#delete-data').on('show.bs.modal', function (event) {
        var url = base_url +"delete/"+id;
        var modal = $(this)
        modal.find('#hapus-true-data').attr("href",url);
        })
    }