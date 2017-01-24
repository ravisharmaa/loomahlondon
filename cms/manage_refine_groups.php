<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
?>
<h1>Refine Groups</h1>
<div class="clearboth"></div>
<div class="breadcrumb">
	<a href="login.php">Dashboard</a> &raquo; Refine Groups
</div>
<div class="info">
    Provided below are the groups of refine tags.
    <br /><br />
    Click the "Add a group" button below if you wish to add a group.
    <br /><br />
    Click on the pencil icon to manage its tags.
    <br /><br />
    In the unlikely event that you wish to delete a group, click on the cross icon associated with it. You will be shown a warning alert should you wish to do this.
    <br /><br />
    If you wish to change the order in which groups are displayed, you can drag and drop a group to an alternative position.
</div>
<div class="myadd">
    <a href="ajax/refine_group_add.php" class="refine_group_add fancybox.ajax">Add a group</a>
</div>
<div class="clearboth"></div>
<script>
$(function(){
	$('.refine_group_add').fancybox();	
});
</script>
<div id="refine_group_block">
    <div class="pleasewait">Please wait...</div>
    <script>
    $(function(){
        $.ajax({
            url: 'ajax/refine_group_show.php',
            type: 'post',
            data: {},
            success: function(data){
                $('#refine_group_block').html(data);
            }
        });
    });
    </script>
</div>
