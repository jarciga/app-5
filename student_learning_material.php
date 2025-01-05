<?php include('session.php'); ?>
<?php include('sql_statements.php'); ?>
<?php include('header_dashboard.php'); ?>

<body>
		<?php include('navbar_student.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('student_learning_material_sidebar.php'); ?>
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
                                <div id="" class="muted pull-right">Learning Materials</div>
                            </div>
                            <div class="block-content collapse in">
                                <!--p style="text-align: justify">
                                Learning style refers to the preferential way in which the student absorbs, processes, comprehends and retains information. Your learning styles have more influence than you may realize. Your preferred styles guide the way you learn. By recognizing and understanding your own learning styles, you can use techniques better suited to you. This improves the speed and quality of your learning.

                                </p>
                                <p style="text-align: justify">
                                Using the Learning Style Survey Questionnaire, the following are your preferred learning styles in studying this course.

                                </p-->

                                <?php
                                    /*$check_survey=select_info_multiple_key("select * from survey_answer where id_student=".$session_id." and con=1");
                                                                            
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
                                    }*/

                                    $result1 = mysql_query("SELECT s.*, sa.* FROM student AS s
                                    LEFT JOIN survey_answer AS sa ON s.student_id = sa.id_student WHERE s.student_id = " . $session_id . " ORDER BY sa.category ASC") or die(mysql_error());

                                   $num_rows1 = mysql_num_rows($result1);

                                    /*if ($num_rows1 == 0) {
                                        echo '<span class="label label-important">No Learning Style</span><br>';
                                    } else {
                                        echo '<span class="label label-success">Rank by<br>Learning Style</span><br>';
                                    }*/

                                    //http://localhost/lms/lms/admin/uploads/5496_File_sample.pdf

                                    $base_url = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/';

                                    while ($row1 = mysql_fetch_array($result1)) {
                                        //echo' <span class="badge badge-info" title="Total Survey Answer: ' . $row['answer'] . '">' . $rank_counter . '. ' . $row['category'] . '</span><br>';
                                        //var_dump($row);
                                        echo '<h5>' . ucwords($row1['category']) . ' - <span class="label label-default">Learning Materials</span></h5>';

                                        $result2 = mysql_query("SELECT l1.*, ll1.*, fs1.*, f1.* FROM file_student as fs1
                                        INNER JOIN files as f1 ON fs1.file_id = f1.file_id
                                        INNER JOIN learner_learning AS ll1 ON f1.file_id = ll1.id_file
                                        INNER JOIN learner AS l1 ON ll1.id_learner = l1.id_learner
                                        WHERE fs1.student_id = " . $row1['student_id'] . " AND l1.learners = '" . ucwords($row1['category']) . "'") or die(mysql_error());
                                        $num_rows2 = mysql_num_rows($result2);

                                        if ($num_rows2 == 0) {
                                            echo '<span class="label label-info" title="No Learning Material">No Learning Material</span><br>';
                                        }
                                        
                                        echo '<ul style="list-style:none; padding-left:0; margin-left:0;">';
                                        while ($row2 = mysql_fetch_array($result2)) {
                                            /*if ($row2['learning_type'] == 'Video') {
                                                echo '<li><a href="' . $row2['reference'] . '" title="' . $row2['learning_type'] . '">' . $row2['reference'] . ' </a><i class="icon-facetime-video"> </i></li>';
                                            } elseif($row2['learning_type'] == 'Document') {
                                                echo '<li> <a href="' . $row2['reference'] . '" title="' . $row2['learning_type'] . '">' . $row2['reference'] . ' </a><i class="icon-file"></i></li>';   
                                            }*/

                                            echo '<a href = "' . $base_url.rawurldecode($row2['floc']) . '" title = "' . ucwords($row2['fdesc']) . '" target="_blank">' . ucwords($row2['fname']) . '</a>';
                                        }
                                        echo '</ul><hr>';

                                    }
                                ?>
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