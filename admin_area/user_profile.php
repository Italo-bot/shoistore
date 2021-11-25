<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {

?>

<?php

if(isset($_GET['user_profile'])){

$edit_id = $_GET['user_profile'];

$get_admin = "select * from admins where admin_id='$edit_id'";

$run_admin = mysqli_query($con,$get_admin);

$row_admin = mysqli_fetch_array($run_admin);

$admin_id = $row_admin['admin_id'];

$admin_name = $row_admin['admin_name'];

$admin_email = $row_admin['admin_email'];

$admin_pass = $row_admin['admin_pass'];

$admin_image = $row_admin['admin_image'];

$new_admin_image = $row_admin['admin_image'];

$admin_country = $row_admin['admin_country'];

$admin_job = $row_admin['admin_job'];

$admin_contact = $row_admin['admin_contact'];

$admin_about = $row_admin['admin_about'];

}

?>

<div class="row" >
<div class="col-lg-12">

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard" ></i> Dashboard / Editar Perfil

</li>

</ol>

</div>

</div>

<div class="row" >

<div class="col-lg-12" >

<div class="panel panel-default" >

<div class="panel-heading" >

<h3 class="panel-title" >

<i class="fa fa-money fa-fw" ></i> Editar Perfil

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" method="post" enctype="multipart/form-data">

<div class="form-group">

<label class="col-md-3 control-label">Nombre: </label>

<div class="col-md-6">

<input type="text" name="admin_name" class="form-control" required value="<?php echo $admin_name; ?>">

</div>
</div>


<div class="form-group">

<label class="col-md-3 control-label">Usuario Email: </label>

<div class="col-md-6">

<input type="text" name="admin_email" class="form-control" required value="<?php echo $admin_email; ?>">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label">Usuario País: </label>

<div class="col-md-6">

<input type="text" name="admin_country" class="form-control" required value="<?php echo $admin_country; ?>">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label">Usuario Trabajo: </label>

<div class="col-md-6">

<input type="text" name="admin_job" class="form-control" required value="<?php echo $admin_job; ?>">

</div>

</div>


<div class="form-group">

<label class="col-md-3 control-label">Usuario Contacto: </label>

<div class="col-md-6">

<input type="text" name="admin_contact" class="form-control" required value="<?php echo $admin_contact; ?>">

</div>

</div>


<div class="form-group">

<label class="col-md-3 control-label">Sobre el usuario: </label>

<div class="col-md-6">

<textarea name="admin_about" class="form-control" rows="3"> <?php echo $admin_about; ?> </textarea>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label">Imagen: </label>

<div class="col-md-6">

<input type="file" name="admin_image" class="form-control" >
<br>
<img src="admin_images/<?Php echo $admin_image; ?>" width="70" height="70" >

</div>

</div>

<hr>

<h3> 
Cambie la contraseña de la cuenta <span class="text-muted h6"> Si no desea cambiar la contraseña, deje estos campos vacíos. </span> 
</h3>

<div class="form-group">

<label class="col-md-3 control-label">Cambiar la contraseña: </label>

<div class="col-md-6">

<input type="text" name="admin_pass" class="form-control">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label">Confirmar cambio de contraseña: </label>

<div class="col-md-6">

<input type="password" name="confirm_admin_pass" class="form-control">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"></label>

<div class="col-md-6">

<input type="submit" name="update" value="Update User" class="btn btn-primary form-control">

</div>

</div>

</form>

</div>

</div>

</div>

</div>

<?php

if(isset($_POST['update'])){

$admin_name = $_POST['admin_name'];

$admin_email = $_POST['admin_email'];

$admin_pass = $_POST['admin_pass'];

$confirm_admin_pass = $_POST['confirm_admin_pass'];

$admin_country = $_POST['admin_country'];

$admin_job = $_POST['admin_job'];

$admin_contact = $_POST['admin_contact'];

$admin_about = $_POST['admin_about'];

$admin_image = $_FILES['admin_image']['name'];

$temp_admin_image = $_FILES['admin_image']['tmp_name'];

move_uploaded_file($temp_admin_image,"admin_images/$admin_image");

if(empty($admin_image)){

$admin_image = $new_admin_image;

}

if(!empty($admin_pass) or !empty($confirm_admin_pass)){
	
if($admin_pass !== $confirm_admin_pass){

echo "<script>alert('Su contraseña no coincide. Vuelva a intentarlo.');</script> ";

exit();

}else{
	
$encrypted_password = password_hash($admin_pass, PASSWORD_DEFAULT);	

$update_admin_pass = "update admins set admin_pass='$encrypted_password' where admin_id='$admin_id'";

$run_admin_pass = mysqli_query($con,$update_admin_pass);

}

}

$update_admin = "update admins set admin_name='$admin_name',admin_email='$admin_email',admin_image='$admin_image',admin_contact='$admin_contact',admin_country='$admin_country',admin_job='$admin_job',admin_about='$admin_about' where admin_id='$admin_id'";

$run_admin = mysqli_query($con,$update_admin);

if($run_admin){

echo "<script>alert('El usuario ha sido actualizado con éxito e inicia sesión de nuevo')</script>";

echo "<script>window.open('login.php','_self')</script>";

session_destroy();

}

}

?>

<?php }  ?>