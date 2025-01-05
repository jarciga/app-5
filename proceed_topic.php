<?php
  include 'sql_statements.php';
  $student_id=$_GET['student'];
  $get_id=$_GET['id'];

  $score=select_info_multiple_key("select * from score_pretest
where student_id=$student_id and teacher_class_id=$get_id");
	$sqlw = select_info_multiple_key("SELECT * FROM pretest_question where quiz_id = '$get_id'
    and qtype='pretest' ORDER BY RAND()");
    $qt = count($sqlw);
$total=round((($score[0]['score']/$qt)*100));

$file=select_info_multiple_key("select * from files where class_id=$get_id and percentile between $total and 100");
if($file)
{

$ctr=0;
    foreach($file as $f)
    {
        $file_student=select_info_multiple_key("select * from file_student where
        file_id='".$f['file_id']."' and student_id='".$student_id."' ");
        if($file_student)
        {

        }
        else
        {
          if($ctr==0)  insert_update_delete("insert into file_student values('','".$f['file_id']."',$student_id)");
    $ctr=1;
        }
    }
}
header("Location:progress_student.php?id=".$get_id);
?>