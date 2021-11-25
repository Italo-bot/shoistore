<?php

if(!isset($_SESSION['customer_email'])){

echo "<script> window.open('../checkout.php','_self'); </script>";

}

$customer_email = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

if(isset($_GET['edit_coupon'])){

$edit_id = $_GET['edit_coupon'];

$edit_coupon = "select * from coupons where coupon_id='$edit_id'";

$run_edit = mysqli_query($con,$edit_coupon);

$row_edit = mysqli_fetch_array($run_edit);

$c_id = $row_edit['coupon_id'];

$c_title = $row_edit['coupon_title'];

$c_price = $row_edit['coupon_price'];

$c_code = $row_edit['coupon_code'];

$c_limit = $row_edit['coupon_limit'];

$c_used = $row_edit['coupon_used'];

$p_id = $row_edit['product_id'];

}

?>

<div class="row">
<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"> </i> Editar Cupón

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" method="post">

<div class="form-group" >
<label class="col-md-3 control-label"> Nombre cupón </label>

<div class="col-md-6">

<input type="text" name="coupon_title" class="form-control" value="<?php echo $c_title; ?>" >

</div>

</div>

<div class="form-group" >

<label class="col-md-3 control-label"> Precio cupón </label>

<div class="col-md-6">

<input type="text" name="coupon_price" class="form-control" value="<?php echo $c_price; ?>">

</div>

</div>

<div class="form-group" >

<label class="col-md-3 control-label"> Código cupón </label>

<div class="col-md-6">

<input type="text" name="coupon_code" class="form-control" value="<?php echo $c_code; ?> ">

</div>

</div>

<div class="form-group" >

<label class="col-md-3 control-label"> Limite cupón </label>

<div class="col-md-6">

<input type="number" name="coupon_limit" value="<?php echo $c_limit; ?>" class="form-control">

</div>

</div>

<div class="form-group" >

<label class="col-md-3 control-label"> Seleccionar cupón para producto o paquete </label>

<div class="col-md-6">

<select name="product_id" class="form-control">

<optgroup label="Select Product">

<?php

$select_products = "select * from products where vendor_id='$customer_id' and product_vendor_status='active' and status='product'";

$run_products = mysqli_query($con,$select_products);

while($row_products = mysqli_fetch_array($run_products)){

$product_id = $row_products["product_id"];

$product_title = $row_products["product_title"];

if($product_id == $p_id){

echo "<option value='$product_id' selected> $product_title </option>";

}else{

echo "<option value='$product_id'> $product_title </option>";
	
}
	
}

?>

</optgroup>

<optgroup label="Select Bundle">

<?php

$select_bundles = "select * from products where vendor_id='$customer_id' and product_vendor_status='active' and status='bundle'";

$run_bundles = mysqli_query($con,$select_bundles);

while($row_bundles = mysqli_fetch_array($run_bundles)){

$product_id = $row_bundles["product_id"];

$product_title = $row_bundles["product_title"];

if($product_id == $p_id){

echo "<option value='$product_id' selected>$product_title</option>";
	
}else{

echo "<option value='$product_id'>$product_title</option>";
	
}
	
}

?>

</optgroup>

</select>

</div>

</div>

<div class="form-group" >

<label class="col-md-3 control-label"> </label>

<div class="col-md-6">

<input type="submit" name="update" class=" btn btn-primary form-control" value="Actualizar cupón">

</div>

</div>

</form>

</div>

</div>

</div>

</div>

<?php

if(isset($_POST['update'])){

$coupon_title = $_POST['coupon_title'];

$coupon_price = $_POST['coupon_price'];

$coupon_code = $_POST['coupon_code'];

$coupon_limit = $_POST['coupon_limit'];

$product_id = $_POST['product_id'];

$update_coupon = "update coupons set product_id='$product_id',coupon_title='$coupon_title',coupon_price='$coupon_price',coupon_code='$coupon_code',coupon_limit='$coupon_limit',coupon_used='$c_used' where vendor_id='$customer_id' and coupon_id='$c_id'";

$run_coupon = mysqli_query($con,$update_coupon);

if($run_coupon){

echo "

<script>

alert('El nuevo cupón se ha actualizado correctamente.');

window.open('index.php?coupons','_self');

</script>

";

}

}

?>
