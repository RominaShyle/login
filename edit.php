<?php
require_once "includes/db.php";

$id = $_POST['id'];

if(empty($id)){

  ?>
  <div class="text-center"> No records found <a href="#" onclick="$('#link_add').hide(); $('#show_add').show(600)"> Hide </a></div>  <?php die();
}

$sql = "SELECT * FROM books WHERE id = $id ";

$result = $conn->query($sql);



while($row = $result->fetch_assoc()){

?>

<div class="form-inline" id="edit-data">

  <div class="form-group col-md-3">
    <input type="text" name="title" id="title" value="<?php echo $row['title'];?>" placeholder="Title" class="form-control" required>

  </div>

  <div class="form-group col-md-3">
    <input type="text" name="author" id="author" value="<?php echo $row['author'];?>" placeholder="Author" class="form-control" required>

  </div>
  <div class="form-group col-md-3">
    <input type="text" name="publisher" id="publisher" value="<?php echo $row['publisher'];?>" placeholder="Publisher" class="form-control" required>

  </div>

  <div class="form-group col-md-3">
<button type="button" name="update" class=" update btn btn-outline-success mx-3" id="<?php echo $row['id'];?>"> Update</button>
 <button type="button" name="add" class="btn btn-outline-danger" href="javascript:void(0);" id="cancel"
 onclick="$('#link_add').slideUp(400); $('#show_add').show(700);"> Cancel</button>
 </div>
</div>

<?php
}
 ?>

 <script type="text/javascript">

 $('.update').click(function (){

   var id = $(this).attr('id');

   var author = $('#author').val();
   var title = $('#title').val();
   var publisher = $('#publisher').val();


$.ajax({

  url: "update.php",
  type: "post",
  data: {id: id, author:author , title:title, publisher:publisher},
  success : function(data, status, xhr){
$('#author').val('');
$('#title').val('');
$('#publisher').val('');
$('#records_content').fadeOut(1100).html(data);
$.get("view.php", function(html){

  $('#table_content').html(html);
})
$('#records_content').fadeOut(1100).html(data);
},
complete: function(){
  $('#link_add').hide();
  $('#show_add').show(750);
}
})
 })

 </script>
