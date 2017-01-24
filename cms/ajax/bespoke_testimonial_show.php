<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$row_testimonial=$cnt->getPageContent(15);
?>
<ul class="polaroid">
    <li style="width:940px;">
        <div class="polaroidlabel" style="height:auto;">
            <div style="padding:20px;">
                <?php echo stripslashes($row_testimonial['content_desc']); ?>
            	<br /><h3><?php echo stripslashes($row_testimonial['content_title']); ?></h3>
            </div>        
        </div>
        <div class="polaroidoption">
            <a href="ajax/bespoke_testimonial_edit.php?id=15" class="bespoke_testimonial_edit fancybox.ajax"><img src="images/icon_edit.png" width="24" height="24" border="0" /></a>
        </div>
    </li>
</ul>
<div class="clearboth"></div>
<script>
$(function(){
    $('.bespoke_testimonial_edit').fancybox({
        beforeClose: function(){
            $.ajax({
                url: 'ajax/bespoke_testimonial_show.php',
                type: 'post',
                data: {},
                success: function(data){
                    $('#bespoke_testimonial_block').html(data);
                }
            });	
        }
    });
});
</script>