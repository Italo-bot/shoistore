<?php

if(!isset($_SESSION['customer_email'])){

echo "<script> window.open('../checkout.php','_self'); </script>";

}

$customer_email = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

if(isset($_GET['delete_product'])){

$delete_id = mysqli_real_escape_string($con, $_GET['delete_product']);

$update_product = "update products set product_vendor_status='trash' where vendor_id='$customer_id' and product_id='$delete_id'";

$run_product = mysqli_query($con,$update_product);

if($run_product){

if(isset($_GET['products'])){
	
echo "

<script>

alert(' Un producto se ha eliminado correctamente.');

window.open('index.php?products','_self');

</script>

";
	
}elseif(isset($_GET['bundles'])){
	
echo "

<script>

alert('Un paquete se ha eliminado correctamente.');

window.open('index.php?bundles','_self');

</script>

";

}

}

}

?>
