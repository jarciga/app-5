	<?php include('dbcon.php'); ?>
	<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
		<thead>
		<tr>
			<th>Learning Style</th>
		</tr>
		</thead>
		<tbody>
			
		<?php
			$query1 = mysql_query("SELECT DISTINCT id_learner, learners FROM `learner` ORDER BY learners ASC") or die(mysql_error());
			while ($row = mysql_fetch_array($query1)) {
		?>
		<tr>
			<td>
				<?php
					$query2 = mysql_query("SELECT s.*, sa.* FROM student AS s INNER JOIN survey_answer AS sa ON s.student_id = sa.id_student WHERE sa.category = '" . strtolower(trim($row['learners'])) . "'") or die(mysql_error());
					$student_num_rows = mysql_num_rows($query2);
				?>
				<h5><?php echo strtoupper($row['learners']); ?> <small><em>- Number of Students: <span class="badge badge-info"><?php echo strtoupper($student_num_rows); ?></span></em></small></h5>
				<ul>
				<?php
					while ($row = mysql_fetch_array($query2)) {
				?>
				<li><?php echo ucwords($row['firstname']) . ' ' . ucwords($row['lastname']); ?></li>
				<?php } ?> 
				</ul>
			</td> 
		</tr>
		<?php } ?>    
	
		</tbody>
	</table>
	<!--/form-->