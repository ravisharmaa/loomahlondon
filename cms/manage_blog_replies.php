<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$blog_id=$_REQUEST['id'];
$row_blog=$blg->showBlog($blog_id);
?>
<h1>Replies: <?php echo stripslashes($row_blog['blog_title']); ?></h1>
<div class="goback"><a href="login.php?p_id=manage_blogs">Back to News</a></div>
<div class="clearboth"></div>
<div class="breadcrumb">
	<a href="login.php">Dashboard</a> &raquo; News &raquo; <a href="login.php?p_id=manage_blogs">All News</a> &raquo; Replies
</div>
<div class="info">
    Provided below are the replies that are shown just below the news.
    <br /><br />
    Click on the pencil icon to manage its detail.
</div>
<div class="clearboth"></div>
<div id="blog_block">
    <div class="pleasewait">Please wait...</div>
    <script>
    $(function(){
        $.ajax({
            url: 'ajax/blog_reply_show.php',
            type: 'post',
            data: { id: '<?php echo $blog_id; ?>' },
            success: function(data){
                $('#blog_block').html(data);
            }
        });
    });
    </script>
</div>