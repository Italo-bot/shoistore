<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {


?>

<?php

if(isset($_GET['delete_note'])){

echo "

<script>

alert('La nota de su pedido se ha eliminado correctamente.');

window.open('index.php?view_order_id=41', '_self');

</script>

";

}

?>

<?php } ?>