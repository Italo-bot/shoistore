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

<i class="fa fa-dashboard"></i> Dashboard / Ver Fabricantes

</li>

</ol>

</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Ver Fabricantes

</h3>

</div>

<div class="panel-body">

<div class="table-responsive">

<table class="table table-bordered table-hover table-striped">

<thead>
<tr>

<th> ID del fabricante: </th>
<th> Título del fabricante: </th>
<th> Eliminar fabricante: </th>
<th> Editar fabricante: </th>

</tr>

</thead>
<tbody>

<?php

$i = 0;

$get_manufacturers = "select * from manufacturers";

$run_manufacturers = mysqli_query($con,$get_manufacturers);

while($row_manufacturers = mysqli_fetch_array($run_manufacturers)){

$manufacturer_id = $row_manufacturers['manufacturer_id'];

$manufacturer_title = $row_manufacturers['manufacturer_title'];

$i++;

?>

<tr>

<td><?php echo $i; ?></td>

<td><?php echo $manufacturer_title; ?></td>

<td>

<a href="index.php?delete_manufacturer=<?php echo $manufacturer_id; ?>">

<i class="fa fa-trash-o"></i> Borrar

</a>

</td>

<td>

<a href="index.php?edit_manufacturer=<?php echo $manufacturer_id; ?>">

<i class="fa fa-pencil"></i> Editar

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>

<?php } ?>