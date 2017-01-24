<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$refine_group_id=$_REQUEST['id'];
$show_tab="tag_list";
$row_refine_group=$rfn->showRefineGroup($refine_group_id);
?>
<h1><?php echo stripslashes($row_refine_group['refine_group_name']); ?></h1>
<div class="goback"><a href="login.php?p_id=manage_refine_groups">Back to Refine Groups</a></div>
<div class="clearboth"></div>
<div class="breadcrumb">
	<a href="login.php">Dashboard</a> &raquo; <a href="login.php?p_id=manage_refine_groups">Refine Groups</a> &raquo; <?php echo stripslashes($row_refine_group['refine_group_name']); ?>
</div>

<div class="accordion"><a href="JavaScript:void(0);" rel="refine_group_content" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="refine_group_content") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT REFINE GROUP NAME</a></div>
<div id="refine_group_content" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="refine_group_content")?"block":"none"; ?>;">
	<div class="info">
    	Please provide the refine group name that you wish to have.
    </div>
    <form id="form_refine_group_edit">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Group Name</td>
        <td class="formright"><input type="text" name="refine_group_name" value="<?php echo stripslashes($row_refine_group['refine_group_name']); ?>" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright" style="height:36px;">
        	<input type="button" value="Save" class="mybtn save_refine_group" />
        	<div class="saving">Saving...</div>
            <div class="saved">Successfully Saved.</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="refine_group_id" value="<?php echo $refine_group_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.save_refine_group').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/refine_group_save.php',
				type: 'post',
				data: $('#form_refine_group_edit').serialize(),
				success: function(){
					$('.saving').fadeOut(function(){
						$('.saved').fadeIn(function(){
							$(this).fadeOut(2000,function(){
								t.show();	
							});
						});	
					});
				}
			});
		});
	});
	</script>
</div>

<div class="accordion"><a href="JavaScript:void(0);" rel="tag_list" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="tag_list") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO MANAGE TAGS WITHIN THIS REFINE GROUP</a></div>
<div id="tag_list" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="tag_list")?"block":"none"; ?>;">
	<div class="info">
        Provided below are the tags that feature within this refine group.
        <br /><br />
        Click the "Add a tag" button below if you wish to add a tag.
        <br /><br />
        Click on the pencil icon to edit the tag.
        <br /><br />
        In the unlikely event that you wish to delete a tag, click on the cross icon associated with it. You will be shown a warning alert should you wish to do this.
        <br /><br />
        If you wish to change the order in which tags are displayed, you can drag and drop a tag to an alternative position.
    </div>
    <div class="myadd">
    	<a href="ajax/refine_tag_add.php?id=<?php echo $refine_group_id; ?>" class="refine_tag_add fancybox.ajax">Add a tag</a>
    </div>
    <div class="clearboth"></div>
	<script>
	$(function(){
		$('.refine_tag_add').fancybox({
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
	});
	</script>
    <div id="refine_tag_block">
    	<div class="pleasewait">Please wait...</div>
		<script>
		$(function(){
			$.ajax({
				url: 'ajax/refine_tag_show.php',
				type: 'post',
				data: { id: '<?php echo $refine_group_id; ?>' },
				success: function(data){
					$('#refine_tag_block').html(data);
				}
			});
		});
		</script>
	</div>
</div>