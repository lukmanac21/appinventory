var base_url = global_url+'perhitungan/';

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
           daysOfWeekDisabled: [0, 6],
    });
    $('#date2').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd',
           daysOfWeekDisabled: [0, 6],
    });
    $('#formTransaksi').on('keypress', function(e){
        return e.which !== 13;
    });
    
    $("#menu_perhitungan").addClass("active");
   
//    $( "#barang" ).change(function() {
//         var barang = $( "#barang" ).val();
//         if(barang != 0){
//            loadData(barang);
////            $(".pilih_barang").removeAttr("disabled");
//            $("#btnFilter").css("display","inline");
////            resetBarang();
//         }
//         else{
//            $("#biaya_pesan").val("");
//            $("#biaya").val("");
//            $("#permintaan").val("");
////            $(".pilih_barang").attr("disabled","disabled");
//            $("#add_barang").css("display","none");
//            resetBarang();
//         }
//         
//      });
//    var dataGrid =
//    $(document).on('click', '#export-xls', function(){
//        $('[name="date1"]').val($('#date1').val());
//        $('[name="date2"]').val($('#date2').val());        
//        $('[name="status"]').val($('#status_pembayaran').val());   
//        
//    });

    $('#btnFilterGet').click(function() {        
//        dataGrid.api().ajax.reload();
            searchHitung(); 
    });
    $(document).ready(function(){
          $("#btnFilter").click(function(){ 
              search(); 
          });
     });
});
function searchHitung(){
     $('#datatable').dataTable({
        processing : true,
        serverSide : true,
        searching : false,
        ajax : {
            url : base_url + 'getData/',
            type : 'post',
            data:  function(d){
                d.date1 = $('#date1').val();
                d.date2 = $('#date2').val();
                d.barang = $('#barang').val();
            }
        },
        columns : [
            {data : 'nama'},
            {data : 'jumlah'},
            {data : 'harga'},
            {data : 'biaya_simpan'},            
            {data : 'action'},
//            {data : 'id_kain'},
//            {data : 'permintaan_id'},
//            {data : 'notes'},
            
        ]         
    });
       
//  $("#loading").show(); // Tampilkan loadingnya
//  $.ajax({
//        type: "post", // Method pengiriman data bisa dengan GET atau POST
//       url : base_url + 'getSearchHitung/', // Isi dengan url/path file php yang dituju
//        data: {
//            barang : $("#barang").val(),
//            date1 : $("#date1").val(),
//            date2 : $("#date2").val(),
//            permintaan_barang : $("#permintaan_barang").val(),
//            biaya_pesan : $("#biaya_pesan").val(),
//            biaya : $("#biaya").val(),
//        }
////        }, // data yang akan dikirim ke file proses
////        dataType: "json",
////        beforeSend: function(e) {
////            if(e && e.overrideMimeType) {
////                e.overrideMimeType("application/json;charset=UTF-8");
////            }
////    },
////    success: function(response){ 
////            $("#loading").hide();             
////            if(response.status == "success"){
////                $("#permintaan_barang").val(response.permintaan_barang);
////                $("#biaya").val(response.biaya); 
////                $("#biaya_pesan").val(response.biaya_pesan); 
////                $("#btnFilterGet").css("display","inline");
////                $("#reset").css("display","inline");
////      }else{ 
////        alert("Data Tidak Ditemukan");
////      }
////    },
////        error: function (xhr, ajaxOptions, thrownError) { 
////      alert(xhr.responseText);
////        }
//    });
}
function search(){
  $("#loading").show(); // Tampilkan loadingnya
  $.ajax({
        type: "post", // Method pengiriman data bisa dengan GET atau POST
       url : base_url + 'getSearch/', // Isi dengan url/path file php yang dituju
        data: {
            barang : $("#barang").val(),
            date1 : $("#date1").val(),
            date2 : $("#date2").val(),
        
        }, // data yang akan dikirim ke file proses
        dataType: "json",
        beforeSend: function(e) {
            if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
            }
    },
    success: function(response){ 
            $("#loading").hide();             
            if(response.status == "success"){
                $("#permintaan_barang").val(response.permintaan_barang);
                $("#biaya").val(response.biaya); 
                $("#biaya_pesan").val(response.biaya_pesan); 
                $("#btnFilterGet").css("display","inline");
                $("#reset").css("display","inline");
      }else{ 
        alert("Data Tidak Ditemukan");
      }
    },
        error: function (xhr, ajaxOptions, thrownError) { 
      alert(xhr.responseText);
        }
    });
}
function loadData(id) {
//    alert(id);
    $.ajax({
        url: base_url+'getDataProduk/'+id
    })
    .done(function( msg ) {
        $("#permintaan_barang").val(msg.jumlah);
        $("#biaya").val(msg.biaya);
        $("#biaya_pesan").val(msg.harga);
    });
    return false;
}