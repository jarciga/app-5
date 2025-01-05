<?php include 'session.php';
  include 'sql_statements.php';
?>
<pre>

    <?php
   //   print_r($_POST);
    ?>

</pre>

<?php

     $file_id=$_POST['file_id'];
     //echo $file_id;
  $pretest=select_info_multiple_key("select * from quiz_question where
  quiz_id='".$_POST['quiz_id']."'");
  $ctr=0;
  if($pretest)
  {
      foreach($pretest as $p)
      {
        if($_POST[$p['quiz_question_id']]==$p['answer'])
        {
            $ctr++;
        }

      }
  }

  $score=(($ctr/count($pretest))*40)+60;

  if($score<75)
  {
 $check_survey=select_info_multiple_key("select * from survey_answer where id_student=".$session_id."
            and con=1");
  $msg="Sorry, you failed the assessment of this chapter. To help you pass, the following are references you might read and watch which are based from your learning style.<br>";
                                                       if($check_survey)
                                                       {
                                                           foreach($check_survey as $s)
                                                           {

                                                               $query=select_info_multiple_key("select * from learner
                                                               where learners='".$s['category']."'");
                                                               if($query)
                                                               {

                                                                 $reference=select_info_multiple_key("select * from learner_learning
                                                                 where id_file='".$file_id."' and id_learner='".$query[0]['id_learner']."'");
                                                                 if($reference)
                                                                 {    $msg=$msg."&nbsp;&nbsp;<b>".$s['category']."</b><br>";
                                                                     foreach($reference as $r)
                                                                     {
                                                                         $msg=$msg."&nbsp;&nbsp;<a target=_blank href=".$r['reference'].">".$r['reference']."</a><br>";
                                                                     }
                                                                 }
                                                               }
                                                           }
                                                       }
                                                      // echo $msg;
$teacher=select_info_multiple_key("select * from teacher_class tc, teacher t
where tc.teacher_id=t.teacher_id and teacher_class_id='".$_GET['id']."'");
$student=select_info_multiple_key("select * from student where student_id='".$session_id."'");

$teacher_name=$teacher[0]['firstname']."&nbsp;".$teacher[0]['lastname'];
$student_name=$student[0]['firstname']."&nbsp;".$student[0]['lastname'];

insert_update_delete("insert into message(reciever_id,content,date_sended,sender_id,reciever_name,sender_name) values('".$session_id."','".$msg."',NOW(),'".$teacher[0]['teacher_id']."','".$student_name."','".$teacher_name."')");
insert_update_delete("insert into message_sent(reciever_id,content,date_sended,sender_id,reciever_name,sender_name) values('".$session_id."','".$msg."',NOW(),'".$teacher[0]['teacher_id']."','".$student_name."','".$teacher_name."')");
//mysql_query("insert into message_sent (reciever_id,content,date_sended,sender_id,reciever_name,sender_name) values('$teacher_id','$my_message',NOW(),'$session_id','$name','$name1')")or die(mysql_error());

   }
 insert_update_delete("insert into student_class_quiz values('','".$_POST['class_quiz_id']."','".$session_id."','0','".$ctr."')");
  //echo "insert into student_class_quiz values('','".$_POST['quiz_id']."','".$session_id."','0','".$ctr."')";
 header("Location:student_quiz_list.php?id=".$_GET['id']);
 echo "<br>Score ". $ctr;


?>