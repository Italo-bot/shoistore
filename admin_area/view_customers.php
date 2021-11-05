<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {


?>

<div class="row"><!-- 1 row Starts -->

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<ol class="breadcrumb"><!-- breadcrumb Starts -->

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard / Ver Clientes

</li>

</ol><!-- breadcrumb Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 1 row Ends -->

<div class="row"><!-- 2 row Starts --> 

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<div class="panel panel-default"><!-- panel panel-default Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<h3 class="panel-title"><!-- panel-title Starts -->

<i class="fa fa-money fa-fw"></i> Ver Clientes

</h3><!-- panel-title Ends -->

</div><!-- panel-heading Ends -->


<div class="panel-body" ><!-- panel-body Starts -->

<div class="table-responsive" ><!-- table-responsive Starts -->

<table class="table table-bordered table-hover table-striped" ><!-- table table-bordered table-hover table-striped Starts -->

<thead><!-- thead Starts -->

<tr>

<th> Número de cliente: </th>
<th> Nombre del cliente: </th>
<th> Email del cliente: </th>
<th> Imagen del cliente: </th>
<th> Número de teléfono del cliente: </th>
<th> Función del cliente: </th>
<th> Eliminación del cliente: </th>

</tr>

</thead><!-- thead Ends -->

<tbody><!-- tbody Starts -->

<?php

$i=0;

$get_c = "select * from customers";

$run_c = mysqli_query($con,$get_c);

while($row_c=mysqli_fetch_array($run_c)){

$c_id = $row_c['customer_id'];

$c_name = $row_c['customer_name'];

$c_email = $row_c['customer_email'];

$c_image = $row_c['customer_image'];

$c_contact = $row_c['customer_contact'];

$customer_role = $row_c['customer_role'];

$i++;

?>

<tr>

<td><?php echo $i; ?></td>

<td><?php echo $c_name; ?></td>

<td><?php echo $c_email; ?></td>

<td><img src="../customer/customer_images/<?php echo $c_image; ?>" width="60" height="60" ></td>

<td><?php echo $c_contact; ?></td>

<td><?php echo ucwords($customer_role); ?></td>

<td>

<a href="index.php?customer_delete=<?php echo $c_id; ?>" >

<i class="fa fa-trash-o" ></i> Borrar

</a>

</td>

</tr>

<?php } ?>

</tbody><!-- tbody Ends -->

</table><!-- table table-bordered table-hover table-striped Ends -->

</div><!-- table-responsive Ends -->

<center>

<ul class="pagination">

<?php

$page = 1;

$per_page = 10;

//Now select all from table

$query = "select * from countries order by 1 DESC LIMIT 0,20";

$result = mysqli_query($con, $query);

// Count the total records
$total_records = mysqli_num_rows($result);

//Using ceil function to divide the total records on per page
$total_pages = ceil($total_records / $per_page);

//Going to first page

echo "<li class='page-item' ><a href='index.php?countries_pagination=1' class='page-link' >".'Primera'. "</a><li> ";

for ($i=1; $i<=$total_pages; $i++) {		

echo "<li "; 

if($i == $page){

echo "class='page-item active'";	
	
}

echo "><a href='index.php?countries_pagination=".$i."' class='page-link' >".$i."</a></li>";

};

// Going to last page
echo "<li class='page-item'><a href='index.php?countries_pagination=$total_pages' class='page-link' >".'Última'."</a></li> ";

?>

</ul>

</center>

</div><!-- panel-body Ends -->

</div><!-- panel panel-default Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 2 row Ends --> 

<?php } ?>