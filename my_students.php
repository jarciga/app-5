<?php include('session.php'); ?>
<?php include('header_dashboard.php'); ?>

<?php include('sql_statements.php'); ?>
<?php $get_id = $_GET['id']; ?>
    <body>
		<?php include('navbar_teacher.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('class_sidebar.php'); ?>
                <div class="span9" id="content">
                     <div class="row-fluid">
						<div class="pull-right">
							<a href="add_student.php<?php echo '?id='.$get_id; ?>" class="btn btn-info"><i class="icon-plus-sign"></i> Add Student</a>
							<a onclick="window.open('print_student.php<?php echo '?id='.$get_id; ?>')"  class="btn btn-success"><i class="icon-list"></i> Student List</a>
						</div>
						<?php include('my_students_breadcrums.php'); ?>
                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-right">
								<?php
								$my_student = mysql_query("SELECT * FROM teacher_class_student
														LEFT JOIN student ON student.student_id = teacher_class_student.student_id
														INNER JOIN class ON class.class_id = student.class_id where teacher_class_id = '$get_id' order by lastname ")or die(mysql_error());


								$count_my_student = mysql_num_rows($my_student);?>
								Number of Students: <span class="badge badge-info"><?php echo $count_my_student; ?></span>
								</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
									<ul	 id="da-thumbs" class="da-thumbs">
										    <?php
														$my_student = mysql_query("SELECT * FROM teacher_class_student
														LEFT JOIN student ON student.student_id = teacher_class_student.student_id
														INNER JOIN class ON class.class_id = student.class_id where teacher_class_id = '$get_id' order by lastname ")or die(mysql_error());
														while($row = mysql_fetch_array($my_student)){
														$id = $row['teacher_class_student_id'];
														?>
											<li id="del<?php echo $id; ?>">
													<a href="#">
															<img id="student_avatar_class" src ="admin/<?php echo $row['location'] ?>" width="124" height="140" class="img-polaroid">
														<div>
														<span>
														<p><?php ?></p>

														</span>
														</div>
													</a>
													<p class="class"><?php echo $row['lastname'];?></p>
													<p class="subject"><?php echo $row['firstname']; ?></p>
                                                    <?php
                                                       //$check_survey = select_info_multiple_key("select * from survey_answer where id_student=".$row['student_id']." and con=1");
													   //$check_survey = select_info_multiple_key("SELECT * FROM survey_answer WHERE id_student=".$row['student_id']." AND con=1 ORDER BY answer DESC");
													   
													   $result = mysql_query("SELECT * FROM survey_answer WHERE id_student=".$row['student_id']." AND con=1 ORDER BY answer DESC, category ASC") or die(mysql_error());
													   $num_rows = mysql_num_rows($result);

														
														if ($num_rows == 0) {
															echo '<span class="label label-important">No Learning Style</span><br>';
														} else {
															echo '<span class="label label-success">Rank by<br>Learning Style</span><br>';
														}

														$rank_counter = 1;
														while ($row = mysql_fetch_array($result)) {
															echo' <span class="badge badge-info" title="Total Survey Answer: ' . $row['answer'] . '">' . $rank_counter . '. ' . $row['category'] . '</span><br>';
														
														$rank_counter++;
														}
														

                                                       /*if($check_survey)
                                                       {
                                                           foreach($check_survey as $s)
                                                           {
                                                               echo $s['category']."<br>";
                                                           }
                                                       }*/
                                                    ?>
													<br><a  href="#<?php echo $id; ?>" data-toggle="modal"><i class="icon-trash"></i> Remove</a>
											</li>
											<?php include("remove_student_modal.php"); ?>
											<?php } ?>
									</ul>
												<script type="text/javascript">
													$(document).ready( function() {
														$('.remove').click( function() {
														var id = $(this).attr("id");
															$.ajax({
															type: "POST",
															url: "remove_student.php",
															data: ({id: id}),
															cache: false,
															success: function(html){
																$("#del"+id).fadeOut('slow', function(){ $(this).remove();}); 
																$('#'+id).modal('hide');
																$.jGrowl("Your Student is Successfully Remove", { header: 'Student Remove' });
															}
															}); 	
															return false;
														});				
													});
												</script>
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