<?php


if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}else{


?>

<?php

if(isset($_GET['activate_product'])){

$product_id = $_GET['activate_product'];

$update_product_status = "update products set product_vendor_status='active' where product_id='$product_id'";

$run_product_status = mysqli_query($con,$update_product_status);

if($run_product_status){
	
if(isset($_GET['products'])){

echo "

<script>

alert(' Un producto se ha activado con éxito y se puede ver en la tienda de ShoiStore');

window.open('index.php?view_products','_self');

</script>

";

}elseif(isset($_GET['bundles'])){

echo "

<script>

alert(' Un paquete se ha activado con éxito y se puede ver en la tienda de ShoiStore.');

window.open('index.php?view_bundles','_self');

</script>

";
	
}

}

}

?>

<?php } ?>