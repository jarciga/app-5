<?php include('session.php'); ?>
<?php include('header_dashboard.php'); ?>

<?php include('sql_statements.php'); ?>
<?php $get_id = $_GET['id']; ?>
    <body>
        <?php include('navbar_teacher.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <?php include('quiz_link.php'); ?>
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
                            <li><a href="#"><b> Quiz</b></a></li>
                        </ul>
                         <!-- end breadcrumb -->
                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-left"></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">

                                   <form action=assign_quiz.php method=post>
                                      <table cellpadding="0" cellspacing="0" border="0" class="table" id="">

                                    <?php include('modal_delete_class_quiz.php'); ?>

                                        <thead>
                                                <tr>

                                                <th>Quiz title</th>
                                                <th>Description</th>
                                                <th>QUIZ TIME (IN MINUTES)</th>
                                                <th>Assign to a Learning Materials</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                      <?php

                                        $query = mysql_query("select * FROM class_quiz
                                        LEFT JOIN quiz ON quiz.quiz_id  = class_quiz.quiz_id
                                        where teacher_class_id = '$get_id'
                                        order by date_added DESC ")or die(mysql_error());
                                        while($row = mysql_fetch_array($query)){
                                        $id  = $row['class_quiz_id'];
                                    ?>
                                        <tr id="del<?php echo $id; ?>">

                                        <td><?php echo $row['quiz_title']; ?></td>
                                         <td><?php  echo $row['quiz_description']; ?></td>
                                         <td><?php  echo $row['quiz_time'] / 60; ?></td>
                                         <td><?php
                                              $files=select_info_multiple_key("select * from files
                                              where class_id=$get_id");
                                          ?>

                                <?php echo  "<select name=a".$row['quiz_id']." onchange=validate(this.value,$id,$get_id);   class=input required>"; ?>
                                        <option></option>
                                    <?php
                                    if($files)
                                    {
                                        foreach($files as $f)
                                        {
                                            $selected="";
                                            if($row['file_id']==$f['file_id'])$selected="selected=selected";
                                          echo "<option $selected value=".$f['file_id'].">".$f['fname']." </option>";
                                        }
                                     echo "<input id=q".$row['class_quiz_id']." type=hidden value='".$row['class_quiz_id']."' />";
                                    }

                                    ?>

                                </select>

                                </td>


                                        </tr>
                                    <?php } ?>
                                        </tbody>
                                    </table>
                                    </form>

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
            url='update_quiz.php?file_id='+a+'&class_quiz_id='+id+'&get_id='+get_id;
           // alert(url);
          window.location=url;
         }
</script>