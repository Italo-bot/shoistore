<?php


if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {

?>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
  
<?php

if(isset($_GET['edit_service'])){

$edit_id = $_GET['edit_service'];

$get_services = "select * from services where service_id='$edit_id'";

$run_services = mysqli_query($con,$get_services);

$row_services = mysqli_fetch_array($run_services);

$service_id = $row_services['service_id'];

$service_title = $row_services['service_title'];

$service_image = $row_services['service_image'];

$service_desc = $row_services['service_desc'];

$service_button = $row_services['service_button'];

$service_url = $row_services['service_url'];

$new_s_image = $row_services['service_image'];


}

?>  

<div class="row" >

<div class="col-lg-12" >

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard" ></i> Dashboard / Editar Servicio

</li>

</ol>

</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">
<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Editar Servicio

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

<div class="form-group">

<label class="col-md-3 control-label"> Nombre : </label>

<div class="col-md-6">

<input type="text" name="service_title" class="form-control" value="<?php echo $service_title; ?>">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Imagen de Servicio : </label>

<div class="col-md-6">

<input type="file" name="service_image" class="form-control">

<br>

<img src="services_images/<?php echo $service_image; ?>" width="70" height="70" >

</div>

</div>


<div class="form-group">

<label class="col-md-3 control-label"> Descripción : </label>

<div class="col-md-6">

<textarea name="service_desc" class="form-control" rows="10" cols="19">

<?php echo $service_desc; ?>

</textarea>

</div>

</div>


<div class="form-group">

<label class="col-md-3 control-label"> Botón de servicio : </label>

<div class="col-md-6">

<input type="text" name="service_button" class="form-control" value="<?php echo $service_button; ?>">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> URL Servicio : </label>

<div class="col-md-6">

<input type="url" name="service_url" class="form-control" value="<?php echo $service_url; ?>">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> </label>

<div class="col-md-6">

<input type="submit" name="update" value="Actualizar" class="btn btn-primary form-control">

</div>

</div>


</form>

</div>

</div>

</div>

</div>

<?php

if(isset($_POST['update'])){

$service_title = $_POST['service_title'];

$service_desc = $_POST['service_desc'];

$service_button = $_POST['service_button'];

$service_url = $_POST['service_url'];

$service_image = $_FILES['service_image']['name'];

$tmp_image = $_FILES['service_image']['tmp_name'];

if(empty($service_image)){

$service_image = $new_s_image;

}

move_uploaded_file($tmp_image,"services_images/$service_image");

$update_services = "update services set service_title='$service_title',service_image='$service_image',service_desc='$service_desc',service_button='$service_button',service_url='$service_url' where service_id='$service_id'";

$run_services = mysqli_query($con,$update_services);

if($run_services){

echo "<script>alert('Se ha actualizado una columna de servicio')</script>";

echo "<script>window.open('index.php?view_services','_self')</script>";

}

}

?>

<?php } ?>