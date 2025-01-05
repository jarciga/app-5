<?php include('session.php'); ?>
<?php include('header_dashboard.php'); ?>

<?php include('sql_statements.php'); ?>
<?php $get_id = $_GET['id']; ?>
    <body>
        <?php include('navbar_teacher.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <?php include('progress_link.php'); ?>
                <div class="span9" id="content">
                     <div class="row-fluid">
                       <!-- breadcrumb -->
                                        <?php $class_query = mysql_query("select * from teacher_class
                                        LEFT JOIN class ON class.class_id = teacher_class.class_id
                                        LEFT JOIN subject ON subject.subject_id = teacher_class.subject_id
                                        where teacher_class_id = '$get_id'")or die(mysql_error());
                                        $class_row = mysql_fetch_array($class_query);
                                        ?>
                         <ul class="breadcrumb">
                            <li><a href="#"><?php echo $class_row['class_name']; ?></a> <span class="divider">/</span></li>
                            <li><a href="#"><?php echo $class_row['subject_code']; ?></a> <span class="divider">/</span></li>
                            <li><a href="#">School Year: <?php echo $class_row['school_year']; ?></a> <span class="divider">/</span></li>
                            <li><a href="#"><b>Student Progress</b></a></li>
                        </ul>
                         <!-- end breadcrumb -->
                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-left"></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">

                                <?php
                                $ctr=0;
                                  $my_student = select_info_multiple_key("SELECT * FROM teacher_class_student
														LEFT JOIN student ON student.student_id = teacher_class_student.student_id
														INNER JOIN class ON class.class_id = student.class_id where teacher_class_id = '$get_id' order by lastname ");
                                 $files=select_info_multiple_key("select * from files
                                 where class_id=$get_id");
                                 if($files)
                                 {
                                     foreach($files as $f)
                                     {
                                      //   echo "<h3>".$f['fdesc']."</h3>";
                                          if($my_student)
                                          {
                                              echo "<table border=1 cellspacing=10 cellpadding=10>
                                                <tr>
                                                       <th>Name</th>
                                                       <th>Quiz</th>

                                                       <th>Assignment</th>
                                                       <th>Grade</th>

                                                </tr>";

                                                foreach($my_student as $m)
                                                {

                                                     $score=select_info_multiple_key("select * from score_pretest
where student_id='".$m['student_id']."' and teacher_class_id=$get_id");
	$sqlw = select_info_multiple_key("SELECT * FROM pretest_question where quiz_id = '$get_id'
    and qtype='pretest' ORDER BY RAND()");
    $qt = count($sqlw);
$total=round((($score[0]['score']/$qt)*100));

                                                    $score_quiz=select_info_multiple_key("select * from quiz q,class_quiz cq ,student_class_quiz sq
                                                    where q.quiz_id=cq.quiz_id and cq.class_quiz_id=sq.class_quiz_id and file_id='".$f['file_id']."'
                                                    and student_id='".$m['student_id']."'");

                                                      $quiz_items=select_info_multiple_key("select * from quiz q ,quiz_question qq
                                                    where q.quiz_id=qq.quiz_id  and file_id='".$f['file_id']."'");

                                                   echo "<tr>
                                                    <td>".$m['firstname']." ".$m['lastname']."</td>";
                                                   if( $score_quiz)
                                                   { $quiz_grade=((($score_quiz[0]['grade']/count($quiz_items))*40)+60);
                                                    echo "<td>".$quiz_grade." </td>";
                                                   }
                                                   else
                                                   {
                                                       $quiz_grade="";
                                                    echo "<td>&nbsp;</td>";
                                                   }

                                                   $assignment=select_info_multiple_key("select * from assignment a, student_assignment sa
                                                   where a.assignment_id=sa.assignment_id and file_id='".$f['file_id']."'
                                                   and student_id='".$m['student_id']."'");
                                                 $totalscore=(($assignment[0]['grade']*.5)+($quiz_grade*.5));
                                                 if($totalscore >=75)
                                                 {
                                                     $file=select_info_multiple_key("select * from files where class_id='".$get_id."' and percentile between ".$total." and 100
                                                                        and file_id not in (select file_id from file_student where student_id='".$m['student_id']."'  )
                                                                        order by file_id ");
                                                     if($file)
                                                     {
                                                         insert_update_delete("insert into file_student values('','".$file[0]['file_id']."','".$m['student_id']."')");
                                                     }
                                                     else
                                                     {
                                                         $posttest=select_info_multiple_key("select * from postest_activate where subject_id='".$get_id."' and student_id='".$m['student_id']."'");
                                                         if($posttest)
                                                         {

                                                         }
                                                         else
                                                         {
                                                             insert_update_delete("insert into postest_activate values('','".$get_id."','".$m['student_id']."')");
                                                         }
                                                     }
                                                 }

                                                     echo "<td>".$assignment[0]['grade']."</td>";
                                                     echo "<td>".$totalscore."</td>";
                                                      /*
                                                     if($total>=$f['percentile'] && $score)
                                                     {
                                                         echo "<td>Excempted</td>";
                                                     }
                                                     else
                                                     {
                                                         $file_student=select_info_multiple_key("select * from file_student where
                                                      file_id='".$f['file_id']."' and student_id='".$m['student_id']."' ");
                                                      if($file_student)
                                                      {
                                                          echo "<td>
                                                        Yes
                                                          </td>
                                                     ";
                                                      }
                                                      else
                                                      {
                                                         echo "<td>
                                                        <a href=proceed_topic.php?student=".$m['student_id']."&id=$get_id>No</a>
                                                        </td>
                                                     ";
                                                      }

                                                      }
                                                      */
                                                  echo" </tr>";
                                                }
                                                echo "</table>";
                                          }
                                     }
                                 }



                                ?>

                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>


                </div>

            </div>
        <?php include('footer.php'); ?>
        </div>
        <?php include('script.php'); ?>
    </body>
</html>


<script>
         function validate(a,q,get_id)
         {

            x="q"+q;
            id=document.getElementById(x).value;
            url='update_quiz.php?file_id='+a+'&quiz_id='+id+'&get_id='+get_id;
           // alert(url);
            window.location=url;
         }
</script>