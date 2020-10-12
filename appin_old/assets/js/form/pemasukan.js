var base_url_tag = global_url+'pemasukan/';
var base_url = global_url+'pemasukan/';

$(function() {
    if ($('#myModal').length > 0) {
        $('#myModal').modal();                     
        $('#myModal').modal('show');  
    }
    $(".select2").select2();
   $('#formworkorder').on('keypress', function(e){
        return e.which !== 13;
    });
    $('#date1').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd',
    });
     $("#menu_transaksi").addClass("active");
    $("#menu_pemasukan").addClass("active"); 
     $( "#id_supplier" ).change(function() {
         var id_supplier = $( "#id_supplier" ).val();
         if(id_supplier != 0){
            loadDataAgen(id_supplier);
            $(".pilih_barang").removeAttr("disabled");
            $("#add_barang").css("display","inline");
            resetBarang();
         }
         else{
            $("#alamat").val("");
            $("#no_telpon").val("");
            $("#nama_supplier").val("");
            $(".pilih_barang").attr("disabled","disabled");
            $("#add_barang").css("display","none");
            resetBarang();
         }
         
      });
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

function loadDataAgen(id) {
    $.ajax({
        url: base_url_tag+'getAgen/'+id
    })
    .done(function( msg ) {
        $("#alamat").val(msg.alamat);
        $("#no_telpon").val(msg.telp);
        $("#nama_supplier").val( msg.nama);
    });
    return false;
}
function addBarang(){
    var idRow = $('#tabel_barang tr:last').attr('data-id');
    if( idRow == undefined){
        idRow = 0;
    }else{
        idRow = parseInt(idRow)+1;
          var lastRow = parseInt($('#index_row').val());
    }
    var lastRow = parseInt($('#index_row').val());
   if(lastRow != idRow){
       lastRow = idRow;
       var nextRow = lastRow;
   } else {
       lastRow = parseInt(lastRow);
       var nextRow = lastRow+1;
   }
    var htmlRow = $("#barang_0").html();
    htmlRow = htmlRow.replace('style="display: none;"', '');
    htmlRow = htmlRow.split("id_barang_0").join("id_barang_"+idRow); 
    htmlRow = htmlRow.split("jumlah_0").join("jumlah_"+idRow);
    htmlRow = htmlRow.split("harga_0").join("harga_"+idRow);
    htmlRow = htmlRow.split("total_0").join("total_"+idRow);
    htmlRow = htmlRow.split("delete_0").join("delete_"+idRow);
    htmlRow = htmlRow.split("barang_0").join("barang_"+idRow);
    htmlRow = '<tr id="barang_'+idRow+'" data-id="'+idRow+'">'+htmlRow+'</tr>';
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
function resetBarang(){
    var lastRow = parseInt($('#index_row').val());
    for(var i=2; i <= lastRow; i++){
        if($("#barang_"+i).length > 0){
            $("#barang_"+i).remove();
        }
    }
    $("#id_barang_1").val("0");
    $("#jumlah_1").val("0");
    $("#harga_1").val("0");
    $("#total_1").val("0");
    $("#total_tagihan").val("0");
    $('#index_row').val("1");
}
function editData(id) {
    $('#edit-data').on('show.bs.modal', function(event) {
        var url = base_url_tag + "edit/" + id;
        var modal = $(this)
        modal.find('#hapus-true-data').attr("href", url);
    })
}
function getHarga(row){
    var dly = 50;
    var id_barang = $("#"+row).val();
    var indexRow = row.replace('id_barang_','');
	
    var dup = checkDuplicate();
    if(dup == false){
        setTimeout(function (){
            $.ajax({
                url: base_url_tag+'getharga/'+id_barang
            })
            .done(function( msg ) {
                if(msg != null){
                    $("#harga_"+indexRow).val(toCurrency(msg.harga));
                }
                else{
                    $("#harga_"+indexRow).val("0");
                }
                $("#jumlah_"+indexRow).val("0");
                $("#diskon_"+indexRow).val("0");
                $("#total_"+indexRow).val("0");
                getTotalHarga();
            });
            return false;
        },dly);
    }
    else{
        $("#"+row).val(0);
        alert("Duplikat barang, Barang yang anda pilih sudah terdaftar");
    }
    
    
}
function getTotalHargaItem(row){
 $(".maks").mask("#.##0",{reverse:true});
    var dly = 50;
    var indexRow = row.replace('id_barang_','');
    setTimeout(function (){
       var jumlah = ($("#jumlah_"+indexRow).val() == "") ? 0 : parseFloat($("#jumlah_"+indexRow).val());
       if(jumlah < 0){
           alert("Jumlah Kain tidak boleh kurang dari 0");
           $("#jumlah_"+indexRow).val(0);
       }
       else{
            var harga = parseFloat($("#harga_"+indexRow).cleanVal());
            var totalNoDis = jumlah * harga;
            var totwithDis = totalNoDis;
            $("#total_"+indexRow).val(toCurrency(totwithDis));
             setTimeout(function (){
                 getTotalHarga();
             },dly);
       }
        return false;
    },dly);
    
}
function getTotalHarga(){
    var idRow = $('#tabel_barang tr:last').attr('data-id');
    var total = 0;    
    for(var i=1; i <= idRow; i++){
        if($("#barang_"+i).length > 0){
            harga = parseFloat($("#total_"+i).cleanVal());
            total = total + harga;
        }
    }

    $("#total_tagihan").val(toCurrency(total));
}
function deleteData(id) {
     $('#delete-data').on('show.bs.modal', function (event) {
        var url = base_url+"delete/"+id;
        var modal = $(this)
        modal.find('#hapus-true-data').attr("href",url);
        })
    }
function konfirmasiData(id) {
     $('#update-data').on('show.bs.modal', function (event) {
        var url = base_url+"konfirmasi/"+id;
        var modal = $(this)
        modal.find('#update-true-data').attr("href",url);
        })
    }
function nonAktifData(id) {
     $('#nonaktif-data').on('show.bs.modal', function (event) {
        var url = base_url+"konfirmasi/"+id;
        var modal = $(this)
        modal.find('#nonakktif-true-data').attr("href",url);
        })
    }
function checkDuplicate(){
    var key = [];
    var results = [];
    var ret = false;
    $(".pilih_barang").each(function(){
        key.push(this.value);        
    });
    var sorted_arr = key.slice().sort(); 
    
    for (var x = 0; x < key.length - 1; x++) {
        if (sorted_arr[x + 1] == sorted_arr[x] && sorted_arr[x + 1] != 0) {
            results.push(sorted_arr[x]);
        }
    }
    
    if(results.length > 0){
        ret = true;
    }
    
    return ret;
}