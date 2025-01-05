<?php include('session.php'); ?>
<?php include('header_dashboard.php'); ?>

<?php $get_id = $_GET['id']; ?>
    <body>
		<?php include('navbar_teacher.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('pretest_link.php'); ?>
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
							<li><a href="#"><b>Subject Overview</b></a></li>
						</ul>
						 <!-- end breadcrumb -->
                        <!-- block -->


                        <!-- /block -->


                        <!-- pre test-->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-right">
                                              
										     <a href="add_pretest.php<?php echo '?qtype=pretest&id='.$get_id; ?>" class="btn btn-success"><i class="icon- plus-sign"></i> Add Question</a>

								</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
		<form action="delete_quiz_question.php" method="post">
									<input type="hidden" name="get_id" value="<?php echo $get_id; ?>">
  									<table cellpadding="0" cellspacing="0" border="0" class="table" id="">

									<?php include('modal_delete_quiz_question.php'); ?>
										<thead>
										        <tr>
												<th></th>
												<th>Question Text</th>
												<!-- <th>Points</th> -->
												<th>Question Type</th>
												<th>Answer</th>
												<th>Date Added</th>
												<th></th>
												</tr>
										</thead>
										<tbody>
                              		<?php
										$query = mysql_query("select * FROM pretest_question
										LEFT JOIN question_type on pretest_question.question_type_id = question_type.question_type_id
										where quiz_id = '$get_id' and qtype='pretest'  order by date_added DESC ")or die(mysql_error());
										while($row = mysql_fetch_array($query)){
										$id  = $row['quiz_question_id'];
									?>
										<tr id="del<?php echo $id; ?>">
										<td width="30">
											<input id="optionsCheckbox" class="" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
										</td>
												<td><?php echo $row['question_text']; ?></td>
												<td><?php  echo $row['question_type']; ?></td>
												<td><?php  echo $row['answer']; ?></td>
												<td><?php echo $row['date_added']; ?></td>
											<?php



                                            ?>
										</tr>
									<?php } ?>
										</tbody>
									</table>
									</form>

                                </div>
                            </div>
                        </div>



        



                    </div>
                </div>
            </div>
		<?php include('footer.php'); ?>
        </div>
		<?php include('script.php'); ?>
    </body>
</html>