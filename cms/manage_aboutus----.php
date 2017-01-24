<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$content_id=6;
$show_tab="sub_pages";
?>
<h1>About Us</h1>
<div class="clearboth"></div>
<div class="breadcrumb">
	<a href="login.php">Dashboard</a> &raquo; About Us
</div>

<div class="accordion"><a href="JavaScript:void(0);" rel="page_content" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="page_content") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO CHANGE BANNER AND HEAD PARAGRAPH FOR THE ABOUT US PAGE</a></div>
<div id="page_content" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="page_content")?"block":"none"; ?>;">
	<div class="info">
    	Please provide the banner and head paragraph for the about us page that you wish to have.
    </div>
    <?php
	$row_content=$cnt->getPageContent($content_id);
	$row_content_banner=$cnt->contentBanner($content_id);
	?>
    <form id="form_page_content">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Banner Title</td>
        <td class="formright"><input type="text" name="content_banner_title" value="<?php echo stripslashes($row_content_banner['content_banner_title']); ?>" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">Banner Description</td>
        <td class="formright"><textarea name="content_banner_desc" class="myeditor"><?php echo stripslashes($row_content_banner['content_banner_desc']); ?></textarea></td>
    </tr>
    <?php
	if(empty($row_content_banner['content_banner_image']))
	{
		?>
        <tr>
            <td class="formleft">Upload Banner Image</td>
            <td class="formright"><input type="file" id="content_banner_image" name="content_banner_image" value="" />
                                  <b class="line_height"><br />The uploaded image will appear on the top of about us page.
            <br /><br />The dimensions of the image should be <?php echo BANNER_IMG_W; ?> px in width.
            <br /><br>The height may vary with a maximum height of <?php echo BANNER_IMG_H; ?> px. For example a wider (landscape shaped) product may not required as much height as a square shaped product or portrait shaped product.
            </b></td>
        </tr>
		<?php
	}
	else
	{
		?>
    	<tr>
            <td class="formleft">Banner Image</td>
            <td class="formright"><img src="../<?php echo BANNER_IMG.$row_content_banner['content_banner_image']; ?>" width="695" /></td>
        </tr>
		<tr>
            <td class="formleft"></td>
            <td class="formright"><input type="file" id="content_banner_image" name="content_banner_image" />
            <b class="line_height"><br />The uploaded image will appear on the top of about us page.
            <br /><br />The dimensions of the image should be <?php echo BANNER_IMG_W; ?> px in width.
            <br /><br>The height may vary with a maximum height of <?php echo BANNER_IMG_H; ?> px. For example a wider (landscape shaped) product may not required as much height as a square shaped product or portrait shaped product.
            <br /><br />If you decide to upload a new image, it will replace the existing one. 
            </b></td>
        </tr>
		<?php
	}
	?>
<?php /*?>    <tr>
        <td class="formleft">Title</td>
        <td class="formright"><input type="text" name="content_title" value="<?php echo stripslashes($row_content['content_title']); ?>" class="mytextbox" /></td>
    </tr><?php */?><input type="hidden" name="content_title" value="<?php echo stripslashes($row_content['content_title']); ?>" class="mytextbox" />
    <tr>
        <td class="formleft">Head Paragraph</td>
        <td class="formright"><textarea name="content_desc" class="myeditor"><?php echo stripslashes($row_content['content_desc']); ?></textarea></td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright" style="height:36px;">
        	<input type="button" value="Save" class="mybtn save_content" />
        	<div class="saving">Saving...</div>
            <div class="saved">Successfully Saved.</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="content_id" value="<?php echo $content_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.save_content').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/bespoke_content_and_banner_save.php',
				type: 'post',
				data: $('#form_page_content').serialize(),
				success: function(){
					$("#content_banner_image").upload("ajax/content_banner_image_upload.php?id=<?php echo $content_id; ?>",function(res){
						$('.saving').fadeOut(function(){
							$('.saved').fadeIn(function(){
								$(this).fadeOut(function(){
									t.show();
								});
							});
						});
					},function(data){
					});
				}
			})
		});
	});
	</script>
</div>

<div class="accordion"><a href="JavaScript:void(0);" rel="sub_pages" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="sub_pages") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO MANAGE THE SUB-PAGES FOR THE ABOUT US PAGE</a></div>
<div id="sub_pages" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="sub_pages")?"block":"none"; ?>;">
	<div class="info">
        Provided below are the contents for the sub-pages that feature within the about us page.
        <br /><br />
        Click the "Add a page" button below if you wish to add a page.
        <br /><br />
        Click on the pencil icon to edit the contents of the page.
        <br /><br />
        In the unlikely event that you wish to delete a page, click on the cross icon associated with it. You will be shown a warning alert should you wish to do this.
        <br /><br />
        If you wish to change the order in which pages are displayed, you can drag and drop a page to an alternative position.
    </div>
    <div class="myadd">
    	<a href="ajax/content_add.php?id=<?php echo $content_id; ?>" class="content_add fancybox.ajax">Add a page</a>
    </div>
    <div class="clearboth"></div>
	<script>
	$(function(){
		$('.content_add').fancybox({
			beforeClose: function(){
				$.ajax({
					url: 'ajax/content_show.php',
					type: 'post',
					data: { id: '<?php echo $content_id; ?>' },
					success: function(data){
						$('#content_block').html(data);
					}
				});
			}
		});
	});
    </script>
    <div id="content_block">
    	<div class="pleasewait">Please wait...</div>
		<script>
		$(function(){
			$.ajax({
				url: 'ajax/content_show.php',
				type: 'post',
				data: { id: '<?php echo $content_id; ?>' },
				success: function(data){
					$('#content_block').html(data);
				}
			});
		});
		</script>
	</div>
</div>

<div class="accordion"><a href="JavaScript:void(0);" rel="page_seo" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="page_seo") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT SEO FOR THE ABOUT US PAGE</a></div>
<div id="page_seo" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="page_seo")?"block":"none"; ?>;">
	<div class="info">
    	Please provide the SEO contents for the about us page that you wish to have.
    </div>
    <?php
	$row_seo=$cnt->getPageSEO($content_id);
	?>
    <form id="form_page_seo">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Title tag</td>
        <td class="formright"><input type="text" name="content_titletag" value="<?php echo stripslashes($row_seo['content_titletag']); ?>" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">Meta keywords</td>
        <td class="formright"><textarea name="content_metakeywords" class="mytextarea"><?php echo stripslashes($row_seo['content_metakeywords']); ?></textarea></td>
    </tr>
    <tr>
        <td class="formleft">Meta description</td>
        <td class="formright"><textarea name="content_metadescription" class="mytextarea"><?php echo stripslashes($row_seo['content_metadescription']); ?></textarea></td>
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
				data: $('#form_page_seo').serialize(),
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