<?php include('session.php'); ?>
<?php include('header_dashboard.php'); ?>

<?php include('sql_statements.php'); ?>
    <body>
		<?php include('navbar_student.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('student_sidebar.php'); ?>
                <div class="span9" id="content">
                     <div class="row-fluid">
					    <!-- breadcrumb -->


					     <ul class="breadcrumb">
						<?php
						$school_year_query = mysql_query("select * from school_year order by school_year DESC")or die(mysql_error());
						$school_year_query_row = mysql_fetch_array($school_year_query);
						$school_year = $school_year_query_row['school_year'];
						?>
							<li><a href="#"><b>My Class</b></a><span class="divider">/</span></li>
							<li><a href="#">School Year: <?php echo $school_year_query_row['school_year']; ?></a></li>
						</ul>
						 <!-- end breadcrumb -->



                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-right">
									<?php $query = mysql_query("select * from teacher_class_student
														LEFT JOIN teacher_class ON teacher_class.teacher_class_id = teacher_class_student.teacher_class_id
														LEFT JOIN class ON class.class_id = teacher_class.class_id
														LEFT JOIN subject ON subject.subject_id = teacher_class.subject_id
														LEFT JOIN teacher ON teacher.teacher_id = teacher_class.teacher_id
														where student_id = '$session_id' and school_year = '$school_year'
														")or die(mysql_error());
														$count = mysql_num_rows($query);
									?>
												<span class="badge badge-info"><?php echo $count; ?></span>
								</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">

  										<ul	 id="da-thumbs" class="da-thumbs">
													<?php
														if ($count != '0'){
													   while($row = mysql_fetch_array($query)){
														$id = $row['teacher_class_id'];
													?>
											<li>
												<a href="my_classmates.php<?php echo '?id='.$id; ?>">
														<img src ="<?php echo $row['thumbnails'] ?>" width="124" height="140" class="img-polaroid">
													<div>
													<span>
													<p><?php echo $row['class_name']; ?></p>

													</span>
													</div>
												</a>
												<p class="class"><?php echo $row['class_name']; ?></p>
												<p class="subject"><?php echo $row['subject_code']; ?></p>
												<p class="subject"><?php echo $row['firstname']." ".$row['lastname']?></p>


											</li>


									<?php }}
                                    else{ ?>


                                <form action="save_survey.php" method=post>
                                    <?php
                                    $check_survey=select_info_multiple_key("select * from survey_answer where id_student=$session_id
                                    order by answer desc");
                                    if($check_survey){
                                        $max=0;

                                        foreach($check_survey as $c)
                                        {
                                            if($max==0)
                                            {
                                                $type_learner[]=$c['category'];
                                                $max=$c['answer'];
                                                insert_update_delete("update survey_answer set con=1
                                                where id_survey='".$c['id_survey']."'");
                                            }
                                            else
                                            {
                                                if($max==$c['answer'])
                                                {
                                                       $type_learner[]=$c['category'];
                                                       $max=$c['answer'];
                                                        insert_update_delete("update survey_answer set con=1
                                                where id_survey='".$c['id_survey']."'");
                                                }

                                             }
                                        }
                                        echo "<div class='alert alert-info'><i class='icon-info-sign'></i>Type of Learner <br>";
                                        foreach($type_learner as $t)
                                        {
                                            echo $t."<br>";
                                        }
                                        echo "</div>";

                                    }
                                    else
                                    {
                                        echo " <h3>PERCEPTUAL LEARNING-STYLE PREFERENCE QUESTIONNAIRE</h3>
                                        <div class='alert alert-info'><i class='icon-info-sign'></i> Respond to each statement quickly, without too much thought.  Try not to change your responses after you choose them.  Please answer all the questions.</div> ";

                                        include 'survey.php';
                                    }

                                    ?>
                                </form>
                                <?php } ?>
									</ul>

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