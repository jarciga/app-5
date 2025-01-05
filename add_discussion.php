<?php include('session.php'); ?>
<?php include('header_dashboard.php'); ?>

<?php include('sql_statements.php'); ?>
<?php $get_id = $_GET['id']; ?>
<?php $file_id = $_GET['file_id']; ?>
<?php //$subject_id = $_GET['subject_id']; ?>
    <body>
        <?php include('navbar_teacher.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
                            <?php include('downloadable_link.php'); ?>
                <div class="span9" id="content">
                     <div class="row-fluid">
                      <!-- breadcrumb -->
                                        <?php $class_query = mysql_query("select * from teacher_class
                                        LEFT JOIN class ON class.class_id = teacher_class.class_id
                                        LEFT JOIN subject ON subject.subject_id = teacher_class.subject_id
                                        where teacher_class_id = '$get_id'")or die(mysql_error());
                                        $class_row = mysql_fetch_array($class_query);
                                        $class_id = $class_row['class_id'];
                                        $school_year = $class_row['school_year'];
                                        ?>


                         <ul class="breadcrumb">
                    	<li><a href="#"><?php echo $class_row['class_name']; ?></a> <span class="divider">/</span></li>
                            <li><a href="#"><?php echo $class_row['subject_code']; ?></a> <span class="divider">/</span></li>
                            <li><a href="#">School Year: <?php echo $class_row['school_year']; ?></a> <span class="divider">/</span></li>
                            <li><a href="#"><b>Learning Materials</b></a></li>
                                </ul>
                         <!-- end breadcrumb -->

                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-right">
                                <a href="subject_overview.php<?php echo '?id='.$get_id; ?>" class="btn btn-success"><i class="icon-arrow-left"></i> Back</a>
                                </div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">

                                                        <form class="form-horizontal" method="post">
                                                                <div class="control-group">
                                                                    <label class="control-label" for="inputPassword">Discussion:</label>
                                                                    <div class="controls">
                                                                        <?php
                                                                          $query2=select_info_multiple_key("select * from files where file_id='".$_GET['file_id']."'");
                                                                        ?>
                                                                            <textarea name="content" id="ckeditor_full">
                                                                                <?php
                                                                                 echo $query2[0]['content'];
                                                                             ?>
                                                                             </textarea>
                                                                    </div>
                                                                </div>
                                                    	<div class="control-group">
                                                        <div class="controls">

                                                        <button name="save" type="submit" class="btn btn-success"><i class="icon-save"></i> Save</button>
                                                        </div>
                                                        </div>
                                                        </form>
                                                        <form class="form-horizontal" method="post">
                                                                <div class="control-group">
                                                                    <label class="control-label" for="inputPassword">Type of Learners:</label>
                                                                    <div class="controls">
                                                                            <select name=learner>
                                                                                <?php
                                                                                   $learner=select_info_multiple_key("select * from learner");
                                                                                   if($learner)
                                                                                   {
                                                                                       foreach($learner as $l)
                                                                                       {
                                                                                          echo "<option value=".$l['id_learner'].">".$l['learners']."</option>";
                                                                                       }
                                                                                   }
                                                                                ?>

                                                                            </select>
                                                                    </div>
                                                                </div>

                                                          <div class="control-group">
                                                                    <label class="control-label" for="inputPassword">Reference:</label>
                                                                    <div class="controls">
                                                                        <input type="text" name=reference />

                                                                    </div>
                                                                </div>
                                                                                                                	<div class="control-group">
                                                        <div class="controls">

                                                        <button name="addreference" type="submit" class="btn btn-success"><i class="icon-save"></i> Add Reference</button>
                                                        </div>
                                                        </div>
                                                        </form>

                                                          <div class="control-group">

                                                                    <div class="controls">
                                                                        <?php
                                                                        if (isset($_POST['addreference']))
                                                                        {
                                                                             insert_update_delete("insert into learner_learning
                                                                             values('','".$_POST['learner']."','".$file_id."','".$_POST['reference']."')");
                                                                            ?>
                                                                            <script>

                                                                            </script>
                                                                            <?php
                                                                         }
                                                                             if($learner)
                                                                             {
                                                                                 foreach($learner as $l)
                                                                                 {
                                                                                     echo "<h3>".$l['learners']."</h3>";
                                                                                     $query=select_info_multiple_key("select * from learner_learning
                                                                                     where id_learner='".$l['id_learner']."' and id_file='".$_GET['file_id']."'");
                                                                                     if($query)
                                                                                     {
                                                                                         echo "	<table cellpadding=0 cellspacing=0 border=0 class=table id=''>
                                                                                              <thead>
                                                                                                 <tr>
                                                                                                      <th>References</th>
                                                                                                 </tr>
                                                                                               </thead>";
                                                                                               foreach($query as $v)
                                                                                               {
                                                                                                   echo "<tr id=del>
                                                                                                          <td>
                                                                                                          <a href=".$v['reference']." target=_blank>".$v['reference']."></a></td>
                                                                                                   </tr>";
                                                                                               }

                                                                                         echo "</table>";
                                                                                     }
                                                                                 }
                                                                             }

                                                                        ?>

                                                                    </div>
                                                                </div>

                                        <?php
                                        if (isset($_POST['save'])){
                                        $content = $_POST['content'];
                                        mysql_query("update files set content = '$content' where file_id = '".$_GET['file_id']."'")or die(mysql_error());
                                        ?>
                                        <script>
                                            window.location = 'downloadable.php<?php echo '?id='.$get_id; ?>';
                                        </script>
                                        <?php
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