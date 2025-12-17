<?php
$location = explode('/',$_SERVER['HTTP_REFERER'])[3];
$table = explode('.',$location)[0];
echo "$table and $location";
include("config.php");
$id = $_GET['id'];
$stm = mysqli_prepare($conn,"delete from $table where id=?");
mysqli_stmt_bind_param($stm,'i',$id);
mysqli_stmt_execute( $stm );
header("location:$location");