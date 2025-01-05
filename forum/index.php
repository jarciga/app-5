<?php
include('header.php');
 //echo $get_id;
?>
<body>
<br><br>
    <div class="container">
	 <form class="form-horizontal" method="POST">
    <div class="control-group">

    <div class="controls">
    <textarea rows="3" name="post_content" class="span6" placeholder=""></textarea>
    </div>
    </div>
   
    <div class="control-group">
    <div class="controls">
    <button name="post" type="submit" class="btn btn-info"><i class="icon-share"></i>&nbsp;Post</button>
    </div>
    </div>
	
	<div class="control-group">
	
    <div class="controls">
 

    <table border=1>

    <thead>
	
    </thead>
    <tbody>
			<?php
	$query=mysql_query("select * from post where subject_id='".$get_id."'")or die(mysql_error());
	while($row=mysql_fetch_array($query)){
	$id=$row['post_id'];
	?>
	
	
    <tr>
    <td width=400><?php echo $row['content']; ?></td>
    <td width="10">
	<?php 
	$comment_query=mysql_query("select * from comment where post_id='$id'")or die(mysql_error());
	$count=mysql_num_rows($comment_query);
	?>
	<a href="#<?php echo $id; ?>" data-toggle="modal"><i class="icon-comments-alt"></i>&nbsp;<span class="badge badge-info"><?php echo $count; ?></span></a>
	</td>
    <?php
      if($session_id==$row['user_id'])
      {  // echo $session_id;

    echo "<td width=20><a class='btn btn-danger' href=forum/delete_post.php?id=".$id."&get_id=".$get_id."><i class='icon-trash'></i></a></td>";

     }
     else
     {
         echo "<td>&nbsp;</td>";
     }
   ?>
    </tr>
	
	    <!-- Modal -->
    <div id="<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
    </div>
    <div class="modal-body">
	
	<!----comment -->
		 <form  method="POST">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
    <textarea rows="3" name="comment_content" class="span6" placeholder="Your Comment Here"></textarea>
	<br>
	<br>
    <button name="comment" type="submit" class="btn btn-info"><i class="icon-share"></i>&nbsp;Comment</button>
	</form>
	<br>
	<br>
	
	<?php $comment=mysql_query("select * from comment where post_id='$id'")or die(mysql_error());
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
		
		
		mysql_query("insert into post (content,user_id,subject_id) values('$post_content',$session_id,$get_id)")or die(mysql_error());
	   //	header('location:forum.php?id='.$get_id);
         echo "<script >
                   window.location='forum.php?id=$get_id';
         </script>";

		}
		?>
		
		
			<?php
		if(isset($_POST['comment'])){
		$comment_content=$_POST['comment_content'];
		$post_id=$_POST['id'];
		
		mysql_query("insert into comment (content,post_id) values('$comment_content',$post_id)")or die(mysql_error());
	   echo "<script >
                   window.location='forum.php?id=$get_id';
         </script>";

		
		}
		?>
</body>
</html>