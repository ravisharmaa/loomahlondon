<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$show_tab="content_parts";
$content_id=$_REQUEST['id'];
$row_content=$cnt1->showContent($content_id);
?>
<h1><?php echo stripslashes($row_content['content_name']); ?></h1>
<div class="goback">
	<?php
	if($row_content['parent_id']==6)
	{
		?>
    	<a href="login.php?p_id=manage_aboutus">Back to About Us</a> 
    	<?php
	}
	else if($row_content['parent_id']==16)
	{
		?>
    	<a href="login.php?p_id=manage_otherservices">Back to Other Services</a> 
    	<?php
	}
	?>
</div>
<div class="clearboth"></div>
<div class="breadcrumb">
	<a href="login.php">Dashboard</a> &raquo; 
    <?php
	if($row_content['parent_id']==6)
	{
		?>
    	<a href="login.php?p_id=manage_aboutus">About Us</a> 
    	<?php
	}
	else if($row_content['parent_id']==16)
	{
		?>
    	<a href="login.php?p_id=manage_otherservices">Other Services</a> 
    	<?php
	}
	?>
    &raquo; <?php echo stripslashes($row_content['content_name']); ?>
</div>

<div class="accordion"><a href="JavaScript:void(0);" rel="content_detail" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="content_detail") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT THE CONTENT NAME</a></div>
<div id="content_detail" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="content_detail")?"block":"none"; ?>;">
	<div class="info">
        Provide the content name that you wish to update.
    </div>
    <form id="form_content_edit">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Content Name</td>
        <td class="formright"><input type="text" name="content_name" value="<?php echo stripslashes($row_content['content_name']); ?>" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright" style="height:36px;">
        	<input type="button" value="Save" class="mybtn content_edit" />
        	<div class="saving">Saving...</div>
            <div class="saved">Successfully Saved.</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="content_id" value="<?php echo $content_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.content_edit').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/content_edit.php',
				type: 'post',
				data: $('#form_content_edit').serialize(),
				success: function(){
					$('.saving').fadeOut(function(){
						$('.saved').show().delay(1000).hide(function(){
							t.show();
						});	
					});
				}
			})
		});
	});
	</script>
</div>

<div class="accordion"><a href="JavaScript:void(0);" rel="content_parts" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="content_parts") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT THE CONTENT FOR THE PAGE</a></div>
<div id="content_parts" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="content_parts")?"block":"none"; ?>;">
    <div class="insert_options">
        <h3>Add more content to your page</h3>
        <a href="ajax/content_part_add.php?id=<?php echo $content_id; ?>&type=Title" class="add_part fancybox.ajax"><img src="images/icons/title.png" border="0" /><br />Title</a>
        <a href="ajax/content_part_add.php?id=<?php echo $content_id; ?>&type=Text" class="add_part fancybox.ajax"><img src="images/icons/text.png" border="0" /><br />Text Only</a>
        <a href="ajax/content_part_add.php?id=<?php echo $content_id; ?>&type=Image" class="add_part fancybox.ajax"><img src="images/icons/image.png" border="0" /><br />Image Only</a>
        <a href="ajax/content_part_add.php?id=<?php echo $content_id; ?>&type=TextImage" class="add_part fancybox.ajax"><img src="images/icons/textimage.png" border="0" /><br />Text &amp; Image</a>
        <a href="ajax/content_part_add.php?id=<?php echo $content_id; ?>&type=Gallery" class="add_part fancybox.ajax"><img src="images/icons/gallery.png" border="0" /><br />Gallery</a>
        <a href="ajax/content_part_add.php?id=<?php echo $content_id; ?>&type=Link" class="add_part fancybox.ajax"><img src="images/icons/link.png" border="0" /><br />Link</a>
        <a href="ajax/content_part_add.php?id=<?php echo $content_id; ?>&type=File" class="add_part fancybox.ajax"><img src="images/icons/file.png" border="0" /><br />File</a>
        <a href="ajax/content_part_add.php?id=<?php echo $content_id; ?>&type=Video" class="add_part fancybox.ajax"><img src="images/icons/video.png" border="0" /><br />Video</a>
        <a href="ajax/content_part_add.php?id=<?php echo $content_id; ?>&type=FAQ" class="add_part fancybox.ajax"><img src="images/icons/faq.png" border="0" /><br />FAQs</a>
        <div class="clearboth"></div>
        <script>
        $(function(){
            $('.add_part').fancybox({
                'beforeClose': function(){
                    $.ajax({
                        type: 'post',
                        url: 'ajax/content_part_show.php',
                        data: { id: '<?php echo $content_id; ?>' },
                        success: function(data){
                            $('#content_paragraph_block').html(data);
                            $('.saving').hide();
                        }   
                    });	
                }						
            });
            $('.youtube_video').fancybox();
        });
        </script>
    </div>
	<div id="content_paragraph_block">
    	<script>
		$(function(){
			$.ajax({
				type: 'post',
				url: 'ajax/content_part_show.php',
				data: { id: '<?php echo $content_id; ?>' },
				success: function(data){
					$('#content_paragraph_block').html(data);
				}   
			});	
        });
		</script>
	</div>
</div>

<div class="accordion"><a href="JavaScript:void(0);" rel="content_seo" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="content_seo") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT SEO FOR THE PAGE</a></div>
<div id="content_seo" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="content_seo")?"block":"none"; ?>;">
	<div class="info">
    	Please provide the SEO contents for the case study page that you wish to have.
    </div>
    <form id="form_content_seo">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Title tag</td>
        <td class="formright"><input type="text" name="content_titletag" value="<?php echo stripslashes($row_content['content_titletag']); ?>" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">Meta keywords</td>
        <td class="formright"><textarea name="content_metakeywords" class="mytextarea"><?php echo stripslashes($row_content['content_metakeywords']); ?></textarea></td>
    </tr>
    <tr>
        <td class="formleft">Meta description</td>
        <td class="formright"><textarea name="content_metadescription" class="mytextarea"><?php echo stripslashes($row_content['content_metadescription']); ?></textarea></td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright" style="height:36px;">
        	<input type="button" value="Save" class="mybtn save_seo" />
        	<div class="saving">Saving...</div>
            <div class="saved">Successfully Saved.</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="content_id" value="<?php echo $content_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.save_seo').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/content_seo_save.php',
				type: 'post',
				data: $('#form_content_seo').serialize(),
				success: function(){
					$('.saving').fadeOut(function(){
						$('.saved').show().delay(1000).hide(function(){
							t.show();	
						});	
					});
				}
			})
		});
	});
	</script>
</div>