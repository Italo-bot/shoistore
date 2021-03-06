<?php


if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {


?>

<div class="row">

<div class="col-lg-12">

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard / Agregar Reseña

</li>

</ol>

</div>

</div>


<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i  class="fa fa-money fa-fw"></i> Agregar Reseña

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" action="" method="post">

<div class="form-group">

<label class="col-md-3 control-label"> Seleccionar Cliente: </label>

<div class="col-md-6">

<select name="customer_id" class="form-control" required>

<option value="" class="hidden"> Seleccionar Cliente </option>

<?php

$select_customers = "select * from customers";

$run_customers = mysqli_query($con,$select_customers);

while($row_customers = mysqli_fetch_array($run_customers)){

$customer_id = $row_customers['customer_id'];

$customer_name = $row_customers['customer_name'];

echo "<option value='$customer_id'>$customer_name</option>";

}

?>

</select>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Seleccione un producto / paquete: </label>

<div class="col-md-6">

<select name="product_id" class="form-control" required>

<option value="" class="hidden"> Seleccione un producto / paquete </option>

<optgroup label="Seleccionar producto">

<?php

$select_products = "select * from products where status='product'";

$run_products = mysqli_query($con,$select_products);

while($row_products = mysqli_fetch_array($run_products)){

$product_id = $row_products['product_id'];

$product_title = $row_products['product_title'];

echo "<option value='$product_id'>$product_title</option>";

}

?>

</optgroup>

<optgroup label="Seleccionar paquete">

<?php

$select_bundles = "select * from products where status='bundle'";

$run_bundles = mysqli_query($con,$select_bundles);

while($row_bundles = mysqli_fetch_array($run_bundles)){

$product_id = $row_bundles['product_id'];

$product_title = $row_bundles['product_title'];

echo "<option value='$product_id'>$product_title</option>";

}

?>

</optgroup>

</select>

</div>

</div>
<div id="review-variations-div">

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Reseña:  </label>

<div class="col-md-6">

<input type="text" name="review_title" class="form-control" required>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Puntos de reseña:  </label>

<div class="col-md-6">

<input type="hidden" id="rating" name="review_rating" class="rating-loading" data-size="sm" required>

<script>

$(document).ready(function(){
		
$("#rating").rating({

step: 1,

starCaptions: {1: 'lo odio', 2: 'malo', 3: 'bien', 4: 'Me gustó', 5: 'perfecto!'},

starCaptionClasses: {1: 'btn btn-danger', 2: 'btn btn-warning', 3: 'btn btn-info', 4: 'btn btn-primary', 5: 'btn btn-success'},

clearCaptionClass:"btn btn-default"

});
	
});

</script>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Revisar contenido / comentario: </label>

<div class="col-md-6">

<textarea name="review_content" rows="5" class="form-control" required></textarea>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> </label>

<div class="col-md-6">

<input type="submit" name="submit" value="Agregar" class="btn btn-success form-control">

</div>

</div>

</form>

</div>

</div>

</div>

</div>

<script>

$(document).ready(function(){
	
$("select[name='product_id']").on("change", function(){
	
var product_id = $(this).val();

$.ajax({
	
method: "POST",

url: "load_review_variations.php",

data: { product_id: product_id},

success:function(data){
	
$("#review-variations-div").html(data);

}	 
      
});
	
});

});

</script>

<?php

if(isset($_POST['submit'])){

$customer_id = mysqli_real_escape_string($con, $_POST["customer_id"]);

$product_id = mysqli_real_escape_string($con, $_POST["product_id"]);

$variation_id = mysqli_real_escape_string($con, $_POST["variation_id"]);

$review_title = mysqli_real_escape_string($con, $_POST["review_title"]);

$review_rating = mysqli_real_escape_string($con, $_POST["review_rating"]);

$review_content = mysqli_real_escape_string($con, $_POST["review_content"]);

$review_date = date("F d, Y");

$insert_review = "insert into reviews (customer_id,product_id,review_title,review_rating,review_content,review_date,review_status) values ('$customer_id','$product_id','$review_title','$review_rating','$review_content','$review_date','active')";

$run_review = mysqli_query($con,$insert_review);

$insert_review_id = mysqli_insert_id($con);

if($run_review){
	
if(!empty($variation_id)){
	
$insert_variation_id_meta = "insert into reviews_meta (review_id,meta_key,meta_value) values ('$insert_review_id','variation_id','$variation_id')";

$run_variation_id_meta = mysqli_query($con,$insert_variation_id_meta);
	
$select_variations_meta = "select * from variations_meta where variation_id='$variation_id'";

$run_variations_meta = mysqli_query($con,$select_variations_meta);

while($row_variations_meta = mysqli_fetch_array($run_variations_meta)){

$meta_key = $row_variations_meta["meta_key"];

$meta_value = $row_variations_meta["meta_value"];

$insert_reviews_meta = "insert into reviews_meta (review_id,meta_key,meta_value) values ('$insert_review_id','$meta_key','$meta_value')";

$run_reviews_meta = mysqli_query($con, $insert_reviews_meta);

}

}

echo "

<script>

alert('Su reseña se ha insertado correctamente.');

window.open('index.php?view_reviews','_self');

</script>

";

}

}

?>


<?php } ?>