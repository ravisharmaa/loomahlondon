<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$refine_group_sn=0;
$row_refine_groups=$rfn->showRefineGroups();
if(count($row_refine_groups))
{
	?>
	<ul id="sorter_refine_group" class="polaroid">
    	<?php    
    	foreach($row_refine_groups as $row_refine_group)
		{
			?>
            <li id="sortdata_refine_group_<?php echo $row_refine_group['refine_group_id']; ?>">
                <div class="polaroidlabel">
                    <div class="tr">
                    	<div class="td">
                        	<span class="refine_group_sn"><?php echo ++$refine_group_sn; ?></span>. <?php echo $row_refine_group['refine_group_name']; ?>
                		</div>
                	</div>        
                </div>
                <div class="polaroidoption">
                    <a href="login.php?p_id=manage_refine_tags&id=<?php echo $row_refine_group['refine_group_id']; ?>"><img src="images/icon_edit.png" width="24" height="24" border="0" /></a>
                    <a href="JavaScript:void(0);" class="refine_group_del" rel="<?php echo $row_refine_group['refine_group_id']; ?>"><img src="images/icon_delete.png" width="24" height="24" border="0" /></a>
                </div>
            </li>
			<?php
		}
		?>
	</ul>
	<div class="clearboth"></div>
	<script>
    $(function(){
        $("#sorter_refine_group").sortable({ 
            opacity: 0.6, cursor: 'move', update: function(){
                var order=$(this).sortable('serialize'); 
                $.post("ajax/refine_group_sort.php", order, function(theResponse){
                    var refine_group_sn=0;
                    $('.refine_group_sn').each(function(){
                        $(this).html(++refine_group_sn);
                    });
                }); 															 
            }								  
        });
        $('.refine_group_del').click(function(){
            if(confirm("Are you sure that you wish to delete this group?\nOn deleting the group, all the tags under this group will be unlinked.")){
                var t=$(this);
                $.ajax({
                    url: 'ajax/refine_group_delete.php',
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
    <div class="unavailable">No groups are available in refine section. If you wish to add, click the "Add a group" button above.</div>
    <?php	
}
?>