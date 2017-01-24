<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$sn_bespoke_content=0;
$row_bespoke_contents=$cnt->showBespokeContents();
if(count($row_bespoke_contents))
{
	?>
	<ul id="sorter_bespoke_content" class="polaroid">
    	<?php    
    	foreach($row_bespoke_contents as $row_bespoke_content)
		{
			?>
            <li id="sortdata_bespoke_content_<?php echo $row_bespoke_content['bespoke_content_id']; ?>" style="width:940px;">
                <div class="polaroidlabel">
                    <div class="tr">
                    	<div class="td">
                        	<span class="sn_bespoke_content"><?php echo ++$sn_bespoke_content; ?></span>. <?php echo $row_bespoke_content['bespoke_content_title']; ?>
                		</div>
                	</div>        
                </div>
                <div class="polaroidlabel" style="height:auto;">
                    <div style="padding-left:20px;">
						<?php echo $row_bespoke_content['bespoke_content_desc']; ?>
                	</div>        
                </div>
                <div class="polaroidoption">
                    <a href="ajax/bespoke_content_edit.php?id=<?php echo $row_bespoke_content['bespoke_content_id']; ?>" class="bespoke_content_edit fancybox.ajax"><img src="images/icon_edit.png" width="24" height="24" border="0" /></a>
                    <?php /* <a href="JavaScript:void(0);" class="bespoke_content_del" rel="<?php echo $row_bespoke_content['bespoke_content_id']; ?>"><img src="images/icon_delete.png" width="24" height="24" border="0" /></a> */ ?>
                </div>
            </li>
			<?php
		}
		?>
	</ul>
	<div class="clearboth"></div>
	<script>
    $(function(){
        $('.bespoke_content_edit').fancybox({
            beforeClose: function(){
				$.ajax({
					url: 'ajax/bespoke_content_show.php',
					type: 'post',
					data: {},
					success: function(data){
						$('#bespoke_content_block').html(data);
					}
				});	
			}
        });
		<?php /*
		$("#sorter_bespoke_content").sortable({ 
            opacity: 0.6, cursor: 'move', update: function(){
                var order=$(this).sortable('serialize'); 
                $.post("ajax/bespoke_content_sort.php", order, function(theResponse){
                    var sn_bespoke_content=0;
                    $('.sn_bespoke_content').each(function(){
                        $(this).html(++sn_bespoke_content);
                    });
                }); 															 
            }								  
        });
    	$('.bespoke_content_del').click(function(){
            if(confirm("Are you sure that you wish to delete this block?")){
                var t=$(this);
                $.ajax({
                    url: 'ajax/bespoke_content_delete.php',
                    type: 'post',
                    data: { id: t.attr('rel') },
                    success: function(data){
                        t.parent().parent().hide();
                    }
                });	
            }
        });
		*/ ?>
    });
    </script>
	<?php
}
else
{
	?>
    <div class="unavailable">No paragraphs are available in this page. If you wish to add, click the "Add a paragraph" button above.</div>
    <?php	
}
?>