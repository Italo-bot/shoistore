<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {
	
$select_general_settings = "select * from general_settings";

$run_general_settings = mysqli_query($con,$select_general_settings);

$row_general_settings = mysqli_fetch_array($run_general_settings);

$site_title = $row_general_settings["site_title"];

$meta_author = $row_general_settings["meta_author"];

$meta_description = $row_general_settings["meta_description"];

$meta_keywords = $row_general_settings["meta_keywords"];

$enable_vendor = $row_general_settings["enable_vendor"];

$new_product_status = $row_general_settings["new_product_status"];

$edited_product_status = $row_general_settings["edited_product_status"];

$order_status_change = $row_general_settings["order_status_change"];

?>

<div class="row">

<div class="col-lg-12">

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard /  Configuración General

</li>

</ol>

</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"> </i>  Configuración General

</h3>

</div><

<div class="panel-body">

<form class="form-horizontal" method="post">

<div class="form-group">

<label class="col-md-3 control-label"> Sitio Nombre : </label>

<div class="col-md-7">

<input type="text" name="site_title" class="form-control" value="<?php echo $site_title; ?>" required>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Autor(s) : </label>

<div class="col-md-7">

<input type="text" name="meta_author" class="form-control" value="<?php echo $meta_author; ?>">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Descripción : </label>

<div class="col-md-7">

<input type="text" name="meta_description" class="form-control" value="<?php echo $meta_description; ?>">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Keywords : </label>

<div class="col-md-7">

<input type="text" name="meta_keywords" class="form-control" value="<?php echo $meta_keywords; ?>">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Habilitar el registro de vendedores: </label>

<div class="col-md-7">

<label class="control-label">

<input type="radio" name="enable_vendor" value="yes" <?php if($enable_vendor == "yes"){ echo "checked"; } ?> required> si

</label>

<label class="control-label">

<input type="radio" name="enable_vendor" value="no" <?php if($enable_vendor == "no"){ echo "checked"; } ?> required> No

</label>

<span id="helpBlock" class="help-block">

Esta opción significa que si los vendedores pueden registrarse en su sitio web.

</span>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Estado del nuevo producto : </label>

<div class="col-md-7">

<select class="form-control" name="new_product_status">

<option value="active" <?php if($new_product_status == "active"){ echo "selected"; } ?>> (Activo) Publicado </option>

<option value="pending" <?php if($new_product_status == "pending"){ echo "selected"; } ?>> (Pendiente) Pendiente de aprobación </option>

</select>

<span id="helpBlock" class="help-block">

Estado del producto cuando un vendedor crea un producto.

</span>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Estado del producto editado : </label>

<div class="col-md-7">

<label class="control-label">

<input type="checkbox" name="edited_product_status" value="yes" <?php if($edited_product_status == "yes"){ echo "checked"; } ?>> 

Establecer el estado del producto como aprobación pendiente cuando un vendedor edita o actualiza un producto.

</label>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Cambio de estado del pedido : </label>

<div class="col-md-7">

<label class="control-label">

<input type="checkbox" name="order_status_change" value="yes" <?php if($order_status_change == "yes"){ echo "checked"; } ?>> El proveedor puede actualizar / cambiar el estado de la orden.

</label>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> </label>

<div class="col-md-7">

<input type="submit" name="submit" class="form-control btn btn-primary" value="Actualizar">

</div>

</div>

</form>

</div>

</div>

</div>

</div>

<?php

if(isset($_POST['submit'])){

$site_title = mysqli_real_escape_string($con, $_POST['site_title']);

$meta_author = mysqli_real_escape_string($con, $_POST['meta_author']);

$meta_description = mysqli_real_escape_string($con, $_POST['meta_description']);

$meta_keywords = mysqli_real_escape_string($con, $_POST['meta_keywords']);

$enable_vendor = mysqli_real_escape_string($con, $_POST['enable_vendor']);

$new_product_status = mysqli_real_escape_string($con, $_POST['new_product_status']);

if(isset($_POST["edited_product_status"])){

$edited_product_status = mysqli_real_escape_string($con, $_POST['edited_product_status']);

}else{
	
$edited_product_status = "no";
	
}

if(isset($_POST["order_status_change"])){

$order_status_change = mysqli_real_escape_string($con, $_POST['order_status_change']);

}else{
	
$order_status_change = "no";
	
}

$update_general_settings = "update general_settings set site_title='$site_title',meta_author='$meta_author',meta_description='$meta_description',meta_keywords='$meta_keywords',order_status_change='$order_status_change',enable_vendor='$enable_vendor',new_product_status='$new_product_status',edited_product_status='$edited_product_status',order_status_change='$order_status_change'";

$run_general_settings = mysqli_query($con,$update_general_settings);

if($run_general_settings){

echo "

<script>

alert(' Su configuración general se ha actualizado correctamente.');

window.open('index.php?general_settings','_self');

</script>

";

}


}

?>

<?php } ?>