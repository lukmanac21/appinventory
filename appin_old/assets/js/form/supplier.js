var base_url_tag = global_url+'Master/Supplier/';
var base_url = global_url+'supplier/';

$(function() {
    if ($('#myModal').length > 0) {
        $('#myModal').modal();                     
        $('#myModal').modal('show');  
    }

   $('#formworkorder').on('keypress', function(e){
        return e.which !== 13;
    });
    
     $("#menu_data").addClass("active");
    $("#menu_data_supplier").addClass("active"); 
     
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
        var url = base_url+"delete/"+id;
        var modal = $(this)
        modal.find('#hapus-true-data').attr("href",url);
        })
    }