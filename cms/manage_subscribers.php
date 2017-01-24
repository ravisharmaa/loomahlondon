<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../";
include_once($myroot."config/config.php");
?>
<style>
.hover_me:hover{
	
	 position: relative;
}
.text_box:hover{
	 opacity:0.6;
}

.delete_icon{
    color: red;
    display: none;
	position: absolute;
	right:3px;
	top:3px;
	cursor:pointer;
}

.hover_me:hover .delete_icon {
   display:block  
}

</style>
<script type="text/javascript" src="js/jquery-ui-1.10.2.custom.js"></script>

    <h1>News Subscribers </h1>
    <div class="clearboth"></div>
    <div class="breadcrumb">
        <a href="login.php">Dashboard</a> &raquo;  News Subscribers 
    </div>
	<?php
    $myquery_blog_subscribers=$blg->isSubscribed();
	if(count($myquery_blog_subscribers))
	{
		?>
        <div class="info">
        	The list of news subscribers are as follow.
        </div>
        <form method="post" action="">
        <div style="padding: 10px 0 0 10px;border:#EEE 1px solid;">
        	<script>
			$(function(){
				$('#select_all').click(function(){
					if($(this).is(':checked')){
						$('.checkboxes').prop('checked','checked');	
					}
					else{
						$('.checkboxes').removeAttr('checked');	
					}
				});	   
			});
			</script>
           <?php /*?>    
			<div style="float:left;width:200px;margin: 0 10px 10px 0;padding:10px;border:#DDD 1px solid;background:#EEE;">
                <label><input type="checkbox" id="select_all" checked /> Select All Subscribers</label>
            </div><?php */?>    
            <div class="clearboth"></div>
            <?php
			$sn=0;
            foreach($myquery_blog_subscribers as $row_blog_subscriber)
            {	
			$sn++;
                ?>
                <div class="hover_me" style="float:left;width:205px;margin: 0 10px 10px 0;padding:10px;border:#DDD 1px solid;background:#EEE;">
               		<div class="text_box">
                	<label><?php /*?><input type="checkbox" name="subscribers['<?php echo stripslashes($row_blog_subscriber['blog_subscriber_email']); ?>']" class="checkboxes" checked  /> &nbsp; <?php */?><?php echo stripslashes($row_blog_subscriber['blog_subscriber_name']); ?><br /><?php echo stripslashes($row_blog_subscriber['blog_subscriber_email']); ?></label>
                    </div>
                     
                    
                 
                <a href="JavaScript:void(0);" class="unsubscribe" rel="<?php echo $row_blog_subscriber['blog_subscriber_id']; ?>"><img class="delete_icon" src="images/icon_delete.png" width="24" height="24" border="0" /></a> 
                </div>  
                <?php
				if($sn%4==0){
					?>
                        <div class="clearboth"></div>
                    <?php
				}
            }
            ?>
            <div class="clearboth"></div>
        </div>
        
       </form>
        
        <?php
	}
	else
	{
		?>
        <p style="margin-top:20px;">Currently no subscriber is available.</p>
        <?php	
	}

?>
<script>
$('.unsubscribe').click(function(){
            if(confirm("Are you sure that you wish to unsubscribe this subscriber?")){
                var t=$(this);
                $.ajax({
                    url: 'ajax/unsubscribe.php',
                    type: 'post',
                    data: { id: t.attr('rel') },
                    success: function(data){
                        t.parent().hide();
                    }
                });	
            }
        });
</script>