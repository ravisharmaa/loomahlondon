<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
?>
<h1>News Categories</h1>
<div class="clearboth"></div>
<div class="breadcrumb">
	<a href="login.php">Dashboard</a> &raquo; Blog &raquo; News Categories
</div>
<div class="info">
    Provided below are the categories that feature within the news page.
    <br /><br />
    Click the "Add a category" button below if you wish to add a category.
    <br /><br />
    Click on the pencil icon to manage its detail.
    <br /><br />
    In the unlikely event that you wish to delete a category, click on the cross icon associated with it. You will be shown a warning alert should you wish to do this.
    <br /><br />
    If you wish to change the order in which categories are displayed, you can drag and drop a category to an alternative position.
</div>
<div class="myadd">
    <a href="ajax/blog_cat_add.php" class="blog_cat_add fancybox.ajax">Add a category</a>
</div>
<div class="clearboth"></div>
<script>
$(function(){
    $('.blog_cat_add').fancybox({
		beforeClose: function(){
			$.ajax({
				url: 'ajax/blog_cat_show.php',
				type: 'post',
				data: {},
				success: function(data){
					$('#blog_cat_block').html(data);
				}
			});	
		}
	});	
});
</script>
<div id="blog_cat_block">
    <div class="pleasewait">Please wait...</div>
    <script>
    $(function(){
        $.ajax({
            url: 'ajax/blog_cat_show.php',
            type: 'post',
            data: {},
            success: function(data){
                $('#blog_cat_block').html(data);
            }
        });
    });
    </script>
</div>