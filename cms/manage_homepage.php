<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$content_id=1;
$show_tab="slide_show";
?>
<h1>Home Page</h1>
<div class="clearboth"></div>
<div class="breadcrumb">
	<a href="login.php">Dashboard</a> &raquo; Home Page
</div>


<div class="accordion"><a href="JavaScript:void(0);" rel="slide_show" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="slide_show") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO MANAGE IMAGES FOR THE SLIDESHOW</a></div>
<div id="slide_show" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="slide_show")?"block":"none"; ?>;">
	<div class="info">
        Provided below are the slide images that feature within the home page.
        <br /><br />
        Click the "Add a slide image" button below if you wish to add a slide image.
        <br /><br />
        Click on the image or pencil icon of a slide image to manage its detail.
        <br /><br />
        In the unlikely event that you wish to delete a slide image, click on the cross icon associated with it. You will be shown a warning alert should you wish to do this.
        <br /><br />
        If you wish to change the order in which slide images are displayed, you can drag and drop a slide image to an alternative position.
    </div>
    <div class="myadd">
    	<a href="ajax/home_slideimage_add.php" class="slide_add_link fancybox.ajax">Add a slide image</a>
    </div>
    <div class="clearboth"></div>
	<script>
	$(function(){
		$('.slide_add_link').fancybox({
			'beforeClose': function(){
				$.ajax({
					url: 'ajax/home_slideimage_show.php',
					type: 'post',
					data: {},
					success: function(data){
						$('#slideshow_block').html(data);
					}
				});	
			}
		});
	});
	</script>
    <div id="slideshow_block">
    	<div class="pleasewait">Please wait...</div>
		<script>
		$(function(){
			$.ajax({
				url: 'ajax/home_slideimage_show.php',
				type: 'post',
				data: {},
				success: function(data){
					$('#slideshow_block').html(data);
				}
			});
		});
		</script>
	</div>
</div>

<div class="accordion"><a href="JavaScript:void(0);" rel="quick_links" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="quick_links") echo "style='background: url(images/tgdown.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO MANAGE SCROLLING LINKS IN THE FOOTER</a></div>
<div id="quick_links" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="quick_links")?"block":"none"; ?>;">

	<div class="info">
        Provided below are the scrolling link images that feature within the home page.
        <br /><br />
        Click the "Add a scrolling link image" button below if you wish to add an image.
        <br /><br />
        Click on the image or pencil icon of a scrolling link image to manage its detail.
        <br /><br />
        In the unlikely event that you wish to delete an image, click on the cross icon associated with it. You will be shown a warning alert should you wish to do this.
        <br /><br />
        If you wish to change the order in which scrolling link images are displayed, you can drag and drop a scrolling link image to an alternative position.
    </div>
    <div class="myadd">
    	<a href="ajax/home_scrolling_link_add.php" class="scroll_add_link fancybox.ajax">Add a scrolling link image</a>
    </div>
    <div class="clearboth"></div>
	<script>
	$(function(){
		$('.scroll_add_link').fancybox({
			'beforeClose': function(){
				$.ajax({
					url: 'ajax/home_scrolling_link_show.php',
					type: 'post',
					data: {},
					success: function(data){
						$('#scroll_block').html(data);
					}
				});	
			}
		});
	});
	</script>
    <div id="scroll_block">
    	<div class="pleasewait">Please wait...</div>
		<script>
		$(function(){
			$.ajax({
				url: 'ajax/home_scrolling_link_show.php',
				type: 'post',
				data: {},
				success: function(data){
					$('#scroll_block').html(data);
				}
			});
		});
		</script>

</div>
</div>


<div class="accordion"><a href="JavaScript:void(0);" rel="page_seo" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="page_seo") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT SEO FOR THE HOME PAGE</a></div>
<div id="page_seo" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="page_seo")?"block":"none"; ?>;">
	<div class="info">
    	Please provide the SEO contents for the home page that you wish to have.
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