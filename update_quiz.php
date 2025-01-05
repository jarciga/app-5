<?php
  include 'sql_statements.php';
  insert_update_delete("update class_quiz set file_id='".$_GET['file_id']."'
  where class_quiz_id='".$_GET['class_quiz_id']."'");
  header("Location:class_quiz.php?id=".$_GET['get_id']);

?>