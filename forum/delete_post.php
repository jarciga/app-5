<?php
include('dbcon.php');
$id=$_GET['id'];
$get_id=$_GET['get_id'];

mysql_query("delete from post where post_id='".$id."'")or die(mysql_error());
header('location:../forum.php?id='.$get_id);



?>