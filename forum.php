<?php include('session.php'); ?>
<?php include('header_dashboard.php'); ?>

<?php include('sql_statements.php'); ?>
<?php $get_id = $_GET['id']; ?>
    <body>
		<?php include('navbar_teacher.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('forum_link.php'); ?>
                <div class="span9" id="content">
                     <div class="row-fluid">
						<div class="pull-right">

                        </div>
						<?php //include('my_students_breadcrums.php'); ?>
                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-right">
							   Forum
								</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <?php
                                   
                                    include 'forum/index.php';
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