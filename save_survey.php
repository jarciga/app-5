<?php
  include 'sql_statements.php';
  echo "<pre>";
   //   print_r($_POST);
  echo"</pre>";
    $visual=($_POST['q6']+$_POST['q10']+$_POST['q12']+$_POST['q24']+$_POST['q29'])*2;
    $tactile=($_POST['q11']+$_POST['q14']+$_POST['q16']+$_POST['q22']+$_POST['q25'])*2;
    $auditory=($_POST['q1']+$_POST['q7']+$_POST['q9']+$_POST['q17']+$_POST['q20'])*2;
    $group=($_POST['q3']+$_POST['q4']+$_POST['q5']+$_POST['q21']+$_POST['q23'])*2;
    $kinesthetic=($_POST['q2']+$_POST['q8']+$_POST['q15']+$_POST['q19']+$_POST['q26'])*2;
    $individual=($_POST['q13']+$_POST['q18']+$_POST['q27']+$_POST['q28']+$_POST['q30'])*2;
  insert_update_delete("insert into survey_answer values('','".$_POST['user']."' ,'visual',$visual,0)");
  insert_update_delete("insert into survey_answer values('','".$_POST['user']."' ,'tactile',$tactile,0)");
  insert_update_delete("insert into survey_answer values('','".$_POST['user']."' ,'auditory',$auditory,0)");
  insert_update_delete("insert into survey_answer values('','".$_POST['user']."' ,'group',$group,0)");
  insert_update_delete("insert into survey_answer values('','".$_POST['user']."' ,'kinesthetic',$kinesthetic,0)");
  insert_update_delete("insert into survey_answer values('','".$_POST['user']."' ,'individual',$individual,0)");


header("Location:dashboard_student.php");

?>