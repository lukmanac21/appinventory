var base_url_tag = global_url+'konsultasi/';

$(function() {
    
    if ($('#myModal').length > 0) {
        $('#myModal').modal();                     
        $('#myModal').modal('show');  
    }

   $(".nav-tabs a").click(function(){
    $(this).tab('show');
  });
    $("#menu_transaksi").addClass("active");
    $("#menu_transaksi_input").addClass("active");
    
     function myFunction() {
  window.print();
}
});