
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="screen">
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>

<body>
<br><br>
    <div class="container">
	 <form class="form-horizontal" method="POST">
    <div class="control-group">

    <div class="controls">
    <textarea rows="3" name="post_content" class="span6" placeholder="Whats on Your Mind"></textarea>
    </div>
    </div>
   
    <div class="control-group">
    <div class="controls">
    <button name="post" type="submit" class="btn btn-info"><i class="icon-share"></i>&nbsp;Post</button>
    </div>
    </div>
	
	<div class="control-group">
	
    <div class="controls">
 
 
    <table class="table table-bordered">

    <thead>
	
    </thead>
    <tbody>
			<?php
	$query=mysql_query("select * from post")or die(mysql_error());
	while($row=mysql_fetch_array($query)){
	$id2=$row['post_id'];
	?>
	
	
    <tr>
    <td><?php echo $row['content']; ?></td>
    <td width="50">
	<?php 
	$comment_query=mysql_query("select * from comment where post_id='$id2'")or die(mysql_error());
	$count=mysql_num_rows($comment_query);
	?>
	<a href="/#<?php echo $id2; ?>" data-toggle="modal"><i class="icon-comments-alt"></i>&nbsp;<span class="badge badge-info"><?php echo $count; ?></span></a>
	</td>
    <td width="40"><a class="btn btn-danger" href="delete_post.php<?php echo '?id='.$id2; ?>"><i class="icon-trash"></i></a></td>
    </tr>
	
	    <!-- Modal -->
    <div id="<?php echo $id2; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
    </div>
    <div class="modal-body">
	
	<!----comment -->
		 <form  method="POST">
	<input type="hidden" name="id" value="<?php echo $id2; ?>">
    <textarea rows="3" name="comment_content" class="span6" placeholder="Your Comment Here"></textarea>
	<br>
	<br>
    <button name="comment" type="submit" class="btn btn-info"><i class="icon-share"></i>&nbsp;Comment</button>
	</form>
	<br>
	<br>
	
	<?php $comment=mysql_query("select * from comment where post_id='$id2'")or die(mysql_error());
	while($comment_row=mysql_fetch_array($comment)){ ?>

	<div class="alert alert-success"><?php echo $comment_row['content']; ?></div>
	
	<?php } ?>
	<!--- end comment -->
	
	
	
    </div>
    <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
   
    </div>
    </div>
	
	<?php  } ?>
    </tbody>
    </table>
 

    </div>
    </div>
	
    </form>

	
	


	
	
		
	
	
		
		
		</div>
		<?php
		if(isset($_POST['post'])){
		$post_content=$_POST['post_content'];
		
		
		mysql_query("insert into post (content) values('$post_content')")or die(mysql_error());
		header('location:index.php');
		
		
		}
		?>
		
		
			<?php
		if(isset($_POST['comment'])){
		$comment_content=$_POST['comment_content'];
		$post_id=$_POST['id'];
		
		mysql_query("insert into comment (content,post_id) values('$comment_content',$post_id)")or die(mysql_error());
		header('location:index.php');
		
		
		}
		?>
</body>
</html>