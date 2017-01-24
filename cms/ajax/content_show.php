<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$content_id=$_POST['id'];
$row_contents=$cnt1->showContents($content_id);
if(count($row_contents))
{
	?>
	<ul id="sorter" class="polaroid">
		<?php
		$sn_content=0;
		foreach($row_contents as $row_content)
		{
			?>
			<li id="sortdata_<?php echo $row_content['content_id']; ?>" style="width:940px;"> 
            <a href="login.php?p_id=manage_content&id=<?php echo $row_content['content_id']; ?>" style="text-decoration:none; color:#333; margin-top:15px; ">
				<div class="polaroidlabel">
                	<div class="tr">
                    	<div class="td">
                    		<span class="sn_content"><?php echo ++$sn_content; ?></span>. <?php echo stripslashes($row_content['content_name']); ?>
						</div>
                	</div>    
                </div>
                 </a>    
				<div class="polaroidoption">
					<a href="login.php?p_id=manage_content&id=<?php echo $row_content['content_id']; ?>"><img src="images/icon_edit.png" width="24" height="24" border="0" /></a>
					<a href="JavaScript:void(0);" class="content_del" rel="<?php echo $row_content['content_id']; ?>"><img src="images/icon_delete.png" width="24" height="24" border="0" /></a>
				</div>
			</li>
			<?php
		}
		?>
	</ul>
	<div class="clearboth"></div>
	<script>
    $(function(){
        $("#sorter").sortable({ 
            opacity: 0.6, cursor: 'move', update: function(){
                var order=$(this).sortable('serialize'); 
                $.post("ajax/content_sort.php", order, function(theResponse){
                    var sn_content=0;
					$('.sn_content').each(function(){
						$(this).html(++sn_content);
					});
                }); 															 
            }								  
        });
        $('.content_del').click(function(){
            if(confirm("Are you sure that you wish to delete this page?")){
                var t=$(this);
                $.ajax({
                    url: 'ajax/content_delete.php',
                    type: 'post',
                    data: { id: t.attr('rel') },
                    success: function(data){
                        t.parent().parent().hide();
                    }
                });	
            }
        });
    });
    </script>
    <?php
}
else
{
	?>
    <div class="unavailable">No pages are available. If you wish to add a page, click the "Add a page" button above.</div>
    <?php
}
?>