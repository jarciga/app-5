<div class="span3" id="">
    <div class="row-fluid">
                      <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-left"><h4> Learning Materials</h4></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">

                               <table border=1>
                                    <tbody>
                                        <tr>
                                            <th>Description </th>
                                            <th>Download  </th>

                                        </tr>

                                    </tbody>

                                    <?php

                                    $score=select_info_multiple_key("select * from score_pretest
where student_id=$session_id and teacher_class_id=$get_id");
	$sqlw = mysql_query("SELECT * FROM pretest_question where quiz_id = '$get_id'
    and qtype='pretest' ORDER BY RAND()");
    $qt = mysql_num_rows($sqlw);
$total=round((($score[0]['score']/$qt)*100));

$file=select_info_multiple_key("select * from files where class_id=$get_id and percentile between $total and 100");
if($file)
{
    $check_file=select_info_multiple_key("select * from file_student where file_id='".$file[0]['file_id']."' and student_id=$session_id");
    if($check_file)
    {

    }
    else
    {

        insert_update_delete("insert into file_student values('','".$file[0]['file_id']."','".$session_id."')");
    }
    foreach($file as $f)
    {
        $check=select_info_multiple_key("select * from file_student where file_id='".$f['file_id']."' and student_id=$session_id");

        echo "<tr> ";

        if($check)
        {
         echo "  <td><a href=downloadable_student.php?id=$get_id&file_id=".$f['file_id'].">".$f['fname']."</a></td>
         <td>
         	 <a data-placement='bottom' title='Download' href=".$file[0]['floc']."  target=_blank  class='btn btn-info'><i class='icon-download icon-large'></i></a>
         </td>
         ";
        }
        else
        {
          echo "  <td>".$f['fdesc']."</td>";
        }
        echo "</tr>";
    }
}
                                    ?>


                               </table>

                                </div>
                            </div>
                        </div>
                        <!-- /block -->


    </div>
</div>