<?php include('session.php'); ?>
<?php include('sql_statements.php'); ?>
<?php include('header_dashboard.php'); ?>

<body>
		<?php include('navbar_student.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('backpack_sidebar.php'); ?>
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
										<li><a href="#">School Year: <?php echo $school_year_query_row['school_year']; ?></a><span class="divider">/</span></li>
										<li><a href="#"><b>Learning Style</b></a></li>
									</ul>
						 <!-- end breadcrumb -->
                        <!-- block -->
                        <div id="block_bg" class="block">

                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-right">Learning Style</div>
                            </div>
                      <p style="text-align: justify">
                      Learning style refers to the preferential way in which the student absorbs, processes, comprehends and retains information. Your learning styles have more influence than you may realize. Your preferred styles guide the way you learn. By recognizing and understanding your own learning styles, you can use techniques better suited to you. This improves the speed and quality of your learning.

                      </p>
                      <p style="text-align: justify">
                      Using the Learning Style Survey Questionnaire, the following are your preferred learning styles in studying this course.

                      </p>

                       <?php
                                                       $check_survey=select_info_multiple_key("select * from survey_answer where id_student=".$session_id."
                                                                                                and con=1");
                                                                                             
                                                       if($check_survey)
                                                       {
                                                           foreach($check_survey as $s)
                                                           {
                                                               echo "<h3>". $s['category']." major learning style preference</h3>";
                                                               $query=select_info_multiple_key("select * from learner
                                                               where learners='".$s['category']."'");
                                                               if($query)
                                                               {
                                                                   echo $query[0]['content_style'];
                                                               }
                                                           }
                                                       }
                                                    ?>

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