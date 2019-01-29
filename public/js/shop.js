 $(document).ready(function(){

   $('#product_name').keyup(function(){
    var query = $(this).val();
    if(query != '')
    {
     var _token = $('input[name="_token"]').val();
     $.ajax({
      url:"{{ route('autocomplete.fetch') }}",
      method:"POST",
      data:{query:query, _token:_token},
      success:function(data){
       $('#productList').fadeIn();
       $('#productList').html(data);
     }
   });
   }
 });

   $(document).on('click', 'li', function(){
    $('#product_name').val($(this).text());
    $('#productList').fadeOut();
  });

 });
