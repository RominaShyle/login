$(document).ready(function(){

  $.get("view.php", function(data){
    $("#table_content").html(data)
  })

  $('#link_add').hide();
  $('#show_add').click(function(){
    $('#link_add').slideDown(500);
    $('#show_add').hide();

  });


  $('#add_new').click(function(){

var author = $('#author').val();
var title = $('#title').val();
var publisher = $('#publisher').val();


$.ajax({

url: "add.php",
type: "post",
data : {author: author, title:title, publisher: publisher},
success: function(data, status, xhr){
  $('#author').val('');
$('#title').val('');
$('#publisher').val('');

$.get('view.php',function(html){
  $('#table_content').html(html);
});
$('#records_content').fadeOut(1000).html(data);
},
error: function(){
  $('#records_content').fadeOut(3000).html('<div class="text-center"> Error </div');
},
beforeSend: function(){
  $('#records_content').fadeOut(8800).html('<div class="text-center"> Loading.. </div');
},
complete: function (){
  $('#link_add').hide();
  $('#show_add').show(700);
}
});
});
});
