<?php include('session.php'); ?>
<?php include('header_dashboard.php'); ?>

<?php include('sql_statements.php'); ?>
<?php $get_id = $_GET['id']; ?>
    <body>
		<?php include('navbar_student.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('downloadable_link_student.php'); ?>
                <div class="span6" id="content">
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
							<li><a href="#"><b>Downloadable Materials</b></a></li>
						</ul>
						 <!-- end breadcrumb -->

                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">


                                <div id="" class="muted pull-right"><span class="badge badge-info"><?php //echo $count; ?></span></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
										<div class="pull-left">
                                   <?php
                                   if(isset($_GET['file_id']))
                                   {
                                     $file_content=select_info_multiple_key("select * from files
                                     where file_id='".$_GET['file_id']."'");
                                     if($file_content)
                                     {
                                          echo "<h2>Discussion</h2>";
                                         echo $file_content[0]['content'];

                                     $survey_answer=select_info_multiple_key("select * from survey_answer
                                     where id_student=$session_id and con=1");
                                     if($survey_answer)
                                     {
                                         echo "<h3>Reference</h3>";
                                         foreach($survey_answer as $s)
                                         {

                                             $learner=select_info_multiple_key("select * from learner l,learner_learning ll where
                                             l.id_learner=ll.id_learner and  learners='".$s['category']."'
                                             and id_file='".$_GET['file_id']."'");

                                             if($learner)
                                             {    echo "<h4>".$s['category']."</h4>";
                                                 foreach($learner as $l)
                                                 {
                                                     echo "<h5>
                                                     <a href=".$l['reference']." target=_blank>".$l['reference']."</a>
                                                     </h5>";
                                                 }
                                             }
                                         }
                                     }
                                     }
                                     }
                                   ?>
							</div>


                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
				<?php

                 include('downloadable_content.php');


                 ?>
            </div>
		<?php include('footer.php'); ?>
        </div>
		<?php include('script.php'); ?>
    </body>
</html>