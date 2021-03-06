<?php

if(!isset($_SESSION['customer_email'])){

echo "<script> window.open('../checkout.php','_self'); </script>";

}

$customer_email = $_SESSION['customer_email'];

$select_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$select_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

$select_store_settings = "select * from store_settings where vendor_id='$customer_id'";

$run_store_settings = mysqli_query($con,$select_store_settings);

$row_store_settings = mysqli_fetch_array($run_store_settings);

$store_cover_image = $row_store_settings["store_cover_image"];

$store_profile_image = $row_store_settings["store_profile_image"];

$store_name = $row_store_settings["store_name"];

$store_country = $row_store_settings["store_country"];

$store_address_1 = $row_store_settings["store_address_1"];

$store_address_2 = $row_store_settings["store_address_2"];

$store_state = $row_store_settings["store_state"];

$store_city = $row_store_settings["store_city"];

$store_postcode = $row_store_settings["store_postcode"];

$paypal_email = $row_store_settings["paypal_email"];

$phone_no = $row_store_settings["phone_no"];

$store_email = $row_store_settings["store_email"];

?>

<div class="row" >

<div class="col-lg-12" >

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Configuración de la tienda

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal store-settings-form" method="post" enctype="multipart/form-data">

<div class="form-group">

<label class="col-md-3 control-label"> Imagen de portada / banner </label>

<div class="col-md-6">

<input type="file" name="cover_image" class="form-control">

<br>

<?php if(empty($store_cover_image)){ ?>

<img src="../images/no-image.jpg" width="70" height="70">

<?php }else{ ?>

<img src="../images/<?php echo $store_cover_image; ?>" width="70" height="70">

<?php } ?>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Image de perfil </label>

<div class="col-md-6">

<input type="file" name="profile_image" class="form-control">

<br>

<?php if(empty($store_profile_image)){ ?>

<img src="../images/no-image.jpg" width="70" height="70">

<?php }else{ ?>

<img src="../images/<?php echo $store_profile_image; ?>" width="70" height="70">

<?php } ?>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label">Nombre tienda</label>

<div class="col-md-6">

<input type="text" name="store_name" class="form-control" value="<?php echo $store_name; ?>" required>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label">Dirección tienda</label>

<div class="col-md-6">

<div class="form-group">

<label> País: </label>

<select name="store_country" class="form-control" required>

<option value=""> Seleccionar País </option>

<?php

$get_countries = "select * from countries";

$run_countries = mysqli_query($con,$get_countries);

while($row_country = mysqli_fetch_array($run_countries)){

$country_id = $row_country['country_id'];

$country_name = $row_country['country_name'];

?>

<option value="<?php echo $country_id; ?>" 

<?php

if($store_country == $country_id){ echo "selected"; }

?>

>

<?php echo $country_name; ?>

</option>

<?php
	
}

?>

</select>

</div>

<div class="form-group">

<label> Dirección 1: </label>

<input type="text" name="store_address_1" class="form-control" value="<?php echo $store_address_1; ?>" required>

</div>

<div class="form-group">

<label> Dirección 2 (Opcional): </label>

<input type="text" name="store_address_2" class="form-control" value="<?php echo $store_address_2; ?>">

</div>

<div class="form-group">

<label> Región: </label>

<input type="text" name="store_state" class="form-control" value="<?php echo $store_state; ?>" required>

</div>

<div class="form-group">

<label> Ciudad: </label>

<input type="text" name="store_city" class="form-control" value="<?php echo $store_city; ?>" required>

</div>

<div class="form-group">

<label> Postal: </label>

<input type="text" name="store_postcode" class="form-control" value="<?php echo $store_postcode; ?>" required>

</div>


</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> PayPal Email </label>

<div class="col-md-6">

<input type="email" name="paypal_email" class="form-control" value="<?php echo $paypal_email; ?>" required>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Teléfono </label>

<div class="col-md-6">

<input type="number" name="phone_no" class="form-control" value="<?php echo $phone_no; ?>">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Tienda Email </label>

<div class="col-md-6">

<label class="control-label">

<input type="checkbox" name="store_email" value="yes" <?php if($store_email == "yes"){ echo "checked"; } ?>> 

Mostrar la dirección de Email en la tienda

</label>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"></label>

<div class="col-md-6">

<input type="submit" name="submit" value="Save Settings" class="btn btn-success form-control">

</div>

</div>

</form>

</div>

</div>

</div>

</div>


<?php

if(isset($_POST['submit'])){
	
$cover_image = mysqli_real_escape_string($con, $_FILES['cover_image']['name']);

$profile_image = mysqli_real_escape_string($con, $_FILES['profile_image']['name']);

$cover_image_tmp = $_FILES['cover_image']['tmp_name'];

$profile_image_tmp = $_FILES['profile_image']['tmp_name'];
	
$store_name = mysqli_real_escape_string($con, $_POST["store_name"]);

$store_country = mysqli_real_escape_string($con, $_POST["store_country"]);

$store_address_1 = mysqli_real_escape_string($con, $_POST["store_address_1"]);

$store_address_2 = mysqli_real_escape_string($con, $_POST["store_address_2"]);

$store_state = mysqli_real_escape_string($con, $_POST["store_state"]);

$store_city = mysqli_real_escape_string($con, $_POST["store_city"]);

$store_postcode = mysqli_real_escape_string($con, $_POST["store_postcode"]);

$paypal_email = mysqli_real_escape_string($con, $_POST['paypal_email']);

$phone_no = mysqli_real_escape_string($con, $_POST["phone_no"]);

if(isset($_POST["store_email"])){

$store_email = mysqli_real_escape_string($con, $_POST["store_email"]);

}else{

$store_email = "no";
	
}

$allowed = array('jpeg','jpg','gif','png');

$cover_image_extension = pathinfo($cover_image, PATHINFO_EXTENSION);

$profile_image_extension = pathinfo($profile_image, PATHINFO_EXTENSION);

if(empty($cover_image)){

$cover_image = $store_cover_image;

}else{

if(!in_array($cover_image_extension,$allowed)){
 
echo "<script> alert('Su extensión de archivo de imagen de portada / banner no es compatible.'); </script>";

$cover_image = "";

}else{

move_uploaded_file($cover_image_tmp, "../images/$cover_image");

}
	
}

if(empty($profile_image)){

$profile_image = $store_profile_image;

}else{

if(!in_array($profile_image_extension,$allowed)){
 
echo "<script> alert('Su extensión de archivo de imagen de perfil no es compatible.'); </script>";

$profile_image = "";

}else{

move_uploaded_file($profile_image_tmp, "../images/$profile_image");

}
	
}

$update_store_settings = "update store_settings set store_cover_image='$cover_image',store_profile_image='$profile_image',store_name='$store_name',store_country='$store_country',store_address_1='$store_address_1',store_address_2='$store_address_2',store_state='$store_state',store_city='$store_city',store_postcode='$store_postcode',paypal_email='$paypal_email',phone_no='$phone_no',store_email='$store_email' where vendor_id='$customer_id'";

$run_store_settings = mysqli_query($con,$update_store_settings);

if($run_store_settings){

echo "

<script>

alert('La configuración de tu tienda se ha guardado correctamente.');

window.open('index.php?store_settings','_self');

</script>

";

}

}

?>


