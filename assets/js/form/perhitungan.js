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
   
    $('#btnFilterGet').click(function() {   
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
            {data : 'warna'},
            {data : 'jumlah'},
            {data : 'harga'},
            {data : 'biaya_simpan'},            
            {data : 'action'},
            
        ]         
    });
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