<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$refine_group_id=$_POST['id'];
$refine_tag_sn=0;
$row_refine_tags=$rfn->showRefineTags($refine_group_id);
if(count($row_refine_tags))
{
	?>
	<ul id="sorter_refine_tag" class="polaroid">
    	<?php    
    	foreach($row_refine_tags as $row_refine_tag)
		{
			?>
            <li id="sortdata_refine_tag_<?php echo $row_refine_tag['refine_tag_id']; ?>">
                <div class="polaroidlabel">
                    <div class="tr">
                    	<div class="td">
                        	<span class="refine_tag_sn"><?php echo ++$refine_tag_sn; ?></span>. <?php echo $row_refine_tag['refine_tag_name']; ?>
                		</div>
                	</div>        
                </div>
                <div class="polaroidoption">
                    <a href="ajax/refine_tag_edit.php?id=<?php echo $row_refine_tag['refine_tag_id']; ?>" class="refine_tag_edit fancybox.ajax"><img src="images/icon_edit.png" width="24" height="24" border="0" /></a>
                    <a href="JavaScript:void(0);" class="refine_tag_del" rel="<?php echo $row_refine_tag['refine_tag_id']; ?>"><img src="images/icon_delete.png" width="24" height="24" border="0" /></a>
                </div>
            </li>
			<?php
		}
		?>
	</ul>
	<div class="clearboth"></div>
	<script>
    $(function(){
        $("#sorter_refine_tag").sortable({ 
            opacity: 0.6, cursor: 'move', update: function(){
                var order=$(this).sortable('serialize'); 
                $.post("ajax/refine_tag_sort.php", order, function(theResponse){
                    var refine_tag_sn=0;
                    $('.refine_tag_sn').each(function(){
                        $(this).html(++refine_tag_sn);
                    });
                }); 															 
            }								  
        });
        $('.refine_tag_edit').fancybox({
            beforeClose: function(){
				$.ajax({
					url: 'ajax/refine_tag_show.php',
					type: 'post',
					data: { id: '<?php echo $refine_group_id; ?>' },
					success: function(data){
						$('#refine_tag_block').html(data);
					}
				});	
			}
        });
		$('.refine_tag_del').click(function(){
            if(confirm("Are you sure that you wish to delete this tag?")){
                var t=$(this);
                $.ajax({
                    url: 'ajax/refine_tag_delete.php',
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
    <div class="unavailable">No tags are available in this refine group. If you wish to add, click the "Add a tag" button above.</div>
    <?php	
}
?>