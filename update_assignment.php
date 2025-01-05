<?php
  include 'sql_statements.php';
  insert_update_delete("update assignment set file_id='".$_GET['file_id']."'
  where assignment_id='".$_GET['assignment_id']."'");
 header("Location:assignment.php?id=".$_GET['get_id']);

?>