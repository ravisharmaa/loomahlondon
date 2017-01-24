<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$content_id=2;
$show_tab="cat_list";
?>
<h1>Mirror Gallery</h1>
<div class="clearboth"></div>
<div class="breadcrumb">
	<a href="login.php">Dashboard</a> &raquo; Mirror Gallery
</div>
<div class="accordion"><a href="JavaScript:void(0);" rel="page_content" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="page_content") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT TITLE, HEAD PARAGRAPH AND SELECT FEATURED FRAMES</a></div>
<div id="page_content" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="page_content")?"block":"none"; ?>;">
	<div class="info">
    	Please provide the title and head paragraph for the mirror gallery page that you wish to have.
    </div>
    <?php
	$row_content=$cnt->getPageContent($content_id);
	?>
    <form id="form_page_content">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Title</td>
        <td class="formright"><input type="text" name="content_title" value="<?php echo stripslashes($row_content['content_title']); ?>" class="mytextbox" /></td>
    </tr>
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
				url: 'ajax/content_save.php',
				type: 'post',
				data: $('#form_page_content').serialize(),
				success: function(){
					$('.saving').fadeOut(function(){
						$('.saved').fadeIn(function(){
							$(this).fadeOut(2000,function(){
								t.show();	
							});
						});	
					});
				}
			})
		});
	});
	</script>
    <div class="info">
        Provided below are the categories that are displayed as featured frames.
        <br /><br />
        Click the "Select a category" button below if you wish to select a category as featured frame.
        <br /><br />
        In the unlikely event that you wish to remove a category from featured frames, click on the cross icon associated with it. You will be shown a warning alert should you wish to do this.
        <br /><br />
        If you wish to change the order in which categories are displayed, you can drag and drop a category to an alternative position.
    </div>
    <div class="myadd">
    	<a href="ajax/featured_cat_add.php" class="featured_cat_add fancybox.ajax">Select a category</a>
    </div>
    <div class="clearboth"></div>
	<script>
	$(function(){
		$('.featured_cat_add').fancybox({
			beforeClose: function(){
				$.ajax({
					url: 'ajax/featured_cat_show.php',
					type: 'post',
					data: {},
					success: function(data){
						$('#featured_block').html(data);
					}
				});	
			}
		});	
	});
	</script>
    <div id="featured_block">
    	<div class="pleasewait">Please wait...</div>
		<script>
		$(function(){
			$.ajax({
				url: 'ajax/featured_cat_show.php',
				type: 'post',
				data: {},
				success: function(data){
					$('#featured_block').html(data);
				}
			});
		});
		</script>
	</div>
</div>
<div class="accordion"><a href="JavaScript:void(0);" rel="cat_list" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="cat_list") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO MANAGE CATEGORIES WITHIN THE MIRROR GALLERY PAGE</a></div>
<div id="cat_list" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="cat_list")?"block":"none"; ?>;">
    <div class="info">
    	Please provide the title and head paragraph for the other categories section that you wish to have.
    </div>
    <?php
	$row_content2=$cnt->getPageContent(4);
	?>
    <form id="form_page_content2">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Title</td>
        <td class="formright"><input type="text" name="content_title" value="<?php echo stripslashes($row_content2['content_title']); ?>" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">Head Paragraph</td>
        <td class="formright"><textarea name="content_desc" class="myeditor"><?php echo stripslashes($row_content2['content_desc']); ?></textarea></td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright" style="height:36px;">
        	<input type="button" value="Save" class="mybtn save_content2" />
        	<div class="saving">Saving...</div>
            <div class="saved">Successfully Saved.</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="content_id" value="4" />
    </form>
    <script>
	$(function(){
		$('.save_content2').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/content_save.php',
				type: 'post',
				data: $('#form_page_content2').serialize(),
				success: function(){
					$('.saving').fadeOut(function(){
						$('.saved').fadeIn(function(){
							$(this).fadeOut(2000,function(){
								t.show();	
							});
						});	
					});
				}
			})
		});
	});
	</script>
        
    <div class="info">
        Provided below are the categories that feature within the mirror gallery page.
        <br /><br />
        Click the "Add a category" button below if you wish to add a category.
        <br /><br />
        Click on the image or pencil icon to manage its constituent products.
        <br /><br />
        In the unlikely event that you wish to delete a category, click on the cross icon associated with it. You will be shown a warning alert should you wish to do this.
        <br /><br />
        If you wish to change the order in which categories are displayed, you can drag and drop a category to an alternative position.
    </div>
    <div class="myadd">
    	<a href="ajax/cat_add.php" class="cat_add_link fancybox.ajax">Add a category</a>
    </div>
    <div class="clearboth"></div>
	<script>
	$(function(){
		$('.cat_add_link').fancybox();	
	});
	</script>
    <div id="cat_block">
    	<div class="pleasewait">Please wait...</div>
		<script>
		$(function(){
			$.ajax({
				url: 'ajax/cat_show.php',
				type: 'post',
				data: {},
				success: function(data){
					$('#cat_block').html(data);
				}
			});
		});
		</script>
	</div>
</div>


<div class="accordion"><a href="JavaScript:void(0);" rel="page_seo" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="page_seo") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT SEO FOR THE MIRROR GALLERY PAGE</a></div>
<div id="page_seo" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="page_seo")?"block":"none"; ?>;">
	<div class="info">
    	Please provide the SEO contents for the mirror gallery page that you wish to have.
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
        <td class="formright">
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
						$('.saved').fadeIn().delay(1000).fadeOut(function(){
							t.show();	
						});	
					});
				}
			})
		});
	});
	</script>
</div>